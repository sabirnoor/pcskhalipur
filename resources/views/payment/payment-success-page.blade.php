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

        Payment Receipt ## {{sprintf('%07d',intval($PaymentReceipt->id))}} <br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  <div class="clearfix">&nbsp;</div>

    <p>Payment successfully captured. Please note down below details for further query.</p>
    <table class="responsive" width="100%">
      <tbody>
        
      <tr>
        <td><b>Receipt No.</b></td>
        <td align="right"><b>{{sprintf('%07d',intval($PaymentReceipt->id))}}</b></td>
      </tr>
      <tr>
        <td><b>Payment Id</b></td>
        <td align="right"><b>{{$data['rzp_paymentid']}}</b></td>
      </tr>
      <tr>
        <td><b>Admission Ref. No.</b></td>
        <td align="right"><b>{{$data['admission_ref_no']}}</b></td>
      </tr>
      <tr>
        <td><b>Status</b></td>
        <td align="right"><b>PAID</b></td>
      </tr>
      <tr>
        <td><b>Amount</b></td>
        <td align="right"><b>{{$data['amount']}}</b></td>
      </tr>
      
      
    </tbody>
</table>
 
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