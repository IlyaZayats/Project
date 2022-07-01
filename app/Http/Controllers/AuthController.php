<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    function isLoanOfficer($request): bool
    {
        return $request->session()->has('accountType') && $request->session()->get('accountType')==2;
    }

    public function goToMain(){
        $login_field = 'login';
        $pass_field = 'password';
        return view('main', ['login_field' => $login_field, 'pass_field' => $pass_field]);
    }

    public function authenticate(Request $request){

        $request->validate([
            'login' => ['required', 'regex:/^[0-9a-zA-Z-_]+$/', 'min:8', 'max:30'],
            'password' => ['required', 'regex:/^[0-9a-zA-Z]+$/', 'min:8', 'max:70']
        ]);

        $hash = DB::table('Auth_data')->where('login', $request->input('login'))->value('password');

        if(!empty(DB::select('SELECT * FROM Auth_data WHERE login=(?)', [$request->input('login')])) && password_verify($request->input('password'),$hash)){
            $request->session()->regenerate();
            $acc_type = DB::table('Auth_data')->where('login', $request->input('login'))->value('acc_type');
            $request->session()->put('accountType', $acc_type);
            $request->session()->put('login', $request->input('login'));
            return ['type' => 0, 'accType' => $acc_type];
        }
        return ['type' => 1];
    }

    //Login processing
    public function cabinet_clerk(){
        return view('cabinet_clerk');
    }

    public function cabinet_user(){
        return view('cabinet_user');
    }

    public function cabinet_loan_officer(Request $request){
        if(DB::table('Application')->where('login_worker', '=', $request->session()->get('login'))->where('valid','=', 1)->doesntExist()) {
            $data = collect(DB::select('SELECT * FROM Application WHERE login_worker="login_worker"'))->all();
            return view('cabinet_loan_officer', ['data' => $data]);
        } else {
            $id_app = DB::table('Application')->where('login_worker', '=' ,$request->session()->get('login'))->where('valid', '=', 1)->value('id_app');
            $ITN = DB::table('Application')->where('login_worker', '=' ,$request->session()->get('login'))->where('valid', '=', 1)->value('ITN');
            return redirect('/application/'.$ITN.'/'.$id_app);
        }
    }

    public function cabinet(Request $request){
        if($request->session()->has('accountType')) {
            //$acc_type = $request->session()->get('accountType');
            //return $this->cabinet_loan_officer();
            //return view ('test', ['bruh'=>$acc_type]);
//            if($acc_type == 1){
//                $this->cabinet_user($request);
//            }
//            if($acc_type == 2){
//                $this->cabinet_loan_officer($request);
//            }
//            if($acc_type == 3){
//                //$this->cabinet_clerk($request);
//                return view ('test', ['bruh'=>$acc_type]);
//            }

            switch ($request->session()->get('accountType')){
                case 1:{
                    return $this->cabinet_user();
                }
                case 2:{
                    return $this->cabinet_loan_officer($request);
                }
                case 3:{
                    return $this->cabinet_clerk();
                }
                default:{
                    return redirect()->route('main_route');
                }
            }

        }
        return redirect()->route('main_route');
    }

    public function leave(Request $request){
        if($this->isLoanOfficer($request)) {
            //DB::update('UPDATE Application SET login_worker="login_worker" WHERE id_app=?', [$request->session()->get('id')]);
            DB::table('Application')->where('id_app', [$request->session()->get('id')])->update(['login_worker' => "login_worker"]);
        }
        $request->session()->flush();
        return redirect()->route('main_route');
    }



}