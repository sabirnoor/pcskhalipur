<?php
Use App\Image\Resize\SimpleImage;
use App\Masternewcoach;
use App\Newsevents;
function pr($string){
	 echo "<pre>";
	 print_r($string);
	 echo "</pre>";
}

function clean($string) {
   $string = str_replace('', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '-', strtolower($string)); // Removes special chars.
}

function entity_type() {
   return array('bustype'=>'Bus Type','currency'=>'Currency','vehicleMaker'=>'Vehicle Maker','busstation'=>'Bus Station');
}

function layout_type() {
   return array('2+1'=>'2+1','1+2'=>'1+2','2+2'=>'2+2','2+3'=>'2+3','1+1'=>'1+1','1+1+1'=>'1+1+1');
}
function bookingType() {
   return array('1'=>'Bus','2'=>'Hotel','3'=>'Package','4'=>'Activity','5'=>'Sightseeing');
}

function coachfeature() {
   return array('Video'=>'Video','Non-Video'=>'Non-Video','LCD'=>'LCD','LED'=>'LED','Individual LCD'=>'Individual LCD','Individual LED'=>'Individual LED','Cabin LCD'=>'Cabin LCD','Cabin LED'=>'Cabin LED','Cabin Video'=>'Cabin Video');
}

function imageResize($old_image,$new_image_name, $target_dir, $new_img_width, $new_img_height){
    $target_file = $target_dir . basename($new_image_name);
    $image = new SimpleImage();
    $image->load($old_image);
    $image->resize($new_img_width, $new_img_height);
    $image->save($target_file);
    return $target_file; //return name of saved file
}
function is_localhost() {
    $whitelist = array( '127.0.0.1', '::1' );
    if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
        return true;
}

function upload_path()
{
	if(is_localhost())
		$path = public_path().'/upload/';
	else 
		$path = public_path().'/upload/';
	return $path;
}

function src_path()
{
	if(is_localhost())
		$path = "http://local.tekoffice.com/public/upload/";
	else 
		$path = "http://local.tekoffice.com/public/upload/";
	return $path;
}
function img_src_path()
{
	if(is_localhost())
		$path = "http://localhost/pcs/public/upload/";
	else 
		$path = "http://admin.pcskhalispur.com/public/upload/";
	return $path;
}

function getLatesNews() {
	return Newsevents::where(array('IsDelete' => 0))->orderBy('orders_by', 'ASC')->get();
}


function isValidApiKey($api_key) {	
	return "1679091c5a880faf6fb5e6087eb1b2dc"==$api_key;
}



function Dateformate($date) {
	if(!empty($date)){
		$ex = explode('-',$date);
		return $ex[2].'-'.$ex[1].'-'.$ex[0];
	}
}

function array_empty($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $value) {
            if (!array_empty($value)) {
                return false;
            }
        }
    }
    elseif (!empty($mixed)) {
        return false;
    }
    return true;
}