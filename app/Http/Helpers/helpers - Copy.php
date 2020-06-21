<?php
Use App\Image\Resize\SimpleImage;

function pr($string){
	 echo "<pre>";
	 print_r($string);
	 echo "</pre>";
}	

function curl_custom_postfields($ch, array $assoc = array(), array $files = array()) {
    
    // invalid characters for "name" and "filename"
    static $disallow = array("\0", "\"", "\r", "\n");
    
    // build normal parameters
	
    foreach ($assoc as $k => $v) {		
		if($k=='entry') {	
		  $k = 'dob';
		  $v = $v['year'].'-'.$v['month'].'-'.$v['day'];					  
			$k = str_replace($disallow, "_", $k);
			$body[] = implode("\r\n", array(
            "Content-Disposition: form-data; name=\"{$k}\"",
            "",
            filter_var($v), 
			));		  
		}	
		else if(is_array($v)) {
			foreach($v as $value)
			{
				$k = str_replace($disallow, "_", $k);
				$body[] = implode("\r\n", array(
				"Content-Disposition: form-data; name=".$k."[]",
				"",
				filter_var($value),	
				));
			}
		}
		else {
			$k = str_replace($disallow, "_", $k);
			$body[] = implode("\r\n", array(
            "Content-Disposition: form-data; name=\"{$k}\"",
            "",
            filter_var($v), 
        ));

		}		
        
    }
    
     // generate safe boundary 
    do {
        $boundary = "---------------------" . md5(mt_rand() . microtime());
    } while (preg_grep("/{$boundary}/", $body));
    
    // add boundary for each parameters
    array_walk($body, function (&$part) use ($boundary) {
        $part = "--{$boundary}\r\n{$part}";
    });
    
    // add final boundary
    $body[] = "--{$boundary}--";
    $body[] = "";
   
    // set options
    return @curl_setopt_array($ch, array(
        CURLOPT_POST => true,
		CURLOPT_RETURNTRANSFER => 1, // comment this line for  enable debug 
        CURLOPT_POSTFIELDS => implode("\r\n", $body),
        CURLOPT_HTTPHEADER => array(
            "Expect: 100-continue",
            "Content-Type: multipart/form-data; boundary={$boundary}", // change Content-Type
        ),
    ));
	
}

function curlHttp($postData = array(), $url = '',  $files = array(),$request = null)
{		

		$ch = curl_init($url);
		
		curl_custom_postfields($ch, $postData, $files);			
		$output=curl_exec($ch);	 
		curl_close($ch);		
	return $output = json_decode($output,true);
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
		$path = "http://localhost/bookabus/public/upload/";
	else 
		$path = "https://www.bookabus.co.in/public/upload/";
	return $path;
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
	if(is_localhost())
    return '122.160.42.11';
	else 
	return $ipaddress	;
}


function ip_details() {
$user_agent = "Slack/1.0";
# URL to call.
$ip = get_client_ip();
	$state = 'Delhi';
	$city = 'New Delhi';
	$country = 'India';
	$latlong = '28.8309925,76.6556824';
	$pincode = '110005';
	if(isset($_COOKIE['country']) && $_COOKIE['country'] == 'India')
	{
		if(isset($_COOKIE['state']))
			$state = $_COOKIE['state'];
		if(isset($_COOKIE['city']))
			$city = $_COOKIE['city'];
		if(isset($_COOKIE['country']))
			$country = $_COOKIE['country'];
		if(isset($_COOKIE['latlong']))
			$latlong = $_COOKIE['latlong'];
		if(isset($_COOKIE['pincode']))
			$pincode = $_COOKIE['pincode'];
	}
	$response = json_encode(array('pincode'=>$pincode,'latlong'=>$latlong,'city'=>$city,'country'=>$country,'region'=>$state));
	return $response;
}

function categoryList()
{		
	$url = getenv('APP_URL');
	$data['authorization'] = getenv('AUTH');
	$data['type'] = 'category';
	$url = $url.'/dropdown';	
	return curlHttp($data,$url);
}

function sidenaveCate()
{
	$url = getenv('APP_URL');
	$url = $url.'/menuCategory';
	$data = array('authorization'=>getenv('AUTH'));
	return curlHttp($data,$url);
}


class formLoader {

	/**
	 * Form structure
	 *
	 * @var object
	 **/
	var $form_data;

