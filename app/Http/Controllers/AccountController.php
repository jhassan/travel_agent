<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use DB;
use Validator;
use Input;
use Session;
use App\COA;
use App\ItemPrices;
use App\Party;
use App\Category;
use Redirect;

class AccountController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    // view list transections
    public function list_transections()
    {
    	$data = new COA;
    	$arrayList = $data->get_all_transection();
        return View('accounts.list_transections', compact('arrayList'));
    }

    // show form ledeger
    public function frm_ledger()
    {
        // Get all parties
        $party_data = new Party;
        $arrayParties = $party_data->party_coa();

        // Get all Categories
        $category_data = new Category;
        $array_category = $category_data->all_category();        
        return View('accounts.frm_ledger', compact('arrayParties', 'array_category'));
    }

    // View Ledeger
    public function view_ledger()
    {
        $rules = array(
            'category_id' => 'required',
            'coa_code'  => 'required',
        );
        
        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $category_id = Input::get('category_id');
        $coa_code = Input::get('coa_code');
        $start_date = date("Y-m-d", strtotime(Input::get('start_date')));
        $end_date = date("Y-m-d", strtotime(Input::get('end_date')));
        // Get Opening Balance
        $coa = new COA;
        $OpeningBalance = $coa->opening_balance($coa_code, $start_date, $category_id);
        // Search Ledeger
        $arrayLedeger = $coa->search_ledger($coa_code, $start_date, $end_date, $category_id);
        return View('accounts.view_ledger', compact('OpeningBalance','arrayLedeger','coa_code','start_date','end_date'));
    }
}
