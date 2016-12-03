<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;




class Voucher extends Model
{
	 protected $table = 'sale_vouchers';
	public function all_vouchers($voucher_type)
	{ 	$arrayVoucher = DB::table('sale_vouchers')
			->select('id','pnr', 'pax_name','ticket_no','vendor_payable_amount','client_receivable_amount')
			->where('voucher_type', '=', $voucher_type)
			->get();

		return $arrayVoucher;
	}
}
