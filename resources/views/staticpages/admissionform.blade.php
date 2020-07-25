<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
                
        @include('includes.css_part')
        @show

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

      <!--Grid column-->
      <div class="col-md-12 mb-md-0 mb-5">
          <form id="admission-form" name="admission-form" action="{{url('admission')}}" method="POST" autocomplete="on">
            {{csrf_field()}}
              <!--Grid row-->
              <div class="row">
					<h4>Personal Information</h4>
                  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="present_class" class="">Class <span style="font-size:15px;color: red;">*</span></label></label>
                          <select id="present_class" name="present_class"  class="form-control" value="" autocomplete="off">
						  <option value="XI">XI</option>
						  </select>
                          
                      </div>
                  </div>
				  
				  <!--Grid column-->
                  <div class="col-md-6">
				  
                      <div class="md-form mb-0">
                        <label for="student_name" class="">Name Of the Candidate ( As per record in Birth Certificate / T.C. / Marksheet) <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="student_name" name="student_name" class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
                 
                  
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="dob" class="">Date of Birth (As per document to be uploaded) <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="dob" name="dob" class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
				  
				   <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="dob_in_words" class="">Date Of Birth (in words) <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="dob_in_words" name="dob_in_words" class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="nationality" class="">Nationality<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="nationality" name="nationality"  class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="aadharno" class="">Aadhar No.<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="aadharno" name="aadharno"  class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="religion" class="">Religion<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="religion" name="religion"  class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="gender" class="">Gender<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="gender" name="gender" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="social_category" class="">Social Category<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="social_category" name="social_category" class="form-control" value="" autocomplete="off">
                      </div>
                  </div> 
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="blood_group" class="">Blood Group<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="blood_group" name="blood_group" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  Contact Details
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="permanent_address" class="">Permanent Address<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="permanent_address" name="permanent_address"  class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="student_mobile" class="">Mobile<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="student_mobile" name="student_mobile"  class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="email" class="">Email<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="email" name="email"  class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  Checkbox - Select if Permanent address is same as Correspondence address
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="present_address" class="">Present Address<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="present_address" name="present_address" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  
				  Parents' Information
				  
				  
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="father_name" class="">Father's Name <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="father_name" name="father_name"  class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="father_qualification" class="">Father's Education Qualification <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="father_qualification" name="father_qualification"  class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="father_occupation" class="">Father's Occupation <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="father_occupation" name="father_occupation"  class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="father_mobile" class="">Father's Mobile No. <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="father_mobile" name="father_mobile"  class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="mother_name" class="">Mother's Name <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="mother_name" name="mother_name"  class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="mother_qualification" class="">Mother's Education Qualification <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="mother_qualification" name="mother_qualification"  class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="mother_occupation" class="">Mother's Occupation <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="mother_occupation" name="mother_occupation"  class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="mother_mobile" class="">Mother's Mobile No. <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="mother_mobile" name="mother_mobile"  class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
				  
				  
                 
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="contact_no" class="">Annual Income<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="contact_no" name="contact_no" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  Education Details
				  
				   <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="old_school_name_address" class="">Name of the School Last Attended with Address <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="old_school_name_address" name="old_school_name_address" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="board_name" class="">Name of the Board<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="board_name" name="board_name" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="board_registration_no" class="">Registration No<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="board_registration_no" name="board_registration_no" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				   <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="board_roll_no" class="">Roll No<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="board_roll_no" name="board_roll_no" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				   
				   <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="passing_year" class="">Year Of Passing<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="passing_year" name="passing_year" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  
				 V. Marks Detail (Board) 
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="english_marks" class="">English<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="english_marks" name="english_marks" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="science_marks" class="">Science<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="science_marks" name="science_marks" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="math_marks" class="">Maths<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="math_marks" name="math_marks" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="marks_percentage" class="">Percentage<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="marks_percentage" name="marks_percentage" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="exam_medium" class="">Medium Of Exam<span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="exam_medium" name="exam_medium" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
				  
				VI . Subject Selection

				1. English Core (301)
				2. Physics (042)
				3. Chemistry (043)
				4. Math (041)
				5. Biology (044)
				6. Physical Education (048)
				 
				VI. List of Documents to be uploaded
				1. Please Upload Child Photograph: (Maximum Size 200kb)				
				2. Please upload Board Mark sheet: (Maximum Size 200kb)  

				
				
				NOTE: Change of Name or Date of Birth is not permissible.
DECLARATION I / We hereby certify that the above information provided by me / us is correct and I / We understand that if the information is found to be incorrect or false, the ward shall be automatically debarred from selection / admission process without any correspondence in this regard. I / We also understand that the application / registration / short listing does not guarantee admission to my ward. I / We accept the process of admission undertaken by the school and I / We will abide by the decision taken by the school authority. I / We understand that :
•	This admission is purely provisional and will be confirmed on submission of documents and subject to acceptance of the candidature by CBSE / Other Boards.
•	I hereby declare that the particulars given in respect of my son / daughter / ward are true to the best of my knowledge and I shall not request the authorities of any alteration in date of birth etc. given above.
•	My ward will pass subjectly as well as aggregate in all the examinations held during the session.
•	He or she, if found in any indisciplinary activity in the School his / her T.C. should be sent to my residence.
Before pressing the submit button, please ensure that the all information is correct. After submit this form you will not able to modify any field. Are you sure to Submit this form?

              </div>
              

             

             

          </form>

          <div class="text-lrft text-md-left submitdiv">
              <a class="btn btn-primary submitfeedback" >Submit</a>
          </div>
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
      $('.submitfeedback').on('click', function(event){
        event.preventDefault();
        var student_name = $('#student_name').val();
        if($.trim(student_name) === ''){
          alert('Please enter student name');
          $( "#student_name" ).focus();
          return false;
        }
        var admission_no = $('#admission_no').val();
        if($.trim(admission_no) === ''){
          alert('Please enter admission no');
          $( "#admission_no" ).focus();
          return false;
        }
        var roll_no_previous = $('#roll_no_previous').val();
        if($.trim(roll_no_previous) === ''){
          alert('Please enter roll no previous class');
          $( "#roll_no_previous" ).focus();
          return false;
        }
        var present_class = $('#present_class').val();
        if($.trim(present_class) === ''){
          alert('Please enter present class');
          $( "#present_class" ).focus();
          return false;
        }
        var contact_no = $('#contact_no').val();
        if($.trim(contact_no) === ''){
          alert('Please enter contact no.');
          $( "#contact_no" ).focus();
          return false;
        }
        var whatsapp_no = $('#whatsapp_no').val();
        if($.trim(whatsapp_no) === ''){
          alert('Please enter whatsapp no.');
          $( "#whatsapp_no" ).focus();
          return false;
        }
        var suggestion = $('#suggestion').val();
        if($.trim(suggestion) === ''){
          alert('Please enter your suggestion');
          $( "#suggestion" ).focus();
          return false;
        }
        
        var PostData = $('#feedback-form').serialize();
        $.ajax({
            type: "POST",
            url: $('#feedback-form').attr('action'),
            dataType: 'json',
            data: PostData,
            beforeSend: function() {
                $('.submitfeedback').html('Please wait...');
            },
            success: function(data) {
                if (data.success) {
                  $('#feedback-form').hide();
                  $('.submitdiv').hide();
                  $('.status').html(data.message);
                  $('.submitfeedback').html('Submit');
                } else {
                    alert(data.message);
                    $('.submitfeedback').html('Submit');
                }
            }
        });
        //$('#feedback-form').submit();
        
      });
      </script>

    </body>

</html>