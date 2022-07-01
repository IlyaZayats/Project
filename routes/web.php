<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoanOfficerController;
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

function isLoanOfficer($request): bool
{
    return $request->session()->has('accountType') && $request->session()->get('accountType')==2;
}

function isUser($request): bool
{
    return $request->session()->has('accountType') && $request->session()->get('accountType')==1;
}

Route::get('/', function (Request $request) {
    if(isLoanOfficer($request)){
        return view('main', ['login' => $request->session()->get('login')]);
    }
    $login_field = 'login';
    $pass_field = 'password';
    return view('main', ['login_field' => $login_field, 'pass_field' => $pass_field]);
})->name('main_route');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/registration', [RegistrationController::class, 'registration']);

Route::get('/registration', function (){
    return view('registration');
})->name('registration_route');

//Cabinet
Route::get('/cabinet', [AuthController::class, 'cabinet'])->name('cabinet_route');

//Application
Route::get('/application/{itn}/{id}', function ($itn, $id, Request $request){
    if(isLoanOfficer($request)){
            session(['ITN'=>$itn, 'id'=>$id]);
            //DB::select('SELECT * FROM Application WHERE login_worker=?', [$request->session()->get('login')])
            //DB::update('UPDATE Application SET in_work=1 WHERE id_app=?', [$id]);
            DB::table('Application')->where('id_app', $id)->update(['login_worker' => $request->session()->get('login')]);
            return view('application', ['id' => $id]);
    }
    return redirect()->route('main_route');
});

//Solvency
Route::get('/solvency', function (Request $request){
    if(isLoanOfficer($request)){
        return view('solvency', ['id' => $request->session()->get('id')]);
    }
    return redirect()->route('main_route');
});

Route::post('/solvency', [LoanOfficerController::class, 'getSolvency']);

//Loan Response
Route::get('/loan_response', function (Request $request){
    if(isLoanOfficer($request)) {
        $data = current(DB::select('SELECT * FROM Application WHERE id_app = ?', [$request->session()->get('id')]));
        //return view('test', ['bruh' => $data]);
        if(!empty($data)) {
            if ($data->rating == 0) {
                return view('loan_response', ['itn' => $data->ITN, 'sum' => $data->sum, 'term' => $data->term, 'fee' => $data->fee, 'rating' => $data->rating, 'id' => $data->id_app, 'flag' => $data->flag]);
            } else {
                return view('loan_response', ['itn' => $data->ITN, 'sum' => $data->sum, 'term' => $data->term, 'fee' => $data->fee, 'rating' => $data->rating, 'fee_max' => $data->fee_max, 'term_new' => $data->term_new, 'sum_new' => $data->sum_new, 'id' => $data->id_app, 'flag' => $data->flag]);
            }
        }
    }
    return view('loan_response', ['error' => 'yeah, dude, we have got error']);
})->name('loan_response_route');


//Rating
Route::post('/rating', [LoanOfficerController::class, 'getRating']);

//Additional Data Check
Route::get('/additional_data_check', function (Request $request){
   if(isLoanOfficer($request)){
       $data = current(collect(DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->get())->all());
       $pass_data = DB::table('Registered')->where('ITN', $request->session()->get('ITN'))->value('passport_data');
       $count = 0;
       if(!empty(DB::table('Overdue')->where('ITN', $request->session()->get('ITN')))){
           $count = DB::table('Overdue')->where('ITN', $request->session()->get('ITN'))->value('count_o');
       }
       //return view('test', ['bruh'=>$data]);
       $guarantor_ITN = 80085;
       if(!empty(DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->value('guarantor'))){
           $guarantor_ITN = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->value('guarantor');
       }
       return view('additional_data_check', ['INIPA' => $data->INIPA, 'criminal_record' => $data->criminal_record, 'income_statement' => $data->income_statement, 'ITN' => $data->ITN, 'passport_data'=>$pass_data, 'count' => $count, 'id'=>$request->session()->get('id'), 'guarantor' => $guarantor_ITN]);
   } else {
       return redirect()->route('main_route');
   }
});

Route::get('/additional_data_check_guarantor', function (Request $request){
    if(isLoanOfficer($request) && !empty(DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->value('guarantor'))){
        $guarantor_ITN = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->value('guarantor');
        $data = current(collect(DB::table('Guarantor')->where('ITN', $guarantor_ITN)->get())->all());
        return view('additional_data_check_guarantor', ['INIPA' => $data->INIPA, 'income_statement' => $data->income_statement, 'ITN' => $data->ITN, 'passport_data'=>$data->passport_data, 'id'=>$request->session()->get('id'), 'last_name' => $data->last_name, 'first_name' => $data->first_name, 'middle_name' => $data->middle_name, 'statement' => $data->statement]);
    } else {
        return redirect()->route('main_route');
    }
});

Route::post('/additional_data_check', [LoanOfficerController::class, 'checkResult']);

Route::post('/additional_data_check_guarantor', [LoanOfficerController::class, 'checkResultGuarantor']);

//Loan Response Message
Route::get('/loan_response_message', function (Request $request){
    if(isLoanOfficer($request)) {
        $data = DB::select('SELECT * FROM Application WHERE id_app = ?', [$request->session()->get('id')]);
        if(!empty($data)) {
            return view('loan_response_message', ['id' => $request->session()->get('id')]);
        }
    }
    return redirect()->route('main_route');

})->name('loan_response_message_route');

Route::post('/loan_response_message', [LoanOfficerController::class, 'loanResponseMessage']);


//Black List
Route::get('/black_list', function (Request $request){
    if(isLoanOfficer($request)){
        return view('black_list', ['id' => $request->session()->get('id')]);
    }
    return redirect()->route('main_route');
});

Route::post('/black_list', [LoanOfficerController::class, 'insertIntoBlackList']);

Route::any('/leave', [AuthController::class, 'leave'])->name('leave_route');

Route::get('/loan_response_contract', function (Request $request){
    if(isLoanOfficer($request)){
        return view('loan_response_contract', ['confirm' => DB::table('Application')->where('id_app', $request->session()->get('id'))->value('confirm'), 'id' => $request->session()->get('id')]);
    }
    return redirect()->route('main_route');
});

Route::post('/loan_response_contract', [LoanOfficerController::class, 'loanResponseContract']);

Route::get('/drop_application', function (Request $request){
    if(isLoanOfficer($request)){
        DB::table('Application')->where('id_app', $request->session()->get('id'))->update(['login_worker' => "login_worker"]);
        return redirect()->route('cabinet_route');
    }
    return redirect()->route('main_route');
});
