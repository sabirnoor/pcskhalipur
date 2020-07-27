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

        Privacy Policy <br>

        <img src="{{asset('public/assets/img/hed-sep.jpg')}}" alt="">

      </h1>
	  <div class="clearfix">&nbsp;</div>
      
	  
<h2>Conditions of Use and Privacy Statement</h2>

<ul>
	 
<li>1.) General. Public Central School enables users to pay school fee online through Public Central School student-teacher portal. Online Services are provided through a secure website using EBS payment gateway. All such Online Services shall be subject to these Terms and Conditions for Online Services, and the Terms of Use of the Public Central School student-teacher portal, which are incorporated herein by reference.</li>

<li>2.) Use of Online Services. School makes Online Services available for school fee payment only. Please do not modify the information or make it available to third parties through a networked computer environment and do not make any additional representations or warranties regarding the information.</li>

<li>3.) Information. You hereby authorize Public Central School portal to collect information about you (including information about transactions processed by you) from time to time through the Public Central School portal. Any such information collected shall be treated in accordance with the Public Central School Privacy Policy. Public Central School may disclose information about you (including your identity) to a third party if necessary to carry out the Online Services, if Public Central School is requested to do so in the course of a criminal or other legal investigation, or if Public Central School determines that disclosure is necessary in connection with any complaint regarding your use of the site.</li>

<li>4.) Consent for us to receive and store information in electronic form. Use of these services means that you agree to provide information through electronic means. This means you agree to provide any relevant information, documents and attachments in the format and to the standards described for each transaction. It also means you agree and understand that the information will be retained in electronic form.</li>

<li>5.) Consent for us to provide you with information in electronic form. Use of these services means that you agree to receive information through electronic means. Where information is requested by another person, the requesting party is deemed to be the recipient's agent and is presumed to have obtained the consent of the recipient to receive the information in electronic format.</li>

<li>6.) Registered users. Online fee payment service offered by Public Central School portal require verified access for verification of your identity (e.g your card number and password on the payment gateway). You agree that all information provided by you on the payment gateway in relation to online services shall be current, complete and accurate. You agree to comply with all such terms and conditions in respect of your use of Online Services.</li>

<li>7.) Password Security. We recommend the password you select should not relate to any readily accessible data such as your name, birth date, address, telephone number, driver's licence, licence plate or passport. Nor may it be an obvious combination of letters and numbers, including sequential or same numbers or letters. You are entirely responsible for maintaining the security of your login ID and password, and for all activity which occurs on or through your account, and, through you credit card, whether authorised or unauthorised, including you, or any of your known entity. You should change your password immediately if you believe that your login ID and password have been used without authorisation. Public Central School portal shall not have any liability for your failure to comply with these obligations.</li>

<li>8.) Security. Online Services are provided through a secure payment gateway. However, you acknowledge and agree that Internet transmissions are never entirely secure or private, and that any message or information you send to or through the website (including credit card information) may be read or intercepted by others, even where a website is stated as being secure. Public Central School portal shall have no liability for the interception or 'hacking' of data through the website by unauthorised third parties.</li>

<li>9.) Accuracy and binding nature of the Transaction Information. Upon completing an Online Service, you will be presented with a confirmation screen verifying the transaction details you wish to process. It is your responsibility to verify that all transaction information and other details are correct. The transaction shall be deemed binding at the time the confirmation screen is displayed. You should print the transaction confirmation for future reference and your files. Public Central School portal shall have no liability for transactions which are incorrect as a result of inaccurate data entry in the course of providing Online Services or for loss of data or information caused by factors outside of Public Central School portal's control.</li>

<li>10.) Right to suspend, alter or cancel service. Use of this Public Central School portal shall be entitled at any time without prior notice or any liability to you, to cancel or suspend the Online fee payment services and/or to substitute alternative services, which may or may not be interactive or transactional in nature.</li>

</ul>

<h3>Governing law</h3>

 <p>Use of this Public Central School portal and subsidiary websites and these terms shall be governed by the laws of India without reference to principles of conflict of laws. You agree to be bound by such laws and irrevocably agree to submit to the jurisdiction of the courts of India in connection with the interpretation or application of these terms. Those who choose to access this website and subsidiary websites from other locations do so on their own initiative and are responsible for compliance with local laws, if and to the extent local laws are applicable. </p>

 
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