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

                        <p class="lead">'Public Central School' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam aliquam sed est sit amet scelerisque. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis efficitur tempus luctus. Nulla eu dui pretium, consequat sapien vitae, vehicula lorem. Vivamus malesuada a felis non pretium. Cras a mauris in magna auctor pellentesque.Ut commodo sem eget velit feugiat mollis.Proin congue erat a dolor bibendum accumsan.</p>

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
                                <img src="{{asset('public/assets/img/happy-birthday.png')}}" alt="">
                            </div>
                            <div class="clearfix"></div>
                            <div class="slide-area">
                                <!-- Carousel
                                ================================================== -->
                                <div id="birthday" class="carousel slide" data-ride="carousel">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                            <?php if ($Birthday) {
                                                foreach ($Birthday as $k => $val) { ?>
                                                <div class="item <?php if ($k == 0) {
                                                        echo 'active';
                                                    } ?>">
        <?php if (!empty($val['images'])) { ?>
                                                        <img src="{{img_src_path()}}birthday/photo/{{$val['images']}}" alt="<?= $val['title'] ?>">
                                                <?php } else { ?>
                                                        <img src="{{asset('public/assets/img/birthday-girl-no.png')}}" alt="">
        <?php } ?>
                                                    <div class="detail">
                                                        <h4><?= $val['title'] ?><span>BIRTHDAY : <?= date('D M j', strtotime($val['dateofbirth'])) ?></span><span>CLASS : <?= $val['classes'] ?></span></h4>
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
                            <h4 class="modal-title" style="text-align: center;">Covid-19 Not to affect your study</h4>
                        </div>
                        <div class="modal-body con-area">
                            <p>E-Book are now available</p>
                            <div class="panel-group" id="accordion">
                            <?php
                            if ($Syllabusmaster) {
                                foreach ($Syllabusmaster as $k => $val) {
                                    ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_<?= $k ?>">
                                                    <h4 class="panel-title">
                                                        <i class="fa fa-plus"></i> <?= $val['SC']->name ?>
                                                    </h4>
                                                </a>
                                            </div>
                                            <div id="collapseOne_<?= $k ?>" class="panel-collapse collapse <?= ($k == 0) ? 'in' : '' ?>">
                                                <div class="panel-body">
                                                    <div class="panel-body whbg table-responsive nopadding">
                                                        <div class="clearfix"></div>
                                                        <table class="responsive" width="100%">
                                                            <tr>
                                                              <!-- <th class="heading-tabl">Download Class Wise </th> -->
                                                                <th class="heading-tabl">Form Name</th>
                                                                <!-- <th class="heading-tabl">View </th> -->
                                                                <th class="heading-tabl" style="text-align:right;">Download <span class="caret"></span></th>
                                                            </tr>
                                                            <?php
                                                            if ($val['SM']) {
                                                                foreach ($val['SM'] as $ke => $value) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?= $value->name ?></td>
                                                                        <td align="right"><a href="{{img_src_path()}}syllabus/{{$value->filesname}}" target="_blank" class="fa fa-download btn btn-primary right"></a></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </table>
                                                        <p>&nbsp;</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                            <?php
                                        }
                                    }
                                    ?>

                            </div>
                        </div>
                        <div class="modal-footer">
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
        </script>
    </body>

</html>