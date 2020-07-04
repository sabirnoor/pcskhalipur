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

        <?php echo $quiz_details['quiz_title'];?><br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  
	  <div class="clearfix"></div>
	  
      <!--Section: Contact v.2-->
<section class="mb-4">


  <div class="row">

      <!--Grid column-->
      <div class="col-md-12 mb-md-0 mb-5">
	  
	  <div id="end_counter"></div>
	  
	  <h3>Question: <?php echo $Session_Vars['Session_Offset']+1; ?></h3>
	  
	  <h2><?php echo $question_list[0]['question_title']; ?></h2>
	 
	  
          <form id="quiz-form" name="quiz-form" action="{{url('quiz')}}" method="POST" autocomplete="off">
            {{csrf_field()}}
              
			<input type="hidden" name="question_id" value="<?php echo $question_list[0]['id']; ?>" />
			<input type="hidden" name="answer_id" value="<?php echo isset($answer_info['answer_id'])?$answer_info['answer_id']:''; ?>" />
			<input type="hidden" id="resultid" value="<?php echo $Session_Vars['Session_Result_Id']; ?>" />
			
			<?php
			  $quiz_end_date = '';
			   if(isset($quiz_details['quiz_end_date'])){
				$quiz_end_date = date('F d, Y',strtotime($quiz_details['quiz_end_date']));
			  }			  
              $quiz_end_time = $quiz_details['quiz_end_time'];
			  ?>
			
			<input type="hidden" name="qend" id="qend" value="<?php echo $quiz_end_date.' '.$quiz_end_time; ?>" /><!--June 30, 2020 20:35:00-->
			
			<input type="hidden" name="timeup" id="timeup" value="" />

              <!--Grid row-->
              <div class="row">
                  <div class="col-md-12">
                      <div class="radio">
							  <label><input type="radio" name="user_answer" value="1" <?php echo(isset($answer_info['optionchosen']) && $answer_info['optionchosen']==1)?'checked="checked"':''; ?>><?php echo $question_list[0]['option1']; ?></label>
					  </div>					  
                  </div>
              </div>
              <!--Grid row-->
			  
			  <!--Grid row-->
              <div class="row">
                  <div class="col-md-12">
                      <div class="radio">
							  <label><input type="radio" name="user_answer" value="2" <?php echo(isset($answer_info['optionchosen']) && $answer_info['optionchosen']==2)?'checked="checked"':''; ?>><?php echo $question_list[0]['option2']; ?></label>
					  </div>					  
                  </div>
              </div>
              <!--Grid row-->
			  
			  <!--Grid row-->
              <div class="row">
                  <div class="col-md-12">
                      <div class="radio">
							  <label><input type="radio" name="user_answer" value="3" <?php echo(isset($answer_info['optionchosen']) && $answer_info['optionchosen']==3)?'checked="checked"':''; ?>><?php echo $question_list[0]['option3']; ?></label>
					  </div>					  
                  </div>
              </div>
              <!--Grid row-->
			  
			  <!--Grid row-->
              <div class="row">
                  <div class="col-md-12">
                      <div class="radio">
							  <label><input type="radio" name="user_answer" value="4" <?php echo(isset($answer_info['optionchosen']) && $answer_info['optionchosen']==4)?'checked="checked"':''; ?>><?php echo $question_list[0]['option4']; ?></label>
					  </div>					  
                  </div>
              </div>
              <!--Grid row-->
			
			 <?php if(isset($Session_Vars['Session_Offset']) && $Session_Vars['Session_Offset']>0){?>
			<div class="col-md-2 quizbuttons" style="display:none">
				<input class="btn btn-primary"  type="submit" name="submit" value="Prev" />
			</div>
			<?php } ?>
			
			<?php if(isset($Session_Vars['Session_Offset']) && $Session_Vars['Session_Offset']==$total_question-1){?>
			<div class="col-md-2 quizbuttons" style="display:none">
				<input class="btn btn-primary"  type="submit" name="submit" value="Finish" />
				<!--<button class="btn btn-primary finalsubmit"  type="submit" name="submit">Finish</button>-->
			</div>
			<?php }else{?>
			<div class="col-md-2 quizbuttons" style="display:none">
				<input class="btn btn-primary" type="submit" name="submit" value="Next" />
			</div>
			<?php }?>

              

          </form>

           <div class="text-lrft text-md-left resultdiv" style="display:none">
              <a href="<?=url('quiz-result')?>" class="btn btn-primary">Result</a>
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
	
// Set the date we're counting down to

qend = document.getElementById("qend").value;

var quizEndDate = new Date(qend).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();    
  // Find the distance between now and the count down date
  
  var timetoend = quizEndDate - now;    
  
  // Time calculations for days, hours, minutes and seconds
  var days2 = Math.floor(timetoend / (1000 * 60 * 60 * 24));
  var hours2 = Math.floor((timetoend % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes2 = Math.floor((timetoend % (1000 * 60 * 60)) / (1000 * 60));
  var seconds2 = Math.floor((timetoend % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="end_counter"
  document.getElementById("end_counter").innerHTML = "Exam ends in: " + days2 + "d " + hours2 + "h "
  + minutes2 + "m " + seconds2 + "s ";
    
  // If the count down is over, write some text 
  if (timetoend < 0) {
			clearInterval(x);
			document.getElementById("end_counter").innerHTML = "Exam Ended.";			
			$resultid = $('#resultid').val(); //alert('Time Up');
			
			$('.resultdiv').css('display','block');
			
  }else{
	  $('.quizbuttons').css('display','block');
  }
}, 1000);

 
 });

</script>

    </body>

</html>