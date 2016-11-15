<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use DB;
use Validator;
use Input;
use Session;
use App\Party;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // view sale vouchers
    public function sale_voucher()
    {
        // Get all parties
        $party_data = new Party;
        $arrayParties = $party_data->all_parties(2);

        return View('vouchers.sale_voucher', compact('arrayParties'));
    }
}
