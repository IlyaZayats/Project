<?php

use App\Http\Controllers\RegistrationController;
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
    return view('main');
})->name('main_route');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticate']);

Route::post('/registration', [App\Http\Controllers\RegistrationController::class, 'registration']);

Route::get('/registration', function (){
    return view('registration');
})->name('registration_route');

Route::get('/cabinet', function (Request $request){
    $acc_type = '0';
    if($request->session()->has('accountType')) {
        $acc_type = $request->session()->get('accountType');
    }
    return match ($acc_type) {
        '1' => view('cabinet_user'),
        '2' => view('cabinet_clerk'),
        '3' => view('cabinet_admin'),
        default => view('main'),
    };
})->name('cabinet_route');
