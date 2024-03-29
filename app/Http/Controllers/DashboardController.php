<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Uploadflash;
use App\Syllabusmaster;
use App\Schedulemaster;
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
use Illuminate\Support\Facades\Crypt;
use Cart;
use Carbon\Carbon;
use App\Quiz;
use App\Question;
use App\Quizresult;
use App\Quizanswer;
use App\Quizinvitation;
use App\Studentmaster;
use App\Quizgroup;
use Validator;
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
	
	public function termandcondition(Request $request){
		return view('staticpages/termandcondition');
	}
	public function privacypolicy(Request $request){
		return view('staticpages/privacypolicy');
	}
	public function refundpolicy(Request $request){
		return view('staticpages/refundpolicy');
	}
	
	public function Syllabus(Request $request){
		$Syllabusmaster = Syllabusmaster::SyllabusClassList();
		//echo '<pre>';print_r($Syllabusmaster);die;
		return view('staticpages/Syllabus', compact('Syllabusmaster'));
	}
	
	public function Schedule(Request $request){
		$Schedulemaster = Schedulemaster::ScheduleClassList();
		//echo '<pre>';print_r($Schedulemaster);die;
		return view('staticpages/Schedule', compact('Schedulemaster'));
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
	
	public function quizinvitation(Request $request, $link=null)
    {        
        Session::forget('Session_Result_Id');
		Session::forget('Session_Offset');
		Session::forget('Session_Quiz_Id');
		Session::forget('Session_Student_Id');
		Session::save();
		
		$quiz_invitation_details = Quizinvitation::where(array('invitation_link' => $link,'IsDelete' => 0))->first();
		if(!isset($quiz_invitation_details->quiz_id)){
			echo "Invalid link"; exit;
		}
		
		$quizid = $quiz_invitation_details->quiz_id;  
		$student_master_id = $quiz_invitation_details->student_master_id;  
		
		$quiz_details = Quiz::where(array('id'=>$quizid,'IsDelete' => 0))->first();
		$student_details = Studentmaster::where(array('id'=>$student_master_id,'IsDelete' => 0))->first();
		
		//redirect to start quiz page if already verified
		if($quiz_invitation_details->isVerified==1){ 
				Session::put('Session_Quiz_Id',$quizid); 
				Session::save();
				Session::put('Session_Student_Id',$student_master_id); 
				Session::save();
				return redirect('startquiz');
		}
		if ($request->isMethod('post')) { 
			
			$post = $request->all(); 
			
			if(Session::get('captcha')){
				$sess_captcha = Session::get('captcha');
			}
			if($post['user_captcha'] != $sess_captcha){ 
				return redirect('exam-invitation/'.$link)->with('msgerror', 'Wrong Captcha. Try again!');
			}
			//var_dump($post); exit;
			$otp = $post['otp'];
			if($otp == $quiz_invitation_details->otp){
				$data = array(
						'isVerified' => 1,						
						'updated_at' => date('Y-m-d H:i:s')
					);
				
				$insert = Quizinvitation::where('invitation_link', $link)->update($data);
					
				Session::put('Session_Quiz_Id',$quizid); 
				Session::save();
				Session::put('Session_Student_Id',$student_master_id); 
				Session::save();
				return redirect('startquiz');
			}else{
				 	
				return redirect('exam-invitation/'.$link)->with('msgerror', 'Wrong OTP. Try again!');				
			}
			
		}
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
		$captcha = substr(str_shuffle($permitted_chars), 0, 6);
		
		Session::forget('captcha');
		Session::put('captcha',$captcha); 
		Session::save();
		
		return view('quiz/quiz-invitation', compact('quiz_invitation_details','quiz_details','student_details','link','captcha'));
		
    }
	
	public function startquiz(Request $request)
    {        
        $quizid = 0; $studentid = 0;  
		if(Session::get('Session_Quiz_Id')){
			$quizid = Session::get('Session_Quiz_Id');
		}
		if(Session::get('Session_Student_Id')){
			$studentid = Session::get('Session_Student_Id');
		}
		
		$already_played = 0;
		$result_details = Quizresult::where(array('quizid' => $quizid,'userid' => $studentid))->first();

		if(isset($result_details->result_id) && isset($result_details->isFinished) && $result_details->isFinished==1){
			$already_played = 1;
		}
		
		// if quiz is restarted for any reason, pick that result_id and set in session to continue
		if(isset($result_details->result_id) && isset($result_details->isFinished) && $result_details->isFinished==0){
			
			Session::forget('Session_Result_Id');
			Session::put('Session_Result_Id',$result_details->result_id); 
			Session::save();
			
		}		
		
		if ($request->isMethod('post')) {
			
			$post = $request->all();			
			if($quizid>0 && $studentid>0){
				return redirect('playexam'); //playquiz for one by one ques and playexam for all ques
			}else{
				return redirect('startquiz');
			}			
		}
		
		
		if($quizid){					
			$quiz_details = Quiz::where(array('id' => $quizid,'IsDelete' => 0))->first();
			$student_details = Studentmaster::where(array('id'=>$studentid))->first();
			return view('quiz/start-quiz', compact('quiz_details','student_details','already_played','result_details'));
		}else{
			return url('/');
		}
		
		
    }
	
	public function jumpquestion(Request $request,$ques_no){ 
		$ques_no = (int)$ques_no;
		if(isset($ques_no) && $ques_no<>''){
			Session::forget('Session_Offset');
			Session::save();
			$offset = $ques_no-1;
			Session::put('Session_Offset',$offset); 
			Session::save();
		}
		return redirect('playquiz');
	}
	public function playquiz(Request $request){
		
		//check quiz and user ids are set or not
		if(Session::get('Session_Quiz_Id')){
			$quizid = Session::get('Session_Quiz_Id');
		}else{
			echo "You are not authorised to visit this page."; exit;
			return redirect(url('/'));	
		}			
		if(Session::get('Session_Student_Id')){
				$Session_Student_Id = Session::get('Session_Student_Id');
		}else{
			echo "You are not authorised to visit this page."; exit;
			return redirect(url('/'));	
		}
		
		
		$post = $request->all(); 	
		
		$quiz_details = Quiz::where(array('id' => $quizid))->first();
		$total_question = Question::where(array('quizid' => $quizid,'IsDelete' => 0))->get()->count();
		
		$current_date_time = date('Y-m-d H:i:s');
		$quiz_begin_date_time = $quiz_details['quiz_start_date'].' '.$quiz_details['quiz_start_time'];
		
		
		if(strtotime($current_date_time) >= strtotime($quiz_begin_date_time)){
			//User can proceed
		}
		else{
			echo "Wait till exam starts."; exit;
			return redirect(url('/'));	
		}
		
		//echo $total_question; exit;
		
		if(Session::get('Session_Offset')){
			$Session_Offset = Session::get('Session_Offset'); 
		}else{
			$Session_Offset = 0;
			Session::put('Session_Offset',$Session_Offset); 
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
		$question_list = Question::where(array('quizid' => $quizid,'IsDelete' => 0))->orderBy('id', 'ASC')->offset($offset)->limit(1)->get()->toArray();
		if(empty($question_list)){
			return redirect('startquiz')->with('msgerror', 'oops there is no question added by the school');
		}
		if(Session::get('Session_Result_Id')){
			$Session_Result_Id = Session::get('Session_Result_Id'); 
		}else{
			$Session_Result_Id = -1;
		}
				
		
		if ($request->isMethod('post')){  
						
			if(isset($post['submit']) && $post['submit']=='Prev'){
				$Session_Offset = $Session_Offset - 1;
				if($Session_Offset<0){
					$Session_Offset = 0;
				}
				Session::forget('Session_Offset');
			    Session::save();
				Session::put('Session_Offset',$Session_Offset); 
			    Session::save();
				return redirect('playquiz');
			}
			
			if(isset($post['submit']) &&  ($post['submit']=='Next' || $post['submit']=='Finish')){ 
			//print_r($post);exit;
				$Session_Offset = $Session_Offset + 1;	
				
				Session::forget('Session_Offset');
			    Session::save();
				Session::put('Session_Offset',$Session_Offset); 
				Session::save();
				$question_id = $post['question_id'];
				$user_answer = isset($post['user_answer'])?$post['user_answer']:0;	
				
				
				if($Session_Result_Id==-1){				
					
					$data = array(
						'userid' => $Session_Student_Id,
						'quizid' => $quizid,
						'isFinished' => 0,
						'IsDelete' => 0,
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					);
					
					$insertid = Quizresult::insertGetId($data);
					
					Session::put('Session_Result_Id',$insertid); 
					Session::save();
					$Session_Result_Id = Session::get('Session_Result_Id'); 
				}					
				
				if(isset($post['answer_id']) && $post['answer_id']<>''){					
					
					$data = array(
						'optionchosen' => $post['user_answer'],
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					);
					$insertid = Quizanswer::where('answer_id', $post['answer_id'])->update($data);					
				}else{
					
					if(isset($post['user_answer']) && $post['user_answer']<>''){					
						$data = array(
							'resultid' => $Session_Result_Id,
							'userid' => $Session_Student_Id,
							'quizid' => $quizid,
							'questionid' => $question_list[0]['id'],
							'optionchosen' => $post['user_answer'],
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s')
						);
						$insertid = Quizanswer::insertGetId($data);
					}
				}	
				
				if($post['submit']=='Finish'){
					
					//set flag isFinished when quiz completed
					$data = array(						
						'isFinished' => 0,	//set 1	if required				
						'updated_at' => date('Y-m-d H:i:s')
					);
					$insertid = Quizresult::where('result_id', $Session_Result_Id)->update($data);	
										
					return redirect('quiz-result');
					
				}else{
					return redirect('playquiz');
				}
			}
			
		}
		
		$answer_info = array();
		if(isset($Session_Result_Id) && $Session_Result_Id!=-1){
			$answer_info = Quizanswer::where(array('resultid' => $Session_Result_Id,'quizid' => $quizid,'questionid' => $question_list[0]['id']))->first();
		}
		
		$Session_Vars = array(
                'Session_Offset' => $Session_Offset,
                'Session_Result_Id' => $Session_Result_Id                
			);
		
		return view('quiz/quiz',compact('quizid','quiz_details','total_question','question_list','Session_Vars','answer_info'));
	}
	
	
	public function playexam(Request $request){
		
		//check quiz and user ids are set or not
		if(Session::get('Session_Quiz_Id')){
			$quizid = Session::get('Session_Quiz_Id');
		}else{
			echo "You are not authorised to visit this page."; exit;
			return redirect(url('/'));	
		}			
		if(Session::get('Session_Student_Id')){
				$Session_Student_Id = Session::get('Session_Student_Id');
		}else{
			echo "You are not authorised to visit this page."; exit;
			return redirect(url('/'));	
		}
		
		
		$post = $request->all(); 	
		
		$quiz_details = Quiz::where(array('id' => $quizid))->first();
		$total_question = Question::where(array('quizid' => $quizid,'IsDelete' => 0))->get()->count();
		
		$current_date_time = date('Y-m-d H:i:s');
		$quiz_begin_date_time = $quiz_details['quiz_start_date'].' '.$quiz_details['quiz_start_time'];
		
		
		if(strtotime($current_date_time) >= strtotime($quiz_begin_date_time)){
			//User can proceed
		}
		else{
			echo "Wait till exam starts."; exit;
			return redirect(url('/'));	
		}
		
		
			
		$question_list = Question::where(array('quizid' => $quizid,'IsDelete' => 0))->orderBy('id', 'ASC')->get()->toArray();
		
		//print_r($question_list); exit;
		
		if(empty($question_list)){
			return redirect('startquiz')->with('msgerror', 'oops there is no question added by the school');
		}
		if(Session::get('Session_Result_Id')){
			$Session_Result_Id = Session::get('Session_Result_Id'); 
		}else{
			$Session_Result_Id = -1;
		}
				
		
		if ($request->isMethod('post')){ 			
			
			if(isset($post['submit']) &&  $post['submit']=='Finish'){ 
				//print_r($post);exit;
				
				$question_id = $post['question_id'];
				$user_answer = isset($post['user_answer'])?$post['user_answer']:0;	
				
				
				if($Session_Result_Id==-1){				
					
					$data = array(
						'userid' => $Session_Student_Id,
						'quizid' => $quizid,
						'isFinished' => 0,
						'IsDelete' => 0,
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					);
					
					$insertid = Quizresult::insertGetId($data);
					
					Session::put('Session_Result_Id',$insertid); 
					Session::save();
					$Session_Result_Id = Session::get('Session_Result_Id'); 
				}else{
					//set flag isFinished when quiz completed
					$data = array(						
						'isFinished' => 0,	//set 1	if required				
						'updated_at' => date('Y-m-d H:i:s')
					);
					$insertid = Quizresult::where('result_id', $Session_Result_Id)->update($data);
				}					
				
				
				if(isset($post['user_answer']) && $post['user_answer']<>''){					
					
					foreach($post['user_answer'] as $key=>$val){
						
						$answer_given = 0;
						$answer_given = Quizanswer::where(array('resultid' => $Session_Result_Id,'questionid' => $key))->get()->count();
					
					if(!$answer_given){					
						$data = array(
							'resultid' => $Session_Result_Id,
							'userid' => $Session_Student_Id,
							'quizid' => $quizid,
							'questionid' => $key,
							'optionchosen' => $val,
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s')
						);
						$insertid = Quizanswer::insertGetId($data);
					}else{
						$data = array(
							'optionchosen' => $val,							
							'updated_at' => date('Y-m-d H:i:s')
						);
						$insertid = Quizanswer::where(array('resultid' => $Session_Result_Id,'questionid' => $key))->update($data);	
					}
					
				}				
										
				return redirect('quiz-result');
				
			}
			
		}
		}
		
		$answer_info = array();
		if(isset($Session_Result_Id) && $Session_Result_Id!=-1){
			$answer_info = Quizanswer::where(array('resultid' => $Session_Result_Id,'quizid' => $quizid))->get()->toArray();
		}
		
		$Session_Vars = array(
                'Session_Result_Id' => $Session_Result_Id                
			);
			
		$answer_arr = array_column($answer_info, 'optionchosen', 'questionid');
		
		return view('quiz/playquiz_singlepage',compact('quizid','quiz_details','total_question','question_list','Session_Vars','answer_arr'));
	
	}
	
	//function to save user answer on click by ajax
	public function ajaxsaveanswer(Request $request){
		
		//check quiz and user ids are set or not
		if(Session::get('Session_Quiz_Id')){
			$quizid = Session::get('Session_Quiz_Id');
		}else{			
			echo json_encode(array('success'=>false, 'message'=>'You are not authorised to visit this page.'));exit;	
		}			
		if(Session::get('Session_Student_Id')){
				$Session_Student_Id = Session::get('Session_Student_Id');
		}else{			
			echo json_encode(array('success'=>false, 'message'=>'You are not authorised to visit this page.'));exit;
		}
		
		$post = $request->all();  
		
		if(Session::get('Session_Result_Id')){
			$Session_Result_Id = Session::get('Session_Result_Id'); 
		}else{
			$Session_Result_Id = -1;
		}
		
		if($Session_Result_Id==-1){				
					
			$data = array(
				'userid' => $Session_Student_Id,
				'quizid' => $quizid,
				'isFinished' => 0,
				'IsDelete' => 0,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			);
			
			$insertid = Quizresult::insertGetId($data);
			
			Session::put('Session_Result_Id',$insertid); 
			Session::save();
			$Session_Result_Id = Session::get('Session_Result_Id'); 
		}
		
		$answer_given = 0;
		$answer_given = Quizanswer::where(array('resultid' => $Session_Result_Id,'questionid' => $post['qid']))->get()->count();
		
		// if answer is not given just add it otherwise update it
		if(!$answer_given){					
			$data = array(
				'resultid' => $Session_Result_Id,
				'userid' => $Session_Student_Id,
				'quizid' => $quizid,
				'questionid' => $post['qid'],
				'optionchosen' => $post['qanswer'],
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			);
			$insertid = Quizanswer::insertGetId($data);
			if($insertid){
				echo json_encode(array('success'=>true, 'message'=>'Saved Successfully!'));exit;
			}
		}else{	
			$data = array(
				'optionchosen' => $post['qanswer'],							
				'updated_at' => date('Y-m-d H:i:s')
			);
			$insertid = Quizanswer::where(array('resultid' => $Session_Result_Id,'questionid' => $post['qid']))->update($data);
			
			if($insertid){
				echo json_encode(array('success'=>true, 'message'=>'Updated Successfully!'));exit;	
			}				
		}
		
		echo json_encode(array('success'=>false, 'message'=>'Oops something went wrong.'));
					
		//print_r($post); exit;
	}
	
	public function showquizresult(Request $request)
    {
        
		if(Session::get('Session_Result_Id')){
			$Session_Result_Id = Session::get('Session_Result_Id'); 
		}
		//$Session_Result_Id = $id;
		if(!$Session_Result_Id){
			return redirect(url('/'));
		}
		$details = Quizresult::where(array('result_id' => $Session_Result_Id))->first();
		if(!isset($details->quizid)){
			return redirect(url('/'));
		}
		$quizid = $details->quizid;		
		
		$result_data = Quizresult::get_result_data($Session_Result_Id);
		
		$quiz_details = Quiz::where(array('id' => $quizid))->first();
		
		$correct_answer = 0; $wrong_answer = 0; $user_score = 0;$quiz_full_marks = 0; $percentage = 0;
		$final_status = ''; $question_attempted = 0;
		
		if(isset($result_data)){ 
			foreach ($result_data as $value) {
			$value = (array) $value;
				if(isset($value['optionchosen'])){
					if($value['optionchosen']==$value['correct_answer']){
						$correct_answer++;
						$user_score += $value['score'];
					}
					$question_attempted++;
				}
		   }
        }
        
        
		$quiz_total_question = Question::where(array('quizid' => $quizid,'IsDelete' => 0))->get()->count();
		$quiz_full_marks = $quiz_total_question * 1; // each question has 1 mark

		//$wrong_answer = $quiz_total_question-$correct_answer;
		$wrong_answer = $question_attempted-$correct_answer;

		if($quiz_full_marks>0){
			$percentage = round(($user_score*100/$quiz_full_marks),2);
		}
		if($percentage>=33){
			$final_status = 'Pass';
		}else{
			$final_status = 'Fail';
		}		
		
		if($percentage>100){$percentage = 100;} // percentage cannot be grater than 100%
		
		$result_params = array(
                'final_status' => $final_status,
                'user_score' => $user_score,                
                'quiz_full_marks' => $quiz_full_marks,                
                'quiz_total_question' => $quiz_total_question,                
                'question_attempted' => $question_attempted,                
                'percentage' => $percentage,                
                'correct_answer' => $correct_answer,                  
                'wrong_answer' => $wrong_answer                
		);
		
        return view('quiz/quiz-result', compact('result_params'));
    }

    public function admissionform(Request $request){
		if ($request->isMethod('post')){
			$post = $request->all();
			//pr($post);die;
			
			if(empty(trim($post['present_class']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter present class.');
			}
			if(empty(trim($post['student_name']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter student name.');
			}
			if(empty(trim($post['dob']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter date of birth.');
			}
			if(empty(trim($post['dob_in_words']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter date of birth in words.');
			}
			if(empty(trim($post['nationality']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter nationality.');				
			}
			if(empty(trim($post['aadharno']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter aadhar no.');
			}
			if(empty(trim($post['religion']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter religion.');
			}
			if(empty(trim($post['sex']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter gender.');
			}
			if(empty(trim($post['social_category']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter social category.');
			}	
			if(empty(trim($post['blood_group']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter blood group.');
			}	
			if(empty(trim($post['permanent_address']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter permanent address.');
			}
			if(empty(trim($post['student_mobile']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter mobile no.');
			}
			if(empty(trim($post['email']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter email.');
			}	
			if(empty(trim($post['present_address']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter present address.');
			}
			if(empty(trim($post['father_name']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter father name.');
			}
			if(empty(trim($post['father_qualification']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter father qualification.');
			}
			if(empty(trim($post['father_occupation']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter father occupation.');
			}
			if(empty(trim($post['father_mobile']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter father mobile.');
			}
			if(empty(trim($post['mother_name']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter mother name.');
			}
			if(empty(trim($post['mother_qualification']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter mother qualification.');
			}
			if(empty(trim($post['mother_occupation']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter mother occupation.');
			}
			if(empty(trim($post['mother_mobile']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter mother mobile.');
			}
			if(empty(trim($post['family_income']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter family income.');
			}
			if(empty(trim($post['last_school_name_address']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter last school name & address.');
			}			
			if(empty(trim($post['board_name']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter board name.');
			}
			if(empty(trim($post['board_registration_no']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter board registration no.');
			}
			if(empty(trim($post['board_roll_no']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter board roll no.');
			}
			if(empty(trim($post['passing_year']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter passing year.');
			}
			if(empty(trim($post['english_marks']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter english marks.');
			}
			if(empty(trim($post['science_marks']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter science marks.');
			}
			if(empty(trim($post['math_marks']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter math marks.');
			}
			if(empty(trim($post['marks_percentage']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter marks percentage.');
			}
			if(empty(trim($post['exam_medium']))){
				return redirect()->back()->withInput()->with('msgerror', 'Please enter exam medium.');
			}
			
			$selected_subjects = @implode(',',$post['selected_subjects']);
			
			if(empty($selected_subjects)){
				return redirect()->back()->withInput()->with('msgerror', 'Please select subjects.');
			}
			
			$dt = @explode('-',$post['dob']);
		    $dob = $dt[2].'-'.$dt[1].'-'.$dt[0]; 			
			$admission_ref_no = date('Ymd').rand(10,99);  //generate reference number
			
			$dataStudent = array(
                'admission_ref_no' => $admission_ref_no,                
                'present_class' => $post['present_class'],                
                'student_name' => $post['student_name'],                
				'Date_of_Birth' => $dob,
				'dob_in_words' => $post['dob_in_words'],
				'Admission_Date' => date('Y-m-d'),
				'nationality' => $post['nationality'],
				'aadharno' => $post['aadharno'],
				'religion' => $post['religion'],
				'Sex' => $post['sex'],
				'social_category' => $post['social_category'],
				'blood_group' => $post['blood_group'],
				'permanent_address' => $post['permanent_address'],
				'contact_no' => $post['student_mobile'],
				'email' => $post['email'],
				'Address' => $post['present_address'],
				'Father_Name' => $post['father_name'],
				'father_qualification' => $post['father_qualification'],
				'father_occupation' => $post['father_occupation'],
				'father_mobile' => $post['father_mobile'],
				'Mother_Name' => $post['mother_name'],
				'mother_qualification' => $post['mother_qualification'],
				'mother_occupation' => $post['mother_occupation'],
				'mother_mobile' => $post['mother_mobile'],
				'family_income' => $post['family_income'],
				'last_school_name_address' => $post['last_school_name_address'],
				'board_name' => $post['board_name'],
				'board_registration_no' => $post['board_registration_no'],
				'board_roll_no' => $post['board_roll_no'],
				'passing_year' => $post['passing_year'],
				'english_marks' => $post['english_marks'],
				'science_marks' => $post['science_marks'],
				'math_marks' => $post['math_marks'],
				'marks_percentage' => $post['marks_percentage'],
				'exam_medium' => $post['exam_medium'],
				'selected_subjects' => $selected_subjects,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
			);
			//print_r($request->all());
			
			//upload student photo
			$imageName='';
			if ($request->hasFile('student_photo')) { //echo 1; exit;
                $rules = array(
                    'student_photo' => 'required | mimes:jpg,jpeg,png,JPG,JPEG,PNG | max:2049'
                );
                $validator = Validator::make($post, $rules);
                if($validator->fails()) {
                    return redirect()->back()->withInput()->with('msgerror', 'Photo should be jpg/png and size should not be greater than 2 Mb.');
                }
                if(!is_dir("public/upload/student_photo/")) {
                    mkdir("public/upload/student_photo/", 0777, true);
                }
                $image = $request->file('student_photo');
                $imageName = $image->getClientOriginalName();
				
                $file = explode('.', $imageName);  //echo 'img:  '.$imageName; exit;
                $imageName = $file[0]. '_' . md5(microtime()) . '.' . end($file);
				$imageName = str_replace(' ','_',$imageName);
                if (!file_exists('public/upload/student_photo/'. $imageName)) {
                    $path = 'public/upload/student_photo/';
                    $image->move($path, $imageName);
                }
            }else{
				return redirect()->back()->withInput()->with('msgerror', 'Photo is required.');
			}		
			
           
            if(!empty($imageName)){
                $dataStudent['student_photo'] = $imageName;
            }
			
			//upload student marksheet
			$imageName='';
			if ($request->hasFile('student_marksheet')) { 
                $rules = array(
                    'student_marksheet' => 'required | mimes:jpg,jpeg,png,pdf,JPG,JPEG,PNG,PDF | max:2049'
                );
                $validator = Validator::make($post, $rules);
                if($validator->fails()) {
                     return redirect()->back()->withInput()->with('msgerror', 'Marksheet should be jpg/png and size should not be greater than 2 MB.');
                }
                if(!is_dir("public/upload/student_marksheet/")) {
                    mkdir("public/upload/student_marksheet/", 0777, true);
                }
                $image = $request->file('student_marksheet');
                $imageName = $image->getClientOriginalName();
				
                $file = explode('.', $imageName);
                $imageName = $file[0]. '_' . md5(microtime()) . '.' . end($file);
				$imageName = str_replace(' ','_',$imageName);
                if (!file_exists('public/upload/student_marksheet/'. $imageName)) {
                    $path = 'public/upload/student_marksheet/';
                    $image->move($path, $imageName);
                }
            }else{
				return redirect()->back()->withInput()->with('msgerror', 'Marksheet is required.');
			}
            
            if(!empty($imageName)){
                $dataStudent['student_marksheet'] = $imageName;
            }
			
			//Finally submit student info
			$insertGetId = DB::table('student_master')->insertGetId($dataStudent);
			
			if($insertGetId){
				return redirect(url('admission-success/'.$admission_ref_no));
			}else{
				return redirect()->back()->withInput()->with('msgerror', 'Oops unable to submit! try again.');
			}
			
		}
		return view('staticpages/admissionform');
	}
	
	public function admissionsuccess(Request $request,$ref_no){
		//echo $ref_no; exit;
		$studentData = DB::table('student_master')->select('*')->where('admission_ref_no',$ref_no)->first();
		$mst_class = DB::table('mst_class')->select('*')->where('class_name',$studentData->present_class)->where('type','newadmission')->first();

		$encrypted = trim($mst_class->discounted_fee_amount + $mst_class->registration_fee).'/'.trim($studentData->admission_ref_no);
		$secureCode = base64_encode(base64_encode($encrypted));
		//pr($studentData);
		if($studentData->IsPayment == 1){
			die('Payment already done. please contact administrator.');
		}
		
		return view('staticpages/admissionsuccess',compact('ref_no','studentData','mst_class','secureCode'));
	}
	
	public function answersheet(Request $request)
    {
        
		if(Session::get('Session_Result_Id')){
			$Session_Result_Id = Session::get('Session_Result_Id'); 
		}
		//$Session_Result_Id = $id;
		if(!$Session_Result_Id){
			return redirect(url('/'));
		}
		$details = Quizresult::where(array('result_id' => $Session_Result_Id))->first();
		if(!isset($details->quizid)){
			return redirect(url('/'));
		}
		$quizid = $details->quizid;		
		
		$result_data = Quizresult::get_result_data($Session_Result_Id);
		
		$quiz_details = Quiz::where(array('id' => $quizid))->first();
		
		$QuizquestionsList = Question::getquizquestions($quizid);

		//print_r($QuizquestionsList); exit;
		
		if ($result_data) {
            foreach ($result_data as $value) {
                $value = (array) $value;
				$user_result_data_arr[$value['questionid']] = $value;
            }
        }
		//print_r($user_result_data_arr); exit;

        $quiz_total_question = Question::where(array('quizid' => $quizid,'IsDelete' => 0))->get()->count();
		             
        return view( 'quiz/answer-sheet', compact( 'id', 'details', 'quiz_details', 'QuizquestionsList', 'user_result_data_arr') );
    }
	
	public function crownjob() {
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "developer.kaif@gmail.com";
        $to = "sibo.sarso@gmail.com";
        $subject = "PHP Mail Test script";
        $message = "This is a test to check the cron jobs functionality";
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
        echo "Test email sent PCS";exit;
        //echo '<pre>';print_r($this->session);die;
        
    }
	
	public function examgroup(Request $request, $id = null) {

		$QuizGroupList = Quizgroup::where(array('IsDelete' => 0))->get()->toArray();
		//echo 1; exit;
		return view('result/quiz-group-list', compact('QuizGroupList', 'id'));
	}
	
	public function resultlistbygroup(Request $request, $id = null) {
		//echo 1; exit;
		$post = $request->all();
		//abort(404);
		//print_r($post); exit; 
		$admission_no = '';
		if(isset($post['admission_no'])){
			$admission_no = $post['admission_no'];
		}
		$studentid = '';
		if(isset($post['studentid'])){
			$studentid = $post['studentid'];
		}		
				
		$QuizGroupData = Quizgroup::where(array('IsDelete' => 0,'id' => $id))->first();
		
		//print_r($QuizGroupData); exit;
		
		
		if(isset($studentid) && $studentid<>''){
			$StudentmasterData = Studentmaster::where(array('id'=>$studentid))->first();
		}elseif(isset($admission_no) && $admission_no<>''){
			$StudentmasterData = Studentmaster::getStudentInfoByAdmissionNo($admission_no);
		}else{
			$StudentmasterData = null;
		}
		
		//$collection = collect([1, 2, 3, 4]);

		//echo $StudentmasterList->count();
		
		//print_r($StudentmasterData); exit;
		
		return view('result/resultlist-by-group', compact('StudentmasterData', 'id', 'admission_no','studentid','QuizGroupData'));
	}
	
	public static function find_quiz_score($user_id, $quizgroup_id, $subject_id) {

		$data = DB::table('quiz_result as qr')
			->select('qr.result_id')
			->join('quiz as q', 'qr.quizid', '=', 'q.id', 'LEFT')
			->where('qr.userid', $user_id)
			->where('q.quizgroup_id', $quizgroup_id)
			->where('q.subject_id', $subject_id)
			->get()->toArray();
		//print_r($data);exit;

		$user_score = 0;

		if (isset($data[0]->result_id)) {

			$result_id = $data[0]->result_id;
			$result_data = Quizresult::get_result_data($result_id);

			if ($result_data) {
				foreach ($result_data as $value) {
					$value = (array) $value;
					if (isset($value['optionchosen'])) {
						if ($value['optionchosen'] == $value['correct_answer']) {

							$user_score += $value['score'];
						}

					}
				}
			}
		}
		return $user_score;
	}
	
	public static function find_quiz_full_marks_old($user_id, $quizgroup_id, $subject_id) {
		$full_marks = 0;
		$data = DB::table('quiz_result as qr')
			->select('qr.result_id','qr.quizid')
			->join('quiz as q', 'qr.quizid', '=', 'q.id', 'LEFT')
			->where('qr.userid', $user_id)
			->where('q.quizgroup_id', $quizgroup_id)
			->where('q.subject_id', $subject_id)
			->first();
			if(isset($data->quizid) && $data->quizid>0){
				$quiz_details = Quiz::where(array('id'=>$data->quizid))->first();				
			}
			if(isset($quiz_details->quiz_max_marks) && $quiz_details->quiz_max_marks<>''){
				$full_marks = $quiz_details->quiz_max_marks;				
			}
			
		//print_r($full_marks);exit;
		return $full_marks;
	}
	
	public static function find_quiz_full_marks($quizgroup_id, $subject_id) {
		$full_marks = 0;
		$quiz_details = DB::table('quiz')
			->select('id','quiz_max_marks')
			->where('quizgroup_id', $quizgroup_id)
			->where('subject_id', $subject_id)
			->where('IsDelete', 0)
			->first();
			//if(isset($data->id) && $data->id>0){
				//$quiz_details = Quiz::where(array('id'=>$data->id))->first();				
			//}
			if(isset($quiz_details->quiz_max_marks) && $quiz_details->quiz_max_marks<>''){
				$full_marks = $quiz_details->quiz_max_marks;				
			}
			
		//print_r($quiz_details);exit;
		return $full_marks;
	}
	
	
		
}	
