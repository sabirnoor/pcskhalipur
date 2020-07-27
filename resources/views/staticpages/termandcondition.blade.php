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

        Term & Conditions <br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  <div class="clearfix">&nbsp;</div>
      
	  
<h2>TERMS AND CONDITIONS (IN DETAIL) FOR ONLINE PAYMENTS INTRODUCTION</h2>

<p>These terms and conditions apply to the use of the online service for payment of School Fee for Public Central School. Please read the terms and conditions carefully. You will be deemed to have accepted these terms and conditions by authorizing a payment through the online payment service. Public Central School reserves the right to amend these terms and conditions at any time without notice. You should therefore re-read the terms and conditions each time that this service is used.
</p>

 
 <h3>Online school fee payment... An overview</h3>
 
 <ul>
	 <li>To pay the school fees Online, you are required to login on the school's portal through the website www.pcskhalispur.com</li>
	<li>You will be directed to a payment gateway where you will be asked to choose the payment mode- Net-banking/Credit/Debit card. Afterwards kindly enter your Netbanking/Credit/Debit card details and follow the mandatory procedure .Your payment will be authenticated over the gateway and your credit card or your bank account will be instantly debited.</li>
	<li>You will receive a Transaction Reference Number that is an acknowledgement for your payment request.</li>
 </ul>
 
 <p>While availing any of the payment method/s offered by us, we are not responsible or take no liability of whatsoever nature in respect of any loss or damage arising directly or indirectly to you out of the decline due to:</p>
 
 <ul>
	 <li>lack of authorization for any transaction/s,</li>
	<li>exceeding the preset limit mutually agreed by you and between your "Bank/s",</li>
	<li>any payment issues arising out of the transaction,</li>
	<li>decline of transaction for any other reason/s.</li>
 </ul>
 
 <p>Payments can be made by Master/Visa card.</p>
 
 <h3>Terms and Conditions (in detail) for Online Payments Introduction</h3>
 
 <p>These terms and conditions apply to the use of the online service for payment of School Fee for Public Central School. Please read the terms and conditions carefully. You will be deemed to have accepted these terms and conditions by authorizing a payment through the online payment service. Public Central School reserves the right to amend these terms and conditions at any time without notice. You should therefore re-read the terms and conditions each time that this service is used</p>
 
  <h3>Key Terms</h3>
  
  <p>The following is a summary of the key terms of this service:</p>
 
 <ul>
	<li>Payment may only be made with Visa or MasterCard credit cards and also through your bank account debit card or through the net-banking facility.</li>
	  
	<li>Before using this service, enquiry should be made of the credit card provider as to the nature of any fees payable to the provider as a result of using this service.</li>

	<li>School accepts no responsibility for refusal or reversal of payments which are matters solely between the user of the service and the credit card provider.</li>

	<li>The credit card information supplied when using this service is processed by the payment gateway of the service provider and is not supplied to the school. The only information supplied to the school is the name of the payer, the invoice or notice number, part of the credit card number and the amount of the payment. It is the sole responsibility of the user of this service to ensure that the information entered in the relevant fields is correct. It is recommended that you take and retain a copy of the transaction for record keeping purposes, and to assist with the resolution of any disputes that may arise from use of this service.</li>

	<li>This service is provided using a payment gateway service provider through a secure website. However, the school will not be able to give any assurance that information provided online by a user may not be able to be read or intercepted by a third party. The school does not accept any liability in the event of the interception, "hacking" or other unauthorized access to information provided by a user of this service.
	
	<ul>
		<li>1.) No warranty</li>
		<li>2.) No warranty, representation or guarantee, express or implied, is given by the school in respect of the operation of this service.</li>
		<li>3.) Disclaimer and Limitation of liability</li>
		<li>4.) School does not accept liability for any damage, loss, cost (including legal costs), expenses, indirect losses or consequential damage of any kind which may be suffered or incurred from the use of this service.</li>
	</ul>

	</li>

</ul>

<p>The above disclaimer and limitation of liability operates only to the extent permitted by law.</p>


 
<div class="clearfix"></div>
 <p>&nbsp;</p>

    
    </div>

    <div class="col-sm-3">

      <div class="col-md-12" style="padding:0;">
			@include('includes.latest_news')
			@show
		</div>

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