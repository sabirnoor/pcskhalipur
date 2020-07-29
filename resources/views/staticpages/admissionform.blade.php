<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
             
        @include('includes.css_part')
        @show
		
		<style>
		ul.info {
			list-style-type: disc !important;
			padding-left:1em !important;
			margin-left:1em;
		}
		</style>

    </head>

    <!-- NAVBAR
    
    ================================================== -->

    <body>

        <div class="navbar-wrapper">
			@include('includes.menu_nav')
			@show  
        </div>    

        <!-- Carousel
    
        ================================================== -->

<div class="banner">

  <img src="{{asset('public/assets/img/about_banner.jpg')}}" alt="..." class="img-responsive">

</div>

<div class="pencil-bg">

  <div class="container inr-page">

    <div class="col-sm-9 con-area">

      <h1 class="heading">

        Admission Form<br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  
	  <div class="clearfix"></div>
	  
      <!--Section: Contact v.2-->
<section class="mb-4">


  <div class="row">
  
  @if(Session::has('msgerror'))
		<p style="color: red;">{{ Session::get('msgerror') }}</p>
		@endif
		

      <!--Grid column-->
      <div class="col-md-12 mb-md-0 mb-5">
          <form id="admission-form" name="admission-form" action="{{url('admission')}}" method="POST" autocomplete="off" enctype="multipart/form-data" onsubmit = "return(validate());">
            {{csrf_field()}}
            
			  <h4>I. Personal Information</h4>
              <div class="row">
					
                  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="present_class" class="">Class <span style="font-size:15px;color: red;">*</span></label>
                          <select id="present_class" name="present_class"  class="form-control" value="" autocomplete="off">
						  <option value="XI">XI</option>
						  </select>
                          
                      </div>
                  </div>
				  
				 
                  <div class="col-md-6">
				  
                      <div class="md-form mb-0">
                        <label for="student_name" class="">Name Of the Candidate ( As per record in Birth Certificate / T.C. / Marksheet) <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="student_name" name="student_name" class="form-control alpha" value="" autocomplete="off" maxlength="30">
                          
                      </div>
                  </div>
                 
                  
                  <div class="col-md-6">
				 
                      <div class="md-form mb-0">
                        <label for="dob" class="">Date of Birth (As per document to be uploaded) <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" data-toggle="datepicker" id="dob" name="dob" class="form-control date_with_slash" value="" placeholder="dd-mm-yyyy" autocomplete="off" maxlength="10">
                          
                      </div>
                  </div>
				  
				   <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="dob_in_words" class="">Date Of Birth (in words) <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="dob_in_words" name="dob_in_words" class="form-control alpha" value="" autocomplete="off" maxlength="150">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="nationality" class="">Nationality<span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="nationality" name="nationality"  class="form-control alpha" value="" autocomplete="off" maxlength="15">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="aadharno" class="">Aadhar No.<span style="font-size:15px;color: red;">*</span></label>
                          <input type="number" id="aadharno" name="aadharno"  class="form-control numeric" value="" autocomplete="off" maxlength="16">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="religion" class="">Religion<span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="religion" name="religion"  class="form-control alpha" value="" autocomplete="off" maxlength="15">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="sex" class="">Gender <span style="font-size:15px;color: red;">*</span></label>
                          <select id="sex" name="sex"  class="form-control" value="" autocomplete="off">
								<option value="">Select Gender</option>								
								<option value="M">Male</option>								
								<option value="F">Female</option>
						  </select>
                          
                      </div>
                  </div>
				  
				 
				 <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="social_category" class="">Social Category <span style="font-size:15px;color: red;">*</span></label>
                          <select id="social_category" name="social_category"  class="form-control" value="" autocomplete="off">
								<option value="">Social Category</option>								
								<option value="GN">GN</option>								
								<option value="OBC">OBC</option>
								<option value="SC">SC</option>
								<option value="ST">ST</option>
								<option value="Minority">Minority</option>
								<option value="EWS">EWS</option>
						  </select>
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="blood_group" class="">Blood Group<span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="blood_group" name="blood_group" class="form-control" value="" autocomplete="off" maxlength="15">
                      </div>
                  </div>
				  
                  </div>
				  
				  <div class="row">
				  
				  <h4>II. Contact Details </h4>
				  
					  <div class="col-md-12">
						  <div class="md-form mb-0">
							<label for="permanent_address" class="">Permanent Address</label>
							<textarea type="text" id="permanent_address" name="permanent_address" rows="2" class="form-control md-textarea address" autocomplete="off" maxlength="250"></textarea>
							  
						  </div>
					  </div>
				 
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="student_mobile" class="">Mobile<span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="student_mobile" name="student_mobile"  class="form-control numeric" value="" autocomplete="off" maxlength="10">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="email" class="">Email<span style="font-size:15px;color: red;">*</span></label>
                          <input type="email" id="email" name="email"  class="form-control email" value="" autocomplete="off" maxlength="40">
                      </div>
                  </div>
				   
					  <div class="col-md-12">
						  <div class="md-form mb-0">
							<label for="present_address" class="">Present Address</label>
							<textarea type="text" id="present_address" name="present_address" rows="2" class="form-control md-textarea address" autocomplete="off" maxlength="250"></textarea>
							  
						  </div>
					  </div>
                  
				  </div>
				  
				  <div class="row">
				  
				  <h4>III. Parents' Information</h4>				  
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="father_name" class="">Father's Name <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="father_name" name="father_name"  class="form-control alpha" value="" autocomplete="off" maxlength="30">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="father_qualification" class="">Father's Education Qualification <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="father_qualification" name="father_qualification"  class="form-control" value="" autocomplete="off" maxlength="30">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="father_occupation" class="">Father's Occupation <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="father_occupation" name="father_occupation"  class="form-control alpha" value="" autocomplete="off" maxlength="30">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="father_mobile" class="">Father's Mobile No. <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="father_mobile" name="father_mobile"  class="form-control numeric" value="" autocomplete="off" maxlength="10">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="mother_name" class="">Mother's Name <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="mother_name" name="mother_name"  class="form-control alpha" value="" autocomplete="off" maxlength="30">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="mother_qualification" class="">Mother's Education Qualification <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="mother_qualification" name="mother_qualification"  class="form-control" value="" autocomplete="off" maxlength="30">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="mother_occupation" class="">Mother's Occupation <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="mother_occupation" name="mother_occupation"  class="form-control alpha" value="" autocomplete="off" maxlength="30">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="mother_mobile" class="">Mother's Mobile No. <span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="mother_mobile" name="mother_mobile"  class="form-control numeric" value="" autocomplete="off" maxlength="10">
                          
                      </div>
                  </div>
				  
				  
                 
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="family_income" class="">Annual Family Income<span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="family_income" name="family_income" class="form-control numeric" value="" autocomplete="off" maxlength="10">
                      </div>
                  </div>
                  
				  </div>
				  
				  <div class="row">
				  
				  <h4>IV.  Education Details</h4>
				  
				  				  
				  <div class="col-md-12">
						  <div class="md-form mb-0">
							<label for="last_school_name_address" class="">Name of the School Last Attended with Address</label>
							<textarea type="text" id="last_school_name_address" name="last_school_name_address" rows="2" class="form-control md-textarea address" autocomplete="off"></textarea>
							  
						  </div>
				  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="board_name" class="">Name of the Board<span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="board_name" name="board_name" class="form-control" value="" autocomplete="off" maxlength="100">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="board_registration_no" class="">Registration No<span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="board_registration_no" name="board_registration_no" class="form-control" value="" autocomplete="off" maxlength="50">
                      </div>
                  </div>
				  
				   <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="board_roll_no" class="">Board  Roll No<span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="board_roll_no" name="board_roll_no" class="form-control" value="" autocomplete="off" maxlength="30">
                      </div>
                  </div>
				   
				   <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="passing_year" class="">Year Of Passing<span style="font-size:15px;color: red;">*</span></label>
                          <input type="number" id="passing_year" name="passing_year" class="form-control numeric" value="" autocomplete="off" maxlength="4">
                      </div>
                  </div>
                  
				  </div>
				  
				 <div class="row">
				  
				  <h4> V. Marks Detail (Board) </h4> 
				
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="english_marks" class="">English<span style="font-size:15px;color: red;">*</span></label>
                          <input type="number" id="english_marks" name="english_marks" class="form-control decimal" value="" autocomplete="off" maxlength="3">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="science_marks" class="">Science<span style="font-size:15px;color: red;">*</span></label>
                          <input type="number" id="science_marks" name="science_marks" class="form-control decimal" value="" autocomplete="off" maxlength="3">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="math_marks" class="">Maths<span style="font-size:15px;color: red;">*</span></label>
                          <input type="number" id="math_marks" name="math_marks" class="form-control decimal" value="" autocomplete="off" maxlength="3">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="marks_percentage" class="">Percentage<span style="font-size:15px;color: red;">*</span></label>
                          <input type="number" id="marks_percentage" name="marks_percentage" class="form-control decimal" value="" autocomplete="off" maxlength="5">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="exam_medium" class="">Medium Of Exam<span style="font-size:15px;color: red;">*</span></label>
                          <input type="text" id="exam_medium" name="exam_medium" class="form-control alpha" value="" autocomplete="off" maxlength="15">
                      </div>
                  </div>
                  
				  </div>
				  
				<div class="row">
				  
				  <h4> VI . Subject Selection </h4> 
				  
				  <div class="col-md-12">
						  <div class="md-form mb-0">
							<div class="checkbox">
							  <label><input type="checkbox" name="selected_subjects[]" value="2"><strong>1. English Core (301)</strong></label>
							</div>
						  </div>
				  </div> 
				  
				  <div class="col-md-12">
						  <div class="md-form mb-0">
							<div class="checkbox">
							  <label><input type="checkbox" name="selected_subjects[]" value="8"><strong>2. Physics (042)</strong></label>
							</div>
						  </div>
				  </div> 
				  
				  <div class="col-md-12">
						  <div class="md-form mb-0">
							<div class="checkbox">
							  <label><input type="checkbox" name="selected_subjects[]" value="9"><strong>3. Chemistry (043)</strong></label>
							</div>
						  </div>
				  </div>
				
				 <div class="col-md-12">
						  <div class="md-form mb-0">
							<div class="checkbox">
							  <label><input type="checkbox" name="selected_subjects[]" value="3"><strong>4. Math (041)</strong></label>
							</div>
						  </div>
				  </div>
				  
				  <div class="col-md-12">
						  <div class="md-form mb-0">
							<div class="checkbox">
							  <label><input type="checkbox" name="selected_subjects[]" value="10"><strong>5. Biology (044)</strong></label>
							</div>
						  </div>
				  </div>
				
				 <div class="col-md-12">
						  <div class="md-form mb-0">
							<div class="checkbox">
							  <label><input type="checkbox" name="selected_subjects[]" value="27"><strong>6. Physical Education (048)</strong></label>
							</div>
						  </div>
				  </div>
				  
				  </div>
				
				<div class="row">
				  
				  <h4> VII. List of Documents to be uploaded</h4> 
				 
				
				
				<div class="col-md-12">
                      <div class="md-form mb-0">
                        <label for="student_photo" class="">1. Please Upload Child Photograph: (Maximum Size 200kb)<span style="font-size:15px;color: red;">*</span></label>
                          <input type="file" id="student_photo" name="student_photo" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				<div class="col-md-12">
                      <div class="md-form mb-0">
                        <label for="student_marksheet" class="">2. Please upload Board Mark sheet: (Maximum Size 200kb)  <span style="font-size:15px;color: red;">*</span></label>
                          
						  <input type="file" id="student_marksheet" name="student_marksheet" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				 </div>
				  
		<br />		
		<p> <span style="color:#f00;font-weight:bold">NOTE: Change of Name or Date of Birth is not permissible.</span></p>
				
