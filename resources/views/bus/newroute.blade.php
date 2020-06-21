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
            <h4>New Route - {{!empty($array->fromcity_name)?$array->fromcity_name:''}} <span class="icon-arrow-long-right"></span> {{!empty($array->tocity_name)?$array->tocity_name:''}}</h4>
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
        <li class="active"><a href="{{url('newroute/'.$id)}}" id="coachinfo"> Route Info </a></li>
        <li><a href="{{url('routepath/'.$id)}}"> Bording - Dropoff Point</a></li>
         <li><a href="{{url('ratecard/'.$id)}}"> Rate Card</a></li>
         <li><a href="{{url('cancellation/'.$id)}}" >Cancellation</a></li>
        <li><a href="{{url('customizerate/'.$id)}}">Customize Rate</a></li>
        @endif
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="contacts">
        	{!! Form::model($array, array('action' => array('FrontController@newroute',$id), 'files'=>true, 'method' => 'POST', 'id' => 'newcoach')) !!}
            <div class="form-group">
              <div class="row gutter">
                <div class="col-md-4">
                  <label class="control-label">Service Name/No.</label>
                  {!! Form::text('service_name',null,['class' => 'form-control','placeholder' => 'Service Name/No.']) !!}
                </div>
                <div class="col-md-4">
                  <label class="control-label">Travels Name</label>
                  {!! Form::text('travels_name',$operator_company,['class' => 'form-control','readonly'=>'readonly','placeholder' => 'Travels Name']) !!}
                </div>
                <div class="col-md-4">	
                  <label class="control-label">Coach Type/Name</label>
                  <select class="form-control" name="bus_type">
                    <option value="">--Select--</option>
                    @if ($CoachList)
						@foreach($CoachList as $k=>$val)
                    <option value="{{$val->id}}" <?=(!empty($array->bus_type) && $array->bus_type == $val->id)?'selected':''?>>{{$val->name}} - {{$val->vehicle}} {{$val->isac}} {{$val->bus_type}} ({{$val->layout_type}})</option>
                    @endforeach
					@endif	
                  </select>
                 
                </div>
                
              </div>
            </div>
            <div class="form-group">
              <div class="row gutter">
                <div class="col-md-4">
                  <label class="control-label">From City</label>
                  {!! Form::text('fromcity_name',null,['class' => 'form-control','placeholder' => 'Type from city', 'id' => 'fromcity']) !!}
					{!! Form::hidden('fromcity_id',null,['class' => 'form-control','id' => 'fromcity_id']) !!}
                </div>
                <div class="col-md-4">
                  <label class="control-label">To City</label>
                  {!! Form::text('tocity_name',null,['class' => 'form-control','placeholder' => 'Type to city', 'id' => 'tocity']) !!}
					{!! Form::hidden('tocity_id',null,['class' => 'form-control','id' => 'tocity_id']) !!}
                </div>
                <div class="col-md-4">
                  <label class="control-label">Bus Facilities</label>
                  <div class="form-group no-margin">
                        <div class="checkbox checkbox-inline">
                        {{ Form::checkbox('bus_tv', 1, null, ['class' => 'field', 'id' => 'bus_tv']) }}
                          <!--<input type="checkbox" id="bus_tv" name="bus_tv" value="1" />-->
                          <label for="bus_tv">Tv</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                        {{ Form::checkbox('bus_charging', 1, null, ['class' => 'field', 'id' => 'bus_charging']) }}
                          <label for="bus_charging">Charging Point</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                        {{ Form::checkbox('bus_waterbottle', 1, null, ['class' => 'field', 'id' => 'bus_waterbottle']) }}
                          <label for="bus_waterbottle">Water Bottle</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                        {{ Form::checkbox('bus_wifi', 1, null, ['class' => 'field', 'id' => 'bus_wifi']) }}
                          <label for="bus_wifi">Wifi</label>
                        </div>
                        <div class="checkbox checkbox-inline">
                          {{ Form::checkbox('bus_mticket', 1, null, ['class' => 'field', 'id' => 'bus_mticket']) }}
                          <label for="bus_mticket">M-ticket</label>
                        </div>
                    </div>
                </div>
                
              </div>
            </div>
            
            <div class="form-group no-margin">
              <div class="row gutter">
                <div class="col-lg-offset-6 pull-right">
                  <button type="submit" class="btn btn-success">Save & Next</button>
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
		$(document).ready(function(){
			$('.newcoach').click(function(){
				var page = $(this).attr("pg");
				
			});
			
			
		});
		</script>
</body>
</html>