<?php 
//echo '<pre>';print_r($Ratecard);
$validfrom = (isset($Ratecard[0]) && !is_null($Ratecard[0]->validfrom)?date('d-m-Y',strtotime($Ratecard[0]->validfrom)):'');
$validto = (isset($Ratecard[0]) && !is_null($Ratecard[0]->validto)?date('d-m-Y',strtotime($Ratecard[0]->validto)):'');
$getcurrency = (isset($Ratecard[0]) && !empty($Ratecard)?$Ratecard[0]->currency:'');
$getweekdays = (isset($Ratecard[0]) && !empty($Ratecard)?$Ratecard[0]->weekdays:'');

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
            <h4>Rate Card - {{$array->fromcity_name}} <span class="icon-arrow-long-right"></span> {{$array->tocity_name}} <span style="font-size:14px;">({{CoachName($array->bus_type)}})</span></h4>
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
        <li class="active"><a href="{{url('ratecard/'.$id)}}"> Rate Card</a></li>
        <li><a href="{{url('cancellation/'.$id)}}" >Cancellation</a></li>
        <li><a href="{{url('customizerate/'.$id)}}">Customize Rate</a></li>
        @endif
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="contacts">
        	{!! Form::model($array, array('action' => array('FrontController@ratecard',$id), 'files'=>true, 'method' => 'POST', 'id' => 'ratecard', 'class'=>'ratecard','autocomplete' => 'off')) !!}
            <div class="form-group">
				<div class="row gutter">
					<div class="col-md-2">
						<label class="control-label">Valid From</label>
						<input type="text" value="{{$validfrom}}" placeholder="dd-mm-yyyy" name="from" id="from" class="form-control" name="director">
					</div>
					<div class="col-md-2">
						<label class="control-label">Valid To</label>
						<input type="text" value="{{$validto}}" placeholder="dd-mm-yyyy" name="to" id="to" class="form-control" name="writer">
					</div>
					<div class="col-md-2">
						<label class="control-label">Currency</label>
						{!! Form::select('currency', $currency, $getcurrency, ['class'=>'form-control ','placeholder' => '--Select--']) !!}
					</div>
					<div class="col-md-6">
					<?php $arrWeekend = getWeekend(); ?>
						<label class="control-label">Weekend</label>
						<div class="form-group no-margin">
							<?php
								if($arrWeekend){
									foreach($arrWeekend as $key=>$week){
										$checked = '';
										if(isset($getweekdays)){
											if(in_array($key,explode(',',$getweekdays))){$checked = 'checked';}
										}else{
											if(in_array($key,array('Sat','Sun'))){$checked = 'checked';}
										}
										//print_r($key);
							?>
							<div class="checkbox checkbox-inline">
							  <input type="checkbox" class="weekend" id="<?=$key?>" name="weekend[]" <?=$checked?> value="<?=$key?>">
							  <label for="<?=$key?>"><?=$week?></label>
							</div>
							
							<?php } } ?>
							
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
              <div class="row gutter">
				  <div class="col-md-8">
					<div class="value"></div>
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
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closepopup()"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalForm">More Routes</h4>
			</div>
			<div class="modal-body">
				{!! Form::model(null, array('action' => array('FrontController@ratecardrouteservice',$id),'files'=>true, 'method' => 'POST', 'id' => 'ratecardrouteservice', 'autocomplete' => 'off')) !!}
					<input type="hidden" name="routepathId" id="routepathId" value="{{$id}}" class="form-control">
					<div class="form-group">
					<div class="row gutter">
					<div class="col-md-6">
						<label class="control-label">From City:</label>
						{!! Form::text('fromcity',null,['class' => 'form-control','placeholder' => 'Type city', 'id' => 'fromcity']) !!}
						{!! Form::hidden('fromcity_id',null,['class' => 'form-control','id' => 'fromcity_id']) !!}
					</div>
					<div class="col-md-6">
						<label class="control-label">To City:</label>
						{!! Form::text('tocity_name',null,['class' => 'form-control','placeholder' => 'Type city', 'id' => 'tocity']) !!}
						{!! Form::hidden('tocity_id',null,['class' => 'form-control','id' => 'tocity_id']) !!}
					</div>
					</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-info ratecardrouteservice">Add</button>
			</div>
		</div>
	</div>
</div>
@include('includes.copy_right')
@show

@include('includes.js_common_part')
@show 
<script>
$(document).ready(function(){
	$('.newcoach').click(function(){
		var page = $(this).attr("pg");
		
	});
	
	
});
function closepopup() {
    $("#modalForm").hide();
}
</script>

<script>
function ratecardservice() {
    var id = "{{$id}}";
	var _token = "{{ csrf_token() }}";
	$.ajax({
		url:'<?=url('ratecardservice')?>',
		type:'POST',
		data:{id:id, _token: _token},
		dataType:'html',
		success:function(result){
			$('.value').html(result);
		},
		error:function(result){
			alert('Opps something wrong!!');return false;
		}
	});
	$('.value').html('<div class="loading-k"></div>');
}
ratecardservice();


</script>
     
</body>
</html>