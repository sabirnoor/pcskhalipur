<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teksaentity extends Model
{
	
public function get_value_name()
    {
        return $this->belongsTo('App\teksaentity','id');
    }
	
	
	/*
		$me = ProductOptions::find(1)->get_v;
		It returns single object because it's belongsTo. It's tell about parent;
	*/
	public function get_v()
    {
        return $this->belongsTo('App\Values','value_id');
    }
	
	
	
}
