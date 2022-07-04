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

class LoanOfficerController extends Controller
{
    function isLoanOfficer($request): bool
    {
        return $request->session()->has('accountType') && $request->session()->get('accountType')==2;
    }

    public function isValidITN($itn){
        if(empty($itn) || !boolval(preg_match('/^\d+$/', $itn)) || strlen($itn) != 12 || empty(DB::select('SELECT * FROM Registered WHERE ITN=?', [$itn]))){
            return false;
        }
        return true;
    }

    public function getNewSum($fee1, $rate, $term){
        $rate /= 12;
        return (int)($fee1/(($rate*pow(1+$rate, $term))/(pow(1+$rate, $term)-1)));
    }

    public function getNewTerm($fee1, $rate, $sum){
        $rate /= 12;
        $new_term = log(($fee1/($sum*$rate))/($fee1/($sum*$rate)-1), 1+$rate);
        return (int)ceil($new_term);
    }

    public function getRating(Request $request){
        $flag = false;
        if($this->isLoanOfficer($request) && !empty(DB::table('Application')->where('id_app', $request->session()->get('id'))->value('fee_max'))) {
            $flag = true;
            $rating = DB::table('Application')->where('id_app', $request->session()->get('id'))->value('rating');
            $age = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->value('age');
            $data = current(collect(DB::table('Application')->where('id_app', $request->session()->get('id'))->get())->all());
            if ($data->sum >= 1000000 && ($age < 21 || $age > 50)){
                $rating = 1;
                $flag = false;
            }
            if ($data->sum <= 999000 && ($age < 18 || $age > 60)) {
                $rating = 1;
                $flag = false;
            }
           if (!$data->flag){
                $rating = 1;
                $flag = false;
            }
            if ($rating != 1 || $flag) {
                $rating = 1;
                if ($data->fee < $data->fee_max) {
                    $rating = 3;
                } else if ($data->fee_max >= 3000 && $data->term != 0) {
                    $rating = 2;
                    if ($data->sum >= 1000000) { //вычисляем вид кредита "мечты"
                        $rate = 0.09;
                        $sum1 = $this->getNewSum($data->fee_max, $rate, $data->term);
                        $term1 = $this->getNewTerm($data->fee_max, $rate, $data->sum);
                        if ($sum1 < 1000000 && $term1 > 180) {
                            $rating = 1;
                        } // нет доступных для него альтернатив - меняем на отказ
                    }
                    if ($data->sum <= 999000) {
                        $rate = 0.11;
                        $sum1 = $this->getNewSum($data->fee_max, $rate, $data->term);
                        $term1 = $this->getNewTerm($data->fee_max, $rate, $data->sum);
                        if ($sum1 < 50000 && $term1 > 48) {
                            $rating = 1;
                        }
                    }// нет доступных для него альтернатив - меняем на отказ
                }
            }

            switch ($rating) {
                case 1:
                {
                    $code = DB::table('Application')->where('id_app', $request->session()->get('id'))->update(['rating' => $rating]);
                    return ['msg' => 0, 'rating' => 1, 'code' => $code];
                }
                case 2:
                {
                    $code = DB::table('Application')->where('id_app', $request->session()->get('id'))->update(['term_new' => $term1, 'sum_new' => $sum1, 'rating' => $rating]);
                    return ['msg' => 1, 'rating' => $rating, 'code' => $code, 'sum' => $data->sum, 'term' => $data->term, 'fee' => $data->fee, 'sum_new' => $sum1, 'term_new' => $term1, 'fee_max' => $data->fee_max];
                }
                case 3:
                {
                    $code = DB::table('Application')->where('id_app', $request->session()->get('id'))->update(['rating' => $rating]);
                    return ['msg' => 1, 'rating' => $rating, 'code' => $code];
                }

            }
        }
        return ['msg'=>-1, 'rating' => 0, 'code' => $flag];
    }

    function getSolvency(Request $request){
        if($this->isLoanOfficer($request)){
            if((!empty($request->input('duty')) && !empty($request->input('income')) && preg_match('/^\d+$/', $request->input('duty')) && preg_match('/^\d+$/', $request->input('income'))) || $request->input('duty')==0) {
                $solvency = (int)ceil($request->input('income')*0.8 - $request->input('duty') - 14000);
                DB::update('UPDATE Application SET fee_max=? WHERE id_app=?', [$solvency, $request->session()->get('id')]);
                return ['msg' => 1, 'solvency' => $solvency];
            }
        }
        return ['msg' => -1, 'solvency' => 0];
    }

//    function getDateWithTerm($term): string{
//        $month = intval(date('n'));
//        $year = intval(date('Y'));
//        $year += $term/12;
//        $month += ($term/12) * 12 - $term/12;
//        return strval($year.'-'.$month);
//    }

