<?php 
//print_r($entity_type);die;
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
								<h4>Add Bus Station</h4>
							</div>
						</div>
						
					</div>
				</div>
				<!-- Top bar ends -->

				<!-- Main container starts -->
				<div class="main-container">

					<!-- Row starts -->
					<div class="row ">
                        <div class="col-lg-5 col-md-3 col-sm-5 col-xs-12">
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
							<div class="panel">
								<div class="panel-heading">
									<h4>Add Bus Station </h4>
								</div>
								<div class="panel-body">
                                {!! Form::model($array, array('action' => array('FrontController@addbusstation',$id), 'files'=>true, 'method' => 'POST', 'id' => 'addbusstation')) !!}
									
									{!! Form::hidden('entity_type','busstation',['class' => 'form-control']) !!}
                                        <div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">From City</label>
                                                     {!! Form::text('city_name',null,['class' => 'form-control','placeholder' => 'Type from city', 'id' => 'fromcity']) !!}
														{!! Form::hidden('city_id',null,['class' => 'form-control','id' => 'fromcity_id']) !!}
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Bus Station Name</label>
                                                    {!! Form::text('name',null,['class' => 'form-control','placeholder' => 'Enter Name']) !!}
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Pin Number</label>
                                                    {!! Form::text('pincode',null,['class' => 'form-control','Maxlength' => '6']) !!}
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Full Address</label>
                                                    {!! Form::text('address',null,['class' => 'form-control']) !!}
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Landmark</label>
                                                    {!! Form::text('landmark',null,['class' => 'form-control']) !!}
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Contact numbers</label>
                                                    {!! Form::text('contactnumbers',null,['class' => 'form-control','Maxlength' => '10']) !!}
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Contact Person</label>
                                                    {!! Form::text('contactperson',null,['class' => 'form-control']) !!}
												</div>
											</div>
										</div>
										
                                        
										<div class="form-group no-margin">
											<div class="row gutter">
												<div class="col-md-12">
													<button type="submit" class="btn btn-warning">Save Change</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
                        
						<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
							<div class="panel panel-blue">
								<div class="panel-heading">
									<h4>Bus Station List</h4>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table id="responsiveTable" class="table table-striped table-bordered no-margin" cellspacing="0" width="100%">
											<thead>
											  <tr>
										      <th>Bus Station</th>
											  <th>City</th>
										      <th>Action</th>
											  </tr>
											</thead>
											<tfoot>
											  <tr>
											  <th>Bus Station</th>
											  <th>City</th>
										      <th>Action</th>
											  </tr>
											</tfoot>
											<tbody>
											@if ($EntityList)
												@foreach($EntityList as $k=>$val)
											  <tr>
												<td>{{$val->name}}</td>
												<td>{{$val->city_name}}</td>
												
												<td>
												<a href="{{url('busstation/'.$val->id)}}" title="Update" class="text-success"><i class="fa fa-pencil-square-o fa-1x"></i></a>
												<a href="#" title="Delete" class="text-danger"><i class="fa fa-trash-o fa-1x"></i></a></td>
													
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
					<!-- Row ends -->

								

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
				
		
	</body>
</html>