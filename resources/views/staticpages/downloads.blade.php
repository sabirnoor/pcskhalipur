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

        Downloads<br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  
	  <div class="clearfix"></div>
	  
      <table class="responsive" width="100%">

                      <tr>

                        <!-- <th class="heading-tabl">Download Class Wise </th> -->

                        <th class="heading-tabl">Form Name</th>

                        <!-- <th class="heading-tabl">View </th> -->

                        <th class="heading-tabl" style="text-align:right;">Download <span class="caret"></span></th>

   

                      </tr>

                      <tr>
                        <td>Admission Form</td>
                        <td align="right"><a href="{{url('public/assets/download_pdf/admission.pdf')}}" target="_blank" class="fa fa-download btn btn-primary right"></a></td>
                      </tr>
					  <tr>
                        <td>Hostel Form</td>
                        <td align="right"><a href="{{url('public/assets/download_pdf/hostal.pdf')}}" target="_blank" class="fa fa-download btn btn-primary right"></a></td>
                      </tr>
					  <tr>
                        <td>Bus Facility Form</td>
                        <td align="right"><a href="{{url('public/assets/download_pdf/busfacility.pdf')}}" target="_blank" class="fa fa-download btn btn-primary right"></a></td>
                      </tr>
					  <tr>
                        <td>Teachers Application Form</td>
                        <td align="right"><a href="{{url('public/assets/download_pdf/teachers.pdf')}}" target="_blank" class="fa fa-download btn btn-primary right"></a></td>
                      </tr>
					  <tr>
                        <td>Franchise Agreement Form</td>
                        <td align="right"><a href="{{url('public/assets/download_pdf/FranchiseAgreementForm.docx')}}" target="_blank" class="fa fa-download btn btn-primary right"></a></td>
                      </tr>
                    </table>
					<p>&nbsp;</p>

    
    </div>

    <div class="col-sm-3">

      <div class="col-md-12" style="padding:0;">
			@include('includes.latest_news')
			@show
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