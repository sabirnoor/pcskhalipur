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

    <div class="col-sm-6 con-area">

      <h1 class="heading">

        Exam Result

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  
	  <table class="table table-striped table-bordered">
							<thead>
								<!--<tr>
									<th></th>
									<th></th>
								</tr-->
							</thead>
							<tbody>
								<tr class="footableOdd">								
									<td class="text-right">Result:</td>
									<td><?php echo $result_params['final_status']; ?></td>
								</tr>								
								
								<tr class="footableOdd">								
									<td class="text-right">Score:</td>
									<td><?php echo $result_params['user_score']; ?>/<?php echo $result_params['quiz_full_marks']; ?></td>
								</tr>
								
								<tr class="footableOdd">								
									<td class="text-right">Percentage:</td>
									<td><?php echo $result_params['percentage']; ?>%</td>
								</tr>
								
								<tr class="footableOdd">								
									<td class="text-right">Total Questions:</td>
									<td><?php echo $result_params['quiz_full_marks']; ?></td>
								</tr>
								
								<tr class="footableOdd">								
									<td class="text-right">Correct Answers:</td>
									<td><?php echo $result_params['correct_answer']; ?></td>
								</tr>
								
								<tr class="footableOdd">								
									<td class="text-right">Wrong Answers:</td>
									<td><?php echo $result_params['wrong_answer']; ?></td>
								</tr>
								
								
								
								
							</tbody>
						</table>
	  
	  <div class="clearfix"></div>
	  
      <!--Section: Contact v.2-->
<section class="mb-4">


  <div class="row">

      <!--Grid column-->
      <div class="col-md-12 mb-md-0 mb-5">
	  

           
		  
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
	         <!--@include('includes.latest_news')
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
    
<script>
$(document).ready(function() {	
	
if(sessionStorage.getItem("total_seconds")==null || sessionStorage.getItem("total_seconds")=="null" || sessionStorage.getItem("total_seconds")==""){
	
	var total_seconds = $('#quiz_total_time').val() * 60;
	var c_minutes = parseInt(total_seconds / 60);
	var c_seconds = parseInt(total_seconds % 60);
	var timer;
	var remaining_time;
	//set session
	sessionStorage.setItem("total_seconds", total_seconds);
}

function CheckTime() {
  document.getElementById("quiz-time-left").innerHTML = 'Time Left: ' + c_minutes + ' minutes ' + c_seconds + ' seconds ';
  remaining_time = sessionStorage.getItem("total_seconds");
  if (remaining_time <= 0) {
    
	sessionStorage.setItem("total_seconds","");
	
	// stop timer
	clearInterval(timer);
	
	//alert('Time up');
	$('#timeup').val(1);
	$('#quiz_form').submit();
  
  } else {
    total_seconds = remaining_time - 1;
    sessionStorage.setItem("total_seconds",total_seconds);
    c_minutes = parseInt(total_seconds / 60);
    c_seconds = parseInt(total_seconds % 60);
    timer = setTimeout(CheckTime, 1000);
  }
}
timer = setTimeout(CheckTime, 1000);
 
 });

</script>

    </body>

</html>