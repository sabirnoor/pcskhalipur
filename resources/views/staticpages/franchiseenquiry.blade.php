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

        Franchise Enquiry<br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  <div class="clearfix">&nbsp;</div>
      <p>Public Educational & Welfare Society ,Public Central School has recently decided to franchise some schools. A number of agreements have been signed with some individuals on the pattern of the draft agreement…………</p>
                <h3>INTRODUCTION</h3>
                <p>
Public Educational & Welfare Society was founded by dedicated persons and has been registered under the Indian Societies Registration Act.-1860.<br>
<br>
Society is purely non-profitable, charitable, philanthropic, Non- Govt. Organization formed to provide purposeful and profession aimed education to children from Nursery to College level without any discrimination whatsoever and with a secular outlook in the Country.
<br>
<br>
Its aim is to establish, undertake, maintain and run schools, Educational Institutions, Teachers Training Institutions, Publications of Text, Literary, Scientific & Social books of educational values, Public Relation Institutions, Social, Medical and Cultural Educational Institutions of approved nature in the country. <br>
<br>
SOCIETY RUNS A CONSULTANCY SERVICE FOR ESTABLISHING NEW INSTITUTIONS WITH ANY GOVT. OF INDIA UNDERTAKINGS OR WITH ANY INDIVIDUALS.<br>
<br>
SOCIETY MEMBERS HAVE DISTINGUISHED CAREERS IN THEIR LIVES & ARE ASSOCIATED WITH NUMBER OF SUCH INSITITUTIONS.<br>
<br>
At present the Society is running a number of schools through-out India, mainly located in the states of U.P., Bihar, & Delhi. Most of the schools have been named as Public Central School and are affiliated with the Central Board of Secondary Education, New Delhi. Some schools have also been affiliated to the concerned State Board of Education.<br>
<br>

Society has recently decided to franchise some schools. A number of agreements have been signed with some individuals on the pattern of the draft agreement so given underneath.
</p>
 <p>
<a href="{{url('public/assets/download_pdf/FranchiseAgreementForm.docx')}}" target="_blank" class="btn btn-warning">CLICK HERE TO DOWNLOAD AGREEMENT FORM</a>
</p>
<div class="clearfix"></div>
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