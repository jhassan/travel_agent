<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use DB;
use Validator;
use Input;
use Session;
use App\User;
use App\Permission;
use Redirect;
use Auth;
class UserController extends Controller
{
     public function index()
    {
        $data = new User; 
        $users = $data->all_users();
        return View('users.index',compact('users'));
    }

    public function add()
    {
        $data = new User;
        $patentPermission = $data->all_parent_permission();
        $childPermission = $data->all_child_permission();
        return View('users.add',compact('patentPermission','childPermission'));
    }

    public function create()
    {
        $rules = array(
            'name'  => 'required|unique:parties|max:100',
            'phone_no'  => 'unique:parties|max:12',
            'user_type'  => 'required',
			'email'  => 'required',
            'password'  => 'required',
    );
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $data = new User();

        $permission_checked = Input::get('permission');
        $arrayChickList = implode(',', $permission_checked);

        $data->name = Input::get('name');
		$data->user_phone_no = Input::get('user_phone_no');
		$data->user_type = Input::get('user_type');
		$data->email = Input::get('email');
		$data->password = bcrypt(Input::get('password'));
        $data->user_permission = $arrayChickList;


        if($data->save()){
            Session::flash('message', "User added successfully!");
            return Redirect::back();
        }
        else{
            return Redirect::back()->with('error', 'Error message');
        }
    }


    public function edit($id)
    {
       try {
            $data = new User;
            $patentPermission = $data->all_parent_permission();
            $childPermission = $data->all_child_permission();
            $user_permission =  $data->user_permissions($id);
            $user = DB::table('users')->where('id', $id)->first();
            //print_r($users);die;
            return View('users.edit',compact('user','patentPermission','childPermission','user_permission'));
        }
        catch (TestimonialNotFoundException $e) {
            return Redirect::route('users.edit')->with('error', 'Error Message');
        }
    }
}
