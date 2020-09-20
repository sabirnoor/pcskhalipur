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

        Schedule<br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>

      <div class="panel-group" id="accordion">
<?php 
	if($Schedulemaster){
		foreach($Schedulemaster as $k=>$val){
?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_<?=$k?>">
		<h4 class="panel-title">
            <i class="fa fa-plus"></i> <?=$val['SC']->name?>
        </h4>
		</a>
      </div>
      <div id="collapseOne_<?=$k?>" class="panel-collapse collapse <?=($k==0)?'in':''?>">
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
						if($val['SM']){
							foreach($val['SM'] as $ke=>$value){
					  ?>
                      <tr>
                        <td><?=$value->name?></td>
                        <td align="right"><a href="{{img_src_path()}}schedule/{{$value->filesname}}" target="_blank" class="fa fa-download btn btn-primary right"></a></td>
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
	}	?>
    
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