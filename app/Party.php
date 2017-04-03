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
					  ->where('coa_code', DB::raw("(select max(`coa_code`) from coa where coa_code like '".$value."%')"))
					  ->get();
					 // var_dump($arrayCoa); 
					  //print_r($arrayCoa[0]->coa_code);die;
		//$coa = $arrayCoa[0]->coa_code;
		if(empty($arrayCoa[0]))
        {
          $max = 1;
          $max = $this->number_pad($max,3);
          $max = $value.$max;  
        } 
        else
        {
			$max = $arrayCoa[0]->coa_code;
        }
        return $max;			  
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

	public function number_pad($number,$n) {
        return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
    }
}
