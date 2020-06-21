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
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="page-title">
            <h4>Add/Update Coach</h4>
          </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <ul class="right-stats" id="mini-nav-right">
                <li>
                    <a href="{{url('managecoach')}}" class="btn btn-danger">Manage Coach</a>
                </li>
                <li>
                    <a href="{{url('newcoach')}}" class="btn btn-success">Create Coach</a>
                </li>
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
        <li class="active"><a href="{{url('newcoach')}}" id="coachinfo"> Coach Info </a></li>
        @else
        <li class="active"><a href="{{url('newcoach/'.$id)}}" id="coachinfo"> Coach Info </a></li>
        <li><a href="{{url('seatlayout/'.$id)}}"> Seat Layout</a></li>
        <li><a href="{{url('coachgallery/'.$id)}}"  data-toggle="tabajax">Coach Gallery</a></li>
        @endif
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="contacts">
        	{!! Form::model($array, array('action' => array('FrontController@newcoach',$id), 'files'=>true, 'method' => 'POST', 'id' => 'newcoach')) !!}
            <div class="form-group">
              <div class="row gutter">
                <div class="col-md-4">
                  <label class="control-label">Coach Name</label>
                  {!! Form::text('name',null,['class' => 'form-control','placeholder' => 'Coach Name']) !!}
                </div>
                <div class="col-md-4">	
                  <label class="control-label">Bus Type</label>
                 {!! Form::select('bus_type', $bustype, null, ['class'=>'form-control ','placeholder' => '--Select--']) !!}
                </div>
                <div class="col-md-4">
                  <label class="control-label">Vehicle Company</label>
                  {!! Form::select('vehicle', $vehicleMaker, null, ['class'=>'form-control ','placeholder' => '--Select--']) !!}
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row gutter">
                <div class="col-md-4">
                  <label class="control-label">Layout type</label>
                  {!! Form::select('layout_type', $layout_type, null, ['class'=>'form-control ','placeholder' => '--Select--']) !!}
                </div>
                <div class="col-md-4">
                  <label class="control-label">Is ac</label>
                  <select class="form-control" name="isac">
                    <option value="">--Select--</option>
                    <option value="AC" <?=(!empty($array->isac) && $array->isac == 'AC')?'selected':''?>>AC</option>
                    <option value="Non-AC" <?=(!empty($array->isac) && $array->isac == 'Non-AC')?'selected':''?>>Non-AC</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Coach Feature</label>
                  {!! Form::select('coachfeature', $coachfeature, null, ['class'=>'form-control ','placeholder' => '--Select--']) !!}
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