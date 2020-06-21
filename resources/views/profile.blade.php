<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="description" content="Tekoffice | B2B and B2C market place" />
		<meta name="keywords" content="B2B and B2C market place, manage hotels,bus, holidays package and flight" />
		<meta name="author" content="Tekoffice" />
		<title>Profile</title>
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
								<h4>Profile</h4>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<ul class="right-stats" id="mini-nav-right">
								<li>
									<a href="javascript:void(0)" class="btn btn-danger"><span>895</span>Sales</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="btn btn-success"><span>125</span>Leads</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- Top bar ends -->

				<!-- Main container starts -->
				<div class="main-container">

					<!-- Row starts -->
					<div class="row gutter">
						<div class="col-lg-3 col-md-5 col-sm-7 col-xs-12">
							<div class="panel no-border height2 teal-bg">
								<div class="panel-body">
									<div class="user-profile clearfix">
										<div class="user-img">
                                        <i class="fa fa-user fa-10x"></i>
											<!--<img src="{{asset('public/assets/img/thumbs/user7.png')}}" alt="User Info">-->
											<span class="completed-info">78<sup>%</sup></span>
										</div>
										<h5>Completed</h5>
										<h3>{{$details->fname}} {{$details->lname}}</h3>
										<h4>UI Designer</h4>
									</div>
								</div>
							</div>
						</div>
                        <div class="col-lg-5 col-md-3 col-sm-5 col-xs-12">
							<div class="panel">
								<div class="panel-heading">
									<h4>Update Profile </h4>
								</div>
								<div class="panel-body">
                                {!! Form::model($details, array('action' => array('DashboardController@profile','id'=>$details->id), 'files'=>true, 'method' => 'POST', 'id' => 'userprofile')) !!}
									
										<div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Operator/Company/Travels</label>
                                                    {!! Form::text('operator_company',null,['class' => 'form-control','placeholder' => 'Operator/Company']) !!}
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Email Id</label>
                                                    {!! Form::text('emailid',null,['class' => 'form-control', 'disabled'=>'disabled','placeholder' => 'Email Id']) !!}
												</div>
											</div>
										</div>
                                        <div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">First Name</label>
                                                    {!! Form::text('fname',null,['class' => 'form-control','placeholder' => 'First Name']) !!}
												</div>
											</div>
										</div>
                                        <div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Last Name</label>
                                                    {!! Form::text('lname',null,['class' => 'form-control','placeholder' => 'Last Name']) !!}
												</div>
											</div>
										</div>
                                        <div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Mobile Number</label>
                                                    {!! Form::text('mobile',null,['class' => 'form-control','placeholder' => 'Mobile Number']) !!}
												</div>
											</div>
										</div>
                                        <div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Address line 1</label>
                                                    {!! Form::text('address1',null,['class' => 'form-control','placeholder' => 'Address line 1']) !!}
												</div>
											</div>
										</div>
                                        <div class="form-group">
											<div class="row gutter">
												<div class="col-md-12">
													<label class="control-label">Address line 2</label>
                                                    {!! Form::text('address2',null,['class' => 'form-control','placeholder' => 'Address line 2']) !!}
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
                        
						<div class="col-lg-4 col-md-3 col-sm-5 col-xs-12">
							<div class="panel">
								<div class="panel-heading">
									<h4>Change Password</h4>
								</div>
								<div class="panel-body">
									{!! Form::model($details, array('action' => array('DashboardController@change_password','id'=>$details->id), 'files'=>true, 'method' => 'POST', 'id' => 'admin_change_password')) !!}
										<div class="form-group row gutter">
												<label class="col-lg-6 control-label">Current Password</label>
												<div class="col-lg-6">
													<input type="password" class="form-control" placeholder="Password" name="cpassword" id="cpassword" />
												</div>
											</div>
                                            
                                            <div class="form-group row gutter">
												<label class="col-lg-6 control-label">New Password</label>
												<div class="col-lg-6">
													<input type="password" class="form-control" placeholder="Password" name="newpassword" id="newpassword" />
												</div>
											</div>
										<div class="form-group row gutter">
												<label class="col-lg-6 control-label">Confirm Password</label>
												<div class="col-lg-6">
													<input type="password" class="form-control" placeholder="Retype Password" name="confirmPassword" id="confirmPassword" />
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