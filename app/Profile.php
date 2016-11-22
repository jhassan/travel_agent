<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Profile extends Model
{
    protected $table = 'profiles';

    public function profile_info()
	{
		$arrayProfiles = DB::table('profiles')->get();
        return $arrayProfiles;
	}

	// public function image($name){ 

 //        $image = $name;
 //        $destinationPath = public_path(). '/uploads/';
 //        $filename = $image->getClientOriginalName();

 //        $file->move($destinationPath, $filename);

 //        return $image;

	// }
}
