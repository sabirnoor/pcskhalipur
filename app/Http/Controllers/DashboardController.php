<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Uploadflash;
use App\Syllabusmaster;
use App\Noticeboard;
use App\Uploadgallery;
use App\Birthday;
use App\Staticcontent;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
// for cart
use Illuminate\Support\Facades\Redirect;
use Cart;
use Carbon\Carbon;
class DashboardController extends Controller
{
	
	
	protected $url;//'http://bookabus.co.in/slim';
	
	
	public function __construct(){
		
		
		
	}

	
	
	public function isset_session(Request $request){
		if(!$request->session()->has('User')){
			$request->session()->flush();
			return redirect('login'); 
		}
		
	}
	
	public function index(Request $request){
		$dt = Carbon::now()->toDateString();
		$dt = date('m-d',strtotime($dt));
		$dt2 = Carbon::now()->addDays(31)->toDateString();
		$dt2 = date('m-d',strtotime($dt2));
		$UploadflashList = Uploadflash::where(array('IsDelete' => 0))->get();
		$Noticeboard = Noticeboard::where(array('IsDelete' => 0))->orderBy('orders_by', 'ASC')->get();
		$Uploadgallery = Uploadgallery::where(array('IsDelete' => 0))->orderBy('orders_by', 'ASC')->take(6)->get();
		$Birthday = Birthday::where(array('IsDelete' => 0))->whereBetween(DB::raw('DATE_FORMAT(dateofbirth, "%m-%d")'), array($dt, $dt2))->orderBy('orders_by', 'ASC')->take(7)->get();
		$Syllabusmaster = Syllabusmaster::SyllabusClassList();
		return view('welcome',compact('UploadflashList','Noticeboard','Uploadgallery','Birthday','Syllabusmaster'));
	}
	
	public function about(Request $request){
		$Staticcontent = Staticcontent::where(array('page_name' => 'aboutus'))->first();
		return view('staticpages/about', compact('Staticcontent'));
	}
	public function ourmotto(Request $request){
		$Staticcontent = Staticcontent::where(array('page_name' => 'ourmotto'))->first();
		return view('staticpages/ourmotto', compact('Staticcontent'));
	}
	public function directorsdesk(Request $request){
		$Staticcontent = Staticcontent::where(array('page_name' => 'director_desk'))->first();
		//print_r($Staticcontent->contents);die;
		return view('staticpages/directorsdesk', compact('Staticcontent'));
	}
	public function principaldesk(Request $request){
		return view('staticpages/principaldesk');
	}
	public function events(Request $request){
		$Staticcontent = Staticcontent::where(array('page_name' => 'events'))->first();
		return view('staticpages/events', compact('Staticcontent'));
	}
	public function newspaper(Request $request){
		$Staticcontent = Staticcontent::where(array('page_name' => 'newspaper'))->first();
		return view('staticpages/newspaper', compact('Staticcontent'));
	}
	public function academics(Request $request){
		$Staticcontent = Staticcontent::where(array('page_name' => 'academics'))->first();
		return view('staticpages/academics', compact('Staticcontent'));
	}
	public function schoolprofile(Request $request){
		return view('staticpages/schoolprofile');
	}
	public function franchiseenquiry(Request $request){
		return view('staticpages/franchiseenquiry');
	}
	public function downloads(Request $request){
		return view('staticpages/downloads');
	}
	public function contact(Request $request){
		return view('staticpages/contact');
	}
	
	public function Syllabus(Request $request){
		$Syllabusmaster = Syllabusmaster::SyllabusClassList();
		//echo '<pre>';print_r($Syllabusmaster);die;
		return view('staticpages/Syllabus', compact('Syllabusmaster'));
	}
	
	public function result(Request $request){
		return view('staticpages/result');
	}
	public function mandatorydisclosure(Request $request){
		return view('staticpages/mandatorydisclosure');
	}
	
	public function photogallery(Request $request){
		$Uploadgallery = Uploadgallery::galleryList2();
		//echo '<pre>';print_r($Uploadgallery);die;
		return view('staticpages/photogallery',compact('Uploadgallery'));
	}
	
	public function photogallerydetail(Request $request){
		if ($request->isMethod('post')){
			$data = $request->all();
			$Uploadgallery = Uploadgallery::GetgalleryList($data['galleryid']);
			//echo '<pre>';print_r($Uploadgallery);die;
			return view('staticpages/photogallerydetail',compact('Uploadgallery'));
		}else{die;}
	}
	
	public function profile(Request $request){
		if(!$request->session()->has('User')){
			return redirect(url('login'))->with('msg', 'Oops your session has been expired!!');
		}
		if($request->isMethod('post')) {
			$fdata=$request->all();
			$result = Tek_admin_login::UpdateProfileAgent($request);
			if($result){
				echo json_encode(array('success'=>true, 'message'=>'Save Successfully'));
				exit;
			}else{
				echo json_encode(array('success'=>false, 'message'=>'Oops unable to save! try again.'));
				exit;
			}
			//echo '<pre>';print_r($result);die;
		}
		if(isset(session()->get('User')->user_type)){
			$details = Tek_admin_login::agent_profile(session()->get('User')->id);
		}else{
			$details = Tek_admin_login::admin_profile(session()->get('User')->id);
		}
		return view('profile', compact('details'));
	}
	
	public function change_password(Request $request){
		if(!$request->session()->has('User')){
			return redirect(url('login'))->with('msg', 'Oops your session has been expired!!');
		}
		if($request->isMethod('post')) {
			$fdata=$request->all();
			
			if(isset(session()->get('User')->user_type)){
				$details = Tek_admin_login::agent_profile($fdata['id']);
				if($details->password <> md5($fdata['cpassword'])){
					echo json_encode(array('success'=>false, 'message'=>'Entered current password is wrong!'));exit;
				}
			}else{
				$details = Tek_admin_login::admin_profile($fdata['id']);
				if($details->password <> md5($fdata['cpassword'])){
					echo json_encode(array('success'=>false, 'message'=>'Entered current password is wrong!'));exit;
				}
			}
			$result = Tek_admin_login::change_password($request);
			if($result){
				echo json_encode(array('success'=>true, 'message'=>'Password Update Successfully'));
				exit;
			}else{
				echo json_encode(array('success'=>false, 'message'=>'Oops unable to update! try again.'));
				exit;
			}
			//echo '<pre>';print_r($result);die;
			
		}
	}
	
	function logout(Request $request)
	{
		$request->session()->flush();
		return redirect(url('login'))->with('msg', 'Logout successfully!');
	}
		
	
	
	
	
}
