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
      <div class="col-md-4 mb-md-0 mb-5">
	  
	  
	  
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
									<td><?php echo $quiz_details['quiz_max_time']; ?> Minutes</td>
								</tr>
								
								<tr class="footableOdd">								
									<td class="text-right">No. Of Question:</td>
									<td><?php echo $quiz_details['quiz_total_question']; ?></td>
								</tr>
								
							</tbody>
						</table>
	 
	  
          <form id="quiz-form" name="quiz-form" action="{{url('startquiz')}}" method="POST" autocomplete="off">
            {{csrf_field()}}
              
			<input type="hidden" name="quizid" value="<?php echo $quiz_details['id']; ?>" />
			
			
			<div class="col-md-2">
				<input class="btn btn-primary" type="submit" name="submit" value="Start" />
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