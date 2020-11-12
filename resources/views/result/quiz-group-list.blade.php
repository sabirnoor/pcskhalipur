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

    <div class="col-sm-6 con-area">

      <h1 class="heading">

        All Exam

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  
	  <table class="table table-striped table-bordered">
							<thead>
								 <th>Exam</th>
                                <th>Action</th>
							</thead>
							
							<tbody>

                            <?php 
                            if(isset($QuizGroupList)){

                                foreach ($QuizGroupList as $value) {                                 
									$value = (array) $value;
                            ?>

                            <tr id="<?=$value['id']?>">
                            <td><?=$value['quiz_group_title']?> </td>
                            
							
                           
                                <td>
                                    <a href="<?=url('resultlistbygroup/'.$value['id'])?>" title="Result" target="_blank"><i class="ace-icon fa fa-eye fa-2x icon-only"></i></a> 
                                     
                                </td>

							</tr>

                        <?php

                                }

                            }

                        ?>

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