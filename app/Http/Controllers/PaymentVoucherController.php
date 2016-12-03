<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use View;
use DB;
use Validator;
use Input;
use Session;
use App\PaymentVoucher;
use App\COA;
use Redirect;


class PaymentVoucherController extends Controller
{
    //
    public function receive_payment()
    {
    	$data = new PaymentVoucher();
    	$bankLists = $data->bank_list();
    	$clientLists = $data->client_list();
    	return View('payment_vouchers.receive_payment',compact('bankLists','clientLists'));
    }

    public function payment_voucher()
    {
    	$data = new PaymentVoucher();
    	$bankLists = $data->bank_list();
    	$clientLists = $data->client_list();
    	return View('payment_vouchers.payment_voucher',compact('bankLists','clientLists'));
    }

    public function journal_voucher()
    {
    	return View('payment_vouchers.journal_voucher');
    }
}
