<?php 
namespace App\Http\Controllers;
//echo '<pre>';print_r($UploadflashList);die; ?>
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

    <div class="col-sm-12 con-area">

      <!--<h1 class="heading" style=""><u>PUBLIC CENTRAL SCHOOL</u> </h1>
      <h2 class="" style="text-align:center"> <u>NH-322, GANDHI CHOWK, KHALISPUR, DIST-SAMASTIPUR(BIHAR)</u> </h2>
      <h3 class="" style="text-align:center"> AFFILIATION NO-330396 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SCHOOL CODE-65379 </h3>-->
	  
	  <h1 class="heading" style=""><u>GYANDEEP PUBLIC SCHOOL</u> </h1>
      <h2 class="" style="text-align:center"> <u>BALKRISHNAPUR, MARWA, P.O. & P.S. - VIDYAPATINAGAR, DIST-SAMASTIPUR(BIHAR)</u> </h2>
	  
       <h2 class="" style="text-align:center"><u> EXAM NAME: <?php echo $QuizGroupData->quiz_group_title;?> </u></h2>
	  
	  <form method="get" action="{{url('resultlistbygroup/'.$id)}}">
	   <div class="form-group">
				<label class="col-sm-2 control-label no-padding-right" for="admission_no"> Enter Admission No. </label>
				<div class="col-sm-3">
					<input type="text" class="col-xs-5 col-sm-5" id="admission_no" name="admission_no" value="<?php if(isset($admission_no) && $admission_no<>''){ echo $admission_no;}?>">
					
				</div>
				<div class="col-sm-2">
					OR					
				</div>
				<label class="col-sm-2 control-label no-padding-right" for="admission_no">  Enter Student ID </label>
				<div class="col-sm-3">
					<input type="text" class="col-xs-5 col-sm-5" id="studentid" name="studentid" value="<?php if(isset($studentid) && $studentid<>''){ echo $studentid;}?>">
					<button type="submit">Submit</button>	
				</div>
			</div>
			
			</form>
			
			<br/><br/>
	  
	   <?php 
		if(isset($StudentmasterData->id) && $StudentmasterData->id>0){
			?>
	  
	  <table id="groupresult-table" class="table table-striped table-bordered table-hover">
			<tr>
				<th>Name</th>
				<td><?php echo $StudentmasterData->student_name;?></td>
				<th>Class</th>
				<td><?php echo $StudentmasterData->present_class;?></td>
				      
				<th>Roll No.</th> 
				<td><?php echo $StudentmasterData->Roll_No;?></td> 
			</tr>
		
	  </table>
	  
	  <?php 
		//Full Marks					
		$eng_full_marks = DashboardController::find_quiz_full_marks($id,2);
		$hindi_full_marks = DashboardController::find_quiz_full_marks($id,1);
		$math_full_marks = DashboardController::find_quiz_full_marks($id,3);
		$science_full_marks = DashboardController::find_quiz_full_marks($id,4);
		
		$ssc_full_marks = DashboardController::find_quiz_full_marks($id,5);
		$evs_full_marks = DashboardController::find_quiz_full_marks($id,26);
		
		// Marks Obtained
		$eng_obtained_marks = DashboardController::find_quiz_score($StudentmasterData->id,$id,2);
		$hindi_obtained_marks = DashboardController::find_quiz_score($StudentmasterData->id,$id,1);
		$math_obtained_marks = DashboardController::find_quiz_score($StudentmasterData->id,$id,3);
		$science_obtained_marks = DashboardController::find_quiz_score($StudentmasterData->id,$id,4);
		
		$ssc_obtained_marks = DashboardController::find_quiz_score($StudentmasterData->id,$id,5);
		$evs_obtained_marks = DashboardController::find_quiz_score($StudentmasterData->id,$id,26);
		
		if($eng_obtained_marks>$eng_full_marks){$eng_obtained_marks = $eng_full_marks;}
		if($hindi_obtained_marks>$hindi_full_marks){$hindi_obtained_marks = $hindi_full_marks;}
		if($math_obtained_marks>$math_full_marks){$math_obtained_marks = $math_full_marks;}
		if($science_obtained_marks>$science_full_marks){$science_obtained_marks = $science_full_marks;}
		if($ssc_obtained_marks>$ssc_full_marks){$ssc_obtained_marks = $ssc_full_marks;}
		if($evs_obtained_marks>$evs_full_marks){$evs_obtained_marks = $evs_full_marks;}
	?>
	  <table id="groupresult-table" class="table table-striped table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Eng.</th>
                                <th>Hindi</th>
                                <th>Math</th>
                                <!--<th>Sc.</th>-->
								<th>EVS</th>
                            </tr>
                        </thead>

                        <tbody>
                           
								
							<tr>
                           
                            <td><b>Full Marks</b> </td>
                            <td><?php echo $eng_full_marks;?></td>
                            <td><?php echo $hindi_full_marks;?></td>
							<td><?php echo $math_full_marks;?></td>
							<!--<td>< ?php echo $science_full_marks;?></td>-->							
							
							<td><?php echo $evs_full_marks;?></td>
                            
                            
							</tr>							
								
                            <tr>
                           
                            <td><b>Marks Obtained</b> </td>
                            <td><?php echo $eng_obtained_marks;?></td>
                            <td><?php echo $hindi_obtained_marks;?></td>
							<td><?php echo $math_obtained_marks;?></td>
							<!--<td>< ?php echo $science_obtained_marks;?></td>-->
														
							<td><?php echo $evs_obtained_marks;?></td>
                             
                            
							</tr>
								
                        </tbody>

                       

                   </table>  
	  <?php }else{ if(isset($admission_no) && $admission_no<>''){ echo '<div class="text-danger">No records found.</div>';} }?>
								
		
	  
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
    

    </body>

</html>