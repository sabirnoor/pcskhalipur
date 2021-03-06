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

        Photo Gallery<br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  
	  <div class="gallery1">
            <ul class="img-sec" id="lightgallery">
			<?php 
			if($Uploadgallery){
				foreach($Uploadgallery as $val){
					
			?>
              <li data-responsive="{{img_src_path()}}uploadgallery/{{$val->images}} 375, {{img_src_path()}}uploadgallery/{{$val->images}} 480, {{img_src_path()}}uploadgallery/{{$val->images}} 800" data-src="{{img_src_path()}}uploadgallery/{{$val->images}}" data-sub-html=''><a href=""><img src="{{img_src_path()}}uploadgallery/{{$val->images}}" alt=""></a></li>
			  <?php 
				}
			}
			  ?>
              
            </ul>
          </div>
		  
      <p>&nbsp;</p>

    
    </div>

    <div class="col-sm-3">
	
	<ul class="side-list">
		<li><a href="{{url('photo-gallery')}}" class="active">Photo Gallery </a></li>
		<li><a href="#">Vedo Gallery </a></li>
    </ul>

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