	/**
	 * Form action
	 *
	 * @var string
	 **/
	var $action;
	
	var $edit_data;

	/**
	 * Constructor
	 *
	 * @param string $form_json
	 * @return void
	 * @access public
	 **/
	public function __construct($form_json, $form_action, $edit_data)
	{
		$this->form_data = json_decode(str_replace('\\', '', $form_json));
		$this->action = $form_action;
		$this->edit_data = $edit_data;
	}

	/**
	 * Render the form
	 *
	 * @return void
	 * @access public 
	 **/
	public function render_form()
	{
		if( empty($this->form_data) || empty($this->action) ) {
			throw new Exception("Error Processing Request", 1);
		}

		$fields = '';
		$val = '';

		foreach ($this->form_data->fields as $ky=>$field) {
			
			// Single line text
			if($field->type == 'element-single-line-text' ) {
				if(isset($this->edit_data[$ky])){
					$fields .= $this->element_single_line_text($field, !empty($this->edit_data)?$this->edit_data[$ky]->key_values:'');
				}else{
					$fields .= $this->element_single_line_text($field, $val);
				}
			}

			// Number
			if($field->type == 'element-number') {
				if(isset($this->edit_data[$ky])){
					$fields .= $this->element_number($field, !empty($this->edit_data)?$this->edit_data[$ky]->key_values:'');
				}else{
					$fields .= $this->element_number($field, $val);
				}
			}

			// Paragraph text
			if($field->type == 'element-paragraph-text') {
				if(isset($this->edit_data[$ky])){
					$fields .= $this->element_paragraph_text($field, !empty($this->edit_data)?$this->edit_data[$ky]->key_values:'');
				}else{
					$fields .= $this->element_paragraph_text($field, $val);
				}
			}

			// Checkboxes
			if($field->type == 'element-checkboxes') {
				if(isset($this->edit_data[$ky])){
					$fields .= $this->element_checkboxes($field, !empty($this->edit_data)?$this->edit_data[$ky]->key_values:'');
				}else{
					$fields .= $this->element_checkboxes($field, $val);
				}
			}

			// Multiple choice
			if($field->type == 'element-multiple-choice') {
				if(isset($this->edit_data[$ky])){
					$fields .= $this->element_multiple_choice($field, !empty($this->edit_data)?$this->edit_data[$ky]->key_values:'');
				}else{
					$fields .= $this->element_multiple_choice($field, $val);
				}
				//$fields .= $this->element_multiple_choice($field, !empty($this->edit_data)?$this->edit_data[$ky]->key_values:'');
			}

			// Dropdown
			if($field->type == 'element-dropdown') {
				if(isset($this->edit_data[$ky])){
					$fields .= $this->element_dropdown($field, !empty($this->edit_data)?$this->edit_data[$ky]->key_values:'');
				}else{
					$fields .= $this->element_dropdown($field, $val);
				}
				//$fields .= $this->element_dropdown($field, !empty($this->edit_data)?$this->edit_data[$ky]->key_values:'');
			}

			// Section break
			if($field->type == 'element-section-break') {
				$fields .= $this->element_section_break($field);
			}

		}

		//$form = $this->open_form($fields);
		echo $fields;
	}

	/**
	 * Render the form header
	 *
	 * @param object $fields
	 * @return string $html
	 * @access private 
	 **/
	private function open_form($fields)
	{
		$html = sprintf('<form action="%s" method="post" accept-charset="utf-8" role="form" novalidate="novalidate" >', $this->action);
		$html .= '<div class="form-title">';
		$html .= sprintf('<h2>%s</h2><h3>%s</h3>', $this->form_data->title, $this->form_data->description);
		$html .= $fields;
		$html .= '<button type="submit" class="btn btn-primary">Submit</button>';
		$html .= '</div></form>';
		return $html;
	}

	/**
	 * Encode element title
	 *
	 * @param string $title
	 * @return string $str
	 * @access private 
	 **/
	private function encode_element_title($title)
	{
		$str = str_replace(' ', '_', strtolower($title));
		$str = preg_replace("/[^a-zA-Z0-9.-_]/", "", $str);
		$str = htmlentities($str, ENT_QUOTES, 'UTF-8');
		$str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');

		return $str;
	}

