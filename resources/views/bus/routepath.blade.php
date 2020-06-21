<?php 
//print_r($bustype);die;
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
            <h4>Bording - Dropoff Point - {{$array->fromcity_name}} <span class="icon-arrow-long-right"></span> {{$array->tocity_name}} <span style="font-size:14px;">({{CoachName($array->bus_type)}})</span></h4>
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
        <li class="active"><a href="{{url('routepath/'.$id)}}"> Bording - Dropoff Point</a></li>
         <li><a href="{{url('ratecard/'.$id)}}"> Rate Card</a></li>
         <li><a href="{{url('cancellation/'.$id)}}" >Cancellation</a></li>
        <li><a href="{{url('customizerate/'.$id)}}">Customize Rate</a></li>
        @endif
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="contacts">
        	{!! Form::model($array, array('action' => array('FrontController@routepath',$id), 'files'=>true, 'method' => 'POST', 'id' => 'routepath')) !!}
            <div class="form-group">
              <div class="row gutter">
				<div class="tab">
				@if ($RouteserviceList)
					@foreach($RouteserviceList as $k=>$val)
				  <button type="button" class="tablinks open_{{$val->city_id}}" onclick="openCity(event, '{{$val->city_id}}','{{$id}}')" id="defaultOpen">{{$val->city_name}}</button>
					@endforeach
				@endif
				  <button type="button" data-toggle="modal" data-target="#modalForm">Add More Service</button>
				</div>
					<div id="ac_1" class="tabcontent">
					  <p class="value">Please add city</p>
					</div>

					<!--<div id="2" class="tabcontent">
					  <h3>Paris</h3>
					  <p>Paris is the capital of France.</p> 
					</div>

					<div id="3" class="tabcontent">
					  <h3>Tokyo</h3>
					  <p>Tokyo is the capital of Japan.</p>
					</div>
					<div id="4" class="tabcontent">
					  <h3>Tokyo</h3>
					  <p>Tokyo is the capital of Japan.</p>
					</div>-->
                
                
                
                
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
				<h4 class="modal-title" id="modalForm">More Service</h4>
			</div>
			<div class="modal-body">
				{!! Form::model(null, array('action' => array('FrontController@addservice',$id),'files'=>true, 'method' => 'POST', 'id' => 'addservice')) !!}
					<div class="form-group">
						<label class="control-label">City Name:</label>
						{!! Form::text('tocity_name',null,['class' => 'form-control','placeholder' => 'Type city', 'id' => 'tocity']) !!}
						{!! Form::hidden('tocity_id',null,['class' => 'form-control','id' => 'tocity_id']) !!}
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-info addservice">Add</button>
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
function openCity(evt, cityId, id) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
	$('#ac_'+cityId).css("display", "block");
	//console.log(cityId);
    /* for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    } */
    /* tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    } */
	$('.tablinks').removeClass('active');
	$('#'+cityId).css("display", "block");
	$(evt.target).addClass('active');
    //document.getElementById(cityId).style.display = "block";
    //evt.currentTarget.className += " active";
	var _token = "{{ csrf_token() }}";
	$.ajax({
		url:'<?=url('bordingdropoff')?>',
		type:'POST',
		data:{id:id, cityId:cityId, _token: _token},
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

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

</script>
     
</body>
</html>