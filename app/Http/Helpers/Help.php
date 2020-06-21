<?php
namespace App\Http\Helpers;
use DB;


class Help {

	 public static function find_by($table,$col,$val){
	   $obj = \DB::table("$table")->select(DB::raw("*"))->where("$col", "=", "$val")->first();
	   return $obj;
	 }
	 
	 
	 public static function find_whereIn($table,$col,$val){
	   $obj = \DB::table("$table")->select(DB::raw("*"))->whereIn($col,$val)->get();
	   return $obj;
	 }
	 
			
	public static function find_all($table,$col,$val){
	   $obj = \DB::table("$table")->select(DB::raw("*"))->where("$col", "=", "$val")->get();
	   return $obj;
	 }
			
	public static function query($query=''){
	   $obj = \DB::select($query);
	   return $obj;
	 }
	
	
	
	/*public static function get_subcat($cat) {
      //$sub_cat = India::select()->where("category","=",$cat)->groupBy("sub_category")->take(4)->get();
	  $sub_cat = India::select('sub_category')
	                    ->where("category","=",$cat)
						->distinct()
						->take(4)
						->get();
	  return $sub_cat;
    }*/
	


	 
	
	/*public static function id_by_me($field,$name){
	  $obj = India::select("id")
	                ->where($field,"=",$name)
					->first();
	  return $obj->id;
	}*/
	

	
	public static function encryptor($action, $string) {
		$output = false;
	
		$encrypt_method = "AES-256-CBC";
		//pls set your unique hashing key
		$secret_key = 'Idanwptcmd&golmROPqr';
		$secret_iv = 'Iim!i@w2golmIrfj2th13PK';
	
		// hash
		$key = hash('sha256', $secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
	
		//do the encyption given text/string/number
		if( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
			//decrypt the given text/string/number
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
	
		return $output;
	}
	
	
	
	


}