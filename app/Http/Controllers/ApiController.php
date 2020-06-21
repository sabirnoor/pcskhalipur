<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Tek_admin_login;
use App\Apimodels;

use DB;
use Illuminate\Support\Facades\Input;
// for cart
use Illuminate\Support\Facades\Redirect;
class ApiController extends Controller
{
	
	
	protected $url;
	protected $authorization_key;
	
	
	
	public function __construct(){
		$this->url = getenv('APP_URL');
		$this->authorization_key = getenv('AUTH');
	}

	public function index(Request $request){
		if($request->isMethod('get')) {
			$post = $request->all();
			echo $post['user_id'];
			//echo ($this->authorization_key);
			exit;
		}
		
		die($this->url);
		
	}
	
	public function bussearch(Request $request){
		if($request->isMethod('get')) {
			$post = $request->all();
			$RoutesList = Apimodels::RoutesList($post['agent_id']);
			pr($RoutesList);
			//echo ($this->authorization_key);
			exit;
		}
		
		die($this->url);
		
	}

}
