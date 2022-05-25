<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/registration', function (Request $request) {
    $request->wantsJson();
    $errors = false;
    if(empty($request->input('userName')) || !preg_match("/^[\sa-zA-Zа-яА-Я-]+$/", $request->input('userName'))){
        $errors = true;
    }
    if(empty($request->input('userSurname')) || !preg_match("/^[\sa-zA-Zа-яА-Я-]+$/", $request->input('userSurname'))){
        $errors = true;
    }
    if(empty($request->input('userSecondName')) || !preg_match("/^[\sa-zA-Zа-яА-Я-]+$/", $request->input('userSecondName'))){
        $errors = true;
    }
    if(empty($request->input('userITN')) || !preg_match("/^\d+$/", $request->input('userITN')) || strlen($request->input('userITN'))!=12){
        $errors = true;
    }
    if(empty($request->input('userPassport')) || !preg_match("/^\d+$/,/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $request->input('userPassport')) || strlen($request->input('userPassport'))!=10){
        $errors = true;
    }
    if(empty($request->input('userEmail')) || !preg_match("/^[\sa-zA-Zа-яА-Я-]+$/", $request->input('userEmail'))){
        $errors = true;
    }
    if(empty($request->input('userLogin')) || !preg_match("/^[0-9a-zA-Z-_]/", $request->input('userLogin')) || strlen($request->input('userLogin'))>30 || strlen($request->input('userLogin'))<8){
        $errors = true;
    }
    if(empty($request->input('userPassword')) || !preg_match("/^[0-9a-zA-Z]/", $request->input('userPassword'))){
        $errors = true;
    }

    if($errors){
        return view('registration', ['validation_errors' => true]);
    } else{
        if(empty(DB::select('SELECT * FROM Registred WHERE ITN=?',[$request->input('userITN')])) && empty(DB::select('SELECT * FROM Authentication_data WHERE login=(?)',[$request->input('userLogin')]))){
            DB::insert('INSERT INTO Registered (ITN, passport_data, email, last_name, first_name, midle_name) VALUES (?, ?, ?, ?, ?, ?)', [$request->input('userITN'), $request->input('userPassport'), $request->input('userEmail'), $request->input('userSurname'), $request->input('userName'), $request->input('userSecondName')]);
            DB::insert('INSERT INTO Authentication_data (login, ITN, password, acc_type) VALUES (?,?,?,?)', [$request->input('userLogin'), $request->input('userITN'), $request->input('userPassword'), 1]);
            return redirect('/');
        } else {
            return view('registration', ['itn_and_login_errors' => true]);
        }
    }

    //$data = json_decode(file_get_contents("php://input"));

});

Route::get('/registration', function (Request $request){
    if($request->session()->has('account') && session('account')==1){
        return view('cabinet');
    }
    if($request->session()->has('account') && session('account')==2){
        return view('inspector_cabinet');
    }
    if($request->session()->has('account') && session('account')==3){
        return view('admin_cabinet');
    }
    return view('registration');
});
