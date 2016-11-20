<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use DB;
use Validator;
use Input;
use Session;
use App\Profile;
use Redirect;






class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = new Profile;
    	$arrayProfiles = $data->record();
        return View('profiles.index', compact('arrayProfiles'));
    }

	public function add()
    {
        return View('profiles.add');
    }

    public function create()
    {
    	 // print_r(Input::all());die;
        $rules = array(
            'name'  => 'required',
            'cell_no'  => 'required',
            'slogon'  => 'required',
            'email'  => 'required',
            'address'  => 'required',
            'website'  => 'required',
			//'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        );

        // Create a new validator instance from our validation rules
       $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $data = new Profile();
        
        $data->name = Input::get('name');
		$data->slogon = Input::get('slogon');
		$data->cell_no = Input::get('cell_no');
		$data->email = Input::get('email');
        $data->address = Input::get('address');
        $data->website = Input::get('website');
        // $data->image = $data->image(Input::file('image'));
 //print_r($data);die;
// exit;

        
        if($data->save()){
            Session::flash('message', "Profile added successfully!");
            return Redirect::back();
        }
        else{
            return Redirect::back()->with('error', 'Error message');;
        }
    }

}
