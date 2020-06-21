<?php ?>
<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
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
        <style>		
            .bus-entry {
                overflow: hidden;
                clear: both;
                background: #fff none repeat scroll 0 0;
                border-radius: 3px;
                box-shadow: 0 0px #ccc;

            }
            .bus-entry table {
                border-top: solid 0px #CCC;
                border-left: solid 0px #CCC;
            }
            .bus-entry table td {
                padding: 10px 14px;
                font-size:13px;
                border-bottom: solid 0px #CCC;
                border-left: solid 0px #CCC;
                border-right: solid 0px #CCC;
                color:#999;
                
            }

            .create_table {
                overflow: hidden;
            }
            .create_table table {
                border-top: solid 0 #CCC;
                border-left: solid 0px #CCC;
            }
            .create_table table td {
                padding:4px 0px 4px 5px;
                vertical-align: middle;
                border-bottom: solid 0px #CCC;
                border-right: solid 0px #CCC;
            }
            
        </style>



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
            <div class="dashboard-wrapper" ng-app="myApp">

                <!-- Top bar starts -->
                <div class="top-bar clearfix">
                    <div class="row gutter">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="page-title">
                                <h4>Search </h4>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Top bar ends -->

                <!-- Main container starts -->
                <div class="main-container" ng-controller="BusController">

                    <!-- Row starts -->
                    <div class="row ">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-blue">
<?php //echo md5(base64_decode(6));  ?>
                                <div class="panel-body" data-ng-init="SearchBus()">
                                    <div class="panel-body">
                                        {!! Form::model(null, array('action' => array('SearchController@index'), 'files'=>true, 'autocomplete'=>'off', 'method' => 'POST', 'class' => 'form-inline searchbuses')) !!}

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="fromcity" id="fromcity" value="Delhi NCR" placeholder="Type from city">
                                        </div>
                                        <div class="form-group">
                                            <span class="icon-swap fa-2x"></span>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="tocity" id="tocity" value="Lucknow" placeholder="Type to city">
                                        </div>

                                        <div class="input-group">
                                            <input type="text" class="form-control" name="traveldate" id="traveldate" value="<?= date('d-m-Y') ?>" placeholder="Travel date">
                                            <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i> </span>
                                        </div>

                                        <button type="button" class="btn btn-info" ng-click="SearchBus()">Search Bus</button>
                                        <input type="hidden" class="form-control" name="fromcity_id" id="fromcity_id" value="51">
                                        <input type="hidden" class="form-control" name="tocity_id" id="tocity_id" value="170">
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-blue">
                                <div class="panel-heading">
                                    <h4>Search List</h4>
                                </div>
                                <div class="panel-body">

                                    <!--<div class="timeline-item">
                                            <div class="animated-background">
                                                    <div class="background-masker header-top"></div>
                                                    <div class="background-masker header-left"></div>
                                                    <div class="background-masker header-right"></div>
                                                    <div class="background-masker header-bottom"></div>
                                                    <div class="background-masker subheader-left"></div>
                                                    <div class="background-masker subheader-right"></div>
                                                    <div class="background-masker subheader-bottom"></div>
                                                    <div class="background-masker content-top"></div>
                                                    <div class="background-masker content-first-end"></div>
                                                    <div class="background-masker content-second-line"></div>
                                                    <div class="background-masker content-second-end"></div>
                                                    <div class="background-masker content-third-line"></div>
                                                    <div class="background-masker content-third-end"></div>
                                            </div>
                                    </div>-->
                                    {!! Form::model(null, array('action' => array('SearchController@index'), 'files'=>true, 'autocomplete'=>'off', 'method' => 'POST', 'class' => 'ProcessToPayment')) !!}
                                    <div class="table-responsive BookNowDiv" ng-show = "BookNowDiv" style="display:none;">
                                        <table id="example" class="display table no-margin no-footer" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><a href="#" title="Go Back" ng-click="GoBack()"><i class="fa fa-arrow-circle-left" style="font-size:22px;" aria-hidden="true"></i></a> &nbsp; [[bookData.travels_name]] - [[bookData.coachName]]</th>
                                                    <th>Travel Date - [[bookData.traveldate]]</th>
                                                    <th>[[bookData.fr_bordingtime]] <i class="fa fa-arrow-right" aria-hidden="true"></i> [[bookData.to_bordingtime]] </th>
                                                    <th>20 Seats Available</th>
                                                </tr>
                                            </thead>

                                            <tbody>											
                                                <tr>
                                                    <td colspan="4" >
                                                        <div class="col-md-6 ">
                                                            <div class="bus-entry printTable"></div>
                                                            <div class="bus-entry printTableu"></div>
                                                        </div>

                                                        <div class="col-md-6 create_table">
                                                            <table cellspacing="0" width="100%" id="bookingTable">
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <div class="col-md-6">
                                                                            Selected Seat(s): <span class='selected_seat'>0</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            No. of Seats: <span class='TotalSeat'>0</span>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="col-md-6" style="padding-right:1px;">
                                                                            
                                                                            <select id="boardingfrom" name="boardingfrom" class="form-control">
                                                                                <option ng-repeat="brval in boardingfrom" value="[[brval.id]]">[[brval.location]]</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <select id="dropingto" name="dropingto" class="form-control">
                                                                                <option ng-repeat="drval in dropingto" value="[[drval.id]]">[[drval.location]]</option>
                                                                            </select>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
