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

    public static function getName(Request $request){
        return DB::table('Registered')->where('ITN', $request->session()->get('ITN'))->value('first_name');
    }

    public static function getFullMsg(Request $request){
        $ITN = DB::table('Auth_data')->where('login', $request->session()->get('login'))->value('ITN');
        $msg = UserController::getNotifications($request);
        $rec = UserController::getMesRec($request);
        $full_msg = array();
        $i=0;
        foreach ($rec as $item){
            $full_msg[$i] = $msg[$i]->merge($item);
            $full_msg[$i] = $full_msg[$i]->all();
            $i++;
        }
        return $full_msg;
    }

    public static function getAmount($msg){
        $amount = 0;
        foreach ($msg as $item) {
            if ($item['viewed'] == 0) {
                $amount++;
            }
        }
        return $amount;
    }

    function getAdditional(Request $request){
        if($this->isUser($request)){
            $data = current(collect(DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->get())->all());
            $INIPA = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->value('INIPA');
            $passport_data = DB::table('Registered')->where('ITN', $request->session()->get('ITN'))->value('passport_data');
            $name = UserController::getName($request);
            $full_msg = UserController::getFullMsg($request);
            $amount = UserController::getAmount($full_msg);
            return view('cabinet_user_additional_data', ['INIPA'=>$INIPA, 'msg' => $full_msg, 'name' => $name, 'amount' => $amount, 'passport_data' => $passport_data, 'ITN' => $request->session()->get('ITN'), 'data' => $data]);

        }
        return redirect()->route('main_route');
    }

    //'file' => ['required', 'mimetypes:image/jpeg, image/png, file/pdf, file/docx, file/doc']

    function sendApplication(Request $request){
        if($this->isUser($request)){
            if(!empty($request->input('credit-type'))){
                $data = array();
                switch ($request->input('credit-type')){
                    case 'credit-dream':{
                        $request->validate([
                            'credit-dream-per' => ['required', 'integer', 'min:60', 'max:180'],
                            'credit-dream-sum' => ['required', 'integer', 'min:1000000', 'max:15000000'],
                            'monthlyPayment' => ['required', 'integer', 'min:10000', 'max:312000']
                        ]);
                        $data['fee'] = $request->input('monthlyPayment');
                        $data['term'] = $request->input('credit-dream-per');
                        $data['sum'] = $request->input('credit-dream-sum');
                        $data['loan_type'] = 3;
                        break;
                    }
                    case 'credit-card':{
                        $request->validate([
                            'credit-card-sum' => ['required', 'integer', 'min:50000', 'max:200000'],
                        ]);
                        $data['sum'] = $request->input('credit-card-sum');
                        $data['loan_type'] = 1;
                        break;
                    }
                    case 'credit-cash':{
                        $request->validate([
                            'credit-cash-per' => ['required', 'integer', 'min:12', 'max:48'],
                            'credit-cash-sum' => ['required', 'integer', 'min:50000', 'max:990000'],
                            'monthlyPayment' => ['required', 'integer', 'min:1300', 'max:87500']
                        ]);
                        $data['fee'] = $request->input('monthlyPayment');
                        $data['term'] = $request->input('credit-cash-per');
                        $data['sum'] = $request->input('credit-cash-sum');
                        $data['loan_type'] = 2;
                        break;
                    }
                    default:{
                        return ['msg' => -1, 'code' => 'invalid data'];
                    }
                }
                $id_msg = DB::table('Messages')->insertGetId(['sender' => $request->session()->get('login'), 'msg_type' => 2]);
                $code1 = DB::table('Messages_rec')->insert(['id_message' => $id_msg]);
                $id_app = DB::table('Application')->insertGETId(['ITN' => $request->session()->get('ITN'), 'sum' => $data['sum'], 'term' => $data['term'], 'fee' => $data['fee'], 'loan_type' => $data['loan_type'], 'id_message' => $id_msg]);
                $code2 = DB::table('Messages')->where('id_message', $id_msg)->update(['msg_topic' => $id_app]);
                return ['msg' => 1, 'code' => $id_msg.'/'.$code1.$code2. '/'.$id_app];
            }
            return ['msg' => -1, 'code' => -1];
        }
        return ['msg' => 0, 'code' => -1];
    }

    function uploadFile(Request $request){

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
            } else if ($additional_type == 'criminal_record' || $additional_type == 'income_statement'){
                $file_name = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->value($additional_type);
                $code = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->update([$additional_type => null]);
                Storage::delete($file_name);
            }
            return ['msg' => $code, 'additional_type' => $additional_type];
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

    function getStatuses(Request $request){
        if($this->isUser($request)) {
            $name = UserController::getName($request);
            $full_msg = UserController::getFullMsg($request);
            $amount = UserController::getAmount($full_msg);
//        foreach ($full_msg as $item){
//            $full_msg[$i] = collect($item)->all();
//            $i++;
//        }
            //return view ('test', ['bruh'=>$full_msg]);
            return view('cabinet_user_status', ['msg' => $full_msg, 'name' => $name, 'amount' => $amount]);
        }
        return redirect()->route('main_route');
    }

    function getGuarantor(Request $request){
        if($this->isUser($request)) {
            $name = UserController::getName($request);
            $full_msg = UserController::getFullMsg($request);
            $amount = UserController::getAmount($full_msg);

            return view('cabinet_user_additional_data_guarantor', ['msg' => $full_msg, 'name' => $name, 'amount' => $amount]);
        }
        return redirect()->route('main_route');
    }

    function addAdditionalFile(Request $request){
        $request->validate([
            'additional_type' => ['required', 'regex:/^[\sa-zA-Zа-яА-Я-_\d]+$/u'],
            'file' => ['required', 'mimetypes:image/jpeg,image/png,application/pdf']
        ]);
        $additional_type = $request->input('additional_type');
        $file = $request->file('file');
        if($this->isUser($request) && ($additional_type == 'criminal_record' || $additional_type == 'income_statement')){
            $extension = $file->extension();
            //$INIPA = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->value('INIPA');
            $file_name = $additional_type.$request->session()->get('ITN').'.'.$extension;
            $file->storeAs('', $file_name);
            $code = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->update([$additional_type => $file_name]);
            return ['msg' => $code, 'additional_type' => $additional_type];
        }
        return ['msg' => -1, 'additional_type' => $additional_type];
    }

    function addAdditional(Request $request){
        $request->validate([
            'additional_type' => ['required', 'regex:/^[\sa-zA-Zа-яА-Я-_\d]+$/u'],
            'data' => ['required', 'integer']
        ]);
        $additional_type = $request->input('additional_type');
        if($this->isUser($request)){
            $code = -1;
            if($additional_type == 'INIPA' && strlen($request->input('data'))==11){
                $code = DB::table('Additional_data')->insert(['ITN' => $request->session()->get('ITN'), 'INIPA' => $request->input('data')]);
            } else if ($additional_type == 'passport_data' && strlen($request->input('data'))==10){
                $code = DB::table('Registered')->where('ITN', $request->session()->get('ITN'))->update(['passport_data' => $request->input('data')]);
            }
            return ['msg' => $code, 'additional_type' => $additional_type];
        }
        return ['msg' => -2];
    }

    function addGuarantor(Request $request){
        $request->validate([
            'userSurname' => ['required', 'regex:/^[\sa-zA-Zа-яА-Я-]+$/u'],
            'userName' => ['required', 'regex:/^[\sa-zA-Zа-яА-Я-]+$/u'],
            'userSecondName' => ['nullable', 'regex:/^[\sa-zA-Zа-яА-Я-]+$/u'],
            'userITN' => ['required', 'integer'],
            'userPassport' => ['required', 'integer'],
            'userINIPA' => ['required', 'integer'],
            'userIncome' => ['required', 'mimetypes:image/jpeg,image/png,application/pdf'],
            'userStatement' => ['required', 'mimetypes:image/jpeg,image/png,application/pdf'],
        ]);
        $income = $request->file('userIncome');
        $statement = $request->file('userStatement');
        if($this->isUser($request)){
            if(strlen($request->input('userPassport'))==10 && strlen($request->input('userINIPA'))==11 && strlen($request->input('userITN'))==12){
                $code1 = -1;
                $ext1 = $income->extension();
                $ext2 = $statement->extension();
                $file_name1 = 'income_statement'.'guarantor'.$request->session()->get('ITN').'.'.$ext1;
                $file_name2 = 'statement'.'guarantor'.$request->session()->get('ITN').'.'.$ext2;
                $income->storeAs('', $file_name1);
                $statement->storeAs('', $file_name2);
                if(DB::table('Guarantor')->where('ITN', $request->input('userITN'))->doesntExist()) {
                    $code1 = DB::table('Guarantor')->insert(['ITN' => $request->input('userITN'), 'INIPA' => $request->input('userINIPA'), 'income_statement' => $file_name1, 'passport_data' => $request->input('userPassport'), 'first_name' => $request->input('userName'), 'last_name' => $request->input('userSurname'), 'middle_name' => $request->input('userSecondName')]);
                }
                $code2 = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->update(['statement' => $file_name2, 'guarantor' => $request->input('userITN')]);
                return ['msg' => 1, 'code' => $code1.$code2];
            }
            return ['msg' => -1, 'code' => -1];
        }
        return ['msg' => -2, 'code' => -1];
    }

    function getSupport(Request $request){
        if($this->isUser($request)) {
            $name = UserController::getName($request);
            $full_msg = UserController::getFullMsg($request);
            $amount = UserController::getAmount($full_msg);

            return view('cabinet_user_support', ['msg' => $full_msg, 'name' => $name, 'amount' => $amount]);
        }
        return redirect()->route('main_route');
    }

    function sendSupport(Request $request){
        $request->validate([
            'topic' => ['required', 'regex:/^[\s0-9a-zA-Z-_а-яА-Я]+$/'],
            'text' => ['required', 'regex:/^[\s0-9a-zA-Z-_а-яА-Я]+$/']
        ]);
        if($this->isUser($request)) {
            $code = -1;
            $id = DB::table('Messages')->insertGetID(['sender' => $request->session()->get('login'), 'text' => $request->input('text'), 'msg_topic' => $request->input('topic'), 'msg_type' => 1]);
            $code = DB::table('Message_Conditions')->insert(['id_message' => $id]);
            return ['msg' => 1, 'code' => $id.$code];
        }
        return ['msg' => -2, 'code' => -1];
    }

    function getSafety(Request $request){
        if($this->isUser($request)) {
            $name = UserController::getName($request);
            $full_msg = UserController::getFullMsg($request);
            $amount = UserController::getAmount($full_msg);
            return view('cabinet_user_safety', ['msg' => $full_msg, 'name' => $name, 'amount' => $amount]);
        }
        return redirect()->route('main_route');
    }

    function changeAuthData(Request $request){
        if($this->isUser($request)) {
            $msg = -1;
            $code = -1;
            if(!empty($request->input('userPasswordOld'))){
                $msg = 0;
                $request->validate([
                    'userPasswordOld' => ['required', 'regex:/^[0-9a-zA-Z]+$/'],
                    'userPassword' => ['required', 'regex:/^[0-9a-zA-Z]+$/'],
                    'userPasswordCheck' => ['required', 'regex:/^[0-9a-zA-Z]+$/']
                ]);
                $hash = DB::table('Auth_data')->where('ITN', $request->session()->get('ITN'))->value('password');
                if(password_verify($request->input('userPasswordOld'),$hash) && $request->input('userPassword')==$request->input('userPasswordCheck')){
                    $msg = 1;
                    $hash = Hash::make($request->input('userPassword'));
                    $code = DB::table('Auth_data')->where('ITN', $request->session()->get('ITN'))->update(['password' => $hash]);
                }
            } else if(!empty($request->input('userEmail'))){
                $msg = 1;
                $request->validate([
                    'userEmail' => ['required', 'email']
                ]);
                $code = DB::table('Registered')->where('ITN', $request->session()->get('ITN'))->update(['email' => $request->input('userEmail')]);
            }
            return ['msg' => $msg, 'code' => $code];
        }
        return ['msg' => -2, 'code' => -1];
    }

}

