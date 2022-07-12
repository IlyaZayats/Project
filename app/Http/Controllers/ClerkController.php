<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ClerkController extends Controller
{
    function isClerk(Request $request) : bool {
        return $request->session()->has('accountType') && $request->session()->get('accountType')==3;
    }

    function getMessages(Request $request){
        if($this->isClerk($request)){
            $id_messages = collect(DB::table('Messages_cond')->where('worker', 'worker')->select('id_message')->get())->all();
            $data = array();
            //$ITNs = array();
            $i=0;
            foreach ($id_messages as $item) {
                $data[$i] = current(collect(DB::table('Messages')->where('id_message', $item->id_message)->get())->all());
                //$ITN[$i] = DB::table('');
                $i++;
            }
            //return view ('test', ['bruh'=>$data]);
            return view('cabinet_clerk_messages', ['data' => $data]);
        }
        return redirect()->route('main_route');
    }

    function getAnswer(Request $request, $login, $id_msg){
        if($this->isClerk($request)){
            $ITN = DB::table('Auth_data')->where('login', $login)->value('ITN');
            session(['ITN' => $ITN]);
            $message = current(collect(DB::table('Messages')->where('id_message', $id_msg)->get())->all());
            DB::table('Messages_cond')->where('id_message', $id_msg)->update(['worker' => $request->session()->get('login')]);
            if(empty(DB::table('Messages_cond')->where('id_message', $id_msg)->value('id_answer'))){
                $id_answer = DB::table('Messages')->insertGetId(['msg_type' => 1, 'sender' => $request->session()->get('login')]);
                DB::table('Messages_rec')->insert(['id_message' => $id_answer]);
            } else {
                $id_answer = DB::table('Messages_cond')->where('id_message', $id_msg)->value('id_answer');
                DB::table('Messages')->where('id_message', $id_answer)->update(['sender' => $request->session()->get('login')]);
            }
            DB::table('Messages_cond')->where('id_message', $id_msg)->update(['id_answer' => $id_answer]);
            return view('cabinet_clerk_messages_answer', ['data' => $message]);
        }
        return redirect()->route('main_route');
    }

    function sendAnswer(Request $request){
        if($this->isClerk($request)){
            $request->validate([
                'text' => ['required', 'regex:/^[\s0-9a-zA-Z-_а-яА-Я!?,.():;]+$/u']
            ]);
            $id_answer = DB::table('Messages_cond')->where('worker', $request->session()->get('login'))->where('active', '=', 1)->value('id_answer');
            $code1 = DB::table('Messages_rec')->where('id_message', $id_answer)->update(['receiver' => DB::table('Auth_data')->where('ITN', $request->session()->get('ITN'))->value('login')]);
            date_default_timezone_set('Europe/Moscow');
            $code2 = DB::table('Messages')->where('id_message', $id_answer)->update(['text' => $request->input('text'), 'send_date' => date('Y-m-d')]);
            $code3 = DB::table('Messages_cond')->where('id_answer', $id_answer)->update(['active' => 0]);
            return ['msg' => 1, 'code' => $code1.'/'.$code2.'/'.$code3];
        }
        return ['msg' => -1, 'code' => -1];
    }
}