<p>DECLARATION: I / We hereby certify that the above information provided by me / us is correct and I / We understand that if the information is found to be incorrect or false, the ward shall be automatically debarred from selection / admission process without any correspondence in this regard. I / We also understand that the application / registration / short listing does not guarantee admission to my ward. I / We accept the process of admission undertaken by the school and I / We will abide by the decision taken by the school authority. I / We understand that :</p>

<ul class="info">
    <li>This admission is purely provisional and will be confirmed on submission of documents and subject to acceptance of the candidature by CBSE / Other Boards.</li>
    <li>I hereby declare that the particulars given in respect of my son / daughter / ward are true to the best of my knowledge and I shall not request the authorities of any alteration in date of birth etc. given above.</li>
    <li>My ward will pass subjectly as well as aggregate in all the examinations held during the session.</li>
    <li>He or she, if found in any indisciplinary activity in the School his / her T.C. should be sent to my residence.
</li>
   
</ul>
	
<p>
Before pressing the submit button, please ensure that the all information is correct. After submit this form you will not able to modify any field. Are you sure to Submit this form?</p>

         
		 <div class="text-lrft text-md-left">
              <input type="submit" name="submit" value="Submit" class="btn btn-lg btn-primary" />
          </div>
		
          </form>

          
          <div class="status" style="text-align:center;font-size:18px; color:green;"></div>
      </div>
      <!--Grid column-->

      
      <!--Grid column-->

  </div>

