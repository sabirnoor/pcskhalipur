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

      <div class="col-md-12">
	  <?php if($Uploadgallery){ foreach($Uploadgallery as $val){ ?>
          <div class="col-md-4 ">
            <div class="Photo-GalleryCont"><a href="javascript::void(0);" id="<?=$val->categoryid?>" class="getdetails"><img src="{{img_src_path()}}uploadgallery/{{$val->images}}" alt="" title=""></a>
              <h1><?=$val->categoriesname?></h1>
              <h3>Event Date :<span><?=date('d-M-Y',strtotime($val->event_date))?> </span></h3>
              <h3>Total Photos : <span><?=$val->countTotal?></span> </h3>
              <h3>Description: <span><?=$val->description?></span></h3>
              <p></p>
              <a href="javascript::void(0);" id="<?=$val->categoryid?>" class="getdetails">»Read More</a> </div>
          </div>
	  <?php } } ?>
          

          <!--<div class="col-md-4 ">

            <div class="Photo-GalleryCont"><a href="photo-gallery-detail.html"><img src="{{asset('public/assets/img/ga2.jpg')}}" alt="" title=""></a>
              <h1>Dance Competition - Nursery </h1>
              <h3>Event Date :<span>22nd Apr, 2016 </span></h3>
              <h3>Total Photos : <span>23</span> </h3>
              <h3>Description: <span> Earth Day is an annual event, celebrated..</span></h3>
              <p></p>
              <a href="photo-gallery-detail.html">»Read More</a> </div>

          </div>

          <div class="col-md-4 ">
            <div class="Photo-GalleryCont"><a href="photo-gallery-detail.html"><img src="{{asset('public/assets/img/ga3.jpg')}}" alt="" title=""></a>
              <h1>Dance Competition - Nursery </h1>
              <h3>Event Date :<span>22nd Apr, 2016 </span></h3>
              <h3>Total Photos : <span>23</span> </h3>
              <h3>Description: <span> Earth Day is an annual event, celebrated..</span></h3>
              <p></p>
              <a href="photo_gallery_detail.html">»Read More</a> </div>
          </div>
		  <div class="col-md-4 ">
            <div class="Photo-GalleryCont"><a href="photo-gallery-detail.html"><img src="{{asset('public/assets/img/ga3.jpg')}}" alt="" title=""></a>
              <h1>Dance Competition - Nursery </h1>
              <h3>Event Date :<span>22nd Apr, 2016 </span></h3>
              <h3>Total Photos : <span>23</span> </h3>
              <h3>Description: <span> Earth Day is an annual event, celebrated..</span></h3>
              <p></p>
              <a href="photo_gallery_detail.html">»Read More</a> </div>
          </div>-->
		  
        </div>



      <p>&nbsp;</p>

    
    </div>

    <div class="col-sm-3">
	
	<ul class="side-list">
		<li><a href="#" class="active">Photo Gallery </a></li>
		<li><a href="#">Vedo Gallery </a></li>
    </ul>

      <div class="col-md-12" style="padding:0;">
			@include('includes.latest_news')
			@show
		</div>

  <div class="clearfix">&nbsp;</div>
  </div>
   <div class="clearfix">&nbsp;</div>
   
   <form method="post" action="{{url('photo-gallery-detail')}}" id="detailSubmit">
   {{csrf_field()}}
	<input type="hidden" name="galleryid" id="galleryid" >
   </form>
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
		$('.getdetails').on('click', function(){
			var id = $(this).attr('id');
			$('#galleryid').val(id);
			$('#detailSubmit').submit();
			
		});
		</script>

    </body>

</html>