	/**
	 * Get formatted label for form element
	 *
	 * @param string $id
	 * @param string $title
	 * @param mixed $required
	 * @return string
	 * @access private
	 **/
	private function make_label($id, $title, $required)
	{
		if( $required ) {
			$html = sprintf('<label class="control-label col-sm-4" for="%s">%s <span style="color: red">*</span></label>', $id, $title);
		} else {
			$html = sprintf('<label class="control-label col-sm-4" for="%s">%s </label>', $id, $title);
		}

		return $html;
	}
	
	private function make_filter($id, $filter)
	{
		if( $filter ) {
			$html = sprintf('<span for="%s"><input type="hidden" name="filter[]" value="1" /></span>', $id);
		} else {
			$html = sprintf('<span for="%s"><input type="hidden" name="filter[]" value="0" /></span>', $id);
		}

		return $html;
	}

	/**
	 * Render single line text
	 *
	 * @param object $field
	 * @return string $html
	 * @access private 
	 **/
	private function element_single_line_text($field, $val)
	{
		$id = $this->encode_element_title($field->title);
		$required = ($field->required) ? 'required' : FALSE;
		$filter = ($field->filter) ? 'filter' : FALSE;

		$html = '<div class="form-group clearfix required has-feedback">';
		$html .= $this->make_label($id, $field->title, $required);
		$html .= $this->make_filter($id, $filter);
	    $html .= sprintf('<div class="col-sm-6"><input type="text" value="'.$val.'" name="dynamic[%s]" id="%s" class="form-control %s"></div>', $id, $id, $required);
	  	$html .= '</div>';

	  	return $html;
	}

	/**
	 * Render number
	 *
	 * @param object $field
	 * @return string $html
	 * @access private
	 **/
	private function element_number($field)
	{
		$id = $this->encode_element_title($field->title);
		$required = ($field->required) ? 'required' : FALSE;

		$html = '<div class="form-group clearfix required has-feedback">';
		$html .= $this->make_label($id, $field->title, $required);
	    $html .= sprintf('<input type="number" name="dynamic[%s]" id="%s" class="form-control %s">', $id, $id, $required);
	  	$html .= '</div>';

	  	return $html;
	}

	/**
	 * Render paragraph text
	 *
	 * @param object $field
	 * @return string $html
	 * @access private
	 **/
	private function element_paragraph_text($field, $val)
	{
		$id = $this->encode_element_title($field->title);
		$required = ($field->required) ? 'required' : FALSE;
		$filter = ($field->filter) ? 'filter' : FALSE;

		$html = '<div class="form-group clearfix required has-feedback">';
		$html .= $this->make_label($id, $field->title, $required);
		$html .= $this->make_filter($id, $filter);
	    $html .= sprintf('<div class="col-sm-6"><textarea id="%s" name="dynamic[%s]" class="form-control %s" rows="3">'.$val.'</textarea></div>', $id, $id, $required);
	  	$html .= '</div>';

	  	return $html;
	}

	/**
	 * Checkboxes
	 *
	 * @param object $field
	 * @return string $html
	 * @access private
	 **/
	private function element_checkboxes($field, $val)
	{
		
		if(!empty($val)){$val_exp = explode(', ',$val);}
		error_log('message');
		
		$id = $this->encode_element_title($field->title);
		$required = ($field->required) ? 'required' : FALSE;
		$filter = ($field->filter) ? 'filter' : FALSE;

		$html = '<div class="form-group clearfix required has-feedback">';
		$html .= $this->make_label($id, $field->title, $required);
		$html .= $this->make_filter($id, $filter);
		$html .= '<div class="col-sm-6">';
		
	    // Render choices
		for($i=0; $i < count($field->choices); $i++) {
			$checked = $field->choices[$i]->checked ? "checked" : '';
			if(!empty($val)){$checked = (in_array($field->choices[$i]->value, $val_exp)) ? "checked" : '';}
			$html .= '<div class="col-sm-6"><div class="checkbox"><label>';
			$html .= sprintf('<input type="checkbox" name="dynamic[%s][%d]" id="%s-%d" value="%s" %s>%s ', $id, $i, $id, $i, $field->choices[$i]->value, $checked, $field->choices[$i]->title);
			$html .= '</label></div></div>';
		}

	  	$html .= '</div></div>';

	  	return $html;
	}

