<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;




class Voucher extends Model
{
	 protected $table = 'sale_vouchers';
	public function all_vouchers($id = null)
	{ //echo "fawad";die;
    	$arrayVoucher = DB::table('sale_vouchers')
			->select('id','pnr', 'pax_name','ticket_no','vendor_payable_amount','client_receivable_amount')
			->get();

		return $arrayVoucher;
	}
}
