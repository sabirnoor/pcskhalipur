<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Tek_admin_login;
use App\Masterrouteservice;
use App\Masternewcoach;
use App\Bussearchmodels;
use App\Customratecard;
use App\Wallet_transaction;
use Crypt;
use DB;
use Illuminate\Support\Facades\Input;
// for cart
use Illuminate\Support\Facades\Redirect;
use Location;

class SearchController extends Controller {

    protected $url;
    protected $authorization_key;

    public function __construct() {
        $this->url = getenv('APP_URL');
        $this->authorization_key = getenv('AUTH');
    }
    
    
    public function index(Request $request) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        //echo Crypt::decrypt('123');
        if ($request->isMethod('post')) {
            $post = $request->all();
            
            $trd = !empty($post['traveldate']) ? explode('-', $post['traveldate']) : explode('-', date('d-m-Y'));
            $traveldate = $trd[2] . '-' . $trd[1] . '-' . $trd[0];
            $dayName = date('D',strtotime($traveldate));
            $RoutesList = Bussearchmodels::Search($request, session::get('User')->id);
            //echo '<pre>';print_r($RoutesList);
            if ($RoutesList) {
                $data = array();
                $dataassum = array();
                foreach($RoutesList as $k => $val) {
                    $coachName = $val->vehicle . ' ' . $val->isac . ' ' . $val->bus_typename . ' (' . $val->layout_type . ')';
                    $t1 = strtotime('2018/01/01 ' . $val->fr_bordingtime . '');
                    $t2 = strtotime('2018/01/02 ' . $val->to_bordingtime . '');
                    $delta_T = ($t2 - $t1);
                    $day = round(($delta_T % 604800) / 86400);
                    $hours = round((($delta_T % 604800) % 86400) / 3600);
                    $minutes = round(((($delta_T % 604800) % 86400) % 3600) / 60);
                    $sec = round((((($delta_T % 604800) % 86400) % 3600) % 60));
                    $hours = ($hours > 9) ? $hours : '0' . $hours;
                    $minutes = ($minutes > 9) ? $minutes : '0' . $minutes;
                    $travelTime = $hours . ':' . $minutes . ' hours';
                    $data_encrypted = Crypt::encrypt($val->id . '-' . $val->ag . '-' . $val->route_id . '-' . strtotime($traveldate));
                    $seat_lower_arr = json_decode($val->lower_seat);
                    $seat_upper_arr = json_decode($val->upper_seat);
                    $weekdays = explode(',',$val->weekdays);
                    if(in_array($dayName, $weekdays)){
                        $fare_seater = $val->sfwk;
                        $fare_sleeper = $val->slfwk;
                    }else{
                        $fare_seater = $val->sfw;
                        $fare_sleeper = $val->slfw;
                    }
					$fare_custom = [];
					$custom_ratecard = Customratecard::where(array('route_id'=>$val->route_id,'IsDelete'=>0))->get();
					if($custom_ratecard){
						foreach($custom_ratecard as $k=>$custom){
							if(in_array($dayName, $weekdays)){
								$fare_custom[$custom->seat_no] = $custom->fare_weekend;
							}else{
								$fare_custom[$custom->seat_no] = $custom->fare_weekdays;
							}
						}
					}
                    $TotalBookedSeat = Bussearchmodels::TotalBookedSeat($val->id,$val->route_id,$val->bus_type,$val->fromcity_id,$val->tocity_id,$traveldate);                   
                    //echo '<pre>';print_r($custom_ratecard);die;
                    $c = 0; $skip_array=array();$seat_booked_arr = $TotalBookedSeat;    $countTotalST=array();
                    $output = "<table><tr><td colspan='14'>LOWER</td></tr>\n";
                        for($i=1;$i<=6;$i++){
                    $output .= "<tr>\n";
                            for($j=1;$j<=15;$j++){
                                $class=""; $span="";
                                if(!empty($seat_lower_arr[$c][0])){

                                    if(in_array($c,$skip_array)){
                                        $c++; 
                                        continue;
                                    }	
                                    if(isset($seat_lower_arr[$c+1][0]) && ($seat_lower_arr[$c][0]==$seat_lower_arr[$c+1][0])){

                                        if(in_array($seat_lower_arr[$c][0],$seat_booked_arr)){
                                                $class=' class="sleeper-horizontal-booked"';
                                        }else{
                                                $class='class="availableseat sleeper-horizontal"';
                                        }				
                                        $span=' colspan="2"';
                                        $skip_array[]=$c+1;

                                    }elseif(isset($seat_lower_arr[$c+15][0]) && ($seat_lower_arr[$c][0]==$seat_lower_arr[$c+15][0])){

                                        if(in_array($seat_lower_arr[$c][0],$seat_booked_arr)){
                                                $class=' class="sleeper-vertical-booked"';
                                        }else{
                                                $class='class="availableseat sleeper-vertical"';
                                        }				
                                        $span=' rowspan="2"';
                                        $skip_array[]=$c+15;

                                    }else{

                                        if(in_array($seat_lower_arr[$c][0],$seat_booked_arr)){
                                            $class=' class="seater-booked"';
                                        }else{
                                            $class=' class="availableseat seater"';
                                        }
                                    }

                                }
                                if(isset($seat_lower_arr[$c][0]) && $seat_lower_arr[$c][0]<>""){
                                    if($seat_lower_arr[$c][1] == 'ST'){
									   $Fare_st = (isset($fare_custom[$seat_lower_arr[$c][0]]) && !empty($fare_custom[$seat_lower_arr[$c][0]])?$fare_custom[$seat_lower_arr[$c][0]]:$fare_seater);
                                       $title = 'Seat No-'.$seat_lower_arr[$c][0].' | Fare-'.$Fare_st; 
                                    }else{
									   $Fare_sl = (isset($fare_custom[$seat_lower_arr[$c][0]]) && !empty($fare_custom[$seat_lower_arr[$c][0]])?$fare_custom[$seat_lower_arr[$c][0]]:$fare_sleeper);
                                       $title = 'Seat No-'.$seat_lower_arr[$c][0].' | Fare-'.$Fare_sl; 
                                    }
                                    $countTotalST[] = $seat_lower_arr[$c][0];
                    $output .= "<td ".$class." ".$span." id='".$seat_lower_arr[$c][0]."' onclick='angular.element(this).scope().SelectSeat()' data='".$seat_lower_arr[$c][1]."' title='".$title."'>".$seat_lower_arr[$c][0]."</td>\n";
                                }else{
                    $output .= "<td></td>\n";                
                                }
                            $c++;
                            }
                    $output .= "</tr>\n";
                        }
                    "</table>\n"; 
                    
                    ///UPPER SEAT LAYOUT
                    $cc = 0; $skip_array2=array();$countTotalSL=array();
                    $output_U = "<table><tr><td colspan='14'>UPPER</td></tr>\n";
                        for($i=1;$i<=6;$i++){
                    $output_U .= "<tr>\n";
                            for($j=1;$j<=15;$j++){
                                $class=""; $span="";
                                if(!empty($seat_upper_arr[$cc][0])){

                                    if(in_array($cc,$skip_array2)){
                                        $cc++; 
                                        continue;
                                    }	
                                    if(isset($seat_upper_arr[$cc+1][0]) && ($seat_upper_arr[$cc][0]==$seat_upper_arr[$cc+1][0])){

                                        if(in_array($seat_upper_arr[$cc][0],$seat_booked_arr)){
                                                $class=' class="sleeper-horizontal-booked"';
                                        }else{
                                                $class='class="availableseat sleeper-horizontal"';
                                        }				
                                        $span=' colspan="2"';
                                        $skip_array2[]=$cc+1;

                                    }elseif(isset($seat_upper_arr[$cc+15][0]) && ($seat_upper_arr[$cc][0]==$seat_upper_arr[$cc+15][0])){

                                        if(in_array($seat_upper_arr[$cc][0],$seat_booked_arr)){
                                                $class=' class="sleeper-vertical-booked"';
                                        }else{
                                                $class='class="availableseat sleeper-vertical"';
                                        }				
                                        $span=' rowspan="2"';
                                        $skip_array2[]=$cc+15;

                                    }else{

                                        if(in_array($seat_upper_arr[$cc][0],$seat_booked_arr)){
                                            $class=' class="seater-booked"';
                                        }else{
                                            $class=' class="availableseat seater"';
                                        }
                                    }

                                }
                                if(isset($seat_upper_arr[$cc][0]) && $seat_upper_arr[$cc][0]<>""){
                                    if($seat_upper_arr[$cc][1] == 'ST'){
										$Fare_st = (isset($fare_custom[$seat_upper_arr[$cc][0]]) && !empty($fare_custom[$seat_upper_arr[$cc][0]])?$fare_custom[$seat_upper_arr[$cc][0]]:$fare_seater);
                                       $title = 'Seat No-'.$seat_upper_arr[$cc][0].' | Fare-'.$Fare_st; 
                                    }else{
										$Fare_sl = (isset($fare_custom[$seat_upper_arr[$cc][0]]) && !empty($fare_custom[$seat_upper_arr[$cc][0]])?$fare_custom[$seat_upper_arr[$cc][0]]:$fare_sleeper);
                                       $title = 'Seat No-'.$seat_upper_arr[$cc][0].' | Fare-'.$Fare_sl; 
                                    }
                                    $countTotalSL[] = $seat_upper_arr[$cc][0];
                    $output_U .= "<td ".$class." ".$span." id='".$seat_upper_arr[$cc][0]."' onclick='angular.element(this).scope().SelectSeat()' data='".$seat_upper_arr[$cc][1]."' title='".$title."'>".$seat_upper_arr[$cc][0]."</td>\n";
                                }else{
                    $output_U .= "<td></td>\n";                
                                }
                            $cc++;
                            }
                    $output_U .= "</tr>\n";
                        }
                    "</table>\n";
                    
                    $AvailableSeats = ((count($countTotalST)+count($countTotalSL))-count($TotalBookedSeat));
                    $dataassum = array(
                        'id' => $val->id,
                        'ag' => $val->ag,
                        'route_id' => $val->route_id,
                        'fromcity_id' => $val->fromcity_id,
                        'fromcity_name' => $val->fromcity_name,
                        'tocity_id' => $val->tocity_id,
                        'tocity_name' => $val->tocity_name,
                        'validfrom' => $val->validfrom,
                        'validto' => $val->validto,
                        'currency' => $val->currency,
                        'weekdays' => $val->weekdays,
                        'fare_seater' => $fare_seater,
                        'fare_sleeper' => $fare_sleeper,
                        'st_dsl' => $val->st_dsl,
                        'sl_dsl' => $val->sl_dsl,
                        'bus_type' => $val->bus_type,
                        'service_name' => $val->service_name,
                        'coachName' => $coachName,
                        'travels_name' => $val->travels_name,
                        'fr_bordingtime' => $val->fr_bordingtime,
                        'frnext_day' => $val->frnext_day,
                        'frborpnt_id' => $val->frborpnt_id,
                        'to_bordingtime' => $val->to_bordingtime,
                        'tonext_day' => $val->tonext_day,
                        'toborpnt_id' => $val->toborpnt_id,
                        'frlocation' => $val->frlocation,
                        'tolocation' => $val->tolocation,
                        'travelTime' => $travelTime,
                        'traveldate' => !empty($post['traveldate']) ? $post['traveldate'] : date('d-m-Y'),
                        'lower_seat' => $val->lower_seat,
                        'upper_seat' => $val->upper_seat,
                        'output' => $output,
                        'output_U' => $output_U,
                        'upperTrue' => array_empty($seat_upper_arr),
                        'lowerTrue' => array_empty($seat_lower_arr),
                        'boardingfrom' => Bussearchmodels::BordingdropoffpointList($val->route_id, $val->fromcity_id),
                        'dropingto' => Bussearchmodels::BordingdropoffpointList($val->route_id, $val->tocity_id),
                        'TotalBookedSeat' => $TotalBookedSeat,
                        'TotalBookedSeatCount' => count($TotalBookedSeat),
                        'countTotalST' => count($countTotalST),
                        'countTotalSL' => count($countTotalSL),
                        'AvailableSeats' => $AvailableSeats,
                        'fare_custom' => $fare_custom,
                    );
                    //echo '<pre>';print_r($dataassum);
                    $data['record'][] = $dataassum;
                    //$data['CoachName'][] = CoachName($val->bus_type);
                    //$data['brpfrom'][] = Bussearchmodels::BordingdropoffpointList($val->route_id,$val->fromcity_id);
                    //$data['brpto'][] = Bussearchmodels::BordingdropoffpointList($val->route_id,$val->tocity_id);
                    //$data['img'][] = Bussearchmodels::coachgallery($val->bus_type);
                }
            }
            echo json_encode($data);
            exit;
            //$data = json_encode($post_data);
        }
        return view('bus/bus-searchbus');
    }

    public function brpoint(Request $request, $data = null) {
        $post = $request->all();
        //if($request->isXmlHttpRequest()) {
        $ex = explode('_', $post['data']);
        $result = Bussearchmodels::BordingdropoffpointList($ex[1], $ex[2]);
        return view('bus/ajax/ajax-brpoint', compact('result'));
        //}
    }

    public function randomId() {
        $id = str_random(8);
        $validator = \Validator::make(['id' => $id], ['id' => 'unique:master_booking,id']);
        if ($validator->fails()) {
            $this->randomId();
        }
        return $id;
    }

    public function processtopayment(Request $request) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            //echo '<pre>';print_r($post);die;
            $ip = $request->ip();
            $loc = Location::get($ip);
            $pnr_number = self::randomId();
            $trdb = isset($post['traveldate']) ? explode('-', $post['traveldate']) : '';
            $traveldate = $trdb[2] . '-' . $trdb[1] . '-' . $trdb[0];
            $data = array(
                'pnr_numbers' => strtoupper($pnr_number),
                'booking_id' => date('dmhisy'),
                'ratecard_id' => isset($post['rateid']) ? $post['rateid'] : '',
                'agent_id' => session::get('User')->id,
                'operator_id' => isset($post['agentId']) ? $post['agentId'] : '',
                'route_id' => isset($post['route_id']) ? $post['route_id'] : '',
                'bus_type' => isset($post['bus_type']) ? $post['bus_type'] : '',
                'fromcity_id' => isset($post['fromcity_id']) ? $post['fromcity_id'] : '',
                'fromcity_name' => isset($post['fromcity_name']) ? $post['fromcity_name'] : '',
                'tocity_id' => isset($post['tocity_id']) ? $post['tocity_id'] : '',
                'tocity_name' => isset($post['tocity_name']) ? $post['tocity_name'] : '',
                'traveldate' => isset($traveldate) ? $traveldate : '',
                'currency' => isset($post['currency']) ? $post['currency'] : '',
                'coachName' => isset($post['coachName']) ? $post['coachName'] : '',
                'travels_name' => isset($post['travels_name']) ? $post['travels_name'] : '',
                'fr_bordingtime' => isset($post['fr_bordingtime']) ? $post['fr_bordingtime'] : '',
                'to_bordingtime' => isset($post['to_bordingtime']) ? $post['to_bordingtime'] : '',
                'travelTime' => isset($post['travelTime']) ? $post['travelTime'] : '',
                'boardingfrom' => isset($post['boardingfrom']) ? $post['boardingfrom'] : '',
                'dropingto' => isset($post['dropingto']) ? $post['dropingto'] : '',
                'TotalPax' => isset($post['seatno']) ? count($post['seatno']) : '',
                'pax_name' => isset($post['pax_name']) ? $post['pax_name'] : '',
                'emailid' => isset($post['emailid']) ? $post['emailid'] : '',
                'mobileno' => isset($post['mobileno']) ? $post['mobileno'] : '',
                'fulladdress' => isset($post['fulladdress']) ? $post['fulladdress'] : '',
                'paynetfare' => isset($post['netfare']) ? $post['netfare'] : '',
                'seatnumber' => isset($post['seatno']) ? implode(',', $post['seatno']) : '',
                'IPaddress' => $ip,
                'IPlocation' => json_encode($loc),
                '_tokenId' => isset($post['_token']) ? $post['_token'] : '',
                'created_by' => session::get('User')->id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_by' => session::get('User')->id,
                'modified_on' => date('Y-m-d H:i:s')
            );

            $insertId = DB::table('master_booking')->insertGetId($data);
            $seatno = isset($post['seatno']) ? $post['seatno'] : '';
            $pass_name = isset($post['pass_name']) ? $post['pass_name'] : '';
            $pass_gender = isset($post['pass_gender']) ? $post['pass_gender'] : '';
            $pass_age = isset($post['pass_age']) ? $post['pass_age'] : '';
            if ($seatno) {
                foreach ($seatno as $k => $val) {
                    $datadetail = array(
                        'master_booking_id' => $insertId,
                        'ratecard_id' => isset($post['rateid']) ? $post['rateid'] : '',
                        'agent_id' => session::get('User')->id,
                        'operator_id' => isset($post['agentId']) ? $post['agentId'] : '',
                        'route_id' => isset($post['route_id']) ? $post['route_id'] : '',
                        'bus_type' => isset($post['bus_type']) ? $post['bus_type'] : '',
                        'fromcity_id' => isset($post['fromcity_id']) ? $post['fromcity_id'] : '',
                        'tocity_id' => isset($post['tocity_id']) ? $post['tocity_id'] : '',
                        'pass_name' => $pass_name[$k],
                        'pass_gender' => $pass_gender[$k],
                        'pass_age' => $pass_age[$k],
                        'seatno' => $seatno[$k],
                        'traveldate' => isset($traveldate) ? $traveldate : '',
                        'created_by' => session::get('User')->id,
                        'created_on' => date('Y-m-d H:i:s'),
                        'modified_by' => session::get('User')->id,
                        'modified_on' => date('Y-m-d H:i:s')
                    );
                    $lastinsertId = DB::table('master_booking_details')->insertGetId($datadetail);
                }
            }
            if ($lastinsertId) {
                $checkMail = self::GetUserByEmail($post['emailid']);
                $checkMobile = self::GetUserByMobile($post['mobileno']);
                if (empty($checkMail) && empty($checkMobile)) {
                    $dataUser = array(
                        'agent_id' => isset($post['agentId']) ? $post['agentId'] : '',
                        'fname' => isset($post['pax_name']) ? $post['pax_name'] : '',
                        'mobile' => isset($post['mobileno']) ? $post['mobileno'] : '',
                        'emailid' => isset($post['emailid']) ? $post['emailid'] : '',
                        'userpassword' => password_hash($pnr_number, PASSWORD_DEFAULT),
                        'ipaddress' => $ip,
                        'address1' => isset($post['fulladdress']) ? $post['fulladdress'] : '',
                        'currency_id' => isset($post['currency']) ? $post['currency'] : '',
                        'created_by' => session::get('User')->id,
                        'created_on' => date('Y-m-d H:i:s'),
                        'modified_by' => session::get('User')->id,
                        'modified_on' => date('Y-m-d H:i:s')
                    );
                    $users = DB::table('tek_b2c_users')->insert($dataUser);
                }
            }
            if ($lastinsertId && $insertId) {
                $putSession = array(
                    'LastBookingId' => $insertId,
                    'validTimeStart' => date('Y-m-d h:i:s'),
                );
                Session::put('BookingSession', (object) $putSession);
                Session::save();
                echo json_encode(array('success' => true, 'bookingId' => $insertId, 'message' => 'Booking successfully'));
                exit;
            } else {
                echo json_encode(array('success' => false, 'bookingId' => 0, 'message' => 'Unable to book. please try again later!'));
                exit;
            }
        } else {
            die('wrong request');
        }
    }

    public function currentbalance(Request $request) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isXmlHttpRequest()) {
            if ($request->isMethod('get')) {
                $post = $request->all();
                $balance = Wallet_transaction::select('id', 'current_balance')->where('agent_id', session::get('User')->id)->orderBy('id', 'desc')->first();

                if ($balance) {
                    echo json_encode(array('success' => true, 'current_balance' => $balance->current_balance, 'message' => 'successfully'));
                    exit;
                } else {
                    echo json_encode(array('success' => false, 'current_balance' => 0, 'message' => 'Unable to load. please try again later!'));
                    exit;
                }
            }
        }
    }

    /* public function index(Request $request){
      if(!session::get('User')){
      $continue = $request->fullUrl();
      return redirect(url('login?continue='.$continue))->with('msg', 'Oops your session has been expired!!');
      }
      if($request->isMethod('post')) {
      $post = $request->all();
      $post_data = array(
      '_token' => $post['_token'],
      'fromcity' => $post['fromcity'],
      'tocity' => $post['tocity'],
      'traveldate' => $post['traveldate'],
      'fromcity_id' => $post['fromcity_id'],
      'tocity_id' => $post['tocity_id'],
      'authorization_key' => $this->authorization_key,
      'agent_id' => session::get('User')->id,
      );

      $data = json_encode($post_data);
      //echo '<pre>';pr($data);die;
      try{
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->url.'/bussearch');
      curl_setopt($ch, CURLOPT_ENCODING , "gzip");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data)
      ));
      $output = curl_exec($ch);
      $response = $output;
      curl_close($ch);
      } catch (Exception $error){
      $response = $error->getMessage();
      }
      pr($response);die('res');
      return $response;
      }
      return view('bus/bus-searchbus');
      } */

    public function GetUserByEmail($email = null) {
        $data = DB::table('tek_b2c_users')
                        ->where('emailid', '=', $email)->first();
        return $data;
    }

    public function GetUserByMobile($mobile = null) {
        $data = DB::table('tek_b2c_users')
                        ->where('mobile', '=', $mobile)->first();
        return $data;
    }

}