<!--                                                                        <div class="col-md-6" style="padding-right:1px;">
                                                                            <input type="text" name="pass_name[]" id="pass_name" no-special-char ng-model="pass_name" maxlength="30" placeholder="Full Name" class="form-control">
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <select name="pass_gender[]" id="pass_gender" class="form-control" ><option value="">--</option><option value="M">M</option><option value="F">F</option></select>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <input type="text" name="pass_age[]" ng-keypress="filterValue($event)" maxlength="3" id="pass_age45" class="form-control" placeholder="Age">
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <input type="text" name="seat_no[]" id="seat_no" class="form-control" value="[[Seat.seatno]]" readonly="readonly">
                                                                        </div>
                                                                        <input type="hidden" name="seatno[]" class="form-control" value="[[Seat.seatno]]" readonly="readonly">-->
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div class="col-md-6" style="padding-right:1px;">
                                                                            <input type="text" name="pax_name" id="pax_name" no-special-char ng-model="pax_name" class="form-control" placeholder="Lead Pax Name">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" name="emailid" id="emailid" class="form-control" placeholder="E-mail">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="col-md-6" style="padding-right:1px;">
                                                                            <input type="text" name="mobileno" id="mobileno" ng-keypress="filterValue($event)" maxlength="10" class="form-control" placeholder="Mobile">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" name="fulladdress" id="fulladdress" class="form-control" maxlength="250" placeholder="Address">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="col-md-6" style="padding-right:1px;">
                                                                            Net Fare: <i class="fa fa-fw fa-inr"></i> <span class="netfare">0</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <button class="btn btn-success" ng-click="ProcessToPayment(BookingData)" type="button">Process To Payment</button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>													
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" name="selected_seat" class="selected_seat">
                                    <input type="hidden" name="netfare" class="form-control" value="0" readonly="readonly">
                                    <input type="hidden" name="fare_seater" class="form-control" value="[[bookData.fare_seater]]" readonly="readonly">
                                    <input type="hidden" name="fare_sleeper" class="form-control" value="[[bookData.fare_sleeper]]" readonly="readonly">
                                    </form>
                                    <div class="table-responsive" ng-show = "searchResult">
                                        <table id="example" class="display table no-margin no-footer" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Bus Operator/Bus Type </th>
                                                    <th style="text-align:center !important;">Boarding - Dropping</th>
                                                    <th style="text-align:center !important;">Rating</th>
                                                    <th style="text-align:center !important;">Seat</th>
                                                    <th>Commision</th>
                                                    <th style="text-align:center !important;">Fare</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <tr><td style="text-align:center !important;" colspan="6"><loading></loading></td></tr>
                                            <tr ng-repeat="val in searchResult">
                                                <td><strong>[[val.travels_name]]</strong> <br> [[val.coachName]]</td>
                                                <td style="text-align:center !important;">
                                                    <a style="color:blue; cursor: pointer;" class="borpoint" data-tipped-options="ajax: { data: { data: '[[val.id]]_[[val.route_id]]_[[val.fromcity_id]]' }}">[[val.fr_bordingtime]]</a> <span class="icon-minus3"></span> 
                                                    <a style="color:blue; cursor: pointer;" class="borpoint" data-tipped-options="ajax: { data: { data: '[[val.id]]_[[val.route_id]]_[[val.tocity_id]]' }}">[[val.to_bordingtime]]</a> <br>
                                                    [[val.travelTime]]
                                                </td>
                                                <td style="text-align:center !important;">4.3 <br> Star</td>
                                                <td style="text-align:center !important;">[[val.AvailableSeats]] <br> <small style="color:#1fa208; cursor: pointer;">Seats Available</small></td>
                                                <td><i class="fa fa-fw fa-inr"></i> 0</td>
                                                <td style="text-align:center !important;"><i class="fa fa-fw fa-inr"></i> <span ng-if="val.fare_seater">[[val.fare_seater]]</span> <span ng-if="val.fare_sleeper">/ [[val.fare_sleeper]]</span> <br>
                                                    <button class="btn btn-success btn-xs" ng-click="BookNow(val)" type="button">Book Now</button>
                                                </td>
                                            </tr>

                                            <tr ng-show="!searchResult.length">
                                                <td style="text-align:center !important;" colspan="6">
                                                    No record found!                
                                                </td>
                                            </tr>
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
        <script>
            $(document).ready(function () {
                /* var table = $('#example').DataTable({
                 dom: 'lr<"table-filter-container">tip',
                 "paging": false,
                 "bInfo" : false,
                 "language": {
                 "emptyTable": "",
                 "zeroRecords": ""
                 },
                 "order": [[ 5, "asc" ]],
                 initComplete: function(settings){
                 var api = new $.fn.dataTable.Api( settings );
                 $('.table-filter-container', api.table().container()).append(
                 $('#table-filter').detach().show(),
                 $('#morefield').detach().show()
                 );
                         
                 $('#table-filter select').on('change', function(){
                 table.columns(0).search(this.value).draw();   
                 });
                 $('#morefield select').on('change', function(){
                 table.columns(1).search(this.value).draw();   
                 });
                 }
                 }); */

            });

        </script>		
        <script type="text/javascript">
            $(function () {
                $("#traveldate").datepicker({
                    //defaultDate: "+1w",
                    changeMonth: false,
                    dateFormat: "dd-mm-yy",
                    numberOfMonths: 1,
                    minDate: 0,
                    showOn: "both",
                    buttonText: 'Travel date',
                    buttonImage: "{{asset('public/assets/img/calendar.png')}}",
                    buttonImageOnly: true

                });


            });

        </script>

        <script type="text/javascript">







        </script>
    </body>
</html>