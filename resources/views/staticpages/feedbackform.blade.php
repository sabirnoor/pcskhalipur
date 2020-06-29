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

        Feedback<br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  
	  <div class="clearfix"></div>
	  
      <!--Section: Contact v.2-->
<section class="mb-4">


  <div class="row">

      <!--Grid column-->
      <div class="col-md-12 mb-md-0 mb-5">
          <form id="feedback-form" name="feedback-form" action="{{url('feedbackform')}}" method="POST" autocomplete="on">
            {{csrf_field()}}
              <!--Grid row-->
              <div class="row">
                  <!--Grid column-->
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="student_name" class="">Student name <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="student_name" name="student_name" class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
                  <!--Grid column-->

                  <!--Grid column-->
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="Father_Name" class="">Father Name <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="Father_Name" name="Father_Name" class="form-control" value="" autocomplete="off">
                          
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="roll_no_previous" class="">Roll No Previous Class <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="roll_no_previous" name="roll_no_previous" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="present_class" class="">Present Class <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="present_class" name="present_class" class="form-control" value="" autocomplete="off">
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="contact_no" class="">Contact No <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="contact_no" name="contact_no" class="form-control numbers" maxlength="10" value="" autocomplete="off">
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="md-form mb-0">
                        <label for="whatsapp_no" class="">Whatsapp No <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" id="whatsapp_no" name="whatsapp_no"  class="form-control numbers" maxlength="10" value="" autocomplete="off">
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="md-form mb-0">
                        <label for="email" class="">On Online Class (Please tick) <span style="font-size:15px;color: red;">*</span></label></label><br>
                        <label class="radio-inline" for="comments-0">
                          <input type="radio" name="comments" id="comments-0" value="Satisfied" checked="checked">
                          Satisfied
                        </label> 
                        <label class="radio-inline" for="comments-1">
                          <input type="radio" name="comments" id="comments-1" value="Not Satisfied">
                          Not Satisfied
                        </label> 
                        <label class="radio-inline" for="comments-2">
                          <input type="radio" name="comments" id="comments-2" value="Need Improvement">
                          Need Improvement
                        </label> 
                        <label class="radio-inline" for="comments-3">
                          <input type="radio" name="comments" id="comments-3" value="Overall Ok">
                          Overall Ok
                        </label> 
                      </div>
                  </div>
                  <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Grid row-->
              <div class="row">
                  <div class="col-md-12">
                      <div class="md-form mb-0">
                        <label for="subject" class="">Any Technical Issue</label>
                        <textarea type="text" id="technical_issue" name="technical_issue" rows="2" class="form-control md-textarea"></textarea>
                          
                      </div>
                  </div>
              </div>
              <!--Grid row-->

              <!--Grid row-->
              <div class="row">

                  <!--Grid column-->
                  <div class="col-md-12">

                      <div class="md-form">
                        <label for="message">Your Suggestion <span style="font-size:15px;color: red;">*</span></label>
                          <textarea type="text" id="suggestion" name="suggestion" rows="2" class="form-control md-textarea"></textarea>
                          
                      </div>

                  </div>
              </div>
              <!--Grid row-->

          </form>

          <div class="text-lrft text-md-left submitdiv">
              <a class="btn btn-primary submitfeedback" >Submit</a>
          </div>
          <div class="status"></div>
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
        var Father_Name = $('#Father_Name').val();
        if($.trim(Father_Name) === ''){
          alert('Please enter father name');
          $( "#Father_Name" ).focus();
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