	/**
	 * Mutliple choice
	 *
	 * @param object $field
	 * @return string $html
	 * @access private
	 **/
	private function element_multiple_choice($field, $val)
	{
		$id = $this->encode_element_title($field->title);
		$required = ($field->required) ? 'required' : FALSE;
		$filter = ($field->filter) ? 'filter' : FALSE;

		$html = '<div class="form-group clearfix required has-feedback">';
		$html .= $this->make_label($id, $field->title, $required);
		$html .= $this->make_filter($id, $filter);
		
	    // Render choices
		for($i=0; $i < count($field->choices); $i++) {
			$checked = $field->choices[$i]->checked ? "checked" : '';
			//if(!empty($val)){$checked = (in_array($field->choices[$i]->value, $val_exp)) ? "checked" : '';}
			if(!empty($val)){$checked = ($field->choices[$i]->value == $val) ? "checked" : '';}

			$html .= '<div class="col-sm-2"><div class="radio"><label>';
			$html .= sprintf('<input type="radio" name="dynamic[%s]" id="%s_%d" value="%s" %s>%s', $id, $id, $i, $field->choices[$i]->value, $checked, $field->choices[$i]->title);
			$html .= '</label></div></div>';
		}

	  	$html .= '</div>';

	  	return $html;
	}

	/**
	 * Render dropdown
	 *
	 * @param object $field
	 * @return string $html
	 * @access private
	 **/
	private function element_dropdown($field, $val)
	{
		$id = $this->encode_element_title($field->title);
		$required = ($field->required) ? 'required' : FALSE;
		$filter = ($field->filter) ? 'filter' : FALSE;

		$html = '<div class="form-group clearfix </div> has-feedback">';
		$html .= $this->make_label($id, $field->title, $required);
		$html .= $this->make_filter($id, $filter);
	    $html .= sprintf('<div class="col-sm-6"><select name="dynamic[%s]" id="%s" class="form-control %s">', $id, $id, $required);

	    // Render choices
	    foreach ($field->choices as $choice) {
	    	$checked = $choice->checked ? "selected" : '';
			if(!empty($val)){$checked = ($choice->value == $val) ? "selected" : '';}
	    	$html .= sprintf('<option value="%s" %s>%s</option>', $choice->value, $checked, $choice->title);
	    }

	  	$html .= '</select></div></div>';

	  	return $html;
	}

	/**
	 * Section break
	 *
	 * @param object $field
	 * @return string $html
	 * @access private
	 **/
	private function element_section_break($field)
	{
		$html = '<div class="form-group section-break">';
		$html .= sprintf('<hr/><h4>%s</h4><p>%s</p>', $field->title, $field->description);
		$html .= '</div>';

		return $html;
	}

} // End formLoader.php

