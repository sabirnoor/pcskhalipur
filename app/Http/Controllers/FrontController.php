<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Categories;
use App\teksaentity;
use App\Masternewcoach;
use App\Masterrouteservice;
use App\Customratecard;
use App\Ratecardroutes;
use App\masterbooking;
use App\Tek_admin_login;
use App\Wallet_transaction;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Mail;
// for cart
use Illuminate\Support\Facades\Redirect;
use Cart;
use Carbon\Carbon;
use Eventviva\ImageResize;
use Image;
use Location;
use Validator;
use DateTime;
use DatePeriod;
use DateInterval;

class FrontController extends Controller {

    protected $url; //'http://bookabus.co.in/slim';
    protected $authorization_key;
    protected $units;

    public function __construct() {
        
    }

    public function addstate(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            //echo '<pre>';print_r($post);die;
            $res = DB::table("categories")->where(array('parent_id' => $post['ContId'], 'name' => $post['name']))->count();
            $data = array(
                'parent_id' => $post['ContId'],
                'name' => $post['name'],
                'name_code' => $post['name_code'],
                'coords' => $post['coords'],
                'status' => 0,
                'created' => strtotime(date('d-m-Y h:i:s')),
                'modified' => strtotime(date('d-m-Y h:i:s'))
            );
            if (!empty($id)) {
                DB::table('categories')->where('id', $id)->update($data);
                DB::table('categories_log')->insert($data);
                return redirect('addstate')->with('msgsuccess', 'Update successfully');
            } else {
                if ($res == 1) {
                    return redirect('addstate')->with('msgerror', 'This state name you have already taken.! Please try again');
                }
                DB::table('categories')->insert($data);
                DB::table('categories_log')->insert($data);
                return redirect('addstate')->with('msgsuccess', 'State Save successfully');
            }
        }
        $array = Categories::Details($id);
        $StateList = Categories::StateList();
        //echo '<pre>';print_r($array);die;

