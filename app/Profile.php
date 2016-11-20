<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Profile extends Model
{
    protected $table = 'profiles';

    public function record($id = null)
	{
		$arrayProfiles = DB::table('profiles')->get();

	}

	public function image($name){ 

        $image = $name;
        $destinationPath = public_path(). '/uploads/';
        $filename = $image->getClientOriginalName();

        $file->move($destinationPath, $filename);

        return $image;

	}
}
