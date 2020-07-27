<title> Public Central School</title>
<style>

</style>
<?php $action = Request::segment(1); ?>
<link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/css/scss.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/css/font-awesome.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/css/lightgallery.css')}}" rel="stylesheet">
<?php if(!empty($action)){ ?>
<link rel="stylesheet" href="{{asset('public/assets/css/globals.css')}}">
<?php } ?>
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('public/assets/img/favicon-32x32.png')}}">
<link rel="stylesheet" href="{{ asset('public/assets/css/jquery-ui.min.css') }}" />
   


