<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    protected $table = "users";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function all_parent_permission()
    {
        $arrayParentPermission = DB::table('permissions')->whereRaw('parent_id = 0')->get();

        return $arrayParentPermission;
    }

    public function all_child_permission()
    {
        
            $arrayChieldPerission = DB::table('permissions')->get();
        
        return $arrayChieldPerission;
    }

    public function all_users()
    {
        
            $arrayUsers = DB::table('users')->get();
        // print_r($arrayUsers);die;
        return $arrayUsers;
    }
}