///  Captcha code
function getRandomWord($len = 5) {
    $word = array_merge(range('0', '9'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

function get_cat_id($cat_name = '') {
	$value = '';
    $value=DB::table('categorys')
	->select('passUrl','id')
	->where('passUrl','=', ''.$cat_name.'')->first();
	if(isset($value->id)){
	return $value->id;
	}
}

function dropdown($type,$cId=null){
	switch($type){
		case 'countries':
		   $dp = DB::table('countries')->get()->pluck('name','id');
		break;
		 case 'distance':
			for($i=1;$i<51;$i++){
				$dp[$i] = $i.' Km';
			}
		break;
		case 'state':
			$dp = DB::table('states')->where('country_id',$cId)->get()->pluck('name','id');
		break;
		case 'city':
			$dp =  DB::table('cities')->where('state_id',$cId)->get()->pluck('name','id');
		break;
		case 'subcategory':
			$dp = DB::table('subcategorys')->where('parent_id',$cId)->get()->pluck('name','id');
		break;
		case 'employee':
			$dp = array('1'=>'Emp1','2'=>'Emp2');
		break;
		case 'nameTitle':
			$dp = array('Mr.'=>'Mr.','Miss.'=>'Miss.','Mrs.'=>'Mrs.');
		break;
		case 'exp':
			for($i=1;$i<11;$i++){
				$dp[$i] = $i.(($i==1)?' yr':' yrs');    
			}    
		break;
		case 'qualification':
			$dp = array('10'=>'10th','12'=>'12th','Graduate'=>'Graduate','Post Graduate'=>'Post Graduate');
		break;
		case 'bank':
			$dp = DB::table('banks')->get()->pluck('name','id');
		break;
		case 'carmodel':
			$dp = DB::table('car_models')->where('car_brand_id',$cId)->get()->pluck('name','id');
		break;
	}    
	return $dp;
}

function productOrders($product_id){
 return DB::table('orders')
	  ->select(DB::raw('count(orders.id) as order_count'))
	  ->where('orders.product_id','=', $product_id)
	  ->groupBy('orders.id')
	  ->first()->order_count;
}
///hotel////
function room_name($id){
$data = array();
$data = DB::table('room_types')
		->where('room_types.id','=',$id)->get();
		return $data[0]->r_name;
}

function hotel_name($id){
$data = array();
$data = DB::table('hotels')
		->where('hotels.id','=',$id)->get();
		return $data[0]->name;
}

//Payment method function 
// This function uses the QSI Response code retrieved from the Digital
// Receipt and returns an appropriate description for the QSI Response Code
//
// @param $responseCode String containing the QSI Response Code
//
// @return String containing the appropriate description
//
function getResultDescription($responseCode) {

    switch ($responseCode) {
        case "0" : $result = "Transaction Successful"; break;
        case "?" : $result = "Transaction status is unknown"; break;
        case "E" : $result = "Referred"; break;
        case "1" : $result = "Transaction Declined"; break;
        case "2" : $result = "Bank Declined Transaction"; break;
        case "3" : $result = "No Reply from Bank"; break;
        case "4" : $result = "Expired Card"; break;
        case "5" : $result = "Insufficient funds"; break;
        case "6" : $result = "Error Communicating with Bank"; break;
        case "7" : $result = "Payment Server detected an error"; break;
        case "8" : $result = "Transaction Type Not Supported"; break;
        case "9" : $result = "Bank declined transaction (Do not contact Bank)"; break;
        case "A" : $result = "Transaction Aborted"; break;
        case "B" : $result = "Fraud Risk Blocked"; break;
		case "C" : $result = "Transaction Cancelled"; break;
        case "D" : $result = "Deferred transaction has been received and is awaiting processing"; break;
        case "E" : $result = "Transaction Declined - Refer to card issuer"; break;
		case "F" : $result = "3D Secure Authentication failed"; break;
        case "I" : $result = "Card Security Code verification failed"; break;
        case "L" : $result = "Shopping Transaction Locked (Please try the transaction again later)"; break;
        case "M" : $result = "Transaction Submitted (No response from acquirer)"; break;
		case "N" : $result = "Cardholder is not enrolled in Authentication scheme"; break;
        case "P" : $result = "Transaction has been received by the Payment Adaptor and is being processed"; break;
        case "R" : $result = "Transaction was not processed - Reached limit of retry attempts allowed"; break;
        case "S" : $result = "Duplicate SessionID (Amex Only)"; break;
        case "T" : $result = "Address Verification Failed"; break;
        case "U" : $result = "Card Security Code Failed"; break;
        case "V" : $result = "Address Verification and Card Security Code Failed"; break;
        default  : $result = "Unable to be determined"; 
    }
    return $result;
}

//  ----------------------------------------------------------------------------

// This function uses the QSI AVS Result Code retrieved from the Digital
// Receipt and returns an appropriate description for this code.

// @param avsResultCode String containing the QSI AVS Result Code
// @return description String containing the appropriate description

function getAVSResultDescription($avsResultCode) {
    
    if ($avsResultCode != "") { 
        switch ($avsResultCode) {
            Case "Unsupported" : $result = "AVS not supported or there was no AVS data provided"; break;
            Case "X"  : $result = "Exact match - address and 9 digit ZIP/postal code"; break;
            Case "Y"  : $result = "Exact match - address and 5 digit ZIP/postal code"; break;
            Case "W"  : $result = "9 digit ZIP/postal code matched, Address not Matched"; break;
			Case "S"  : $result = "Service not supported or address not verified (international transaction)"; break;
            Case "G"  : $result = "Issuer does not participate in AVS (international transaction)"; break;
			Case "C"  : $result = "Street Address and Postal Code not verified for International Transaction due to incompatible formats."; break;
            Case "I"  : $result = "Visa Only. Address information not verified for international transaction."; break;
			Case "A"  : $result = "Address match only"; break;
            Case "Z"  : $result = "5 digit ZIP/postal code matched, Address not Matched"; break;
            Case "R"  : $result = "Issuer system is unavailable"; break;
            Case "U"  : $result = "Address unavailable or not verified"; break;
            Case "E"  : $result = "Address and ZIP/postal code not provided"; break;
			Case "B"  : $result = "Street Address match for international transaction. Postal Code not verified due to incompatible formats."; break;
            Case "N"  : $result = "Address and ZIP/postal code not matched"; break;
            Case "0"  : $result = "AVS not requested"; break;
			Case "D"  : $result = "Street Address and postal code match for international transaction."; break;
			Case "M"  : $result = "Street Address and postal code match for international transaction."; break;
			Case "P"  : $result = "Postal Codes match for international transaction but street address not verified due to incompatible formats."; break;
			Case "K"  : $result = "Card holder name only matches."; break;
			Case "F"  : $result = "Street address and postal code match. Applies to U.K. only."; break;
            default   : $result = "Unable to be determined"; 
        }
    } else {
        $result = "null response";
    }
    return $result;
}

//  ----------------------------------------------------------------------------

// This function uses the QSI CSC Result Code retrieved from the Digital
// Receipt and returns an appropriate description for this code.

// @param cscResultCode String containing the QSI CSC Result Code
// @return description String containing the appropriate description

function getCSCResultDescription($cscResultCode) {
    
    if ($cscResultCode != "") {
        switch ($cscResultCode) {
            Case "Unsupported" : $result = "CSC not supported or there was no CSC data provided"; break;
            Case "M"  : $result = "Exact code match"; break;
            Case "S"  : $result = "Merchant has indicated that CSC is not present on the card (MOTO situation)"; break;
            Case "P"  : $result = "Code not processed"; break;
            Case "U"  : $result = "Card issuer is not registered and/or certified"; break;
            Case "N"  : $result = "Code invalid or not matched"; break;
            default   : $result = "Unable to be determined"; break;
        }
    } else {
        $result = "null response";
    }
    return $result;
}

//  -----------------------------------------------------------------------------
function getUrlContent($url){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache",
		"postman-token: b00a4e05-a03e-5d14-16a0-9c3660cbdf55"
		),
		));

		$result = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);


		if ($err) {
			$response = ['status'=>false,'response'=>$err];
		} else {
			$check = json_decode($result);
			if(isset($check->status) && $check->status!='success')
			$response = ['status'=>false,'response'=>$result];
			else
			$response = ['status'=>true,'response'=>$result];
		}
		return $response;
	}

