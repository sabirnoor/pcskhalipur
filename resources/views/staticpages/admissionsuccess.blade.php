<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
               
        @include('includes.css_part')
        @show
		
		<style>
		li {font-size:18px; margin-bottom:10px;}
		</style>

    </head>

    <!-- NAVBAR
    
    ================================================== -->

    <body>

        <div class="navbar-wrapper">
			@include('includes.menu_nav')
			@show  
        </div>    

        <!-- Carousel
    
        ================================================== -->

<div class="banner">

  <img src="{{asset('public/assets/img/about_banner.jpg')}}" alt="..." class="img-responsive">

</div>

<div class="pencil-bg">

  <div class="container inr-page">

    <div class="col-sm-9 con-area">

      <h1 class="heading">

        Registration Successful <br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  <div class="clearfix">&nbsp;</div>

    <p>Congrats! Registration form submitted successfully with reference no: <?=$ref_no?>. Please proceed to pay</p>
    <table class="responsive" width="100%">
      <tbody>
        
      <tr>
        <td>Student Name</td>
        <td align="right">{{$studentData->student_name}}</td>
      </tr>
      <tr>
        <td>Email Id</td>
        <td align="right">{{$studentData->email}}</td>
      </tr>
      <tr>
        <td>Contact Number</td>
        <td align="right">{{$studentData->contact_no}}</td>
      </tr>
      <tr>
        <td>Address</td>
        <td align="right">{{$studentData->Address}}</td>
      </tr>
      <tr>
        <td>Admission Fee</td>
        <td align="right">{{$mst_class->fee_amount}}</td>
      </tr>
      
      <tr>
        <td align="right" colspan="2">
          <button type="button" class="btn btn-primary PayNow">Pay Online</button>
          <button type="button" style="float: right;" class="btn btn-primary">Pay Offline</button>
        </td>
      </tr>
    </tbody></table>
		
		<form action="{{url('/payment-initiate-request')}}" method="POST" hidden>
          <input type="hidden" value="{{csrf_token()}}" name="_token" /> 
          <input type="text" class="form-control" id="name"  name="name" value="{{$studentData->student_name}}">
      
          <input type="text" class="form-control" id="email" name="email" value="{{$studentData->email}}">
      
          <input type="text" class="form-control" id="contactNumber" name="contactNumber" value="{{$studentData->contact_no}}">
      
          <input type="text" class="form-control" id="address" name="address" value="{{$studentData->Address}}">
      
          <input type="text" class="form-control" id="amount" name="amount" value="{{$mst_class->fee_amount}}">
      <input type="text" class="form-control" id="admission_ref_no" value="{{$studentData->admission_ref_no}}" name="admission_ref_no">
      <textarea name="secureCode">{{$secureCode}}</textarea>
      

      <button type="submit" id="PayNow" class="btn btn-primary">Submit</button>
  </form>   
 


 
<div class="clearfix"></div>
 <p>&nbsp;</p>

    
    </div>

    <div class="col-sm-3">

      

  <div class="clearfix">&nbsp;</div>
  </div>
   <div class="clearfix">&nbsp;</div>
</div>

  </div>


            <!-- FOOTER -->

            <footer>
                @include('includes.footer')
				@show
            </footer>



        </div><!-- /.container -->
        
        @include('includes.js_part')
		@show

    </body>

</html>