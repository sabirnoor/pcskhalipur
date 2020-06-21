<?php
//echo '<pre>';print_r($CoachDetails);die;
if($CoachDetails){
	$seat_lower_arr = json_decode($CoachDetails->lower_seat);
	$seat_upper_arr = json_decode($CoachDetails->upper_seat);
}else{
	$seat_lower_arr = array();
	$seat_upper_arr = array();
}
$seat_booked_arr = [];
if($custom_ratecard){
	foreach($custom_ratecard as $k=>$custom){
		$seat_booked_arr[] = $custom->seat_no;
	}
}
//print_r($seat_booked_arr);die;
?>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Tekoffice | B2B and B2C market place" />
	<meta name="keywords" content="B2B and B2C market place, manage hotels, holidays package and flight" />
	<meta name="author" content="Tekoffice" />
	<title>Dashboard</title>
	@include('includes.css_part')
	@show

	<style>


		/* Style the tab */
		div.tab {
			float: left;
			border-left: 1px solid #afc8e3;
			border-top: 1px solid #afc8e3;
			border-bottom: 1px solid #afc8e3;
			background-color: #afc8e3;
			width: 30%;
			min-height: 167px;
		}

		/* Style the buttons inside the tab */
		div.tab button {
			display: block;
			background-color: inherit;
			color: black;
			padding: 7px 16px;
			width: 100%;
			border: none;
			outline: none;
			text-align: left;
			cursor: pointer;
			transition: 0.3s;
			font-size: 17px;
			border-bottom: 2px solid #fff;
		}

		/* Change background color of buttons on hover */
		div.tab button:hover {
			background-color: #ddd;
		}

		/* Create an active/current "tab button" class */
		div.tab button.active {
			background-color: #fff;
		}

		/* Style the tab content */
		.tabcontent {
			float: left;
			padding: 12px 12px;
			border: 0px solid #afc8e3;
			width: 70%;
			border-left: none;
			min-height: 167px;
		}
		
		.bus-entry {
			overflow: hidden;
			clear: both;
			background: #fff none repeat scroll 0 0;
			border-radius: 3px;
			box-shadow: 0 0px #ccc;

		}
		.bus-entry table {
			border-top: solid 0px #CCC;
			border-left: solid 0px #CCC;
		}
		.bus-entry table td {
			padding: 10px 14px;
			font-size:13px;
			border-bottom: solid 0px #CCC;
			border-left: solid 0px #CCC;
			border-right: solid 0px #CCC;
			color:#999;
			
		}

		.create_table {
			overflow: hidden;
		}
		.create_table table {
			border-top: solid 0 #CCC;
			border-left: solid 0px #CCC;
		}
		.create_table table td {
			padding:4px 0px 4px 5px;
			vertical-align: middle;
			border-bottom: solid 0px #CCC;
			border-right: solid 0px #CCC;
		}
		.TableScroll {
			height: 400px;
			display: inline-block;
			overflow: auto;
		}
		
	</style>
</head>

