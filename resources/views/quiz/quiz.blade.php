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
	  
	 <!-- <div id="quiz-time-left"></div>-->
	  
	  <h3>Question: <?php echo $Session_Vars['Session_Offset']+1; ?></h3>
	  
	  <h2><?php echo $question_list[0]['question_title']; ?></h2>
	 
	  
          <form id="quiz-form" name="quiz-form" action="{{url('quiz')}}" method="POST" autocomplete="off">
            {{csrf_field()}}
              
			<input type="hidden" name="question_id" value="<?php echo $question_list[0]['id']; ?>" />
			<input type="hidden" name="answer_id" value="<?php echo isset($answer_info['answer_id'])?$answer_info['answer_id']:''; ?>" />
			
			<input type="hidden" id="quiz_total_time" value="<?php echo $quiz_details['quiz_max_time']; ?>" />
			
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
							  <label><input type="radio" name="user_answer" value="2" <?php echo(isset($answer_info['answer_optionchosen']) && $answer_info['answer_optionchosen']==2)?'checked="checked"':''; ?>><?php echo $question_list[0]['option2']; ?></label>
					  </div>					  
                  </div>
              </div>
              <!--Grid row-->
			  
			  <!--Grid row-->
              <div class="row">
                  <div class="col-md-12">
                      <div class="radio">
							  <label><input type="radio" name="user_answer" value="3" <?php echo(isset($answer_info['answer_optionchosen']) && $answer_info['answer_optionchosen']==3)?'checked="checked"':''; ?>><?php echo $question_list[0]['option3']; ?></label>
					  </div>					  
                  </div>
              </div>
              <!--Grid row-->
			  
			  <!--Grid row-->
              <div class="row">
                  <div class="col-md-12">
                      <div class="radio">
							  <label><input type="radio" name="user_answer" value="4" <?php echo(isset($answer_info['answer_optionchosen']) && $answer_info['answer_optionchosen']==4)?'checked="checked"':''; ?>><?php echo $question_list[0]['option4']; ?></label>
					  </div>					  
                  </div>
              </div>
              <!--Grid row-->
			
			 <?php if(isset($Session_Vars['Session_Offset']) && $Session_Vars['Session_Offset']>0){?>
			<div class="col-md-2">
				<input class="btn btn-primary"  type="submit" name="submit" value="Prev" />
			</div>
			<?php } ?>
			
			<?php if(isset($Session_Vars['Session_Offset']) && $Session_Vars['Session_Offset']==$total_question-1){?>
			<div class="col-md-2">
				<input class="btn btn-primary"  type="submit" name="submit" value="Finish" />
			</div>
			<?php }else{?>
			<div class="col-md-2">
				<input class="btn btn-primary" type="submit" name="submit" value="Next" />
			</div>
			<?php }?>

              

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