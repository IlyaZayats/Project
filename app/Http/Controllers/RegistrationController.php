<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function registration(Request $request){
        $code = '0';
        $errors = false;
        if (empty($request->input('userName')) || !boolval(preg_match("/^[\sa-zA-Zа-яА-Я-]+$/u", $request->input('userName'))) || mb_strlen($request->input('userName'), 'UTF-8') > 30) {
            $errors = true;
            $code = $code.'1';
        }
        if (empty($request->input('userSurname')) || !boolval(preg_match('/^[\sa-zA-Zа-яА-Я-]+$/u', $request->input('userSurname'))) || mb_strlen($request->input('userSurname'), 'UTF-8') > 30) {
            $errors = true;
            $code = $code.'2';
        }
        if (empty($request->input('userSecondName')) || !boolval(preg_match('/^[\sa-zA-Zа-яА-Я-]+$/u', $request->input('userSecondName'))) || mb_strlen($request->input('userSecondName'), 'UTF-8') > 30) {
            $errors = true;
            $code = $code.'3';
        }
        if (empty($request->input('userITN')) || !boolval(preg_match('/^\d+$/', $request->input('userITN'))) || strlen($request->input('userITN')) != 12) {
            $errors = true;
            $code = $code.'4';
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
        if (empty($request->input('userPassword')) || !boolval(preg_match('/^[0-9a-zA-Z]+$/', $request->input('userPassword'))) || strlen($request->input('userPassword')) > 70 || mb_strlen($request->input('userPassword')) < 8) {
            $errors = true;
            $code = $code.'8';
        }

        if (!$errors) {
            if(empty(DB::select('SELECT * FROM Registered WHERE ITN=?', [$request->input('userITN')])) && empty(DB::select('SELECT * FROM Auth_data WHERE login=(?)', [$request->input('userLogin')]))) {

                $hash = Hash::make($request->input('userPassword'));

                DB::insert('INSERT INTO Registered (ITN, passport_data, email, last_name, first_name, middle_name) VALUES (?, ?, ?, ?, ?, ?)', [$request->input('userITN'), $request->input('userPassport'), $request->input('userEmail'), $request->input('userSurname'), $request->input('userName'), $request->input('userSecondName')]);
                DB::insert('INSERT INTO Auth_data (login, ITN, password, acc_type) VALUES (?,?,?,?)', [$request->input('userLogin'), $request->input('userITN'), $hash, 1]);
                $type = 0;
            } else {
                $type = 1;
            }
        } else {
            $type = 2;
        }
        return ['type' => $type, 'code' => $code];
    }

}