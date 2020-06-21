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

        Principal Message<br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>

      <p>'<strong>Mrs. Kumari Sapna (Principal)</strong>' As a principal I owe certain obligatory responsibility to students, parents teachers and the school as a whole with my varied experiences I wish to express my views on education.</p>

      <p>In my opinion Education is a sincere and disciplined endeavor to link the mind with the self. That is why the motto of the school is &ldquo;Sa Vidya Ya Vimuktaya&rdquo; knowledge for liberation from physical, intellectual and spiritual bondage.</p>
	  <p>Education can be given to the students only when they are inspired through the different methods introduced so far by different educationalists in their areas of abilities and excellence.</p>
<p>Our emphasis is to create congenial atmosphere and creative abilities among the students to receive the best perception of their teachers so as to use them in their real life. We suggest both the students and the teachers to avoid all negative approaches to life rather be affirmative and creative approach of life. A teacher is a symbol of inspiration. So his / her overall personality must be pleasing. The relation between the teacher and a student is not commercial but combined with a thread of love and affection.</p>
<p>In Conclusion, I opine that honesty in individual life is a prime necessity, and we must remain ever vigilant that the darkness of petty self interest does not shroud this supreme human treasure. With extinction of honesty, civilization will not survive, the long Sadhana Of human race will go in vain and all intellectual achievements will become meaningless.</p>

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