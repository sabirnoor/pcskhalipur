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
            <h4>Bus Transaction</h4>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <ul class="right-stats" id="mini-nav-right">
            <li> <a href="{{url('busbooking')}}" class="btn btn-success">Manage</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Top bar ends --> 
    
    <!-- Main container starts -->
    <div class="main-container">
      <div class="row gutter">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="panel-body">
              <div class="table-responsive">
                <table id="" class="table table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>PNR No.</th>
                      <th>Customer</th>
                      <th>Bus Type</th>
                      <th>Total Pax</th>
                      <th>Seat No.</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Travel Date</th>
                      <th>Amount</th>
                      <th>TXN Date</th>
                      <th>Mode</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  @if ($bookingList)
						@foreach($bookingList as $k=>$val)
                    <tr id="{{$val->id}}">
                      <td> <?php echo ($bookingList->perPage()*($bookingList->currentPage()-1))+($k+1);?></td>
                      <td>{{$val->pnr_numbers}}</td>
                      <td>{{$val->pax_name}} <br> {{$val->emailid}}<br> {{$val->mobileno}}</td>
                      <td>{{$val->coachName}}</td>
                      <td>{{$val->TotalPax}}</td>
                      <td>{{$val->seatnumber}}</td>
					  <td>{{$val->fromcity_name}}</td>
                      <td>{{$val->tocity_name}}</td>
                      <td>{{date('d-M-Y',strtotime($val->traveldate))}}</td>
					  <td>{{$val->paynetfare}}</td>
					  <td>{{$val->created_on}}</td>
					  <td>Online</td>
					  <td>Success</td>
                      <td>
					  <div class="btn-group" id="flight_9604">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								Select <span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li><a target="_blank" href="{{url('PrintTicket', ['id' => $val->id])}}" title="">Print Ticket</a></li>
								<li><a href="#" title="">Resend Mail</a></li>
								<li><a href="javascript:void(0);" data-toggle="modal" data-target="#TicketDetails" title="View Details" onclick="TicketDetails('{{$val->id}}');">Details</a></li>
								<li><a href="#" title="">Discard</a></li>
							</ul>
						</div>
					 
                      </td>
                    </tr>
                    	@endforeach
					@endif	
                    
                  </tbody>
                </table>
				{{ $bookingList ->links() }}
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
<div class="modal fade" id="TicketDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
@include('includes.copy_right')
@show

@include('includes.js_common_part')
@show 
<script>

function TicketDetails(id) {
    $.ajax({
        url: 'TicketDetailsPop/'+id,
        type: 'POST',
        dataType: 'html',
        error: function () {
        },
        beforeSend: function () {
            var image = "<div class= 'mydivcenter' ><div class='loading-k'></div></div>";
            $("#TicketDetails").html(image);
        },
        success: function (response) {
            $("#TicketDetails").show();
            $("#TicketDetails").html(response);

            //alert(response);
        }
    });
}
function closepopup() {
    $("#TicketDetails").hide();
}
$(document).ready(function(){
	$('.newcoach').click(function(){
		var page = $(this).attr("pg");
		
	});
	
	
});
</script>
</body>
</html>