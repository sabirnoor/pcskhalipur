<?php 
$action = Request::segment(1);
?>
<nav class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand peShiner desktop-logo" href="/">
				<canvas ></canvas>
				<img src="{{asset('public/assets/img/logo.png')}}" alt="logo" title="">
			</a>
			<a class="navbar-brand mobile-logo" href="/">
				<img src="{{asset('public/assets/img/logo.png')}}" alt="logo" title="">
			</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right top-ico-ul">
				<li><a href="#" class="in-circle"><i class="fa fa-apple"></i></a></li>
				<li><a href="#" class="in-circle"><i class="fa fa-android"></i></a></li>
				<li><a href="#" class="in-circle"><i class="fa fa-windows"></i></a></li>
				<li class="devider"></li>
				<li><a href="#" class="rs-icon"><i class="fa fa-envelope"></i></a></li>
				<li><a href="#" class="rs-icon"><i class="fa fa-map-marker"></i><!-- <img src="img/map-mark.png"> --></a></li>
				<li><a href="#" class="rs-icon"><i class="fa fa-pencil"></i></a></li>
				<li><a href="#" class="rs-icon"><i class="fa fa-sitemap"></i></a></li>

			</ul>

			<div class="clearfix"></div>
			<ul class="nav navbar-nav main-nav">
				<li class="<?php if(!$action){echo 'active';} ?>"><a href="/" class="<?php if(!$action){echo 'active';} ?>">Home</a></li>
				<?php //if($action) ?>
				<li class="dropdown"><a href="#" class="dropdown-toggle <?php if($action=='about' || $action=='events' || $action=='news-paper' || $action=='our-motto' || $action=='directors-desk'){echo 'active';} ?>" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us  <span class="caret"></span></a>
					<ul class="dropdown-menu drop-m">
						<li><a href="{{url('about')}}">About Us</a></li>
						<li><a href="{{url('our-motto')}}">Our Motto</a></li>
						<li><a href="{{url('directors-desk')}}">Director's Desk</a></li>
						<li><a href="{{url('events')}}">Events</a></li>
						<li><a href="{{url('news-paper')}}">News Paper</a></li>
					</ul>
				</li>

				<li><a href="{{url('academics')}}" class="<?php if($action=='academics'){echo 'active';} ?>">Academics </a>   </li>
				<li><a href="{{url('school-profile')}}" class="<?php if($action=='school-profile'){echo 'active';} ?>">School Profile</a></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle <?php if($action=='Syllabus'){echo 'active';} ?>" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Student Corner<span class="caret"></span></a>
               <ul class="dropdown-menu drop-m">
                  <li><a href="{{url('Syllabus')}}">Syllabus</a></li>
                    <li><a href="/">Sample Paper</a></li>
                    <li><a href="/">Routine</a></li>
                  </ul>
               </li>
			   <li class="dropdown active drop-menu-mob">
					<a href="academics.html" data-toggle="dropdown" class="dropdown-toggle">Academics <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="about.html">About Us</a></li>
				<li><a href="our-motto.html">Our Motto</a></li>
				<li><a href="directors-desk.html">Director's Desk</a></li>
				<li><a href="events.html">Events</a></li>
				<li><a href="news-paper.html">News Paper</a></li>
					 
					</ul>
				</li>
				<li><a href="{{url('franchise-enquiry')}}" class="<?php if($action=='franchise-enquiry'){echo 'active';} ?>">Franchise Enquiry</a></li>
				<li><a href="{{url('downloads')}}" class="<?php if($action=='downloads'){echo 'active';} ?>" >Downloads</a></li>
				<li><a href="{{url('mandatory-disclosure')}}" class="<?php if($action=='mandatory-disclosure'){echo 'active';} ?>">Mandatory Disclosure </a></li>                
				<!--<li><a href="contact-us.html">Contact Us</a></li>-->
			</ul>
		</div>
	</div>
</nav>