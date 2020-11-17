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

      <h1 class="heading" style=""><u>PUBLIC CENTRAL SCHOOL</u> </h1>
      <h2 class="" style="text-align:center"> <u>NH-322, GANDHI CHOWK, KHALISPUR, DIST-SAMASTIPUR(BIHAR)</u> </h2>
      <h3 class="" style="text-align:center"> AFFILIATION NO-330396 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SCHOOL CODE-65379 </h3>
       <h2 class="" style="text-align:center"><u> EXAM NAME: <?php echo $QuizGroupData->quiz_group_title;?> </u></h2>
	  
	  <form method="get" action="{{url('resultlistbygroup/'.$id)}}">
	   <div class="form-group">
				<label class="col-sm-2 control-label no-padding-right" for="admission_no"> Enter Admission No. </label>
				<div class="col-sm-10">
					<input type="text" class="col-xs-10 col-sm-5" id="admission_no" name="admission_no" value="<?php if(isset($admission_no) && $admission_no<>''){ echo $admission_no;}?>">
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
							
		$ssc_full_marks = DashboardController::find_quiz_full_marks($id,5);
		$evs_full_marks = DashboardController::find_quiz_full_marks($id,26);
							
	?>
	  <table id="groupresult-table" class="table table-striped table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Eng.</th>
                                <th>Hindi</th>
                                <th>Math</th>
                                <th>Sc.</th>
								
								<?php if($ssc_full_marks>0){?>
								<th>S.SC.</th>
								<?php }else{?>
								<th>EVS</th>
								<?php }?>
                                         
                               
                                

                            </tr>

                             </thead>

                        <tbody>
                           
								
							<tr>
                           
                            <td><b>Full Marks</b> </td>
                            <td><?php echo DashboardController::find_quiz_full_marks($id,2);?></td>
                            <td><?php echo DashboardController::find_quiz_full_marks($id,1);?></td>
							<td><?php echo DashboardController::find_quiz_full_marks($id,3);?></td>
							<td><?php echo DashboardController::find_quiz_full_marks($id,4);?></td>
							
							<?php if($ssc_full_marks>0){?>
							<td><?php echo $ssc_full_marks;?></td>
							<?php }else{?>
							<td><?php echo $evs_full_marks;?></td>
                            <?php }?>
                            
							</tr>							
								

                            <tr>
                           
                            <td><b>Marks Obtained</b> </td>
                            <td><?php echo DashboardController::find_quiz_score($StudentmasterData->id,$id,2);?></td>
                            <td><?php echo DashboardController::find_quiz_score($StudentmasterData->id,$id,1);?></td>
							<td><?php echo DashboardController::find_quiz_score($StudentmasterData->id,$id,3);?></td>
							<td><?php echo DashboardController::find_quiz_score($StudentmasterData->id,$id,4);?></td>
							
							<?php 
							
							if($ssc_full_marks>0){?>
							<td><?php echo DashboardController::find_quiz_score($StudentmasterData->id,$id,5);?></td>
							<?php }else{?>
							<td><?php echo DashboardController::find_quiz_score($StudentmasterData->id,$id,26);?></td>
                             <?php }?>
                            
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