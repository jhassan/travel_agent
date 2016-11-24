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
use App\SaleVouchersDetails;
use App\SaleVouchers;
use App\COA;
use Redirect;
use Auth;
use Mailgun\Mailgun;
use Mail;
use App\User;
use App\Http\Controllers\Controller;
use App\Voucher;

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

    // save sale vouchers
    public function create()
    {
        $rules = array(
            'pax_name' => 'required',
            'pnr' => 'required',
            'ticket_no' => 'required'
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $data = new SaleVouchers();
        
        $data->pax_name = Input::get('pax_name');
        $data->pnr = Input::get('pnr');
        $data->ticket_no = Input::get('ticket_no');
        $data->sector = Input::get('sector');
        $data->flight_way = Input::get('flight_way');
        if($data->flight_way == 2)
        {
            $data->depart_date = date("Y-m-d", strtotime(Input::get('depart_date')));
            $data->return_date = date("Y-m-d", strtotime(Input::get('return_date')));    
        }
        else
        {
            $data->depart_date = date("Y-m-d", strtotime(Input::get('depart_date')));
            $data->return_date = "0000-00-00";
        }

        $data->basic_fare = $this->RemoveComma(Input::get('basic_fare'));
        $data->tax = $this->RemoveComma(Input::get('tax'));
        $data->actual_fare_total = $this->RemoveComma(Input::get('actual_fare_total'));
        $data->ven_percent_rec_comm = $this->RemoveComma(Input::get('ven_percent_rec_comm'));
        $data->ven_give_psf_comm = $this->RemoveComma(Input::get('ven_give_psf_comm'));
        $data->ven_wht_percent_comm = $this->RemoveComma(Input::get('ven_wht_percent_comm'));
        $data->client_percent_rec_comm = $this->RemoveComma(Input::get('client_percent_rec_comm'));
        $data->client_receive_psf_comm = $this->RemoveComma(Input::get('client_receive_psf_comm'));
        $data->client_wht_percent_comm = $this->RemoveComma(Input::get('client_wht_percent_comm'));
        $data->vendor_rec_comm_total = $this->RemoveComma(Input::get('vendor_rec_comm_total'));
        $data->ven_give_psf_total = $this->RemoveComma(Input::get('ven_give_psf_total'));
        $data->ven_wht_total = $this->RemoveComma(Input::get('ven_wht_total'));
        $data->ven_main_total = $this->RemoveComma(Input::get('ven_main_total'));
        $data->client_rec_comm_total = $this->RemoveComma(Input::get('client_rec_comm_total'));
        $data->client_receive_psf_total = $this->RemoveComma(Input::get('client_receive_psf_total'));
        $data->client_wht_total = $this->RemoveComma(Input::get('client_wht_total'));
        $data->client_main_total = $this->RemoveComma(Input::get('client_main_total'));
        $data->profit_loss_total = $this->RemoveComma(Input::get('profit_loss_total'));
        $data->vendor_payable_amount = $this->RemoveComma(Input::get('vendor_payable_amount'));
        $data->client_receivable_amount = $this->RemoveComma(Input::get('client_receivable_amount'));
        $data->user_id = Auth::user()->id;
        $data->vendor_id = Input::get('vendor_id');
        $data->client_id = Input::get('client_id');
        // get coa client and vendor
        $coa = new COA;
        $coa_client = $coa->party_coa((int)$data->client_id);
        $coa_vendor = $coa->party_coa((int)$data->vendor_id);
        if($data->save()){
            $insertedId = $data->id;
            // Create Vouchers Details
            $date = date("d-m-Y");
            $voucher_descriptions = $date . " Sale Voucher";
            $DebitAcc = $coa_client;
            $CreditAcc = $coa_vendor;
            $arrTrans[] = array("coa" => $DebitAcc, "desc" => $voucher_descriptions,  "debit" => $this->RemoveComma($data->vendor_payable_amount), "credit" => 0);
            $arrTrans[] = array("coa" => $CreditAcc, "desc" => $voucher_descriptions,"debit" => 0, "credit" => $this->RemoveComma($data->client_receivable_amount));
            foreach($arrTrans as $tran)
            {
                $arrayInsertDetail = array("sale_voucher_master_id" => $insertedId,
                            "coa_code" => $tran["coa"],
                            "coa_debit" => $tran["debit"],
                            "voucher_descriptions" => $tran["desc"],
                            "coa_credit" => $tran["credit"]);
                SaleVouchersDetails::insert($arrayInsertDetail);
            }
            # Instantiate the client.
            $mgClient = new Mailgun('key-42c33cc07ac38fc3899e444d4327133b');
            $domain = "sandboxef6727ca13534f9082db6dd43df24fbc.mailgun.org";
            $user = DB::table('users')->where('id', $data->user_id)->first();
            $html = View::make('emails.reminder',compact('user'))->render();
            # Make the call to the client.
            $result = $mgClient->sendMessage("$domain",
                              array('from'    => 'Mailgun Sandbox <postmaster@sandboxef6727ca13534f9082db6dd43df24fbc.mailgun.org>',
                                    'to'      => 'Jawad Hassan <jawadjee0519@gmail.com>',
                                    'subject' => 'Hello Jawad Hassan',
                                    'html'    => $html//,
                                    // 'text'    => 'Congratulations Jawad Hassan, you just sent an email with Mailgun!  
                                    // You are truly awesome!  You can see a record of this email in your logs: 
                                    // https://mailgun.com/cp/log .  You can send up to 300 emails/day from this 
                                    // sandbox server.  Next, you should add your own domain so you can 
                                    // send 10,000 emails/month for free.'
                                    ));
            //$user = User::findOrFail($data->user_id);
            // $user = DB::table('users')->where('id', $data->user_id)->first();

            // Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            //     $m->from('postmaster@sandboxef6727ca13534f9082db6dd43df24fbc.mailgun.org', 'Hello Jawad Hassan');

            //     $m->to($user->email, $user->name)->subject('Your Reminder for Email!');
            // });

            Session::flash('sale_voucher_message', "Sale voucher added successfully!");
            return Redirect::back();
        }
        else{
            return Redirect::back()->with('error', 'Error message');;
        }
    }

    // Remove commas in a numeric number
    public function RemoveComma($value)
    {   
        $value = str_replace(",", "", $value);
        return str_replace(",", "", $value);
    }

    public function list_sale_voucher()
    {
        $voucher_data = new Voucher;
        $arrayVouchers = $voucher_data->all_vouchers();
        return View('vouchers.list_sale_voucher', compact('arrayVouchers'));
    }


    public function edit_list_voucher($id)
    { 
        try {
            $voucher = DB::table('sale_vouchers')->where('id', $id)->first();
            // print_r($voucher);die;
            return View('vouchers.edit_sale_voucher', compact('voucher'));
        }
        catch (TestimonialNotFoundException $e) {
            return Redirect::route('parties.edit')->with('error', 'Error Message');
        }
    }
}
