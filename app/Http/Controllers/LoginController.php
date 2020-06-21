<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Tek_admin_login;

use DB;
use Illuminate\Support\Facades\Input;
// for cart
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{
	
	
	protected $url;//'http://bookabus.co.in/slim';
	
	
	public function __construct(){
		
	}

	public function index(Request $request){
		if(session::get('User')){
			return redirect(url('/'));
		}
		$fdata=$request->all();
		if(isset($fdata['continue'])){
			$continue = $fdata['continue'];
		}else{
			$continue = url('/');
		}
		return view('login',compact('continue'));
	}

        public function auth_login(Request $request){
            if($request->isMethod('post')) {
                $fdata=$request->all();
                $result =  Tek_admin_login::UserLogin($request);
				if(isset($result) && !empty($result)){
					if(isset($result->active) && $result->active == 0){
						echo json_encode(array('success'=>false, 'message'=>'Hi. '.$fdata['username'].', your account is currently inactive. Please contact Admin.'));
						exit;
					}
					if(isset($result->status) && $result->status == 0){
						echo json_encode(array('success'=>false, 'message'=>'Hi. '.$fdata['username'].', your account is currently inactive. Please contact Admin.'));
						exit;
					}
					if(isset($result->user_type) && $result->user_type == 1){
						echo json_encode(array('success'=>false, 'message'=>'Oops invalid login credentials? try again.'));
						exit;
					}
					if($result){
						Session::put('User',$result);
						Session::save();
						echo json_encode(array('success'=>true, 'message'=>'Login successfully'));
						exit;
					}
					
					//return redirect('/');
				}else{
					echo json_encode(array('success'=>false, 'message'=>'Oops invalid login credentials? try again.'));
					exit;
				}
				
                //pr((array)$result);die;
            }
            return view('login');
        }
		
	
	
	
	
}
