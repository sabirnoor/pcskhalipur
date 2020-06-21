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
            <h4>Manage</h4>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
      <div class="row gutter">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="panel panel-blue">
            <div class="panel-heading">
              <h4>Route List</h4>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table id="responsiveTable" class="table table-striped table-bordered no-margin" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Service Name/No.</th>
                      <th>Bus Type</th>
                      <th>From City</th>
                      <th>To City</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  @if ($RoutesList)
						@foreach($RoutesList as $k=>$val)
                    <tr id="{{$val->id}}">
                      <td>{{$val->service_name}}</td>
                      <td>{{$val->vehicle}} {{$val->isac}} {{$val->bus_type}} ({{$val->layout_type}})</td>
                      <td>{{$val->fromcity_name}}</td>
                      <td>{{$val->tocity_name}}</td>
                      <td>
                      <a href="{{url('newroute/'.$val->id)}}" title="Update" class="text-success"><i class="fa fa-pencil-square-o fa-1x"></i></a>
						<a href="javascript::void(0);" title="Delete" id="{{$val->id}}" class="text-danger Deleteroute"><i class="fa fa-trash-o fa-1x"></i></a></td>
                    </tr>
                    	@endforeach
					@endif	
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
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