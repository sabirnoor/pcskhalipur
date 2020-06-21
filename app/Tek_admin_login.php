<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class Tek_admin_login extends Model
{
	
	
    protected $table = 'tek_admin_login';
    protected $primaryKey = 'id';
    protected $fillable = ['id','username','password','active'];
	
	
	public static function read_agent_information($username = '', $password = '') {
		$data = DB::table('tek_agent_login')
            ->where('emailid','=', $username)
            ->where('password','=', $password)->first();
		return $data;
	}
	public static function read_admin_information($username = '', $password = '') {
		$data = array();
		$data = DB::table('tek_admin_login')
            ->where('username','=', $username)
            ->where('password','=', $password)->first();
		return $data;
	}
    public static function UserLogin(Request $request){
        $fdata=$request->all();
        $username = $fdata['username'];
        $password = md5($fdata['password']);
		$admin = self::read_admin_information($username,$password);
		$agent = self::read_agent_information($username,$password);
        if(isset($admin) && !empty($admin)){
			$data = $admin;
		}else{
			$data = $agent;
		}
        return $data;
    }
	
	public static function admin_profile($userid = '') {
		$data = array();
		$data = DB::table('tek_admin_login')
			->select('tek_admin_login.*','tek_admin_profile.*')
			->leftjoin('tek_admin_profile','tek_admin_login.id','=','tek_admin_profile.tek_admin_id')
            ->where('tek_admin_login.id','=', $userid)->first();
		return $data;
	}
	
	public static function agent_profile($userid = '') {
		$data = DB::table('tek_agent_login')
            ->where('id','=', $userid)->first();
		return $data;
	}
	public static function operatorDetails($userid = '') {
		$data = DB::table('tek_agent_login')
			->select('supplier','supplier_name','title','fname','lname','mobile','emailid','address1','operator_company')
            ->where('id','=', $userid)->first();
		return $data;
	}
	
	public static function UpdateProfileAgent(Request $request){
		$fdata = $request->all();
		//echo '<pre>';print_r($fdata);
		$data = array(
			'operator_company' => trim($fdata['operator_company']),
			'fname' => trim($fdata['fname']),
			'lname' => trim($fdata['lname']),
			'mobile' => trim($fdata['mobile']),
			'address1' => trim($fdata['address1']),
			'address2' => trim($fdata['address2']),
		);
		if(isset(session()->get('User')->user_type)){
			DB::table('tek_agent_login')->where('id', $fdata['id'])->update($data);
		}else{
			DB::table('tek_admin_profile')->where('tek_admin_id', $fdata['id'])->update($data);
		}
		return true;
	}
	
	public static function change_password(Request $request){
		$fdata = $request->all();
		$data = array(
			'password' => md5($fdata['newpassword'])
		);
		if(isset(session()->get('User')->user_type)){
			DB::table('tek_agent_login')->where('id', $fdata['id'])->update($data);
		}else{
			DB::table('tek_admin_login')->where('id', $fdata['id'])->update($data);
		}
		return true;
	}
	
	
	
	
	
	
}
