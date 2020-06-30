<?php // pr($Syllabusmaster); ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        @include('includes.css_part')
        @show
        <style>
            table { background: #ffffff; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; margin:0; border: 1px solid #ddd;  }
.heading-tabl { background: #444;  color:#fff; font-weight:600; border:1px solid #333!important; padding:10px }
	.responsivedash { background: #fff; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; margin: 0 0 0px !important; border:1px solid #ddd!important;  }
	
	table thead, table tfoot { background: #f5f5f5; }
	table thead tr th,
	table tfoot tr th,
	table tbody tr td,
	table tr td,
	table tfoot tr td { font-size: 12px; line-height:24px; text-align: left; font-weight:300; color:#444; }
	table thead tr th,
	table tfoot tr td { padding:10px !important; font-size: 14px; font-weight: bold; color: #8a8a8a; ba }
	table thead tr th:first-child, table tfoot tr td:first-child { border-left: none; }
	table thead tr th:last-child, table tfoot tr td:last-child { border-right: none; }

	table tbody tr.even,
	table tbody tr.alt { background: #f9f9f9; }
	table tbody tr:nth-child(odd) { background: #f2dede; }
	.responsivedash tbody tr:nth-child(odd) { background: #ffffff!important; }
	.responsivedash tbody tr { border-top: 1px solid #e0e2e3!important; }
	table tbody tr td { color: #333; padding: 7px 10px; vertical-align: top; border: 1px solid #d1d1d1; font-size:14px;}
	
	.grayBorderdashboard div.table-wrapper {
    border-right: 1px solid #e0e2e3;
    margin-bottom: 0px!important;
    overflow: hidden;
    position: relative;
}

/* -------------------------------------------------- 
	:: Misc
---------------------------------------------------*/
	.left        { float: left; }
	.right       { float: right; }
	.text-left   { text-align: left; }
	.text-right  { text-align: right; }
	.text-center { text-align: center; }
	.hide        { display: none; }
	.highlight   { background: #ff0; }
	
        </style>
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

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->

            <ol class="carousel-indicators">
                <?php
                if ($UploadflashList) {
                    foreach ($UploadflashList as $k => $val) {
                        ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?= $k ?>" class="<?= ($k == 0) ? 'active' : '' ?>"></li>
                        <?php
                    }
                }
                ?>
                <!--<li data-target="#carousel-example-generic" data-slide-to="1"></li>-->

            </ol>



            <!-- Wrapper for slides -->

            <div class="carousel-inner" role="listbox">
                <?php
                if ($UploadflashList) {
                    foreach ($UploadflashList as $k => $val) {
                        ?>
                        <div class="item <?= ($k == 0) ? 'active' : '' ?>">
                            <img src="{{img_src_path()}}uploadflash/{{$val['images']}}" alt="...">
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
            <!-- Controls -->

            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div><!-- /.carousel -->





        <!-- notice board -->

        <div class="notice-board">

            <div class="container">

                <h1 class="heading">NOTICE 

                    BOARD</h1>

                <div class="slide-area">
                    <!-- Carousel================================================== -->
                    <div id="notice" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php if ($Noticeboard) {
                                foreach ($Noticeboard as $k => $val) { ?>
                                    <div class="item <?php if ($k == 0) {
                                        echo 'active';
                                    } ?>">
                                        <h3><span>Date on: <?= date('d-M-Y', strtotime($val['noticedate'])) ?></span><?= trim($val['title']) ?></h3>
                                    </div>
    <?php }
} ?>
                            <!--<div class="item">
                                <h3><span>Updated on: 3th Apr, 2016</span>Nullam quis ex iaculis, blandit tellus in, tincidunt justo. Ut ex arcu.</h3>
                            </div>
                            <div class="item">
                                <h3><span>Updated on: 4th Apr, 2016</span>Nullam quis ex iaculis, blandit tellus in, tincidunt justo. Ut ex arcu.</h3>
                            </div>
                            <div class="item">
                                <h3><span>Updated on: 5th Apr, 2016</span>Nullam quis ex iaculis, blandit tellus in, tincidunt justo. Ut ex arcu.</h3>
                            </div>-->
                        </div>

                        <a class="left carousel-control" href="#notice" role="button" data-slide="prev">

                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>

                            <span class="sr-only">Previous</span>

                        </a>

                    </div><!-- /.carousel -->

                </div>

            </div>

            <a href="#" class="add-notice"><img src="{{asset('public/assets/img/add.png')}}"></a>

        </div>

        <!-- notice board -->

        <div class="pencil-bg">

            <div class="container marketing">

                <!-- START THE FEATURETTES -->





                <div class="row featurette welcome">

                    <div class="col-md-6">

                        <img class="featurette-image img-responsive center-block" alt="" src="{{asset('public/assets/img/merry.jpg')}}">

                    </div>

                    <div class="col-md-6">

                        <h2><i>Welcome</i> Public Central School</h2>

                        <p class="lead">The Public Central School had been started far from the madding crowd in the year 2007 by the young, dynamic, innovative, successful professionals, educationists & energetic entrepreneurs on the demand of the people of this locality with an aim to impart proper education to the children. In fact education is that which helps an individual to blossom completely, The Public Central School is our heartiest tributes to those prominent persons whose names are the identity of our society. The Public Central School had been nothing more than a "Good Idea". We are trying our best to originate moral, cultural, National and spiritual values in our students. We impart education "TO BUILD" and education "TO PAY".</p>

                        <a href="{{url('about')}}" class="btn btn-primary pull-right">Read More..</a>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="principle-msg">

                            <div class="side">

                                <img src="{{asset('public/assets/img/principle.jpg')}}" alt="" title="">

                            </div>

                            <div class="side">

                                <h3>PRINCIPAL MESSAGE</h3>

                                <p>As a principal I owe certain obligatory responsibility to students, parents teachers and the school as a whole with my varied experiences I wish to express my views on education.</p>
                                <p>In my opinion Education is a sincere and disciplined endeavor to link the mind with the self. That is why the motto of the school is &ldquo;Sa Vidya...</p>

                                <a href="{{url('principal-desk')}}" class="btn btn-default pull-right">Read More..</a>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="birthday">
                            <div class="text-center">
                                <img src="{{asset('public/assets/img/Great-Feedback.png')}}" height="180" alt="">
                            </div>
                            <div class="clearfix"></div>
                            <div class="slide-area">
                                <!-- Carousel
                                ================================================== -->
                                <div id="birthday" class="carousel slide" data-ride="carousel">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                            <?php if ($Feedback) {
                                                foreach ($Feedback as $k => $val) { ?>
                                                <div class="item <?php if ($k == 0) {
                                                        echo 'active';
                                                    } ?>">
                                                        <img src="{{asset('public/assets/img/birthday-girl-no.png')}}" alt="">
                                                    <div class="detail">
                                                        <h4>{{$val->student_name}} <span>{{$val->comments}}</span></h4>
														
														<span>{{$val->suggestion}}</span>
                                                    </div>
                                                </div>
    <?php }
} ?>
                                        <!--<div class="item">
                                              <img src="{{asset('public/assets/img/birthday-girl.jpg')}}" alt="">
                                              <div class="detail">
                                                 <h4>GEETA BISWAS<span>BIRTHDAY : 15th, Jan</span><span>CLASS : 6th A</span></h4>
                                              </div>
                                        </div>
                                        <div class="item">
                                              <img src="{{asset('public/assets/img/birthday-girl.jpg')}}" alt="">
                                              <div class="detail">
                                                 <h4>GEETA BISWAS<span>BIRTHDAY : 15th, Jan</span><span>CLASS : 6th A</span></h4>
                                              </div>
                                        </div>-->
                                    </div>
                                    <a class="left carousel-control" href="#birthday" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#birthday" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">next</span>
                                    </a>
                                </div>
                                <!-- /.carousel -->
                            </div>
                            <!-- <a href="birthday.html" class="btn btn-default pull-right"><i>View All</i></a> -->
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-6">

                        <div class="gallery">

                            <div class="header-p">

                                <h4>LATEST</h4>

                                <h3>PHOTO GALLERY</h3>

                                <a href="{{url('photo-gallery')}}">View All</a>

                            </div>

                            <ul class="img-sec" id="lightgallery">
<?php if ($Uploadgallery) {
    foreach ($Uploadgallery as $gallery) { ?>
                                        <li data-responsive="{{img_src_path()}}uploadgallery/{{$gallery['images']}} 375, {{img_src_path()}}uploadgallery/{{$gallery['images']}} 480, {{img_src_path()}}uploadgallery/{{$gallery['images']}} 800" data-src="{{img_src_path()}}uploadgallery/{{$gallery['images']}}" data-sub-html=''><a href=""><img src="{{img_src_path()}}uploadgallery/{{$gallery['images']}}" alt=""></a></li>
    <?php }
} ?>
                                <!--<li data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="{{asset('public/assets/img/ga2-b.jpg')}}" data-sub-html=''><a href=""><img src="{{asset('public/assets/img/ga2.jpg')}}" alt=""></a></li>

                                <li data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="{{asset('public/assets/img/ga3-b.jpg')}}" data-sub-html=''><a href=""><img src="{{asset('public/assets/img/ga3.jpg')}}" alt=""></a></li>

                                <li data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="{{asset('public/assets/img/ga4-b.jpg')}}" data-sub-html=''><a href=""><img src="{{asset('public/assets/img/ga4.jpg')}}" alt=""></a></li>

                                <li data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="{{asset('public/assets/img/ga5-b.jpg')}}" data-sub-html=''><a href=""><img src="{{asset('public/assets/img/ga5.jpg')}}" alt=""></a></li>

                                <li data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="{{asset('public/assets/img/ga6-b.jpg')}}" data-sub-html=''><a href=""><img src="{{asset('public/assets/img/ga6.jpg')}}" alt=""></a></li>-->

                            </ul>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="portal-all">

                            <a href="#" class="port">

                                <img src="{{asset('public/assets/img/globe.png')}}" alt=""><br>

                                PORTAL

                            </a>

                            <a href="#" class="kg">

                                <img src="{{asset('public/assets/img/kg.png')}}" alt=""><br>

                                KG

                            </a>

                            <a href="#" class="alu">

                                <img src="{{asset('public/assets/img/alumini.png')}}" alt=""><br>

                                ALUMINI

                            </a>

                        </div>

                    </div>

                </div>

            </div>



            <!-- FOOTER -->

            <footer>
                @include('includes.footer')
                @show
            </footer>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="text-align: center;">Feedback</h4>
                        </div>
                        <div class="modal-body con-area">
                            <form id="feedback-form" name="feedback-form" action="{{url('feedbackform')}}" method="POST" autocomplete="on">
							{{csrf_field()}}
							  <!--Grid row-->
							  <div class="row">
								  <!--Grid column-->
								  <div class="col-md-6">
									  <div class="md-form mb-0">
										<label for="student_name" class="">Student name <span style="font-size:15px;color: red;">*</span></label></label>
										  <input type="text" id="student_name" name="student_name" class="form-control" value="" autocomplete="off">
										  
									  </div>
								  </div>
								  <!--Grid column-->

								  <!--Grid column-->
								  <div class="col-md-6">
									  <div class="md-form mb-0">
										<label for="Father_Name" class="">Father Name <span style="font-size:15px;color: red;">*</span></label></label>
										  <input type="text" id="Father_Name" name="Father_Name" class="form-control" value="" autocomplete="off">
										  
									  </div>
								  </div>
								  <div class="col-md-6">
									  <div class="md-form mb-0">
										<label for="roll_no_previous" class="">Roll No Previous Class <span style="font-size:15px;color: red;">*</span></label></label>
										  <input type="text" id="roll_no_previous" name="roll_no_previous" class="form-control" value="" autocomplete="off">
									  </div>
								  </div>
								  <div class="col-md-6">
									  <div class="md-form mb-0">
										<label for="present_class" class="">Present Class <span style="font-size:15px;color: red;">*</span></label></label>
										  <input type="text" id="present_class" name="present_class" class="form-control" value="" autocomplete="off">
									  </div>
								  </div>
								  <div class="col-md-6">
									  <div class="md-form mb-0">
										<label for="contact_no" class="">Contact No <span style="font-size:15px;color: red;">*</span></label></label>
										  <input type="text" id="contact_no" name="contact_no" class="form-control numbers" maxlength="10" value="" autocomplete="off">
									  </div>
								  </div>
								  <div class="col-md-6">
									  <div class="md-form mb-0">
										<label for="whatsapp_no" class="">Whatsapp No <span style="font-size:15px;color: red;">*</span></label></label>
										  <input type="text" id="whatsapp_no" name="whatsapp_no"  class="form-control numbers" maxlength="10" value="" autocomplete="off">
									  </div>
								  </div>
								  <div class="col-md-12">
									  <div class="md-form mb-0">
										<label for="email" class="">On Online Class (Please tick) <span style="font-size:15px;color: red;">*</span></label></label><br>
										<label class="radio-inline" for="comments-0">
										  <input type="radio" name="comments" id="comments-0" value="Satisfied" checked="checked">
										  Satisfied
										</label> 
										<label class="radio-inline" for="comments-1">
										  <input type="radio" name="comments" id="comments-1" value="Not Satisfied">
										  Not Satisfied
										</label> 
										<label class="radio-inline" for="comments-2">
										  <input type="radio" name="comments" id="comments-2" value="Need Improvement">
										  Need Improvement
										</label> 
										<label class="radio-inline" for="comments-3">
										  <input type="radio" name="comments" id="comments-3" value="Overall Ok">
										  Overall Ok
										</label> 
									  </div>
								  </div>
								  <!--Grid column-->

							  </div>
							  <!--Grid row-->

							  <!--Grid row-->
							  <div class="row">
								  <div class="col-md-12">
									  <div class="md-form mb-0">
										<label for="subject" class="">Any Technical Issue</label>
										<textarea type="text" id="technical_issue" name="technical_issue" rows="2" class="form-control md-textarea"></textarea>
										  
									  </div>
								  </div>
							  </div>
							  <!--Grid row-->

							  <!--Grid row-->
							  <div class="row">

								  <!--Grid column-->
								  <div class="col-md-12">

									  <div class="md-form">
										<label for="message">Your Suggestion <span style="font-size:15px;color: red;">*</span></label>
										  <textarea type="text" id="suggestion" name="suggestion" rows="2" class="form-control md-textarea"></textarea>
										  
									  </div>

								  </div>
							  </div>
							  <!--Grid row-->

						  </form>
						  <div class="status" style="text-align:center;font-size:16px; color:green;"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary submitfeedback" >Submit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>


        </div><!-- /.container -->

        @include('includes.js_part')
        @show
        <script>
            $(window).load(function ()
            {
                $('#myModal').modal('show');
            });
			$('.submitfeedback').on('click', function(event){
        event.preventDefault();
        var student_name = $('#student_name').val();
        if($.trim(student_name) === ''){
          alert('Please enter student name');
          $( "#student_name" ).focus();
          return false;
        }
        var Father_Name = $('#Father_Name').val();
        if($.trim(Father_Name) === ''){
          alert('Please enter father name');
          $( "#Father_Name" ).focus();
          return false;
        }
        var roll_no_previous = $('#roll_no_previous').val();
        if($.trim(roll_no_previous) === ''){
          alert('Please enter roll no previous class');
          $( "#roll_no_previous" ).focus();
          return false;
        }
        var present_class = $('#present_class').val();
        if($.trim(present_class) === ''){
          alert('Please enter present class');
          $( "#present_class" ).focus();
          return false;
        }
        var contact_no = $('#contact_no').val();
        if($.trim(contact_no) === ''){
          alert('Please enter contact no.');
          $( "#contact_no" ).focus();
          return false;
        }
        var whatsapp_no = $('#whatsapp_no').val();
        if($.trim(whatsapp_no) === ''){
          alert('Please enter whatsapp no.');
          $( "#whatsapp_no" ).focus();
          return false;
        }
        var suggestion = $('#suggestion').val();
        if($.trim(suggestion) === ''){
          alert('Please enter your suggestion');
          $( "#suggestion" ).focus();
          return false;
        }
        
        var PostData = $('#feedback-form').serialize();
        $.ajax({
            type: "POST",
            url: $('#feedback-form').attr('action'),
            dataType: 'json',
            data: PostData,
            beforeSend: function() {
                $('.submitfeedback').html('Please wait...');
            },
            success: function(data) {
                if (data.success) {
                  $('#feedback-form').hide();
                  $('.submitdiv').hide();
                  $('.submitfeedback').hide();
                  $('.status').html(data.message);
                  $('.submitfeedback').html('Submit');
                } else {
                    alert(data.message);
                    $('.submitfeedback').html('Submit');
                }
            }
        });
        //$('#feedback-form').submit();
        
      });
        </script>
    </body>

</html>