<?php
//echo '<pre>';print_r($TicketDetails);echo '</pre>';
//echo '<pre>';print_r($booking_details);
 ?>
<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closepopup()"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalForm">Ticket Details </h4>
			</div>
			<div class="modal-body">
					<!-- start of container -->
      <div style="width:862px; margin:auto; border:2px solid #ccc; padding:10px;">
         <!-- start of span_24 -->
         <div style="width:450px; float:left;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0; padding:0;color:#333;font:normal 13px Arial, Helvetica, sans-serif;">
               <tbody><tr>
                  <!--<td colspan="2"><img src="public/assets/img/big-logo.png" width="124" height="30"></td>-->
                  <td colspan="2" style="font-size:18px;font-weight:bold;color:#0099cc;"><?=$TicketDetails['operatorDetails']['operator_company']?></td>
               </tr>
               <tr>
                  <td colspan="2">&nbsp;</td>
               </tr>
               <tr>
                  <td width="36%"><strong><?=$TicketDetails['details']['fromcity_name']?> → <?=$TicketDetails['details']['tocity_name']?></strong></td>
                  <td width="64%" height="25"><em><strong> <?=date('d-M-Y',strtotime($TicketDetails['details']['traveldate']))?></strong></em></td>
               </tr>
               
               <tr>
                  <td height="25"><strong>Contact No</strong></td>
                  <td align="left" style="font-size:15px;font-weight:bold;color:#0066cc;"><?=$TicketDetails['operatorDetails']['mobile']?></td>
               </tr>
            </tbody></table>
         </div>
         <div style="width:300px; float:right;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0; padding:0;color:#333;font:normal 13px Arial, Helvetica, sans-serif;">
               <tbody>
			   
               <tr>
                  <td>
                     <div style="width:275px;padding:5px;margin-top:15px;border:3px dotted #ccc;">
                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:0; padding:0;color:#333;font:normal 13px Arial, Helvetica, sans-serif;">
                           <tbody><tr>
                              <td width="39%">PNR # </td>
                              <td width="61%" height="20"> <strong><?=$TicketDetails['details']['pnr_numbers']?></strong></td>
                           </tr>
                           <tr>
                              <td>Ticket #</td>
                              <td height="20"> <?=$TicketDetails['details']['pnr_numbers']?></td>
                           </tr>
                           <tr>
                              <td>Seat (s)</td>
                              <td height="20"><?=$TicketDetails['details']['seatnumber']?></td>
                           </tr>
                        </tbody></table>
                     </div>
                  </td>
               </tr>
            </tbody></table>
         </div>
         <div style="clear:both;"></div>
		 <div style="width:842px;margin-top:15px;padding:5px 5px 15px 5px;height:auto;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0; padding:0;color:#333;font:normal 13px Arial, Helvetica, sans-serif;">
               <tbody><tr>
                  <td width="30%" height="30"><u><strong>Bus Type</strong></u></td>
                  <td width="20%"><u><strong>Reporting Time</strong></u></td>
                  <td width="20%"><u><strong>Departure time</strong></u></td>
                  <td width="30%"><u><strong>Booked By</strong></u></td>
               </tr>
               <tr>
					<td height="18"> {{CoachName($TicketDetails['details']['bus_type'])}}</td>
					<td><?php $endTime =  strtotime("-15 minutes",strtotime($TicketDetails['details']['fr_bordingtime'])); echo date('g:i A',$endTime) ?> </td>
					<td><?=$TicketDetails['details']['fr_bordingtime']?></td>
					<td><?=$TicketDetails['details']['pax_name']?></td>
               </tr>
               <tr>
                  <td height="30"><u><strong>Boarding Point</strong></u></td>
                  <td>&nbsp;</td>
                  <td><u><strong>Dropping Point </strong></u></td>
                  <td>&nbsp;</td>
               </tr>
			   <tr>
                  <td colspan="2" height="20" style="line-height: 18px;">
				  <strong>Location : </strong><?=$TicketDetails['borpoint']['name']?><br>
				  <strong>Landmark : </strong><?=$TicketDetails['borpoint']['landmark']?><br>
				  <strong>Address : </strong><?=$TicketDetails['borpoint']['address']?>
				  </td>
                  <td colspan="2" style="line-height: 18px;">
				  <strong>Location : </strong><?=$TicketDetails['dorpoint']['name']?> <br>
				  <strong>Landmark : </strong><?=$TicketDetails['dorpoint']['landmark']?> <br>
				  <strong>Address : </strong><?=$TicketDetails['dorpoint']['address']?> 
				  </td>
               </tr>
               
               <tr></tr>
               <tr></tr>
               
            </tbody></table>
         </div>
		 
         <div style="clear:both;"></div>
         <div style="width:842px;margin-top:15px;padding:5px;height:auto;background:#e4f0f7;border-top:1px solid #7ccaf9;border-bottom:1px solid #7ccaf9;">
            <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:0; padding:0;color:#333;font:normal 13px Arial, Helvetica, sans-serif;">
               <tbody><tr>
                  <td width="5%" height="30" valign="middle"><strong>S.N.</strong></td>
                  <td width="41%" height="30" valign="middle"><strong>Passenger Name</strong></td>
                  <td width="34%" valign="middle"> <strong>Passenger Age</strong></td>
                  <td width="20%" valign="middle"><strong>Seat Number</strong></td>
               </tr>
               <?php if($TicketDetails['booking_details']){ foreach($TicketDetails['booking_details'] as $k=>$val){ ?>
               <tr>
                  <td height="30"><?=$k+1?></td>
                  <td height="30"><?=$val['pass_name']?> (<?=$val['pass_gender']?>)</td>
                  <td><strong><?=$val['pass_age']?> Yrs</strong></td>
                  <td><?=$val['seatno']?></td>
               </tr>
               <?php } } ?>
            </tbody></table>
         </div>
         <div style="width:842px;margin-top:15px;padding:5px 5px 15px 5px;height:auto;border-bottom:2px solid #ccc;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0; padding:0;color:#333;font:normal 13px Arial, Helvetica, sans-serif;">
               <tbody>
               <tr>
                  <td height="30"><u><strong>Operator Fare(Rs.)</strong></u></td>
                  <td><u><strong>AC Bus GST(Rs.)</strong></u></td>
                  <td><u><strong>Service Charge(Rs.)</strong></u></td>
				  <td height="30"><u><strong>Total Fare(Rs.)</strong></u></td>
               </tr>
               <tr>
                  <td><?=$TicketDetails['details']['paynetfare']?></td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td><?=$TicketDetails['details']['paynetfare']?></td>
               </tr>
               
               <tr></tr>
               <tr></tr>
               
            </tbody></table>
         </div>
         
        
         <div style="clear:both;"></div>
         
	 </div>
			</div>
			
		</div>
	</div>