</section>
<!--Section: Contact v.2-->
					<p>&nbsp;</p>

    
    </div>

    <div class="col-sm-3">

      <div class="col-md-12" style="padding:0;">
			@include('includes.latest_news')
			@show
		</div>

  <div class="clearfix">&nbsp;</div>
  </div>
   <div class="clearfix">&nbsp;</div>
</div>

  </div>


            <!-- FOOTER -->

            <footer>
                @include('includes.footer')
				@show
            </footer>



        </div><!-- /.container -->
        
        @include('includes.js_part')
    @show
    
    <script>
     function validate() {
        
		var present_class = $('#present_class').val();
        if($.trim(present_class) === ''){
          alert('Please enter present class');
          $( "#present_class" ).focus();
          return false;
        }
		
		var student_name = $('#student_name').val();
        if($.trim(student_name) === ''){
          alert('Please enter student name');
          $( "#student_name" ).focus();
          return false;
        }
		
		/*var dob = $('#dob').val();
		if($.trim(dob) === ''){
		  alert('Please enter date of birth.');
		  $( "#dob" ).focus();
		  return false;
		}

		var dob_in_words = $('#dob_in_words').val();
		if($.trim(dob_in_words) === ''){
		  alert('Please enter date of birth in words.');
		  $( "#dob_in_words" ).focus();
		  return false;
		}

		var nationality = $('#nationality').val();
		if($.trim(nationality) === ''){
		  alert('Please enter nationality.');
		  $( "#nationality" ).focus();
		  return false;
		}

		var aadharno = $('#aadharno').val();
		if($.trim(aadharno) === ''){
		  alert('Please enter aadhar no.');
		  $( "#aadharno" ).focus();
		  return false;
		}

		var religion = $('#religion').val();
		if($.trim(religion) === ''){
		  alert('Please enter religion.');
		  $( "#religion" ).focus();
		  return false;
		}

		var sex = $('#sex').val();
		if($.trim(sex) === ''){
		  alert('Please enter gender.');
		  $( "#sex" ).focus();
		  return false;
		}

		var social_category = $('#social_category').val();
		if($.trim(social_category) === ''){
		  alert('Please enter social category');
		  $( "#social_category" ).focus();
		  return false;
		}

		var blood_group = $('#blood_group').val();
		if($.trim(blood_group) === ''){
		  alert('Please enter blood group');
		  $( "#blood_group" ).focus();
		  return false;
		}

		var permanent_address = $('#permanent_address').val();
		if($.trim(permanent_address) === ''){
		  alert('Please enter permanent address.');
		  $( "#permanent_address" ).focus();
		  return false;
		}

		var student_mobile = $('#student_mobile').val();
		if($.trim(student_mobile) === ''){
		  alert('Please enter mobile no.');
		  $( "#student_mobile" ).focus();
		  return false;
		}

		var email = $('#email').val();
		if($.trim(email) === ''){
		  alert('Please enter email.');
		  $( "#email" ).focus();
		  return false;
		}

		var present_address = $('#present_address').val();
		if($.trim(present_address) === ''){
		  alert('Please enter present address.');
		  $( "#present_address" ).focus();
		  return false;
		}

		var father_name = $('#father_name').val();
		if($.trim(father_name) === ''){
		  alert('Please enter father\'s name.');
		  $( "#father_name" ).focus();
		  return false;
		}

		var father_qualification = $('#father_qualification').val();
		if($.trim(father_qualification) === ''){
		  alert('Please enter father\'s qualification');
		  $( "#father_qualification" ).focus();
		  return false;
		}

		var father_occupation = $('#father_occupation').val();
		if($.trim(father_occupation) === ''){
		  alert('Please enter father\'s occupation');
		  $( "#father_occupation" ).focus();
		  return false;
		}

		var father_mobile = $('#father_mobile').val();
		if($.trim(father_mobile) === ''){
		  alert('Please enter father\'s mobile');
		  $( "#father_mobile" ).focus();
		  return false;
		}

		var mother_name = $('#mother_name').val();
		if($.trim(mother_name) === ''){
		  alert('Please enter mother\'s name');
		  $( "#mother_name" ).focus();
		  return false;
		}

		var mother_qualification = $('#mother_qualification').val();
		if($.trim(mother_qualification) === ''){
		  alert('Please enter mother\'s qualification');
		  $( "#mother_qualification" ).focus();
		  return false;
		}

		var mother_occupation = $('#mother_occupation').val();
		if($.trim(mother_occupation) === ''){
		  alert('Please enter mother\'s occupation');
		  $( "#mother_occupation" ).focus();
		  return false;
		}

		var mother_mobile = $('#mother_mobile').val();
		if($.trim(mother_mobile) === ''){
		  alert('Please enter mother\'s mobile');
		  $( "#mother_mobile" ).focus();
		  return false;
		}

		var family_income = $('#family_income').val();
		if($.trim(family_income) === ''){
		  alert('Please enter family income');
		  $( "#family_income" ).focus();
		  return false;
		}

		var last_school_name_address = $('#last_school_name_address').val();
		if($.trim(last_school_name_address) === ''){
		  alert('Please enter name of the school last attended with address');
		  $( "#last_school_name_address" ).focus();
		  return false;
		}

		var board_name = $('#board_name').val();
		if($.trim(board_name) === ''){
		  alert('Please enter board name');
		  $( "#board_name" ).focus();
		  return false;
		}

		var board_registration_no = $('#board_registration_no').val();
		if($.trim(board_registration_no) === ''){
		  alert('Please enter registration no');
		  $( "#board_registration_no" ).focus();
		  return false;
		}

		var board_roll_no = $('#board_roll_no').val();
		if($.trim(board_roll_no) === ''){
		  alert('Please enter roll no');
		  $( "#board_roll_no" ).focus();
		  return false;
		}

		var passing_year = $('#passing_year').val();
		if($.trim(passing_year) === ''){
		  alert('Please enter passing year');
		  $( "#passing_year" ).focus();
		  return false;
		}

		var english_marks = $('#english_marks').val();
		if($.trim(english_marks) === ''){
		  alert('Please enter english marks');
		  $( "#english_marks" ).focus();
		  return false;
		}

		var science_marks = $('#science_marks').val();
		if($.trim(science_marks) === ''){
		  alert('Please enter science marks');
		  $( "#science_marks" ).focus();
		  return false;
		}

		var math_marks = $('#math_marks').val();
		if($.trim(math_marks) === ''){
		  alert('Please enter math marks');
		  $( "#math_marks" ).focus();
		  return false;
		}

		var marks_percentage = $('#marks_percentage').val();
		if($.trim(marks_percentage) === ''){
		  alert('Please enter marks percentage');
		  $( "#marks_percentage" ).focus();
		  return false;
		}

		var exam_medium = $('#exam_medium').val();
		if($.trim(exam_medium) === ''){
		  alert('Please enter exam medium');
		  $( "#exam_medium" ).focus();
		  return false;
		}*/

        return true;
        
      });
      </script>

	
<script type="text/javascript">
           				
               $("#dob").datepicker({
					dateFormat: 'dd-mm-yy',
					//showOtherMonths: true,
					changeMonth: true,
					changeYear: true,
					maxDate:0,
					yearRange: '1990:' + new Date().getFullYear().toString()
				}); 
				

        </script>
		
    </body>

</html>