    function loanResponseContract(Request $request){
        if(!empty($amount = 3/*DB::table('LoanTypes')->count()*/)){
            $request->validate([
                'ITN' => ['required', 'integer', 'min:100000000000', 'max:999999999999'],
                'sum' => ['required', 'integer', 'min:50000', 'max:15000000'],
                'loan_type' => ['required', 'integer', 'min:1', 'max:'.$amount],
                'term' => ['required', 'integer', 'min:12', 'max:180']
            ]);
        } else {
            return ['msg' => -1];
        }

        if($this->isLoanOfficer($request)){
            //$date = $this->getDateWithTerm($request->input('term'));
            $db_code = DB::table('Active_loans')->insert(['ITN' => $request->input('ITN'), 'loan_sum' => $request->input('sum'), 'loan_type' => $request->input('loan_type'), 'term' => $request->input('term')]) && DB::table('Application')->where('id_app', $request->session()->get('id'))->update(['valid' => 0]);;
            return ['msg' => 1, 'db_code' => $db_code];
        }
        return ['msg' => -1, 'db_code' => -1];
    }

    function insertIntoBlackList(Request $request){
        if($this->isLoanOfficer($request)){
            $request->validate([
                'ITN' => ['required', 'numeric', 'min:100000000000', 'max:999999999999'],
                'text' => ['required', 'regex:/^[0-9a-zA-Z-_а-яА-Я]+$/']
            ]);
            $code = DB::insert('INSERT INTO Black_list (ITN) VALUES (?)', [$request->input('ITN')]) && DB::table('Application')->where('id_app', $request->session()->get('id'))->update(['rating' => 0, 'valid' => 0, 'text' => $request->input('text')]);
            return ['msg' => 1, 'code' => $code];
        }
        return ['msg' => -1, 'code' => -1];
    }

    function checkResult(Request $request){
        if($this->isLoanOfficer($request)){
            $request->validate([
                'userAge' => ['required', 'numeric', 'min:14', 'max:150'],
                'loanOfficerConfirmation' => ['required', 'numeric', 'min:-1', 'max:1']
            ]);
            //DB::update('UPDATE Application SET age=?, flag=? WHERE id_app=?', [$request->input('userAge'), $request->input('loanOfficerConfirmation'), $request->session()->get('$id')]);
            $code1 = DB::table('Application')->where('id_app', $request->session()->get('id'))->update(['flag'=>intval($request->input('loanOfficerConfirmation'))]);
            $code2 = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->update(['age' => intval($request->input('userAge'))]);
            return ['msg' => 1, 'code' => $code1.$code2];
        }
        return ['msg' => -1, 'code' => -1];
    }

    function checkResultGuarantor(Request $request){
        if($this->isLoanOfficer($request) && !empty(DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->value('guarantor'))){
            $request->validate([
                'userAge' => ['required', 'numeric', 'min:14', 'max:150'],
                'loanOfficerConfirmation' => ['required', 'numeric', 'min:-1', 'max:1']
            ]);
            $guarantor_ITN = DB::table('Additional_data')->where('ITN', $request->session()->get('ITN'))->value('guarantor');
            $code = DB::table('Application')->where('id_app', $request->session()->get('id'))->update(['guarantor_flag'=>$request->input('loanOfficerConfirmation')]) && DB::table('Guarantor')->where('ITN', $guarantor_ITN)->update(['age' => intval($request->input('userAge'))]);
            return ['msg' => 1 , 'code'=>$code];
        }
        return ['msg' => -1, 'code' => -1];
    }

    function loanResponseMessage(Request $request){
        if($this->isLoanOfficer($request)){
            $request->validate([
                'text' => ['required', 'regex:/^[0-9a-zA-Z-_а-яА-Я]+$/']
            ]);
            //$id_msg=DB::table('Messages_rec')->where('receiver', DB::table('Auth_data')->where('ITN', $request->session()->get('ITN'))->value('login'));
            //$code = DB::table('Application')->where('id_app', $request->session()->get('id'))->update(['text' => $request->input('text')]);
            date_default_timezone_set('Europe/Moscow');
            $code = DB::table('Messages')->where('id_message', $request->session()->get('id_msg'))->update(['text' => $request->input('text'), 'send_date' => date('Y-m-d')]);
            return ['msg' => 1 , 'code'=>$code];
        }
        return ['msg' => -1, 'code' => -1];
    }



}