<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;



class AuthController extends Controller
{
    public function authenticate(Request $request){

        $data = $request->validate([
            'userLogin' => ['required', 'regex:/^[0-9a-zA-Z-_]+$/', 'min:8', 'max:30'],
            'userPassword' => ['required', 'regex:/^[0-9a-zA-Z]+$/', 'min:8', 'max:70']
        ]);

        if(Auth::attempt($data)) {
            $request->session()->regenerate();
            $acc_type = DB::select('SELECT * FROM Auth_data WHERE login=(?)', [$request->input('userLogin')]);
            $request->session()->put('accountType', strval($acc_type));
            return redirect()->to('cabinet_route');
        }

        return ['error' => 'Пользователь с такими данными не найден! Попробуйте еще раз.'];
    }




}