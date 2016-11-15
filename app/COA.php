<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class COA extends Model
{
    protected $table = "coa";

    // Get COA of party
    public function party_coa($id)
    {
    	$arrayCoa = DB::table('coa')->where('party_id',$id)->get();
		$coa = $arrayCoa[0]->coa_code;
		return $coa;
    }

    // Get all transections
    public function get_all_transection()
    {
    	$arrayTransection = DB::table('purchase_voucher_master')
    						->join('parties', 'parties.id', '=', 'purchase_voucher_master.party_id')
    						->join('categories', 'categories.id', '=', 'purchase_voucher_master.category_id')	
    						->select('purchase_voucher_master.*','parties.name AS party_name','categories.category_name AS category_name')	
    						->paginate(10);
    	return $arrayTransection;	
    }

    // Get Opening Balance
    public function opening_balance($coa_code, $start_date, $category_id)
    {
        $arrayDetail = DB::table('purchase_voucher_master')
                        ->join('purchase_voucher_detail', 'purchase_voucher_detail.account_stock_master_id', '=', 'purchase_voucher_master.id')
                        ->join('coa', 'coa.coa_code', '=', 'purchase_voucher_detail.coa_code')
                        //->select(DB::raw('((`coa_credit`+`coa_debit`) + SUM(purchase_debit_amount)) - SUM(purchase_credit_amount) AS OpeningBalance'))
                        ->select(DB::raw('(SUM(IFNULL(coa_debit, 0) - IFNULL(coa_credit, 0)) + SUM(IFNULL(purchase_debit_amount, 0))) - SUM(IFNULL(purchase_credit_amount, 0)) AS OpeningBalance'))
                        ->whereRaw('purchase_voucher_detail.coa_code = "'.$coa_code.'" AND purchase_date < "'.$start_date.'" AND category_id = "'.$category_id.'" ')
                        ->get();
         $ClosingBalance = $arrayDetail[0]->OpeningBalance;
         if(empty($ClosingBalance))
         {
            $arrayOpBalance = array();
            $arrayOpBalance = DB::table('coa')
                        ->select('coa_debit','coa_credit')
                        ->whereRaw('coa_code = "'.$coa_code.'"')
                        ->get();    

            if($arrayOpBalance[0]->coa_debit != 0)
                $ClosingBalance = $arrayOpBalance[0]->coa_debit; 
            elseif($arrayOpBalance[0]->coa_credit != 0)
                $ClosingBalance = $arrayOpBalance[0]->coa_credit;
         }
            return (int)$ClosingBalance;               
    }

    // Search Journal Ledger
    public function search_ledger($coa_code, $start_date, $end_date, $category_id)
    {
        $arrayVoucher = DB::table('purchase_voucher_master')
                    ->join('purchase_voucher_detail', 'purchase_voucher_detail.account_stock_master_id', '=', 'purchase_voucher_master.id')
                    ->join('coa', 'coa.coa_code', '=', 'purchase_voucher_detail.coa_code')
                    ->select('purchase_voucher_master.*','purchase_voucher_detail.*','coa.*')
                    ->whereRaw('purchase_voucher_detail.coa_code = '.$coa_code.' AND purchase_date >= "'.$start_date.'" AND purchase_date <= "'.$end_date.'" AND category_id = "'.$category_id.'" ')
                    ->orderBy('purchase_voucher_detail.id', 'desc')
                    ->get();
        return $arrayVoucher;
    }
}
