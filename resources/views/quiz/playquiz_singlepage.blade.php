<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">        
        @include('includes.css_part')
        @show

    </head>
    

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
      <div class="col-md-12 mb-md-0 mb-5">
	  
	  <div id="end_counter"></div>	  
	 
	  
          <form id="quiz-form" name="quiz-form" action="{{url('playexam')}}" method="POST" autocomplete="off">
            {{csrf_field()}}
			
			<?php
			  $quiz_end_date = '';
			   if(isset($quiz_details['quiz_end_date'])){
				$quiz_end_date = date('F d, Y',strtotime($quiz_details['quiz_end_date']));
			  }			  
              $quiz_end_time = $quiz_details['quiz_end_time'];
			  ?>
			
			<input type="hidden" name="qend" id="qend" value="<?php echo $quiz_end_date.' '.$quiz_end_time; ?>" /><!--June 30, 2020 20:35:00-->			
			<input type="hidden" name="timeup" id="timeup" value="" />			
			<input type="hidden" id="resultid" value="<?php echo $Session_Vars['Session_Result_Id']; ?>" />
			
			<input type="hidden" id="action_url" value="{{url('ajaxsaveanswer')}}" />
			
			
			
			<?php $k=0; foreach($question_list as $val){ ?>
			
			<input type="hidden" name="question_id" value="<?php echo $val['id']; ?>" />
			
              <?php //if(isset($answer_arr[$val['id']]) && $answer_arr[$val['id']]==1){ echo 1 ; exit;} ?>
			  
			  <h2><?php echo $val['question_title']; ?></h2>
              
			  <div class="row">
                  <div class="col-md-12">
                      <div class="radio">
							  <label><input type="radio" name="user_answer[<?php echo $val['id']; ?>]" id="user_answer<?= $k++;?>" class="user_answer_cl" data-qid="<?php echo $val['id']; ?>"  value="1" <?php if(isset($answer_arr[$val['id']]) && $answer_arr[$val['id']]==1){ echo 'checked="checked"';} ?>><?php echo $val['option1']; ?> </label>
					  </div>					  
                  </div>
              </div>
             
              <div class="row">
                  <div class="col-md-12">
                      <div class="radio">
							  <label><input type="radio" name="user_answer[<?php echo $val['id']; ?>]" id="user_answer<?= $k++;?>" class="user_answer_cl" data-qid="<?php echo $val['id']; ?>" value="2" <?php if(isset($answer_arr[$val['id']]) && $answer_arr[$val['id']]==2){ echo 'checked="checked"';} ?>><?php echo $val['option2']; ?></label>
					  </div>					  
                  </div>
              </div>
              
              <div class="row">
                  <div class="col-md-12">
                      <div class="radio">
							  <label><input type="radio" name="user_answer[<?php echo $val['id']; ?>]" id="user_answer<?= $k++;?>" class="user_answer_cl" data-qid="<?php echo $val['id']; ?>" value="3" <?php if(isset($answer_arr[$val['id']]) && $answer_arr[$val['id']]==3){ echo 'checked="checked"';} ?>><?php echo $val['option3']; ?></label>
					  </div>					  
                  </div>
              </div>
              
              <div class="row">
                  <div class="col-md-12">
                      <div class="radio">
							  <label><input type="radio" name="user_answer[<?php echo $val['id']; ?>]" id="user_answer<?= $k++;?>" class="user_answer_cl" data-qid="<?php echo $val['id']; ?>" value="4" <?php if(isset($answer_arr[$val['id']]) && $answer_arr[$val['id']]==4){ echo 'checked="checked"';} ?>><?php echo $val['option4']; ?></label>
					  </div>					  
                  </div>
              </div>
			  <?php } ?>
              
			
			<div class="row">
				<div class="col-md-2 quizbuttons" style="display:none">
					<input class="btn btn-primary form-control" style="margin: 5px 0px;" type="submit" name="submit" value="Finish" />
					<!--<button class="btn btn-primary finalsubmit"  type="submit" name="submit">Finish</button>-->
				</div>
            </div>

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
			$resultid = $('#resultid').val(); 			
			
			$('.quizbuttons').css('display','none');
			$('.jumpquesdiv').css('display','none');
			
			$("#user_answer1").attr('disabled','disabled');			
			$("#user_answer2").attr('disabled','disabled');			
			$("#user_answer3").attr('disabled','disabled');			
			$("#user_answer4").attr('disabled','disabled');	
			
			$('.resultdiv').css('display','block');		
			
  }else{
	  $('.quizbuttons').css('display','block');
	  $('.jumpquesdiv').css('display','block');
  }
}, 1000);

});

$(document).ready(function() {	
	$(document).on("click", ".user_answer_cl", function (e) {
	
	//var value = parseInt($( this ).parent().find("input").val());
    //value = isNaN(value) ? 1 : value;
    //$( this ).parent().find("input").val(value);
	
	//console.log($( this ).attr('data-qid'));
	//console.log($( this ).val());
	var qid = $(this).attr('data-qid');
	var qanswer = $(this).val();
	
	var action_url=$('#action_url').val();
	 $.ajax({
            url: action_url,
            type: 'POST',
			data: {qid: qid,qanswer:qanswer},
            headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },dataType: 'json',
            beforeSend: function () { 
                
            },
            success: function (result) {				
                if (result) {  
				    console.log(result.message);					
                    //$('.loader_data').html('');

                }else{                    
					console.log('something went wrong!');
                }

            },
            error: function (result) {
				console.log('something went wrong!');
            }

        });
   
   });

});

</script>

    </body>

</html>