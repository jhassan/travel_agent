<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class PaymentVoucher extends Model
{

    protected $table = 'payment_vouchers';

    public function bank_list(){

		$arrayBankList = DB::table('coa')
			->select('coa_account','coa_code')
            ->whereRaw('coa_code LIKE "100%" AND coa_code <> 100000')
            ->get();
       return $arrayBankList;

    }

    public function client_list(){

		$arrayClientList = DB::table('coa')
        ->select('coa_account','coa_code')
        ->whereRaw('coa_code LIKE "200%" AND coa_code <> 200000')
        ->get();
       return $arrayClientList;

    }
/*

    public function client_list(){

    		$arrayBankList = DB::table('parties')
    			->select('name')
                
                ->get();
           return $arrayBankList;

    }*/

}
