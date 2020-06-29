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
use App\Feedback;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
// for cart
use Illuminate\Support\Facades\Redirect;
use Cart;
use Carbon\Carbon;
use App\Quiz;
use App\Question;
use App\Quizresult;
use App\Quizanswer;
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
		$Feedback = Feedback::where(array('isPublished'=>1,'IsDelete' => 0))->get();
		//pr($Feedback);die;
		return view('welcome',compact('UploadflashList','Noticeboard','Uploadgallery','Birthday','Syllabusmaster','Feedback'));
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
	function di2(Request $request,$id=null)
	{
		$result = Feedback::where('shortCode', $id)->first()->toArray();
		//pr($result);die; IsClicked
		if($result){
			$data = array(
                'IsClicked' => 1,
                'updated_at' => date('Y-m-d H:i:s')
			);
			Feedback::where('id', $result['id'])->update($data);
			Session::put('dataSession',$result);
			Session::save();
			return redirect(url('feedback'));
		}
		//return redirect(url('login'))->with('msg', 'Logout successfully!');
	}
	public function feedbackform(Request $request){
		if ($request->isMethod('post')){
			$post = $request->all();
			//pr($post);die;
			if(empty(trim($post['student_name']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter student name'));
				exit;
			}
			if(empty(trim($post['Father_Name']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter father name'));
				exit;
			}
			if(empty(trim($post['roll_no_previous']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter roll no previous'));
				exit;
			}
			if(empty(trim($post['present_class']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter present class'));
				exit;
			}
			if(empty(trim($post['contact_no']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter contact no'));
				exit;
			}
			if(empty(trim($post['whatsapp_no']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter whatsapp no'));
				exit;
			}
			if(empty(trim($post['suggestion']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter your suggestion'));
				exit;
			}
			$dataStudent = array(
                'student_name' => $post['student_name'],
                'Father_Name' => $post['Father_Name'],
                'roll_no_previous' => $post['roll_no_previous'],
                'present_class' => $post['present_class'],
                'contact_no' => $post['contact_no'],
                'whatsapp_no' => $post['whatsapp_no'],
                'admission_no' => '',
                'IsWebsite' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
			);
			$insertGetId = DB::table('student_master')->insertGetId($dataStudent);
			if($insertGetId){
				$data = array(
					'student_master_id' => $insertGetId,
					'student_name' => $post['student_name'],
					'admission_no' => '',
					'roll_no_previous' => $post['roll_no_previous'],
					'present_class' => $post['present_class'],
					'contact_no' => $post['contact_no'],
					'whatsapp_no' => $post['whatsapp_no'],
					'comments' => $post['comments'],
					'technical_issue' => !empty($post['technical_issue'])?$post['technical_issue']:'',
					'suggestion' => $post['suggestion'],
					'IsSubmit' => 1,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				);
				$insert = Feedback::insert($data);
			}
			if($insert || $insertGetId){
				echo json_encode(array('success'=>true, 'message'=>'Feedback submitted Successfully'));
				exit;
			}else{
				echo json_encode(array('success'=>false, 'message'=>'Oops unable to submit! try again.'));
				exit;
			}
			//return view('staticpages/photogallerydetail',compact('Uploadgallery'));
		}
		return view('staticpages/feedbackform');
	}
	public function feedback(Request $request){
		$dataSession = Session::get('dataSession');
		if ($request->isMethod('post') && $dataSession){
			$post = $request->all();
			if(empty(trim($post['student_name']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter student name'));
				exit;
			}
			if(empty(trim($post['admission_no']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter admission no'));
				exit;
			}
			if(empty(trim($post['roll_no_previous']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter roll no previous'));
				exit;
			}
			if(empty(trim($post['present_class']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter present class'));
				exit;
			}
			if(empty(trim($post['contact_no']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter contact no'));
				exit;
			}
			if(empty(trim($post['whatsapp_no']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter whatsapp no'));
				exit;
			}
			if(empty(trim($post['suggestion']))){
				echo json_encode(array('success'=>false, 'message'=>'Please enter your suggestion'));
				exit;
			}
			$data = array(
                'comments' => $post['comments'],
                'technical_issue' => !empty($post['technical_issue'])?$post['technical_issue']:'',
                'suggestion' => $post['suggestion'],
                'IsSubmit' => 1,
                'updated_at' => date('Y-m-d H:i:s')
			);
			$insert = Feedback::where('id', $dataSession['id'])->update($data);
			//$insert = Feedback::insert($data);
			if($insert){
				Session::forget('dataSession');
				Session::save();
				echo json_encode(array('success'=>true, 'message'=>'Feedback submitted Successfully'));
				exit;
			}else{
				echo json_encode(array('success'=>false, 'message'=>'Oops unable to submit! try again.'));
				exit;
			}
			//return view('staticpages/photogallerydetail',compact('Uploadgallery'));
		}
		
		if(!$dataSession){
			return redirect(url('/'));
		}
		return view('staticpages/feedback',compact('dataSession'));
	}
	
	
	public function playquiz(Request $request){
		
		/* Session::forget('Session_Result_Id');
					Session::forget('Session_Offset');
					Session::save();
					$Session_Offset = Session::get('Session_Offset');
					var_dump($Session_Offset);
					exit; */
		$quizid = 32;
		$quiz_details = Quiz::where(array('id' => $quizid))->first();
		$total_question = $quiz_details['quiz_total_question'];
		
		$Session_Offset = Session::get('Session_Offset');		
		
		if(!$Session_Offset)
		{			
			Session::put('Session_Offset',0); 
			Session::save();
		}
		if($Session_Offset>=$total_question){
			$Session_Offset = $total_question-1;
			
			Session::forget('Session_Offset');
			Session::save();
			Session::put('Session_Offset',$Session_Offset); 
			Session::save();
		}
			
		$offset = $Session_Offset;		
		$question_list = Question::where(array('quizid' => $quizid))->orderBy('id', 'ASC')->offset($offset)->limit(1)->get()->toArray();

		
		//echo $Session_Offset; exit;
		//print_r($Session_Vars);exit;
		
		if ($request->isMethod('post')){  //&& $dataSession
			$post = $request->all(); //print_r($post);exit;
			
			if(isset($post['submit']) && $post['submit']=='Prev'){
				$Session_Offset = $Session_Offset - 1;
				if($Session_Offset<0){
					$Session_Offset = 0;
				}
				
				Session::forget('Session_Offset');
			    Session::save();
				Session::put('Session_Offset',$Session_Offset); 
			    Session::save();
				return redirect('quiz/'.$quizid);
			}
			
			if(isset($post['submit']) &&  ($post['submit']=='Next' || $post['submit']=='Finish')){ //exit;
				$Session_Offset = $Session_Offset + 1;	
				
				Session::forget('Session_Offset');
			    Session::save();
				Session::put('Session_Offset',$Session_Offset); 
				Session::save();
				$question_id = $post['question_id'];
				$user_answer = isset($post['user_answer'])?$post['user_answer']:0;	
				
				
				if(!$Session_Result_Id){				
					
					$data = array(
						'userid' => 123,
						'quizid' => $quizid,
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					);
					
					$insertid = Quizresult::insert($data);
					
					Session::put('Session_Result_Id',$insertid); 
					Session::save();
				}	
				
				
				if(isset($post['answer_id']) && $post['answer_id']<>''){					
					
					$data = array(
						'optionchosen' => $post['user_answer'],
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					);
					$insertid = Quizanswer::where('answer_id', $post['answer_id'])->update($data);					
				}else{
					
					$data = array(
						'resultid' => $Session_Result_Id,
						'userid' => 123,
						'quizid' => $quizid,
						'questionid' => $question_list[0]['id'],
						'optionchosen' => $post['user_answer'],
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					);
					$insertid = Quizanswer::insert($data);
				}	
				
				if($post['submit']=='Finish' || $post['timeup']==1){	
					
					Session::forget('Session_Result_Id');
					Session::forget('Session_Offset');
					Session::save();
					
					return redirect('quiz-result/'.$quizid.'/'.$Session_Result_Id);
					
				}else{
					return redirect('quiz/'.$quizid);
				}
			}
			
			/* if($insert){				
				echo json_encode(array('success'=>true, 'message'=>'Feedback submitted Successfully'));
				exit;
			}else{
				echo json_encode(array('success'=>false, 'message'=>'Oops unable to submit! try again.'));
				exit;
			} */
			
		}//post ends
		
		$Session_Result_Id = Session::get('Session_Result_Id');
		$answer_info = array();
		if(isset($Session_Result_Id) && $Session_Result_Id<>''){			
			$answer_info = Quizanswer::where(array('resultid' => $Session_Result_Id,'quizid' => $quizid,'questionid' => $question_list[0]['id']))->first()->toArray();
		}
		
		$Session_Vars = array(
                'Session_Offset' => $Session_Offset,
                'Session_Result_Id' => $Session_Result_Id                
		);
		
		
		return view('quiz/quiz',compact('quizid','quiz_details','total_question','question_list','Session_Vars'));
	}
		
}	
