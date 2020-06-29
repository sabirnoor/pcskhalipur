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
	
	public function startquiz(Request $request)
    {        
        $quiz_details = Quiz::where(array('IsDelete' => 0))->first();
		//print_r($quiz_details); exit;
		$quizid = $quiz_details['id'];
		
		Session::put('Session_Quiz_Id',$quizid); 
		Session::save();
		return redirect('quiz');

        //return view('result/result-list', compact('QuizresultList', 'id'));
    }
	
	public function playquiz(Request $request){
		
		//var_dump(Session::get('Session_Quiz_Id')); exit;
		
		if(Session::get('Session_Quiz_Id')){
			$quizid = Session::get('Session_Quiz_Id');
		}else{
			echo "You are not authorised to visit this page."; exit;
		}	
		
		$post = $request->all(); //print_r($post);exit;		
		
		$quiz_details = Quiz::where(array('id' => $quizid))->first();
		$total_question = $quiz_details['quiz_total_question'];
		
		
		
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
		$question_list = Question::where(array('quizid' => $quizid))->orderBy('id', 'ASC')->offset($offset)->limit(1)->get()->toArray();

		if(Session::get('Session_Result_Id')){
			$Session_Result_Id = Session::get('Session_Result_Id'); 
		}else{
			$Session_Result_Id = -1;
		}
				
		
		if ($request->isMethod('post')){  //&& $dataSession
						
			if(isset($post['submit']) && $post['submit']=='Prev'){
				$Session_Offset = $Session_Offset - 1;
				if($Session_Offset<0){
					$Session_Offset = 0;
				}
				Session::forget('Session_Offset');
			    Session::save();
				Session::put('Session_Offset',$Session_Offset); 
			    Session::save();
				return redirect('quiz');
			}
			
			if(isset($post['submit']) &&  ($post['submit']=='Next' || $post['submit']=='Finish')){ //exit;
				$Session_Offset = $Session_Offset + 1;	
				
				Session::forget('Session_Offset');
			    Session::save();
				Session::put('Session_Offset',$Session_Offset); 
				Session::save();
				$question_id = $post['question_id'];
				$user_answer = isset($post['user_answer'])?$post['user_answer']:0;	
				
				
				if($Session_Result_Id==-1){				
					
					$data = array(
						'userid' => 1439,
						'quizid' => $quizid,
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
					
					$data = array(
						'resultid' => $Session_Result_Id,
						'userid' => 1439,
						'quizid' => $quizid,
						'questionid' => $question_list[0]['id'],
						'optionchosen' => $post['user_answer'],
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s')
					);
					$insertid = Quizanswer::insertGetId($data);
				}	
				
				if($post['submit']=='Finish'){	//|| $post['timeup']==1
					
					Session::forget('Session_Result_Id');
					Session::forget('Session_Offset');
					Session::save();
					
					return redirect('quiz-result/'.$Session_Result_Id);
					
				}else{
					return redirect('quiz');
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
	
	public function showquizresult(Request $request, $id = null)
    {
        
		$resultid = $id;
		
		$details = Quizresult::where(array('result_id' => $id))->first();
		$quizid = $details->quizid;		
		
		$result_data = Quizresult::get_result_data($resultid);
		
		$quiz_details = Quiz::where(array('id' => $quizid))->first();
		
		$correct_answer = 0; $wrong_answer = 0; $user_score = 0;$quiz_full_marks = 0; $percentage = 0;
		$final_status = '';
		
		if($result_data){
			foreach ($result_data as $value) {
			$value = (array) $value;
				if($value['optionchosen']==$value['correct_answer']){
					$correct_answer++;
					$user_score += $value['score'];
				}
		   }
        }
        
        $quiz_full_marks = $quiz_details['quiz_max_marks'];
		$quiz_total_question = $quiz_details['quiz_total_question'];

		$wrong_answer = $quiz_total_question-$correct_answer;

		if($quiz_full_marks>0){
			$percentage = round($user_score*100/$quiz_full_marks);
		}
		if($percentage>=40){
			$final_status = 'Pass';
		}else{
			$final_status = 'Fail';
		}		
		        
		$result_params = array(
                'final_status' => $final_status,
                'user_score' => $user_score,                
                'quiz_full_marks' => $quiz_full_marks,                
                'percentage' => $percentage,                
                'correct_answer' => $correct_answer,                  
                'wrong_answer' => $wrong_answer                
		);
		
        return view('quiz/quiz-result', compact('result_params'));
    } 
		
}	