<body>

	<!-- Header starts --> 
	@include('includes.header')
	@show 
	<!-- Header ends --> 

	<!-- Container fluid Starts -->
	<div class="container-fluid"> 

		<!-- Navbar starts --> 
		@include('includes.menu_nav')
		@show 
		<!-- Navbar ends --> 

		<!-- Dashboard wrapper starts -->
		<div class="dashboard-wrapper"> 

			<!-- Top bar starts -->
			<div class="top-bar clearfix">
				<div class="row gutter">
					<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
						<div class="page-title">
							<h4>Customize Rate - {{$array->fromcity_name}} <span class="icon-arrow-long-right"></span> {{$array->tocity_name}} <span style="font-size:14px;">({{CoachName($array->bus_type)}})</span></h4>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
						<ul class="right-stats" id="mini-nav-right">
							<li> <a href="{{url('manageroute')}}" class="btn btn-danger">Manage Route</a> </li>
							<li> <a href="{{url('newroute')}}" class="btn btn-success">Create Route</a> </li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Top bar ends --> 

			<!-- Main container starts -->
			<div class="main-container">
				@if (session('msgerror'))
				<div class="alert alert-danger light no-margin">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon-cross2"></i> {{ session('msgerror') }}
				</div>
				@endif
				@if (session('msgsuccess'))
				<div class="alert alert-success light no-margin">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon-check_circle"></i> {{ session('msgsuccess') }}
				</div>
				@endif

				<ul class="nav nav-tabs tabs-up" id="friends">
					@if(!$id)
					<li class="active"><a href="{{url('newroute')}}" id="coachinfo"> Route Info </a></li>
					@else
					<li><a href="{{url('newroute/'.$id)}}" id="coachinfo"> Route Info </a></li>
					<li><a href="{{url('routepath/'.$id)}}"> Bording - Dropoff Point</a></li>
					<li><a href="{{url('ratecard/'.$id)}}"> Rate Card</a></li>
					<li><a href="{{url('cancellation/'.$id)}}" >Cancellation</a></li>
					<li class="active"><a href="{{url('customizerate/'.$id)}}">Customize Rate</a></li>
					@endif
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="contacts">
						{!! Form::model($array, array('action' => array('FrontController@customizerate',$id), 'files'=>true, 'method' => 'POST', 'id' => 'customratecard', 'class'=>'ratecard','autocomplete' => 'off')) !!}
						<input type="hidden" name="id" value="{{$id}}">
						<input type="hidden" name="TableCount" value="<?php if($custom_ratecard){echo count($custom_ratecard);}?>">
						<div class="form-group">
							<div class="row gutter">
							   <div class="col-md-6 bus-entry">
									<label>LOWER</label>
									<table border="0" cellspacing="0" cellpadding="0" class="no-margin">	
										<?php 
										$c = 0; $skip_array=array();
											for($i=1;$i<=6;$i++){
												echo '<tr>';
												for($j=1;$j<=15;$j++){
													$class=""; $span=""; 
													if(in_array($c,$skip_array)){
															$c++; 
															continue;
													}	
													if(isset($seat_lower_arr[$c+1][0]) && ($seat_lower_arr[$c][0]==$seat_lower_arr[$c+1][0])){

														if(in_array($seat_lower_arr[$c][0],$seat_booked_arr)){
																$class=' class="availableST sleeper-horizontal-booked"';
														}else{
																$class='class="availableST sleeper-horizontal"';
														}				
														$span=' colspan="2"';
														$skip_array[]=$c+1;

													}elseif(isset($seat_lower_arr[$c+15][0]) && ($seat_lower_arr[$c][0]==$seat_lower_arr[$c+15][0])){

														if(in_array($seat_lower_arr[$c][0],$seat_booked_arr)){
																$class=' class="sleeper-vertical-booked"';
														}else{
																$class='class="availableST sleeper-vertical"';
														}				
														$span=' rowspan="2"';
														$skip_array[]=$c+15;

													}else{

														if(in_array($seat_lower_arr[$c][0],$seat_booked_arr)){
																$class=' class="seater-booked"';
														}else{
																$class='class="availableST seater"';
														}
													}
													?>
										<td <?php if(isset($seat_lower_arr[$c][0]) && $seat_lower_arr[$c][0]<>""){ echo $class;echo $span;}?> id="<?=$seat_lower_arr[$c][0]?>" data='<?=$seat_lower_arr[$c][1]?>'><?php echo $seat_lower_arr[$c][0]; ?></td>
													<?php 
													$c++;
												}
												echo '</tr>';
											}
										?>
										
									</table>
									<div class="create_table">
									<label>UPPER</label>
									<table border="0" cellspacing="0" cellpadding="0" class="no-margin">	
										<?php 
										$c = 0; $skip_array=array();
											for($i=1;$i<=6;$i++){
												echo '<tr>';
												for($j=1;$j<=15;$j++){
													$class=""; $span=""; 
													if(in_array($c,$skip_array)){
															$c++; 
															continue;
													}	
													if(isset($seat_upper_arr[$c+1][0]) && ($seat_upper_arr[$c][0]==$seat_upper_arr[$c+1][0])){

														if(in_array($seat_upper_arr[$c][0],$seat_booked_arr)){
																$class=' class="sleeper-horizontal-booked"';
														}else{
																$class='class="availableST sleeper-horizontal"';
														}				
														$span=' colspan="2"';
														$skip_array[]=$c+1;

													}elseif(isset($seat_upper_arr[$c+15][0]) && ($seat_upper_arr[$c][0]==$seat_upper_arr[$c+15][0])){

														if(in_array($seat_upper_arr[$c][0],$seat_booked_arr)){
																$class=' class="sleeper-vertical-booked"';
														}else{
																$class='class="availableST sleeper-vertical"';
														}				
														$span=' rowspan="2"';
														$skip_array[]=$c+15;

													}else{

														if(in_array($seat_upper_arr[$c][0],$seat_booked_arr)){
																$class=' class="seater-booked"';
														}else{
																$class=' class="availableST seater"';
														}
													}
													?>
													<td <?php if(isset($seat_upper_arr[$c][0]) && $seat_upper_arr[$c][0]<>""){ echo $class;echo $span;}?> id="<?=$seat_upper_arr[$c][0]?>" data='<?=$seat_upper_arr[$c][1]?>'><?php echo $seat_upper_arr[$c][0]; ?></td>
													<?php 
													$c++;
												}
												echo '</tr>';
											}
										?>
										
									</table>
									</div>
								</div> 
								
								<div class="col-md-6 create_table TableScroll">
								<?php if(!empty($seat_booked_arr)){ ?>
								<span>
								<table border="0" cellspacing="0" cellpadding="0" id="table1" class="no-margin">
									<tr>
									<td>Seat Number</td>
									<td>Weekdays fare</td>
									<td>Weekend fare</td>
									<td>&nbsp;</td>
									</tr>
									<?php
										foreach($custom_ratecard as $k=>$custom){
									?>
									<tr>
										<td><div class="col-md-12" style="padding-right:2px; padding-left:0px;">
											<input type="text" readonly="readonly" name="seat_no[]" value="<?=$custom->seat_no;?>" id="seat_no" no-special-char ng-model="seat_no" maxlength="30" placeholder="seat no" class="form-control">
										</div></td>
										<td><div class="col-md-12" style="padding-right:2px; padding-left:0px;">
											<input type="text" value="<?=$custom->fare_weekdays;?>" name="rateWeekdays[]" data="wd" maxlength="5" index="<?=$k?>" id="ratewd_<?=$k?>" class="form-control copypaste numericonly">
										</div></td>
										
										<td><div class="col-md-12" style="padding-right:2px; padding-left:0px;">
											<input type="text" value="<?=$custom->fare_weekend;?>" name="rateWeekend[]" data="wk" maxlength="5" index="<?=$k?>" id="ratewk_<?=$k?>" class="form-control copypaste numericonly">
										</div></td>
										<td><div class="col-md-8" style="padding-right:2px; padding-left:0px;">
											<a href="javascript::void(0);" id="<?=$custom->id;?>"><i class="fa fa-trash-o fa-1x"></i></a>
										</div></td>
									</tr>
									<?php
										}
									?>
									
									</table></span>
									<?php 
									}
									?>
									<span id="viewFormSeaterTable"></span>
									
								</div>
							   
							</div>
							
							
							
						</div>

						<div class="form-group no-margin">
							<div class="row gutter">
								<div class="col-lg-offset-6 pull-right">
									<span class="message"></span>
									<button type="submit" class="btn btn-success save">Save</button>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>


			</div>
			<!-- Main container ends --> 

		</div>
		<!-- Dashboard Wrapper End --> 

	</div>
	<!-- Container fluid ends --> 
	
	@include('includes.copy_right')
	@show

	@include('includes.js_common_part')
	@show 
	<script>
		$(document).ready(function () {
			$('.newcoach').click(function () {
				var page = $(this).attr("pg");

			});


		});
		
	</script>

	<script>
		


	</script>

</body>
</html>