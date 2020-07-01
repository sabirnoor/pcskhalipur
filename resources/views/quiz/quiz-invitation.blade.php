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

        You are invited for <?php echo $quiz_details['quiz_title'];?><br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  
	  <div class="clearfix"></div>
	  
      <!--Section: Contact v.2-->
<section class="mb-4">


  <div class="row">

      <!--Grid column-->
      <div class="col-md-4 mb-md-0 mb-5">	
	 
	  
          <form id="quiz-form" name="quiz-form" action="{{url('exam-invitation/'.$link)}}" method="POST" autocomplete="off">
            {{csrf_field()}}
             
			<input type="hidden" name="" value="" />
			
			<?php 
			$first_two = substr($student_details['contact_no'],0,2);
			$last_three = substr($student_details['contact_no'],7,3);
			$formatted_contact = $first_two.'xxxxx'.$last_three;
			?>
			
			<p>Enter OTP sent on your number <?php echo $formatted_contact; ?></p>
			<!--Grid column-->
                  <div class="col-md-12">
                      <div class="md-form mb-0">
                        <label for="otp" class="">OTP <span style="font-size:15px;color: red;">*</span></label></label>
                          <input type="text" name="otp" value="" Placeholder="Enter Otp" />                          
                      </div>
                  </div><br /><br />
                  <!--Grid column-->
				  
			
			<!--Grid column-->
                  <div class="col-md-12">
                      <div class="md-form mb-0">
                       <input class="btn btn-primary" type="submit" name="submit" value="Submit" />                        
                      </div>
                  </div>
                  <!--Grid column-->
				  
			<div class="col-md-2">
				
			</div>
              

          </form>

           <!--<div class="text-lrft text-md-left submitdiv">
              <a class="btn btn-primary submitfeedback" >Submit</a>
          </div>
          <div class="status"></div>-->
		  
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
	       <!-- @include('includes.latest_news')
			@show-->
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
    


    </body>

</html>