$date = date('Y-m-d');
function checkBA_Slab($business_id,$start_date=null,$end_date=null)
{
	$check = 0;
	$slab = 0;
	$start_date = date('Y-m-d 00:00:00', strtotime(date('Y-m-d 00:00:00').' -25 day'));
	$end_date =  date('Y-m-d 00:00:00', strtotime(date('Y-m-d 00:00:00').' +1 day'));
	$result = [];
	$result = DB::table('sellers')
	->select('sellers.*')
	->where('sellers.business_id',$business_id)	
	->whereBetween('sellers.created_at',[$start_date,$end_date])		
	->groupBy('sellers.seller_id')
	->orderBy('sellers.created_at', 'ASC')->get();
		
	return count($result);
	
}

function getTxnPercentage($slab_count)
{
	$perc = 0;
	if($slab_count>0 && $slab_count<4)
	{
		$perc = 0.25;
	}
	else if($slab_count>3) 
	{
		$perc = 0.5;
	}
	else{
		$perc = 0.5;
	}
	return $perc;
}

// machine transactios function
$date = date('Y-m-d');
function checkBASlab($business_id,$seller_id,$start_date=null,$end_date=null)
{
	$check = 0;
	$slab = 0;
	$start_date = date('Y-m-d 00:00:00');
	$end_date =  date('Y-m-d 00:00:00', strtotime($start_date . ' +1 day'));
	$result = [];
	$result = DB::table('sellers')
	->select('sellers.*')
	->where('sellers.business_id',$business_id)	
	->where('sellers.seller_id',$seller_id)
	->whereBetween('sellers.created_at',[$start_date,$end_date])		
	->groupBy('sellers.seller_id')
	->orderBy('sellers.created_at', 'ASC')->get();
	if(count($result))
		$slab = count($result);
	
	if($slab>=5)
		$check = 1;
	else if($slab == 4)
		$check = 2;
	else if($slab == 3)
		$check = 3;
	else if($slab == 2)
		$check = 4;	
	else if($slab == 1)
		$check = 5;		
	else
		$check = 0;			
	return $check;
	
}
//  -----------------------------------------------------------------------------

function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
}