        return view('category/addstate', compact('StateList', 'array', 'id'));
    }

    public function addcity(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            //echo '<pre>';print_r($post);die;
            $res = DB::table("categories")->where(array('parent_id' => $post['stateId'], 'name' => $post['name']))->count();
            $data = array(
                'parent_id' => $post['stateId'],
                'name' => $post['name'],
                'name_code' => $post['name_code'],
                'coords' => $post['coords'],
                'status' => 0,
                'created' => strtotime(date('d-m-Y h:i:s')),
                'modified' => strtotime(date('d-m-Y h:i:s'))
            );
            if (!empty($id)) {
                DB::table('categories')->where('id', $id)->update($data);
                DB::table('categories_log')->insert($data);
                return redirect('addcity')->with('msgsuccess', 'Update successfully');
            } else {
                if ($res == 1) {
                    return redirect('addcity')->with('msgerror', 'This city name you have already taken.! Please try again');
                }
                DB::table('categories')->insert($data);
                DB::table('categories_log')->insert($data);
                return redirect('addcity')->with('msgsuccess', 'State Save successfully');
            }
        }
        $array = Categories::CityDetails($id);
        $CityList = Categories::CityList();
        //echo '<pre>';print_r($array);die;

        return view('category/addcity', compact('CityList', 'array', 'id'));
    }

    public function addmasterentity(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }

        if ($request->isMethod('post')) {
            $post = $request->all();
            //echo '<pre>';print_r($post);die;
            $res = DB::table("teksaentity")->where(array('entity_type' => $post['entity_type'], 'name' => $post['name']))->count();
            $data = array(
                'entity_type' => $post['entity_type'],
                'name' => $post['name'],
                'currency_rate' => 0,
                'airlines_code' => 0,
                'created_by' => session::get('User')->id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_by' => session::get('User')->id,
                'modified_on' => date('Y-m-d H:i:s')
            );
            if (!empty($id)) {
                DB::table('teksaentity')->where('id', $id)->update($data);
                return redirect('masterentity')->with('msgsuccess', 'Update successfully');
            } else {
                if ($res == 1) {
                    return redirect('masterentity')->with('msgerror', 'This name you have already taken.! Please try again');
                }
                DB::table('teksaentity')->insert($data);
                return redirect('masterentity')->with('msgsuccess', 'State Save successfully');
            }
        }
        $array = Categories::EntityDetails($id);
        $EntityList = Categories::EntityList();
        $entity_type = entity_type();
        //echo '<pre>';print_r($array);die;

        return view('category/addmasterentity', compact('EntityList', 'array', 'id', 'entity_type'));
    }

    public function addbusstation(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }

        if ($request->isMethod('post')) {
            $post = $request->all();
            //echo '<pre>';print_r($post);die;
            $res = DB::table("teksaentity")->where(array('entity_type' => $post['entity_type'], 'name' => $post['name']))->count();
            $data = array(
                'entity_type' => $post['entity_type'],
                'name' => $post['name'],
                'city_id' => $post['city_id'],
                'city_name' => $post['city_name'],
                'pincode' => $post['pincode'],
                'address' => $post['address'],
                'landmark' => $post['landmark'],
                'contactnumbers' => $post['contactnumbers'],
                'contactperson' => $post['contactperson'],
                'currency_rate' => 0,
                'airlines_code' => 0,
                'created_by' => session::get('User')->id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_by' => session::get('User')->id,
                'modified_on' => date('Y-m-d H:i:s')
            );
            $datau = array(
                'entity_type' => $post['entity_type'],
                'name' => $post['name'],
                'city_id' => $post['city_id'],
                'city_name' => $post['city_name'],
                'pincode' => $post['pincode'],
                'address' => $post['address'],
                'landmark' => $post['landmark'],
                'contactnumbers' => $post['contactnumbers'],
                'contactperson' => $post['contactperson'],
                'currency_rate' => 0,
                'airlines_code' => 0,
                'modified_by' => session::get('User')->id,
                'modified_on' => date('Y-m-d H:i:s')
            );
            if (!empty($id)) {
                DB::table('teksaentity')->where('id', $id)->update($datau);
                return redirect('busstation')->with('msgsuccess', 'Update successfully');
            } else {
                if ($res == 1) {
                    return redirect('busstation')->with('msgerror', 'This name you have already taken.! Please try again');
                }
                DB::table('teksaentity')->insert($data);
                return redirect('busstation')->with('msgsuccess', 'Save successfully');
            }
        }

        $array = Categories::EntityDetails($id);
        $EntityList = Categories::EntityEntityList('busstation');
        $entity_type = entity_type();

        return view('category/addbusstation', compact('EntityList', 'array', 'id', 'entity_type'));
    }

    public function addbusstationAjax(Request $request, $id = null) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            $check = DB::table("teksaentity")->where(array('entity_type' => $post['entity_type'], 'name' => $post['name']))->count();
            if ($check == 1) {
                echo json_encode(array('success' => false, 'message' => 'This name you have already taken.! Please try again'));
                exit;
            }
            //echo '<pre>';print_r($post);die;
            $data = array(
                'entity_type' => $post['entity_type'],
                'name' => $post['name'],
                'city_id' => $post['city_id'],
                'city_name' => $post['city_name'],
                'address' => $post['address'],
                'landmark' => $post['landmark'],
                'currency_rate' => 0,
                'airlines_code' => 0,
                'created_by' => session::get('User')->id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_by' => session::get('User')->id,
                'modified_on' => date('Y-m-d H:i:s')
            );
            $insertid = DB::table('teksaentity')->insertGetId($data);
            if ($insertid) {
                echo json_encode(array('success' => true, 'insertid' => $insertid, 'name' => $post['name'], 'message' => 'Add successfully'));
                exit;
            } else {
                echo json_encode(array('success' => false, 'insertid' => '', 'name' => '', 'message' => 'Unable to save data.'));
                exit;
            }
        } else {
            die('Access denied!!');
        }
    }

    public function AjaxCountryList(Request $request) {
        $fdata = $request->all();
        $data = DB::table('categories')
                        ->select('categories.id as country_id', 'categories.name as name', 'categories.parent_id as parent_id')
                        ->leftjoin('categories as c2', 'categories.parent_id', '=', 'c2.id')
                        ->where('categories.name', 'like', '%' . $fdata['term'] . '%')
                        ->where('c2.parent_id', 0)
                        ->orderBy('categories.name', 'asc')->get()->pluck('name', 'country_id');
        if (count($data) > 0) {
            foreach ($data as $key => $row) {
                $response[] = array('id' => $key, 'value' => $row, 'label' => $row);
            }
        } else {
            $response[] = array('id' => 0);
        }
        return $response;
    }

    public function AjaxCityList(Request $request) {
        $fdata = $request->all();
        $data = DB::table('categories as c1')
                        ->select('c1.name as continent', 'c2.name as country', 'c3.name as state', 'c3.id as state_id', 'c4.name as city', 'c4.id as city_id')
                        ->join('categories as c2', 'c1.id', '=', 'c2.parent_id')
                        ->join('categories as c3', 'c2.id', '=', 'c3.parent_id')
                        ->join('categories as c4', 'c3.id', '=', 'c4.parent_id')
                        ->where('c4.name', 'like', '%' . $fdata['term'] . '%')
                        ->where('c1.parent_id', '0')
                        ->orderBy('c4.name', 'asc')->get()->pluck('city', 'city_id');

        if (count($data) > 0) {
            foreach ($data as $key => $row) {
                $response[] = array('id' => $key, 'value' => $row, 'label' => $row);
            }
        } else {
            $response[] = array('id' => 0);
        }
        return $response;
    }

    public function AjaxStateList(Request $request) {
        $fdata = $request->all();
        $data = DB::table('categories as c1')
                        ->select('c1.name as continent', 'c2.name as country', 'c3.name as name', 'c3.id as state_id')
                        ->join('categories as c2', 'c1.id', '=', 'c2.parent_id')
                        ->join('categories as c3', 'c2.id', '=', 'c3.parent_id')
                        ->where('c3.name', 'like', '%' . $fdata['term'] . '%')
                        ->where('c1.parent_id', '0')
                        ->orderBy('c3.name', 'asc')->get()->pluck('name', 'state_id');
        ;
        if (count($data) > 0) {
            foreach ($data as $key => $row) {
                $response[] = array('id' => $key, 'value' => $row, 'label' => $row);
            }
        } else {
            $response[] = array('id' => 0);
        }
        return $response;
    }

    public function AjaxLocationList(Request $request, $cityId, $location_arr) {
        $fdata = $request->all();
        //print_r($location_arr);die;
        if ($request->isXmlHttpRequest()) {
            $data = DB::table('teksaentity as c1')
                            ->select('c1.id', 'c1.name', 'c1.city_id', 'c1.entity_type')
                            ->where('c1.name', 'like', '%' . $fdata['term'] . '%')
                            ->where('c1.city_id', $cityId)
                            ->where('c1.entity_type', 'busstation')
                            ->where('c1.IsDelete', '0')
                            ->orderBy('c1.name', 'asc')->get()->pluck('name', 'id');
            ;
            if (count($data) > 0) {
                foreach ($data as $key => $row) {
                    $response[] = array('id' => $key, 'value' => $row, 'label' => $row);
                }
            } else {
                $response[] = array('id' => 0, 'value' => 'Add New Location', 'label' => 'Add New Location');
            }
            return $response;
        }
    }

    public function StateList(Request $request) {
        $data = DB::table('categories')
                        ->select('con.name as countinent', 'cn.name as country', 'categories.id as state_id', 'categories.name as state')
                        ->leftjoin('categories as con', 'con.id', '=', 'cn.parent_id')
                        ->leftjoin('categories as categories', 'cn.id', '=', 'categories.parent_id')
                        ->where('cn.id', '=', 'categories.parent_id')
                        ->where('con.parent_id', 0)
                        ->orderBy('categories.name', 'asc')->get()->pluck('state', 'state_id');

        return $data;
    }

    /*     * *******************************bus msater*************************************** */

    public function newcoach(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        if ($request->isMethod('post')) {
            $post = $request->all();

            $data = array(
                'agent_id' => session::get('User')->id,
                'name' => $post['name'],
                'bus_type' => $post['bus_type'],
                'vehicle' => $post['vehicle'],
                'layout_type' => $post['layout_type'],
                'isac' => $post['isac'],
                'coachfeature' => $post['coachfeature'],
                'created_by' => session::get('User')->id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_by' => session::get('User')->id,
                'modified_on' => date('Y-m-d H:i:s')
            );
            //echo '<pre>';print_r($data);die;
            if (!empty($id)) {
                DB::table('masternewcoach')->where('id', $id)->update($data);
                return redirect('seatlayout/' . $id)->with('msgsuccess', 'Update successfully');
            } else {
                $insertId = DB::table('masternewcoach')->insertGetId($data);
                return redirect('seatlayout/' . $insertId)->with('msgsuccess', 'Save successfully');
            }
        }
        $array = Masternewcoach::MasternewCoachDetails(session::get('User')->id, $id);
        $bustype = Categories::EntityTypeList('bustype');
        $vehicleMaker = Categories::EntityTypeList('vehicleMaker');
        $layout_type = layout_type();
        $coachfeature = coachfeature();
        //echo '<pre>';print_r($bustype);die;
        if ($id && !$array) {
            die("Oops! This page doesn't exist.");
        }
        return view('bus/newcoach', compact('bustype', 'vehicleMaker', 'array', 'id', 'layout_type', 'coachfeature'));
    }

    public function managecoach(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        $CoachList = Masternewcoach::CoachList();
        //echo '<pre>';print_r($CoachList);die;
        return view('bus/managecoach', compact('CoachList', 'id'));
    }

    public function coachgallery(Request $request, $id = null, $gallery_id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }

        $array = Masternewcoach::CoachGalleryDetails(session::get('User')->id, $gallery_id);
        if ($request->isMethod('post')) {
            $post = $request->all();
            //echo $gallery_id;
            //echo '<pre>';print_r($post);die;
            if ($request->hasFile('image')) {
                $rules = array(
                    'image' => 'required | mimes:jpeg,jpg,png | max:1000',
                );
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return redirect('coachgallery/' . $id)->with('msgerror', 'Image file should be jpeg,jpg,png!');
                }
                if (!is_dir("public/upload/coachgallery/gid/" . $id)) {
                    mkdir("public/upload/coachgallery/gid/" . $id, 0777, true);
                }
                $image = $request->file('image');
                $imageName = $image->getClientOriginalName();

                $file = explode('.', $imageName);
                $imageName = date('ymdhis') . '_' . md5(microtime()) . '.' . end($file);
                if (!file_exists(upload_path() . 'coachgallery/gid/' . $id . "/" . $imageName)) {
                    $path = upload_path() . 'coachgallery/gid/' . $id . "/";
                    $image->move($path, $imageName);

                    $image100 = new ImageResize($path . $imageName);
                    $image100->crop(100, 100, ImageResize::CROPCENTER);
                    $image100->save($path . 'mob_' . $imageName);

                    $imageweb = new ImageResize($path . $imageName);
                    $imageweb->resizeToWidth(200);
                    $imageweb->save($path . 'web_' . $imageName);
                }
            }/* else{
              $data_img = array(
              'agent_id'=>session::get('User')->id,
              'name'=>$post['name'],
              'bus_type'=>$id,
              'modified_by'=>session::get('User')->id,
              'modified_on'=>date('Y-m-d H:i:s')
              );
              DB::table('coachgallery')->where('id', $gallery_id)->update($data_img);
              return redirect('coachgallery/'.$id)->with('msgsuccess', 'Update successfully');
              } */
            if ($gallery_id) {
                $data_img = array(
                    'agent_id' => session::get('User')->id,
                    'name' => $post['name'],
                    'coachimage' => !empty($imageName) ? $imageName : $array->coachimage,
                    'bus_type' => $id,
                    'modified_by' => session::get('User')->id,
                    'modified_on' => date('Y-m-d H:i:s')
                );
                DB::table('coachgallery')->where('id', $gallery_id)->update($data_img);
                return redirect('coachgallery/' . $id)->with('msgsuccess', 'Update successfully');
            } else {
                $data_img = array(
                    'agent_id' => session::get('User')->id,
                    'name' => $post['name'],
                    'coachimage' => !empty($imageName) ? $imageName : 'NA',
                    'bus_type' => $id,
                    'created_by' => session::get('User')->id,
                    'created_on' => date('Y-m-d H:i:s'),
                    'modified_by' => session::get('User')->id,
                    'modified_on' => date('Y-m-d H:i:s')
                );
                //echo '<pre>';print_r($data_img);die;
                DB::table('coachgallery')->insert($data_img);
                return redirect('coachgallery/' . $id)->with('msgsuccess', 'Save successfully');
            }
        }
        $CoachGalleryList = Masternewcoach::CoachGalleryList($id);
        $CoachDetails = Masternewcoach::CoachDetails(session::get('User')->id, $id);

        if ($gallery_id && !$array) {
            die("Oops! This page doesn't exist.");
        }
        if ($CoachDetails) {
            return view('bus/coachgallery', compact('array', 'id', 'CoachGalleryList', 'gallery_id'));
        } else {
            die("Oops! This page doesn't exist.");
        }
    }

    public function seatlayout(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        $array = Masternewcoach::MasternewCoachDetails(session::get('User')->id, $id);
        if ($id && !$array) {
            die("Oops! This page doesn't exist.");
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            
            if ($post['layout_error'] == 1) {
                return redirect('seatlayout/' . $id)->with('msgerror', 'Oops something wrong..? Unable to save data.');
            }
            $input_seat_lower_arr = array();
            foreach($post['seat_lower'] as $key=>$val){
                    $seat_arr = array();
                    $seat_arr[] = $post['seat_lower'][$key];
                    $seat_arr[] = $post['seat_lower_type'][$key];
                    array_push($input_seat_lower_arr,$seat_arr);
            }
            $seat_lower = json_encode($input_seat_lower_arr);
            $input_seat_upper_arr = array();
            foreach($post['seat_upper'] as $key=>$val){
                $seat_arr = array();
                $seat_arr[] = $post['seat_upper'][$key];
                $seat_arr[] = $post['seat_upper_type'][$key];
                array_push($input_seat_upper_arr,$seat_arr);
            }
            $seat_upper = json_encode($input_seat_upper_arr);
            $data = array(
                'lower_seat' => $seat_lower,
                'upper_seat' => $seat_upper,
                'modified_by' => session::get('User')->id,
                'modified_on' => date('Y-m-d H:i:s')
            );
            //echo '<pre>';print_r($data);die;
            $update = DB::table('masternewcoach')->where('id', $id)->update($data);
            if (!empty($update)) {
                return redirect('coachgallery/' . $id)->with('msgsuccess', 'Save successfully');
            } else {
                return redirect('seatlayout/' . $id)->with('msgerror', 'Unable to save data.');
            }
        }
        return view('bus/ajseatlayout', compact('array', 'id'));
    }

    /* Route and fare management */

    public function manageroute(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        $RoutesList = Masternewcoach::RoutesList();
        //echo '<pre>';print_r($RoutesList);die;
        return view('bus/manageroute', compact('RoutesList', 'id'));
    }

    public function newroute(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        //echo '<pre>';print_r(session::get('User'));die;
        if ($request->isMethod('post')) {
            $post = $request->all();

            if (!empty($id)) {
                $data = array(
                    'agent_id' => session::get('User')->id,
                    'service_name' => $post['service_name'],
                    'bus_type' => $post['bus_type'],
                    'travels_name' => $post['travels_name'],
                    'fromcity_id' => $post['fromcity_id'],
                    'tocity_id' => $post['tocity_id'],
                    'fromcity_name' => $post['fromcity_name'],
                    'tocity_name' => $post['tocity_name'],
                    'bus_tv' => (isset($post['bus_tv']) && !empty($post['bus_tv'])) ? $post['bus_tv'] : 0,
                    'bus_charging' => (isset($post['bus_charging']) && !empty($post['bus_charging'])) ? $post['bus_charging'] : 0,
                    'bus_waterbottle' => (isset($post['bus_waterbottle']) && !empty($post['bus_waterbottle'])) ? $post['bus_waterbottle'] : 0,
                    'bus_wifi' => (isset($post['bus_wifi']) && !empty($post['bus_wifi'])) ? $post['bus_wifi'] : 0,
                    'bus_mticket' => (isset($post['bus_mticket']) && !empty($post['bus_mticket'])) ? $post['bus_mticket'] : 0,
                    'modified_by' => session::get('User')->id,
                    'modified_on' => date('Y-m-d H:i:s')
                );
                DB::table('masternewroute')->where('id', $id)->update($data);
                return redirect('routepath/' . $id)->with('msgsuccess', 'Update successfully');
            } else {
                $data = array(
                    'agent_id' => session::get('User')->id,
                    'service_name' => $post['service_name'],
                    'bus_type' => $post['bus_type'],
                    'travels_name' => $post['travels_name'],
                    'fromcity_id' => $post['fromcity_id'],
                    'tocity_id' => $post['tocity_id'],
                    'fromcity_name' => $post['fromcity_name'],
                    'tocity_name' => $post['tocity_name'],
                    'bus_tv' => (isset($post['bus_tv']) && !empty($post['bus_tv'])) ? $post['bus_tv'] : 0,
                    'bus_charging' => (isset($post['bus_charging']) && !empty($post['bus_charging'])) ? $post['bus_charging'] : 0,
                    'bus_waterbottle' => (isset($post['bus_waterbottle']) && !empty($post['bus_waterbottle'])) ? $post['bus_waterbottle'] : 0,
                    'bus_wifi' => (isset($post['bus_wifi']) && !empty($post['bus_wifi'])) ? $post['bus_wifi'] : 0,
                    'bus_mticket' => (isset($post['bus_mticket']) && !empty($post['bus_mticket'])) ? $post['bus_mticket'] : 0,
                    'created_by' => session::get('User')->id,
                    'created_on' => date('Y-m-d H:i:s'),
                    'modified_by' => session::get('User')->id,
                    'modified_on' => date('Y-m-d H:i:s')
                );
                $insertId = DB::table('masternewroute')->insertGetId($data);
                $data2 = array(
                    'agent_id' => session::get('User')->id,
                    'route_id' => $insertId,
                    'city_id' => $post['fromcity_id'],
                    'city_name' => $post['fromcity_name'],
                    'created_by' => session::get('User')->id,
                    'created_on' => date('Y-m-d H:i:s'),
                    'modified_by' => session::get('User')->id,
                    'modified_on' => date('Y-m-d H:i:s')
                );
                $data23 = array(
                    'agent_id' => session::get('User')->id,
                    'route_id' => $insertId,
                    'city_id' => $post['tocity_id'],
                    'city_name' => $post['tocity_name'],
                    'created_by' => session::get('User')->id,
                    'created_on' => date('Y-m-d H:i:s'),
                    'modified_by' => session::get('User')->id,
                    'modified_on' => date('Y-m-d H:i:s')
                );
                DB::table('master_routeservice')->insert($data2);
                DB::table('master_routeservice')->insert($data23);
                return redirect('routepath/' . $insertId)->with('msgsuccess', 'Save successfully');
            }
        }
        $array = Masternewcoach::MasternewRouteDetails($id);
        $bustype = Categories::EntityTypeList('bustype');
        $vehicleMaker = Categories::EntityTypeList('vehicleMaker');
        $layout_type = layout_type();
        $coachfeature = coachfeature();
        $CoachList = Masternewcoach::CoachList();
        $operator_company = session::get('User')->operator_company;
        //echo '<pre>';print_r($bustype);die;
        if ($id && !$array) {
            die("Oops! This page doesn't exist.");
        }
        return view('bus/newroute', compact('CoachList', 'bustype', 'vehicleMaker', 'array', 'id', 'layout_type', 'coachfeature', 'operator_company'));
    }

    public function routepath(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }

        if ($request->isMethod('post')) {
            $post = $request->all();
            //echo '<pre>';print_r($post);die;
            $location = $post['location'];
            $location_id = $post['location_id'];
            $Hours = $post['Hours'];
            $Minute = $post['Minute'];
            $ampm = $post['ampm'];
            $bordingdropoffpoint_id = isset($post['bordingdropoffpoint_id']) ? $post['bordingdropoffpoint_id'] : array();

            if ($location) {
                foreach ($location as $k => $value) {
                    $next_day = (isset($post['next_day' . $k]) && !empty($post['next_day' . $k])) ? $post['next_day' . $k] : 0;
                    $primary = (isset($post['primary' . $k]) && !empty($post['primary' . $k])) ? $post['primary' . $k] : 0;
                    $bordingtime = $Hours[$k] . ':' . $Minute[$k] . ' ' . $ampm[$k];
                    $point_id = (isset($bordingdropoffpoint_id[$k]) && !empty($bordingdropoffpoint_id[$k])) ? $bordingdropoffpoint_id[$k] : '';
                    if (in_array($point_id, $bordingdropoffpoint_id)) {
                        $data = array(
                            'agent_id' => session::get('User')->id,
                            'route_id' => $post['routepathId'],
                            'city_id' => $post['cityId'],
                            'location_id' => $location_id[$k],
                            'location' => $location[$k],
                            'hours' => $Hours[$k],
                            'minute' => $Minute[$k],
                            'ampm' => $ampm[$k],
                            'next_day' => (isset($next_day) && !empty($next_day)) ? $next_day : 0,
                            'setprimary' => (isset($primary) && !empty($primary)) ? $primary : 0,
                            'bordingtime' => $bordingtime,
                            'modified_by' => session::get('User')->id,
                            'modified_on' => date('Y-m-d H:i:s')
                        );
                        $insert = DB::table('bordingdropoffpoint')->where('id', $point_id)->update($data);
                    } else {
                        $data = array(
                            'agent_id' => session::get('User')->id,
                            'route_id' => $post['routepathId'],
                            'city_id' => $post['cityId'],
                            'location_id' => $location_id[$k],
                            'location' => $location[$k],
                            'hours' => $Hours[$k],
                            'minute' => $Minute[$k],
                            'ampm' => $ampm[$k],
                            'next_day' => (isset($next_day) && !empty($next_day)) ? $next_day : 0,
                            'setprimary' => (isset($primary) && !empty($primary)) ? $primary : 0,
                            'bordingtime' => $bordingtime,
                            'created_by' => session::get('User')->id,
                            'created_on' => date('Y-m-d H:i:s'),
                            'modified_by' => session::get('User')->id,
                            'modified_on' => date('Y-m-d H:i:s')
                        );
                        $insert = DB::table('bordingdropoffpoint')->insert($data);
                    }
                }//die;
                if ($insert) {
                    echo json_encode(array('success' => true, 'message' => 'Save successfully'));
                    exit;
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Unable to save data.'));
                    exit;
                }
            }
        }

        $array = Masternewcoach::MasternewRouteDetails($id);
        if (!$id && !$array) {
            die("Oops! This page doesn't exist.");
        }
        if(empty($array)){
            die("Oops! This page doesn't exist.");
        }
        $RouteserviceList = Masternewcoach::RouteserviceList($id);

        return view('bus/routepath', compact('RouteserviceList', 'array', 'id'));
    }

    public function ratecard(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }

        if ($request->isMethod('post')) {
            $post = $request->all();
            $validfrom = Dateformate($post['from']);
            $validto = Dateformate($post['to']);
            $period = new DatePeriod(new DateTime($validfrom), new DateInterval('P1D'), new DateTime('' . $validto . ' 1 day'));

            //echo '<pre>';print_r($dates);die;
            $weekend = implode(',', $post['weekend']);
            $ratecard_routes = $post['ratecard_routes'];
            $st_weekdays = $post['st_weekdays'];
            $st_weekend = $post['st_weekend'];
            $st_dsl = $post['st_dsl'];

            $sl_weekdays = $post['sl_weekdays'];
            $sl_weekend = $post['sl_weekend'];
            $sl_dsl = $post['sl_dsl'];

            if ($ratecard_routes) {
                foreach ($ratecard_routes as $k => $value) {
                    $data = array(
                        'validfrom' => $validfrom,
                        'validto' => $validto,
                        'currency' => $post['currency'],
                        'weekdays' => $weekend,
                        'st_weekdays' => $st_weekdays[$k],
                        'st_weekend' => $st_weekend[$k],
                        'st_dsl' => $st_dsl[$k],
                        'sl_weekdays' => $sl_weekdays[$k],
                        'sl_weekend' => $sl_weekend[$k],
                        'sl_dsl' => $sl_dsl[$k],
                        'modified_by' => session::get('User')->id,
                        'modified_on' => date('Y-m-d H:i:s')
                    );
                    $update = DB::table('ratecard_routes')->where('id', $ratecard_routes[$k])->update($data);
                    $Ratecardroutes = Ratecardroutes::select('id', 'agent_id', 'route_id', 'fromcity_id', 'fromcity_name', 'tocity_id', 'tocity_name')->where('id', $ratecard_routes[$k])->orderBy('id', 'desc')->first();
                    //echo '<pre>';print_r($Ratecardroutes);die;
                    /* date by rate insert  */
                    foreach ($period as $date) {
                        $dates_ = $date->format("Y-m-d");
                        $Wherecondition = array('ratecard_routes_id' => $ratecard_routes[$k], 'agent_id' => $Ratecardroutes->agent_id, 'route_id'=>$Ratecardroutes->route_id, 'validfrom' => $dates_);
                        DB::table('ratecard_routes_details')->where($Wherecondition)->delete();
                        $data_ = array(
                            'ratecard_routes_id' => $ratecard_routes[$k],
                            'agent_id' => $Ratecardroutes->agent_id,
                            'route_id' => $Ratecardroutes->route_id,
                            'fromcity_id' => $Ratecardroutes->fromcity_id,
                            'fromcity_name' => $Ratecardroutes->fromcity_name,
                            'tocity_id' => $Ratecardroutes->tocity_id,
                            'tocity_name' => $Ratecardroutes->tocity_name,
                            'validfrom' => $dates_,
                            'validto' => $dates_,
                            'currency' => $post['currency'],
                            'weekdays' => $weekend,
                            'st_weekdays' => $st_weekdays[$k],
                            'st_weekend' => $st_weekend[$k],
                            'st_dsl' => $st_dsl[$k],
                            'sl_weekdays' => $sl_weekdays[$k],
                            'sl_weekend' => $sl_weekend[$k],
                            'sl_dsl' => $sl_dsl[$k],
                            'created_by' => session::get('User')->id,
                            'created_on' => date('Y-m-d H:i:s'),
                            'modified_by' => session::get('User')->id,
                            'modified_on' => date('Y-m-d H:i:s')
                        );
                        $insert = DB::table('ratecard_routes_details')->insert($data_);
                    }
                }
                if ($update) {
                    echo json_encode(array('success' => true, 'message' => 'Save successfully'));
                    exit;
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Unable to save data.'));
                    exit;
                }
            }
        }

        $array = Masternewcoach::MasternewRouteDetails($id);
        if (!$id && !$array) {
            die("Oops! This page doesn't exist.");
        }
        $Ratecard = Ratecardroutes::RatecardRouteList($id);
        $RouteserviceList = Masternewcoach::RouteserviceList($id);
        $currency = Categories::EntityTypeList('currency');
        //echo '<pre>';print_r($bustype);die;

        return view('bus/ratecard', compact('RouteserviceList', 'array', 'id', 'currency', 'Ratecard'));
    }

    public function customizerate(Request $request, $id=null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }

        if ($request->isMethod('post')) {
            $post = $request->all();
            $seat_no = $post['seat_no'];
            $rateWeekdays = $post['rateWeekdays'];
            $rateWeekend = $post['rateWeekend'];
			if ($seat_no){
				$update = array('IsDelete'=>1, 'modified_on' => date('Y-m-d H:i:s'),'modified_by' => session::get('User')->id);
				$Wherecondition = array('route_id' => $id, 'agent_id' => session::get('User')->id);
				DB::table('custom_ratecard')->where($Wherecondition)->update($update);
				//DB::table('custom_ratecard')->where($Wherecondition)->delete();
				foreach ($seat_no as $k => $value){
					$data = array(
						'seat_no' => $seat_no[$k],
						'agent_id' => session::get('User')->id,
						'route_id' => $id,
						'fare_weekdays' => $rateWeekdays[$k],
						'fare_weekend' => $rateWeekend[$k],
						'created_by' => session::get('User')->id,
						'created_on' => date('Y-m-d H:i:s'),
						'modified_by' => session::get('User')->id,
						'modified_on' => date('Y-m-d H:i:s')
					);
					$insert = DB::table('custom_ratecard')->insert($data);
				}
			}
			if ($insert) {
				echo json_encode(array('success' => true, 'message' => 'Save successfully'));
				exit;
			} else {
				echo json_encode(array('success' => false, 'message' => 'Unable to save data.'));
				exit;
			}
        }
		$custom_ratecard = Customratecard::where(array('route_id'=>$id,'IsDelete'=>0) )->get();
        $array = Masternewcoach::MasternewRouteDetails($id);
        if (!$id || !$array) {
            die("Oops! This page doesn't exist.");
        }
        $CoachDetails = Masternewcoach::MasternewCoachDetails($array->agent_id,$array->bus_type);
        //echo '<pre>';print_r($CoachDetails);die;

        return view('bus/customizerate', compact('array', 'id','CoachDetails','custom_ratecard'));
    }
	
	
    public function cancellation(Request $request, $id = null) {
        die('under process');
    }

    public function ratecardservice(Request $request, $id = null) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            $id = $post['id'];
            $RatecardRouteList = Ratecardroutes::RatecardRouteList($id);
            //echo '<pre>';print_r($RatecardRouteList);die;
            return view('bus/ratecardservice', compact('id', 'RatecardRouteList'));
        } else {
            die('Access denied!!');
        }
    }

    public function ratecardrouteservice(Request $request, $id = null) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            $check = Ratecardroutes::where('route_id', $id)->where('fromcity_id', $post['fromcity_id'])->where('tocity_id', $post['tocity_id'])->select('id')->first();
            if ($check) {
                echo json_encode(array('success' => false, 'message' => '' . $post['fromcity'] . ' To ' . $post['tocity_name'] . ' service already taken? please choose another one.'));
                exit;
            }
            //echo '<pre>';print_r($post);die;
            $data = array(
                'agent_id' => session::get('User')->id,
                'route_id' => $id,
                'fromcity_name' => $post['fromcity'],
                'fromcity_id' => $post['fromcity_id'],
                'tocity_name' => $post['tocity_name'],
                'tocity_id' => $post['tocity_id'],
                'created_by' => session::get('User')->id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_by' => session::get('User')->id,
                'modified_on' => date('Y-m-d H:i:s')
            );
            $insert = DB::table('ratecard_routes')->insert($data);
            if ($insert) {
                echo json_encode(array('success' => true, 'message' => 'Add successfully'));
                exit;
            } else {
                echo json_encode(array('success' => false, 'message' => 'Unable to save data.'));
                exit;
            }
        } else {
            die('Access denied!!');
        }
    }

    public function addservice(Request $request, $id = null) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            $check = Masterrouteservice::where('route_id', $id)->where('city_id', $post['tocity_id'])->select('id')->first();
            if ($check) {
                echo json_encode(array('success' => false, 'message' => '' . $post['tocity_name'] . ' city is already taken? please choose another one.'));
                exit;
            }
            $data = array(
                'agent_id' => session::get('User')->id,
                'route_id' => $id,
                'city_id' => $post['tocity_id'],
                'city_name' => $post['tocity_name'],
                'created_by' => session::get('User')->id,
                'created_on' => date('Y-m-d H:i:s'),
                'modified_by' => session::get('User')->id,
                'modified_on' => date('Y-m-d H:i:s')
            );
            $insert = DB::table('master_routeservice')->insert($data);
            if ($insert) {
                echo json_encode(array('success' => true, 'message' => 'Add successfully'));
                exit;
            } else {
                echo json_encode(array('success' => false, 'message' => 'Unable to save data.'));
                exit;
            }
        } else {
            die('Access denied!!');
        }
    }

    public function bordingdropoff(Request $request, $id = null) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isMethod('post')) {
            $post = $request->all();
            $id = $post['id'];
            $cityId = $post['cityId'];
            $BordingdropoffpointList = Masternewcoach::BordingdropoffpointList($id, $cityId);
            //echo '<pre>';print_r($BordingdropoffpointList);die;
            return view('bus/bordingdropoff', compact('id', 'cityId', 'BordingdropoffpointList'));
        } else {
            die('Access denied!!');
        }
    }

    public function deletecoach(Request $request, $id = null) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isXmlHttpRequest()) {
            $data = array(
                'IsDelete' => 1,
                'DeletedBy' => session::get('User')->id,
                'DeleteOn' => date('Y-m-d H:i:s')
            );
            $result = DB::table('masternewcoach')->where('id', $id)->update($data);
            if ($result) {
                echo json_encode(array('success' => true, 'message' => 'Delete Successfully'));
                exit;
            } else {
                echo json_encode(array('success' => false, 'message' => 'Oops unable to delete! try again.'));
                exit;
            }
        } else {
            die('Oops invalid request!!');
        }
    }

    public function deletebrpoint(Request $request, $id = null) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isXmlHttpRequest()) {
            $data = array(
                'IsDelete' => 1,
                'DeletedBy' => session::get('User')->id,
                'DeleteOn' => date('Y-m-d H:i:s')
            );
            $result = DB::table('bordingdropoffpoint')->where('id', $id)->update($data);
            if ($result) {
                echo json_encode(array('success' => true, 'message' => 'Delete Successfully'));
                exit;
            } else {
                echo json_encode(array('success' => false, 'message' => 'Oops unable to delete! try again.'));
                exit;
            }
        } else {
            die('Oops invalid request!!');
        }
    }

    public function deleteratecard(Request $request, $id = null) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isXmlHttpRequest()) {
            $data = array(
                'IsDelete' => 1,
                'DeletedBy' => session::get('User')->id,
                'DeleteOn' => date('Y-m-d H:i:s')
            );
            $result = DB::table('ratecard_routes')->where('id', $id)->update($data);
            if ($result) {
                echo json_encode(array('success' => true, 'message' => 'Delete Successfully'));
                exit;
            } else {
                echo json_encode(array('success' => false, 'message' => 'Oops unable to delete! try again.'));
                exit;
            }
        } else {
            die('Oops invalid request!!');
        }
    }

    public function deleteGallery(Request $request, $id = null) {
        if (!session::get('User')) {
            echo json_encode(array('success' => false, 'message' => 'Oops your session has been expired!!'));
            exit;
        }
        if ($request->isXmlHttpRequest()) {
            $data = array(
                'IsDelete' => 1,
                'DeletedBy' => session::get('User')->id,
                'DeleteOn' => date('Y-m-d H:i:s')
            );
            $result = DB::table('coachgallery')->where('id', $id)->update($data);
            if ($result) {
                echo json_encode(array('success' => true, 'message' => 'Delete Successfully'));
                exit;
            } else {
                echo json_encode(array('success' => false, 'message' => 'Oops unable to delete! try again.'));
                exit;
            }
        } else {
            die('Oops invalid request!!');
        }
    }

    /* Bus Booking Management */

    public function busbooking(Request $request) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        $bookingList = masterbooking::BookingList(session::get('User')->id);
        //echo '<pre>';print_r($bookingList);die;
        return view('bus/booking/busbooking', compact('bookingList'));
    }

    public function TicketDetailsPop(Request $request, $id) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        if ($request->isXmlHttpRequest()) {
            $TicketDetails = masterbooking::TicketDetails(session::get('User')->id, $id);
            //echo '<pre>';print_r($TicketDetails);die;
            return view('bus/booking/TicketDetailsPop', compact('TicketDetails'));
        }
    }

    public function PrintTicket(Request $request, $id) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }
        $TicketDetails = masterbooking::TicketDetails(session::get('User')->id, $id);
        return view('bus/booking/PrintTicket', compact('TicketDetails'));
    }

    public function GetReview(Request $request, $id = null) {
        if (!session::get('User')) {
            $continue = $request->fullUrl();
            return redirect(url('login?continue=' . $continue))->with('msg', 'Oops your session has been expired!!');
        }

        if (session::get('BookingSession')) {
            $id = session::get('BookingSession')->LastBookingId;
            $balance = array();
            $balance = Wallet_transaction::select('id', 'current_balance', 'currency_id')->where('agent_id', session::get('User')->id)->orderBy('id', 'desc')->first();
            $CurrencyName = '';
            if ($balance) {
                $CurrencyName = CurrencyName($balance->currency_id);
            }
            $TicketDetails = masterbooking::TicketDetails(session::get('User')->id, $id);
            if ($request->isMethod('post')) {
                $wallet = array();
                $post = $request->all();
                $current_balance_wallet = $balance->current_balance;

                if ($current_balance_wallet >= $TicketDetails['details']['paynetfare']) {
                    $current_balance = ($current_balance_wallet - $TicketDetails['details']['paynetfare']);
                } else {
                    return redirect(url('GetReview'))->with('msgerror', 'You have enough balance to book this tickets! Please recharge you wallet');
                }

                $wallet = array(
                    'agent_id' => $TicketDetails['details']['agent_id'],
                    'payable_id' => $id,
                    'payable_type' => 1,
                    'txnid' => date('dmyhis'),
                    'amount' => $TicketDetails['details']['paynetfare'],
                    'net_amount_credit' => 0,
                    'net_amount_debit' => $TicketDetails['details']['paynetfare'],
                    'current_balance' => $current_balance,
                    'currency_id' => $TicketDetails['details']['currency'],
                    'unmappedstatus' => 'captured',
                    'status' => 'Completed',
                    'mode' => 'B2B',
                    'created_by' => session::get('User')->id,
                    'created_on' => date('Y-m-d H:i:s'),
                    'modified_by' => session::get('User')->id,
                    'modified_on' => date('Y-m-d H:i:s'),
                );

                $lastinsertId = DB::table('wallet_transaction')->insertGetId($wallet);
                if ($lastinsertId) {
                    $data = array(
                        'payment_confirmation' => 1,
                        'payment_date' => date('Y-m-d H:i:s'),
                        'txnid' => $lastinsertId,
                        'mode' => 'B2B',
                    );
                    $result = DB::table('master_booking')->where('id', $id)->update($data);
                    if ($result) {
                        session()->forget('BookingSession');
                        return redirect(url('PrintTicket/' . $id));
                    }
                } else {
                    return redirect(url('GetReview'))->with('msgerror', 'Oops somethings wrong. please try again!');
                }

                //echo '<pre>';print_r($wallet);die;
            }
            return view('bus/booking/GetReview', compact('TicketDetails', 'id', 'balance', 'CurrencyName'));
        } else {
            return redirect(url('/'));
        }
    }

}
