<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="description" content="Tekoffice | B2B and B2C market place" />
		<meta name="keywords" content="B2B and B2C market place, manage hotels, bus, holidays package and flight" />
		<meta name="author" content="Tekoffice" />
		<link rel="shortcut icon" href="{{asset('public/assets/img/favicon.ico')}}">
		<title>Tekoffice Secure Login</title>
		
		<!-- Bootstrap CSS -->
		<link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" media="screen" />
		<!-- Alertify CSS -->
		<link href="{{asset('public/assets/css/alertify/core.css')}}" rel="stylesheet">
		<link href="{{asset('public/assets/css/alertify/default.css')}}" rel="stylesheet">
		<!-- Login CSS -->
		<link href="{{asset('public/assets/css/main.css')}}" rel="stylesheet" />

		<!-- Ion Icons -->
		<link href="{{asset('public/assets/fonts/icomoon/icomoon.css')}}" rel="stylesheet" />
	</head>
	<body class="login-bg">
	{!! Form::model(null, array('action' => array('LoginController@auth_login',null), 'files'=>true, 'method' => 'POST', 'class' => 'auth_login')) !!}
            
			<div class="login-wrapper">
				<div class="login">
					<div class="login-header">
						<div class="logo">
							<img src="{{asset('public/assets/img/big-logo.png')}}" alt="Holidayfly logo" />
						</div>
						<p>
						@if (session('msg'))
							<div class="alert alert-success">
								{{ session('msg') }}
							</div>
						@endif</p>
						<h5>Login to access to your Holidafly account. </h5>
					</div>
					<div class="login-body">
						<div class="form-group">
							<label for="emailID">Email</label>
                                                        <input id="username" name="username" type="text" class="form-control" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" name="password" type="password" class="form-control" placeholder="Password">
						</div>
						<button class="btn btn-danger btn-block" type="submit">Sign in</button>
					</div>
					<div class="checkbox no-margin">
						<input type="checkbox" id="remember" checked="checked">
						<label for="remember">Remember me</label>
					</div>
				</div>
				<input type="hidden" id="continue" value="{{$continue}}">
<!--				<p>Don't have an Account? <a href="signup.html">Sign up</a></p>-->
			</div>
		</form>
		<script src="{{asset('public/assets/js/jquery.js')}}"></script>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>

		<script src="{{asset('public/assets/js/jquery-ui.js')}}"></script>
		<!-- jquery ScrollUp JS -->
		<script src="{{asset('public/assets/js/scrollup/jquery.scrollUp.js')}}"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>  
		<!-- Notifications JS -->
		<script src="{{asset('public/assets/js/alertify/alertify.js')}}"></script>
		<script src="{{asset('public/assets/js/alertify/alertify-custom.js')}}"></script>
		<script src="{{asset('public/assets/tipped/tipped.js')}}"></script>
		<!-- BS Validator JS -->
		<script src="{{asset('public/assets/js/bsvalidator/bootstrapValidator.js')}}"></script>
		<script src="{{asset('public/assets/js/bsvalidator/custom-validations.js')}}"></script>
		<!-- Custom JS -->
		<script src="{{asset('public/assets/js/custom.js')}}"></script>
	</body>
</html>