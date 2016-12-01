<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Permission extends Model
{
    protected $table = 'permissions';
    
    public function permission_list()
	{
		
			$arrayPerission = DB::table('permissions')
				->select('name','id')
				->whereRaw('parent_id = 0')
				->get();
		
		return $arrayPerission;
	}


	public function permission_index($id = null)
	{
		if(empty($id))
			$arrayPermiss = DB::table('permissions')->orderBy('name', 'asc')->get();
		else
			$arrayPermiss = DB::table('permissions')->where('id',$id)->orderBy('name', 'asc')->get();
		return $arrayPermiss;
	}

}
