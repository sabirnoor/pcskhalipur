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

	{{--<div class="navbar-wrapper">
			@include('includes.menu_nav')
			@show  
	</div>  --}}  

        <!-- Carousel
    
        ================================================== -->

{{--<div class="banner">

  <img src="{{asset('public/assets/img/about_banner.jpg')}}" alt="..." class="img-responsive">

</div>--}}  

<div class="pencil-bg">

  <div class="container inr-page">

    <div class="col-sm-9 con-area">

      <h1 class="heading">

        <?php echo $quiz_details['quiz_title'];?><br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  
	  <div class="clearfix"></div>
	  
      <!--Section: Contact v.2-->
<section class="mb-4">


  <div class="row">

      <!--Grid column-->
      <div class="col-md-4 mb-md-0 mb-5">
	  
	  <p id="start_counter"></p><p id="end_counter"></p>
	  
	  <table class="table table-striped table-bordered">
							<thead>
								<!--<tr>
									<th></th>
									<th></th>
								</tr-->
							</thead>
							<tbody>
								<tr class="footableOdd">								
									<td class="text-right">Full Marks:</td>
									<td><?php echo $quiz_details['quiz_max_marks']; ?></td>
								</tr>								
								
								<tr class="footableOdd">								
									<td class="text-right">Time:</td>
									<td><?php echo $quiz_details['quiz_max_time']; ?></td>
								</tr>
								
								<tr class="footableOdd">								
									<td class="text-right">No. Of Question:</td>
									<td><?php echo $quiz_details['quiz_total_question']; ?></td>
								</tr>
								
								<tr class="footableOdd">								
									<td class="text-right">Student Name:</td>
									<td><?php echo $student_details['student_name']; ?></td>
								</tr>
								
								<tr class="footableOdd">								
									<td class="text-right">Class:</td>
									<td><?php echo $student_details['present_class']; ?></td>
								</tr>
								
								
								<tr class="footableOdd">								
									<td class="text-right">Roll No:</td>
									<td><?php echo $student_details['Roll_No']; ?></td>
								</tr>
								
							</tbody>
						</table>
	 
	 <?php if($already_played==1){ //echo $result_details->result_id;?>
	 <div>You have finished this exam.</div>
	 <!--<div class="col-md-12">
		  <div class="md-form mb-0">
		   <a href="<?=url('quiz-result')?>" title="Result">
		   <button class="btn btn-primary">View Result</button>
		   </a>                      
		  </div>
	  </div>-->
				  
	 <?php }else{?>
	  
          <form id="quiz-form" name="quiz-form" action="{{url('startquiz')}}" method="POST" autocomplete="off">
            {{csrf_field()}}
              <?php
			  $quiz_start_date = '';			  
			  if(isset($quiz_details['quiz_start_date'])){
				$quiz_start_date = date('F d, Y',strtotime($quiz_details['quiz_start_date']));
			  }
			  $quiz_start_time = $quiz_details['quiz_start_time'];
			  
			  $quiz_end_date = '';
			   if(isset($quiz_details['quiz_end_date'])){
				$quiz_end_date = date('F d, Y',strtotime($quiz_details['quiz_end_date']));
			  }			  
              $quiz_end_time = $quiz_details['quiz_end_time'];
			  ?>
			  
			
			<input type="hidden" name="quizid" value="<?php echo $quiz_details['id']; ?>" />
			
			<input type="hidden" name="qstart" id="qstart" value="<?php echo $quiz_start_date.' '.$quiz_start_time; ?>" />
			<input type="hidden" name="qend" id="qend" value="<?php echo $quiz_end_date.' '.$quiz_end_time; ?>" /><!--June 30, 2020 20:35:00-->
			
			<div class="row">
			<div class="col-md-6 startbtn" style="display:none">
				<input class="btn btn-primary form-control " style="margin: 5px 0px;" type="submit" name="submit" value="Start" />
			</div>
			</div>

              

          </form>
		  
		   <?php }?>
		   
		   <div class="col-md-12">
			  <div class="md-form mb-0">
			   <a href="<?=url('quiz-result')?>" title="Result">
			   <button class="btn btn-primary">View Result</button>
			   </a>                      
			  </div>
		  </div>
			   
		  
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
// Set the date we're counting down to
qstart = document.getElementById("qstart").value;
qend = document.getElementById("qend").value;

var quizStartDate = new Date(qstart).getTime();
var quizEndDate = new Date(qend).getTime();



// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var timetostart = quizStartDate - now;
  var timetoend = quizEndDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(timetostart / (1000 * 60 * 60 * 24));
  var hours = Math.floor((timetostart % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((timetostart % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((timetostart % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="start_counter"
  document.getElementById("start_counter").innerHTML = "Exam starts in: " + days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
  
  // Time calculations for days, hours, minutes and seconds
  var days2 = Math.floor(timetoend / (1000 * 60 * 60 * 24));
  var hours2 = Math.floor((timetoend % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes2 = Math.floor((timetoend % (1000 * 60 * 60)) / (1000 * 60));
  var seconds2 = Math.floor((timetoend % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="end_counter"
  document.getElementById("end_counter").innerHTML = "Exam ends in: " + days2 + "d " + hours2 + "h "
  + minutes2 + "m " + seconds2 + "s ";
    
  // If the count down is over, write some text 
  if (timetostart < 0) {		
		
		document.getElementById("start_counter").innerHTML = "";	
		
		if (timetoend < 0) {
			clearInterval(x);
			document.getElementById("end_counter").innerHTML = "Exam Ended.";			
			$('.startbtn').css('display','none')
		}else{
			$('.startbtn').css('display','block')
		}
  }else{
	  document.getElementById("end_counter").innerHTML = "";
  }
}, 1000);
</script>

    </body>

</html>