function count_product($id)
{
	$result = DB::table('products')
	->where('products.company_id',$id)	
	->where('products.product_associate','!=','0')
	->groupBy('products.id')->get();
		
	return count($result);
	
}

function get_comp_id($id,$user_id='')
{
	$result = DB::table('products')
	->select('id')
	->where('products.company_id',$id)	
	->where('products.user_id',$user_id)	
	->where('products.product_associate','0')
	->groupBy('products.id')->first();
		
	return $result;
}

function discount_product($id)
{
	$result = DB::table('products')
	->select('products.discount as discount','image_products.name as imgname','createcompanies.company_name as company_name')
	->leftJoin('image_products','products.id','=','image_products.product_id')
	->leftJoin('createcompanies','products.company_id','=','createcompanies.id')
	->where('products.id',$id)	
	->groupBy('products.id')->first();
		
	return $result;	
}

function GetSMS($mobile,$message)
	{	
		if(isset($mobile) && isset($message))
		{
			$url = "http://quick.smseasy.in:8080/bulksms/bulksms"; 
			//the gateway's interface provided by the gateway provider
			 
			 
			$request = "";
			 
			$param["username"] = "sse-aapkatrade"; //the account username provided by gateway provider
			 
			$param["password"] = "aapkatra"; //the account password provided by gateway provider
			 
			$param["type"] = 0; //the text message that will be sent

			$param["dlr"] = 1; //the text message that will be sent

			$param["destination"] = $mobile; //the recipient of the text message
			 
			$param["source"] = 'AAPKAT'; //the message sender

			$param["message"] = $message; //the text message that will be sent
			 
			foreach($param as $key=>$val){
			 
			$request.= $key."=".urlencode($val);
			 
			$request.= "&";
			 
			}
			 
			$request = substr($request, 0, strlen($request)-1);
			 
			$ch = curl_init();
			 
			curl_setopt($ch, CURLOPT_URL, $url);
			 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			 
			curl_setopt($ch, CURLOPT_POST, 1);
			 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
			 
			$response = curl_exec($ch);
			 
			curl_close($ch);
			if(!empty($response))
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		else 
		{
			return false;
		}
}


 function unique_salt($password = null) {
		return password_hash($password, PASSWORD_BCRYPT, ['cost' => 10,'salt'=>'fhfh55665uh534f3rh54654h54ygdgerwer3']);        
    }
	
function check_password($hash, $password) {
		
	//	$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10,'salt'=>'amit']);
	//$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

	if (password_verify($password, $hash)) {
	   return true;
	} else {
		return false;
	}
        
    }	

function multi_strpos($string, $check, $getResults = false)
{
  $result = array();
  $checks = (array) $check;

  foreach ($check as $s)
  {
    $pos = strpos($string, $s);

    if ($pos !== false)
    {
      if ($getResults)
      {
        $result[$s] = $pos;
      }
      else
      {
        return $pos;          
      }
    }
  }

  return empty($result) ? false : $result;
}

//$id = business id
  function getBusinessRefNo($id){
		  $value = array();
		  $query = DB::table('business_associates')
		  ->select('ref_no')
		  ->where('business_id',$id)->first();
	if(count($query))
		return $query->ref_no;	
	else
		return 'NA';
  }
  
   function custom_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}

function clean($string) {
   $string = str_replace('', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '-', strtolower($string)); // Removes special chars.
}
function businessNotification($business_id,$start_date=null,$end_date=null)
{
	$check = 0;
	$slab = 0;
	$start_date = date('Y-m-d 00:00:00', strtotime(date('Y-m-d 00:00:00')));
	$end_date =  date('Y-m-d 00:00:00', strtotime(date('Y-m-d 00:00:00').' +1 day'));
	
	$result = [];
	$result = DB::table('sellers')
	->select('sellers.*')
	->where('sellers.business_id',$business_id)	
	->whereBetween('sellers.created_at',[$start_date,$end_date])		
	->groupBy('sellers.seller_id')
	->orderBy('sellers.created_at', 'ASC')->get();
	
	
	if(count($result))
		
	
	if($slab>=5)
		$check = 1;
	else if($slab == 4)
		$check = 2;
	else if($slab == 3)
		$check = 3;
	else if($slab == 2)
		$check = 4;	
	else if($slab == 1)
		$check = 5;		
	else
		$check = 0;			
	return $check;	
	
	
}

function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}
