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
use File;
use Image;
use Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = new Profile;
    	$arrayProfiles = $data->profile_info();
        return View('profiles.index', compact('arrayProfiles'));
    }

	public function add()
    {
        $data = new Profile;
        $arrayProfiles = $data->profile_info();
        return View('profiles.add', compact('arrayProfiles'));
    }

    public function create()
    {
        $rules = array(
            'name'  => 'required',
            'cell_no'  => 'required',
            'slogon'  => 'required',
            'email'  => 'required',
            'address'  => 'required',
            'website'  => 'required',
            'ptcl_no'  => 'required',
			'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
        $data->ptcl_no = Input::get('ptcl_no');
		$data->email = Input::get('email');
        $data->address = Input::get('address');
        $data->website = Input::get('website');
        if (Input::file('image')) {
            $image = Input::file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('profile_images'.'/'.$input['imagename']);
            Image::make($image)->resize(140, 140)->save($destinationPath);    
            $data->image = $input['imagename'];
        }
        if($data->save()){
        Session::flash('message', "Profile added successfully!");
        return Redirect::back();
        }
        else{
            return Redirect::back()->with('error', 'Error message');;
        }    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $arrayProfiles = DB::table('profiles')->where('id', $id)->first();
            return View('profiles.edit', compact('arrayProfiles'));
        }
        catch (TestimonialNotFoundException $e) {
            return Redirect::route('profiles.edit')->with('error', 'Error Message');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id = null)
    {
        $rules = array(
            'name'  => 'required',
            'cell_no'  => 'required',
            'slogon'  => 'required',
            'email'  => 'required',
            'address'  => 'required',
            'website'  => 'required',
            'ptcl_no'  => 'required',
            'image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
        $data->ptcl_no = Input::get('ptcl_no');
        $data->email = Input::get('email');
        $data->address = Input::get('address');
        $data->website = Input::get('website');
        if (Input::file('image')) {
            // unlink old image
            $arrayProfiles = DB::table('profiles')->where('id', $id)->first();
            $data->image = $arrayProfiles->image;
            $destinationPath = 'profile_images'; 
            File::delete($destinationPath.'/'.$data->image);
            //echo $data->image; die;
            //Storage::delete($data->image);
            // update new image
            $image = Input::file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('profile_images'.'/'.$input['imagename']);
            Image::make($image)->resize(140, 140)->save($destinationPath);    
            $data->image = $input['imagename'];
        }
        else
        {
            $arrayProfiles = DB::table('profiles')->where('id', $id)->first();
            $data->image = $arrayProfiles->image;
        }
        Profile::where('id', $id)->update(
            [
            'name' => $data->name,
            'address' => $data->address,
            'cell_no' => $data->cell_no,
            'ptcl_no' => $data->ptcl_no,
            'slogon' => $data->slogon,
            'email' => $data->email,
            'website'=> $data->website,
            'image'=> $data->image
            ]);
        $arrayProfiles = $data->profile_info();
        Session::flash('message_update', "Profile updated successfully!");
        return View('profiles.index', compact('arrayProfiles'));
    }

}
