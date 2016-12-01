<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use DB;
use Validator;
use Input;
use Session;
use App\Permission;
use Redirect;

class PermissionController extends Controller
{
    public function index()
    { 
        $data = new Permission;
        $PermissionList = $data->permission_index();
        return View('permissions.index',compact('PermissionList'));
    }

    public function add()
    {
        $data = new Permission;
        $PermissionList = $data->permission_list();
        return View('permissions.add',compact('PermissionList'));
    }

    public function create()
    {
        
        $rules = array(
            'name'  => 'required|max:100',
            // 'parent_id'  => 'required',
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $data = new Permission();
        
        $data->name = Input::get('name');
        $data->parent_id = Input::get('parent_id');

        if($data->save()){
            Session::flash('message', "Permission added successfully!");
            return Redirect::back();
        }
        else{
            return Redirect::back()->with('error', 'Error message');
        }
    }
    

    public function edit($id)
    {

        try {
            $data = new Permission;
            $PermissionList = $data->permission_list();
            $permissions = DB::table('permissions')->where('id', $id)->first();
           return View('permissions.edit', compact('permissions','PermissionList'));
        }
        catch (TestimonialNotFoundException $e) {
            return Redirect::route('parties.edit')->with('error', 'Error Message');
        }
        return View('permissions.edit');
    }

    public function update($id = null)
    {
        $rules = array(
            'name'  => 'required',
            'parent_id'  => 'required'
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $data = new Permission();
        
        $data->name = Input::get('name');
        $data->parent_id = Input::get('parent_id');
        
        Permission::where('id', $id)->update(
            [
            'name' => $data->name,
            'parent_id' => $data->parent_id,
            ]);
        $PermissionList = DB::table('permissions')->orderBy('id', 'desc')->get();
        Session::flash('message_update', "Permission updated successfully!");
        return View('permissions.index', compact('PermissionList'));

    }

     public function destroy($id = null)
    { 
        $DelID = Input::get('DelID');
        $removePermission = Permission::where('id', '=', $DelID)->delete();
        $ID = Permission::where('id', '=', $DelID)->first();
        if ($ID === null) 
           echo "delete"; 
        else
            echo "sorry";
    }

}
