<?php

namespace App\Console\Commands;

use App\Quizinvitation;
use DB;
use Illuminate\Console\Command;

class ExamNotice extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'ExamNotification:cron';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Half yearly exam notice';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		if (is_localhost()) {
			$front_url = 'http://localhost/pcskhalipur/';
		} else {
			$front_url = 'http://pcskhalispur.com/';
		}
		//ini_set('display_errors', 1);
		//error_reporting(E_ALL);
		//$from = "developer.kaif@gmail.com";
		//$to = "sibo.sarso@gmail.com";
		//$subject = "PHP Mail Test script";
		//$message = "This is a test to check the cron jobs functionality";
		//$headers = "From:" . $from;
		//mail($to, $subject, $message, $headers);
		//DB::table('test')->delete();

		$data = DB::table('quiz_invitation as T')
			->select('T.id', 'T.quiz_id', 'T.student_master_id', 'T.invitation_link', 'T.isVerified', 'T.sms_sent', 'T2.quiz_start_date', 'T2.quiz_end_date', 'T2.quiz_start_time', 'T2.quiz_end_time', 'T2.quiz_title', 'T3.present_class', 'T3.student_name', 'T3.contact_no')
			->join('quiz as T2', 'T.quiz_id', '=', 'T2.id', 'LEFT')
			->join('student_master as T3', 'T.student_master_id', '=', 'T3.id', 'LEFT')
		//->whereDate('T2.quiz_start_date', '>=', Carbon::now('Asia/Kolkata')->toDateString())
			->where('T.IsDelete', 0)
			->orderBy('T.created_at', 'ASC')->get()->toArray();

		if ($data) {
			foreach ($data as $key => $value) {
				$startDate = date('dS F', strtotime($value->quiz_start_date));
				$startTime = date('h:i a', strtotime($value->quiz_start_time));
				$message = 'Dear students analyse your skill with on line Periodic Test-1 going to start from ' . $startDate . ' from ' . $startTime . '.just one click here ';
				$MsgLink = $front_url . 'din/' . $value->invitation_link;
				$quizmessage = $message . ' ' . $MsgLink . ' to start the test';

				$msg = str_replace(' ', '%20', $quizmessage);
				$mobileno = $value->contact_no;
				echo $url = "http://shikshakiore.com/cpc/isssms.aspx?mobile=$mobileno&msgtxt=$msg&user=INPCSK&lang=english&name=1300";
				die;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$curl_response = curl_exec($ch);
				curl_close($ch);
				$result = json_decode($curl_response, true);
				pr($result);
				if (isset($result['status']) && $result['status'] == 1) {
					$dataupdate = array(
						'sms_sent' => 1,
						'updated_at' => date('Y-m-d H:i:s'),
					);
					Quizinvitation::where('id', $value->id)->update($dataupdate);
				}
			}
		}
		//$QuizinvitationList = Quizinvitation::get()->toArray();

		//pr($data);
		//pr(Carbon::now('Asia/Kolkata')->toDateString());
		echo "Test email sent PCS";exit;
	}
}
