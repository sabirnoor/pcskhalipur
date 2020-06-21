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

        Contact Us<br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>

      <div>
	 <h4 align="center" style="line-height:24px;">Public Central School</h4>
	 <h5 align="center" style="line-height:24px;">Affiliated to CBSE, New Delhi Aff. No.330396,School No.-50312</h5>
	 <h6 align="center" style="line-height:14px;">N.H. 103, Gandhi Chowk, Khalispur ,Samastipur, Bihar -848505</h6>
	<p></p>


 <div class="clearfix">&nbsp;</div>

  <div class="col-sm-4" align="center"><img alt="phone" src="{{asset('public/assets/img/phone.png')}}"><br>

<strong>Phone No.</strong> 
<br>
06278289301</div>
<div class="col-sm-4" align="center"><img alt="phone" src="{{asset('public/assets/img/email-c.png')}}">

<br>
<strong>Email</strong> 
<br>
<a href="mailto:contact@fatimaconventschool.com ">info@pcskhalispur.com, pcs.khalispur@gmail.com </a>
</div>
<div class="col-sm-4" align="center"><img alt="phone" src="{{asset('public/assets/img/web.png')}}">
<br>
<strong>Website URL</strong> 
<br>
<a target="_blank" href="http://pcskhalispur.com/">pcskhalispur.com</a></div>
<div class="clearfix">&nbsp;</div>
</div>
<div class="clearfix">&nbsp;</div> 
<div class="col-sm-12">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3594.3248472112937!2d85.66795553246408!3d25.726768883652586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ed83904fb31ec3%3A0xd78e9d0b0939f6d7!2sPUBIC+CENTRAL+SCHOOL!5e0!3m2!1sen!2sin!4v1525888639010" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

    
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