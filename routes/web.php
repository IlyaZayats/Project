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
})->name('main');

Route::post('/registration', function (Request $request) {

    $code = '0';
    $errors = false;
    if (empty($request->input('userName')) || !boolval(preg_match("/^[\sa-zA-Zа-яА-Я-]+$/u", $request->input('userName'))) || mb_strlen($request->input('userName'), 'UTF-8') > 30) {
        $errors = true;
        $code = $code.'1'.$request->input('userName').'what'.(int)(mb_strlen($request->input('userName'), 'UTF-8') > 30).'bruh'.(int)!boolval(preg_match('/^[\sa-zA-Zа-яА-Я-]+$/u', $request->input('userName')));
    }
    if (empty($request->input('userSurname')) || !boolval(preg_match('/^[\sa-zA-Zа-яА-Я-]+$/u', $request->input('userSurname'))) || mb_strlen($request->input('userSurname'), 'UTF-8') > 30) {
        $errors = true;
        $code = $code.'2'.$request->input('userSurname').'what'.(int)(mb_strlen($request->input('userSurname'), 'UTF-8') > 30).'bruh'.(int)!boolval(preg_match('/^[\sa-zA-Zа-яА-Я-]+$/u', $request->input('userSurname')));
    }
    if (empty($request->input('userSecondName')) || !boolval(preg_match('/^[\sa-zA-Zа-яА-Я-]+$/u', $request->input('userSecondName'))) || mb_strlen($request->input('userSecondName'), 'UTF-8') > 30) {
        $errors = true;
        $code = $code.'3'.$request->input('userSecondName').'what'.(int)(mb_strlen($request->input('userSecondName'), 'UTF-8') > 30).'bruh'.(int)!boolval(preg_match('/^[\sa-zA-Zа-яА-Я-]+$/u', $request->input('userSecondName')));
    }
    if (empty($request->input('userITN')) || !boolval(preg_match('/^\d+$/', $request->input('userITN'))) || strlen($request->input('userITN')) != 12) {
        $errors = true;
        $code = $code.'4'.!boolval(preg_match('/^\d+$/', $request->input('userITN'))).strlen($request->input('userITN')) != 12;
    }
    if (empty($request->input('userPassport')) || !boolval(preg_match('/^\d+$/', $request->input('userPassport'))) || strlen($request->input('userPassport')) != 10) {
        $errors = true;
        $code = $code.'5';
    }
    if (empty($request->input('userEmail')) || !boolval(preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', $request->input('userEmail'))) || mb_strlen($request->input('userEmail')) > 255) {
        $errors = true;
        $code = $code.'6';
    }
    if (empty($request->input('userLogin')) || !boolval(preg_match('/^[0-9a-zA-Z-_]+$/', $request->input('userLogin'))) || strlen($request->input('userLogin')) > 30 || mb_strlen($request->input('userLogin')) < 8) {
        $errors = true;
        $code = $code.'7';
    }
    if (empty($request->input('userPassword')) || !boolval(preg_match('/^[0-9a-zA-Z]+$/', $request->input('userPassword'))) || strlen($request->input('userPassword')) > 30 || mb_strlen($request->input('userPassword')) < 8) {
        $errors = true;
        $code = $code.'8';
    }

    if (!$errors) {
        if(empty(DB::select('SELECT * FROM Registered WHERE ITN=?', [$request->input('userITN')])) && empty(DB::select('SELECT * FROM Auth_data WHERE login=(?)', [$request->input('userLogin')]))) {
            DB::insert('INSERT INTO Registered (ITN, passport_data, email, last_name, first_name, middle_name) VALUES (?, ?, ?, ?, ?, ?)', [$request->input('userITN'), $request->input('userPassport'), $request->input('userEmail'), $request->input('userSurname'), $request->input('userName'), $request->input('userSecondName')]);
            DB::insert('INSERT INTO Auth_data (login, ITN, password, acc_type) VALUES (?,?,?,?)', [$request->input('userLogin'), $request->input('userITN'), $request->input('userPassword'), 1]);
            $type = 0;
        } else {
            $type = 1;
        }
    } else {
        $type = 2;
    }
    return ['type' => $type, 'code' => $code];
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
