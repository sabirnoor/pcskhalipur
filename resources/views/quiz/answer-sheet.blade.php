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

       

        <!-- Carousel
    
        ================================================== -->

 

<div class="pencil-bg">

  <div class="container inr-page">

    <div class="col-sm-12 con-area">

      <h1 class="heading">

        Answer Sheet

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  
	  <div class="page-content">
	
	<div class="row">
		<div class="col-md-12 mb-md-0 mb-5">
		<h1 style="color:#438eb9"><?=$quiz_details->quiz_title;?></h1>
		<?php 
			if($QuizquestionsList){

				foreach ($QuizquestionsList as $value) {                                 
					$user_answer='';$color='';$icon='';
					$value = (array) $value;
					if(isset($user_result_data_arr[$value['id']])){
						$user_answer = $user_result_data_arr[$value['id']]['optionchosen'];
						
						if($value['correct_answer']==$user_result_data_arr[$value['id']]['optionchosen']){
							$color = '#17ca17';
							$icon = '<i class="ace-icon fa fa-check icon-only"></i>';
						}else{
							$color = '#f00';
							$icon = '<i class="ace-icon fa fa-times icon-only"></i>';
						}
					}else{
						$user_answer='';
					}
			?>
			<h3><?php echo $value['question_title']; ?></h3>
			<h5>Option 1: <?=$value['option1']?></h5>
			<h5>Option 2: <?=$value['option2']?></h5>
			<h5>Option 3: <?=$value['option3']?></h5>
			<h5>Option 4: <?=$value['option4']?></h5>
			
			<h4 style="">Correct Option : Option <?=$value['correct_answer']?></h4>
			
			<h4 style="">Your Answer :
			<span style="color:<?=$color?>">
				<?php if($user_answer<>''){ echo 'Option '.$user_answer.' '.$icon; }?>
			</h4>
		<?php
				}
			}
		?>
		</div>
  
   </div>

        

    </div>
	  
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