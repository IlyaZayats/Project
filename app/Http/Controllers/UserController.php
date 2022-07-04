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

class UserController extends Controller
{
    function isUser($request): bool
    {
        return $request->session()->has('accountType') && $request->session()->get('accountType')==1;
    }

    public static function getNotifications(Request $request){
        $msg = array();
        $id_msg = collect(DB::table('Messages_rec')->where('receiver', $request->session()->get('login'))->select('id_message')->get())->all();
        if(!empty($id_msg)){
            $i = 0;
            foreach ($id_msg as $item) {
                //$msg[$i] = current(collect(DB::table('Messages')->where('id_message', $item->id_message)->get())->all());
                $msg[$i] = collect(DB::table('Messages')->where('id_message', $item->id_message)->get());
                $i++;
            }
                //return view('test', ['bruh' => $data]);
        }
        return $msg;
            //$app_answer = collect(DB::table('Application')->where('ITN', $request->session()->get('ITN'))->select('text')->get())->all();
            //return view('cabinet_user_notifications', ['msg' => $msg, 'app'=>$app_answer]);
    }

    public static function getMesRec(Request $request){
        return collect(DB::table('Messages_rec')->where('receiver', $request->session()->get('login'))->get());
    }

    function getAdditional(Request $request){
        if($this->isUser($request)){
            $data = current(collect(DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->get())->all());
            return view('additional_data', ['data'=>$data]);
        }
        return redirect()->route('main_route');
    }

    //'file' => ['required', 'mimetypes:image/jpeg, image/png, file/pdf, file/docx, file/doc']

    function sendApplication(Request $request){
        if($this->isUser($request)){
            $request->validate([
                'sum' => ['required', 'integer', 'min:50000', 'max:15000000'],
                'term' => ['required', 'integer', 'min:12', 'max:180'],
                'fee' => ['required', 'integer']
            ]);
            DB::table('Application')->insert(['ITN' => $request->session()->get('ITN'), 'sum' => $request->input('sum'), 'term' => $request->input('term'), 'fee' => $request->input('fee')]);
            return ['msg' => 1];
        }
        return ['msg' => 0];
    }

    function addAdditional(Request $request){
        if($this->isUser($request)){

            $request->validate([
                'additional_type' => ['required', 'regex:/^[\sa-zA-Zа-яА-Я-_\d]+$/u'],
                'file' => ['mimetypes:image/jpeg, image/png, file/pdf, file/docx, file/doc'],
                'data' => ['integer', 'min:']
            ]);

            $additional_type = $request->input('additional_type');
            $code = -1;
            if(($additional_type == 'criminal_record' || $additional_type == 'income_statement') && $request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->extension();
                $path = $file->storeAs(public_path() . '/files', $additional_type . $request->session()->get('ITN') . $extension);
                $code = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->update([$additional_type => public_path() . '/files/' . $additional_type . $request->session()->get('ITN') . $extension]);
            }
            if($additional_type == 'INIPA' && !empty($request->input('data')) && strlen($request->input('data'))==11){
                $code = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->update(['INIPA' => $request->input('data')]);
            }
            if($additional_type == 'passport_data' && !empty($request->input('data')) && strlen($request->input('data'))==10){
                $code = DB::table('Registered')->where('ITN', $request->session()->get('ITN'))->update(['passport_data' => $request->input('data')]);
            }
            return ['msg' => $code];
        }
        return ['msg' => -2];
    }

    function deleteAdditional(Request $request){
        if($this->isUser($request)){
            $request->validate([
                'additional_type' => ['required', 'regex:/^[\sa-zA-Zа-яА-Я-_\d]+$/u']
            ]);
            $additional_type = $request->input('additional_type');
            $code = -1;
            if($additional_type == 'passport_data'){
                $code = DB::table('Registered')->where('ITN', $request->session()->get('ITN'))->update(['passport_data' => null]);
            } else if ($additional_type == 'INIPA' || $additional_type == 'criminal_record' || $additional_type == 'income_statement'){
                $code = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->update([$additional_type => null]);
            }
            return ['msg' => $code];
        }
        return ['msg' => -2];
    }

    function messageControl(Request $request){
        if($this->isUser($request)){
            $request->validate([
                'id' => ['required', 'integer'],
                'type' => ['required', 'regex:/^[\sa-z]+$/u']
            ]);
            if(DB::table('Messages')->where('id_message', $request->input('id'))->exists()){
                if($request->input('type') == 'shown'){
                    $code = DB::table('Messages_rec')->where('id_message', intval($request->input('id')))->update([$request->input('type') => 0]);
                } else {
                    $code = DB::table('Messages_rec')->where('id_message', intval($request->input('id')))->update(['viewed' => 1]);
                }
                return ['code' => $code];
            }
            return ['code' => -1];
        }
        return ['code' => -2];
    }
}