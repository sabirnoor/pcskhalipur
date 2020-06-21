<?php
//print_r($entity_type);die;
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
                                <h4>Review Itinerary</h4>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Top bar ends -->

                <!-- Main container starts -->
                <div class="main-container">

                    <!-- Row starts -->
                    <div class="row ">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            @if (session('msgerror'))
                            <div class="alert alert-danger light no-margin">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="icon-cross2"></i> {{ session('msgerror') }}
                            </div>
                            @endif
                            @if (session('msgsuccess'))
                            <div class="alert alert-success light no-margin">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="icon-check_circle"></i> {{ session('msgsuccess') }}
                            </div>
                            @endif
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4>Review  Itinerary</h4>
                                </div>
                                <div class="panel-body">
                                    <div style="margin:auto; border:2px solid #ccc; padding:10px;">
                                        <!-- start of span_24 -->


                                        <div style="clear:both;"></div>
                                        <div style="margin-top:15px;padding:5px 5px 15px 5px;height:auto;">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0; padding:0;color:#333;font:normal 13px Arial, Helvetica, sans-serif;">
                                                <tbody><tr>
                                                        <td width="30%" height="30"><u><strong>Bus Type</strong></u></td>
                                                        <td width="20%"><u><strong>Reporting Time</strong></u></td>
                                                        <td width="20%"><u><strong>Departure time</strong></u></td>
                                                        <td width="30%"><u><strong>Booked By</strong></u></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="18"> {{CoachName($TicketDetails['details']['bus_type'])}}</td>
                                                        <td><?php
                                                            $endTime = strtotime("-15 minutes", strtotime($TicketDetails['details']['fr_bordingtime']));
                                                            echo date('g:i A', $endTime)
                                                            ?> </td>
                                                        <td><?= $TicketDetails['details']['fr_bordingtime'] ?></td>
                                                        <td><?= $TicketDetails['details']['pax_name'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="30"><u><strong>Boarding Point</strong></u></td>
                                                        <td>&nbsp;</td>
                                                        <td><u><strong>Dropping Point </strong></u></td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" height="20" style="line-height: 18px;">
                                                            <strong>Location : </strong><?= $TicketDetails['borpoint']['name'] ?><br>
                                                            <strong>Landmark : </strong><?= $TicketDetails['borpoint']['landmark'] ?><br>
                                                            <strong>Address : </strong><?= $TicketDetails['borpoint']['address'] ?>
                                                        </td>
                                                        <td colspan="2" style="line-height: 18px;">
                                                            <strong>Location : </strong><?= $TicketDetails['dorpoint']['name'] ?> <br>
                                                            <strong>Landmark : </strong><?= $TicketDetails['dorpoint']['landmark'] ?> <br>
                                                            <strong>Address : </strong><?= $TicketDetails['dorpoint']['address'] ?> 
                                                        </td>
                                                    </tr>

                                                    <tr></tr>
                                                    <tr></tr>

                                                </tbody></table>
                                        </div>

                                        <div style="clear:both;"></div>
                                        <div style="margin-top:15px;padding:5px;height:auto;background:#e4f0f7;border-top:1px solid #7ccaf9;border-bottom:1px solid #7ccaf9;">
                                            <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin:0; padding:0;color:#333;font:normal 13px Arial, Helvetica, sans-serif;">
                                                <tbody><tr>
                                                        <td width="5%" height="30" valign="middle"><strong>S.N.</strong></td>
                                                        <td width="41%" height="30" valign="middle"><strong>Passenger Name</strong></td>
                                                        <td width="34%" valign="middle"> <strong>Passenger Age</strong></td>
                                                        <td width="20%" valign="middle"><strong>Seat Number</strong></td>
                                                    </tr>
                                                    <?php
                                                    if ($TicketDetails['booking_details']) {
                                                        foreach ($TicketDetails['booking_details'] as $k => $val) {
                                                            ?>
                                                            <tr>
                                                                <td height="30"><?= $k + 1 ?></td>
                                                                <td height="30"><?= $val['pass_name'] ?> (<?= $val['pass_gender'] ?>)</td>
                                                                <td><strong><?= $val['pass_age'] ?> Yrs</strong></td>
                                                                <td><?= $val['seatno'] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody></table>
                                        </div>



                                        <div style="clear:both;"></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            {!! Form::model(null, array('action' => array('FrontController@GetReview',$id), 'files'=>true, 'method' => 'POST', 'id' => 'addbusstation')) !!}
                            <div class="panel panel-blue">
                                <div class="panel-heading">
                                    <h4>Fare Details</h4>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group no-margin">
                                        <li class="list-group-item">
                                            <span class="pull-right"><?= $TicketDetails['details']['currencyname'] ?> <?= $TicketDetails['details']['paynetfare'] ?></span>
                                            Operator Fare
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"><?= $TicketDetails['details']['currencyname'] ?> 0</span>
                                            AC Bus GST
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"><?= $TicketDetails['details']['currencyname'] ?> 0</span>
                                            Service Charge
                                        </li>
                                        <li class="list-group-item">
                                            <span class="pull-right"><?= $TicketDetails['details']['currencyname'] ?> <?= $TicketDetails['details']['paynetfare'] ?></span>
                                            Total Fare
                                        </li>

                                    </ul>
                                    <br>
                                    <div class="form-group no-margin">
                                        <div class="row gutter">
                                            <div class=" pull-right">
                                                <small>By clicking Pay Button you are agreeing to the <a href="#">Terms & Condition</a>.</small>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group no-margin">
                                        <div class="row gutter">
                                            <div class=" pull-right">
                                                <?php if(!empty($CurrencyName)){ ?>
                                                <span>Current Balance : {{$CurrencyName->name}} {{$balance->current_balance}}</span>
                                                <?php }else{ ?>
                                                <span>Current Balance : 0</span>
                                                <?php } ?>
                                                <?php if($balance){ ?>
                                                @if($balance->current_balance >= $TicketDetails['details']['paynetfare'])
                                                <button type="submit" class="btn btn-success">Pay With Wallet</button>
                                                @else
                                                <button type="submit" class="btn btn-success" disabled="disabled">Pay With Wallet</button>
                                                @endif
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
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