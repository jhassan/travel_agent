<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Party extends Model
{
    protected $table = 'parties';
    // Get all Parties
    public function all_parties($id = null)
	{
		if(empty($id))
			$arrayParty = DB::table('parties')->orderBy('name', 'asc')->get();
		else
			$arrayParty = DB::table('parties')->where('type_id',$id)->orderBy('name', 'asc')->get();
		return $arrayParty;
	}

	// Get COA Code
	public function get_next_coa($value='')
	{
		$arrayCoa = DB::table('coa')
					  ->where('coa_code', DB::raw("(select max(`coa_code`) from coa where account_type = '".$value."')"))
					  ->get();
		$coa = $arrayCoa[0]->coa_code;
		return $coa + 1;			  
	}

	// All party with COA code
	public function party_coa()
	{
		$arrayPartyCoa = DB::table('parties')
						->rightJoin('coa', 'coa.party_id', '=', 'parties.id')
						->select('coa_code','coa.party_id as party_id', 'coa_account')
						->orderBy('coa_account','ASC')
						->get();
		return $arrayPartyCoa;						
	}
}
