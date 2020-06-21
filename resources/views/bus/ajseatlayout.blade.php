<?php
//print_r($entity_type);die;
$seat_lower_arr = json_decode($array->lower_seat);
$seat_upper_arr = json_decode($array->upper_seat);
//echo '<pre>';print_r($array->lower_seat);echo '</pre>';die;
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
        <style>
            .seat_box {
                height: 38px;
                text-align: center;
                width: 38px;
                border: 0px solid #CCC;
            }
            .create_table {
                overflow: hidden;
                /* width:100%; */
            }
            .create_table table {
                border-top: solid 1px #ccc;
                border-left: solid 1px #ccc;
            }
            .create_table table td {
                padding:0px 0px;
                vertical-align: middle;
                border-bottom: solid 1px #ccc;
                border-right: solid 1px #ccc;
                font-size:12px;
            }


            .seater2{
                background-image: url('../public/assets/img/seater.png');
                background-repeat:  no-repeat;
                width:35px;
                height:35px;
                text-align:center;
                font-size: 10px;
            }
            .sleeper-horizontal2{
                background-image: url('../public/assets/img/sleeper-horz.png');
                background-repeat:  no-repeat;	
                width:70px;
                height:35px;
                text-align:center;	
            }
            .sleeper-vertical2{
                background-image: url('../public/assets/img/sleeper-vert.png');
                background-repeat:  no-repeat;	
                width:35px;
                height:70px;
                text-align:center;	
            }
        </style>
    </head>

    <body onload="generateSeats();">

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
                                <h4>Coach Seat Layout :- {{CoachName($id)}}</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="right-stats" id="mini-nav-right">
                                <li>
                                    <a href="{{url('managecoach')}}" class="btn btn-danger">Manage Coach</a>
                                </li>
                                <li>
                                    <a href="{{url('newcoach')}}" class="btn btn-success">Create Coach</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Top bar ends --> 

                <!-- Main container starts -->
                <div class="main-container">
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
                    <ul class="nav nav-tabs" id="friends">
                        <li><a href="{{url('newcoach/'.$id)}}" id="coachinfo"> Coach Info </a></li>
                        <li class="active"><a href="{{url('seatlayout/'.$id)}}"> Seat Layout</a></li>
                        <li><a href="{{url('coachgallery/'.$id)}}"  >Coach Gallery</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="contacts">

                            {!! Form::model($array, array('action' => array('FrontController@seatlayout',$id), 'files'=>true, 'autocomplete'=>'off', 'method' => 'POST', 'id' => 'SeatLayout')) !!}
                            <div class="form-group ">
                                <div class="row gutter">
                                    <div class="col-md-6 create_table">
                                        <label>LOWER</label>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="source_table_lower" class="no-margin source_table">
                                            <?php
                                            $c = 0;
                                            for ($i = 1; $i <= 6; $i++) {
                                                echo '<tr>';
                                                for ($j = 1; $j <= 15; $j++) {
                                                    ?>
                                                    <td><input type="text" name="seat_lower[]"  value="<?php echo $seat_lower_arr[$c][0]; ?>" maxlength="4" onblur="generateSeats()" class="seat_box"/>
                                                    <input type="hidden" name="seat_lower_type[]"  value="" /></td>
                                                    <?php
                                                    $c++;
                                                }
                                                echo '</tr>';
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <label>LOWER V</label>
                                        <table id="dest_table_lower" border="0" cellspacing="0" cellpadding="0" class="no-margin">	

                                            <?php
                                            $c = 0;
                                            for ($i = 1; $i <= 6; $i++) {
                                                echo '<tr>';
                                                for ($j = 1; $j <= 15; $j++) {
                                                    ?>
                                                    <td id="<?php echo 'row_' . $i . '_col_' . $j ?>"></td>
                                                    <?php
                                                    $c++;
                                                }
                                                echo '</tr>';
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>


                                <div class="row gutter ">
                                    <div class="col-md-6 create_table">
                                        <label>UPPER</label>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="no-margin source_table">
                                            <?php
                                            $c = 0;
                                            for ($i = 1; $i <= 6; $i++) {
                                                echo '<tr>';
                                                for ($j = 1; $j <= 15; $j++) {
                                                    ?>
                                                    <td><input type="text" name="seat_upper[]" onblur="generateSeats()" value="<?php echo $seat_upper_arr[$c][0]; ?>" class="seat_box" maxlength="4">
                                                    <input type="hidden" name="seat_upper_type[]"  value="" /></td>
                                                    <?php
                                                    $c++;
                                                }
                                                echo '</tr>';
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <label >UPPER V</label>
                                        <table id="dest_table_upper" border="0" cellspacing="0" cellpadding="0" class="no-margin">

                                            <?php
                                            $c = 0;
                                            for ($i = 1; $i <= 6; $i++) {
                                                echo '<tr>';
                                                for ($j = 1; $j <= 15; $j++) {
                                                    ?>
                                                    <td id="<?php echo 'row_' . $i . '_col_' . $j ?>"></td>
                                                    <?php
                                                    $c++;
                                                }
                                                echo '</tr>';
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" name="layout_error" id="layout_error" value="0" />
                            </div>

                            <div class="form-group no-margin">
                                <div class="row gutter">
                                    <div class="col-lg-offset-6 pull-right">
                                        <button type="submit" class="btn btn-success">Save & Next</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>


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
                $('.newcoach').click(function () {
                    var page = $(this).attr("pg");

                });


            });
        </script>
        <script type="text/javascript">


            function generateSeats()
            {
                var regx = /^[A-Za-z0-9]+$/;
                var values = [];
                var col_num = row_num = 0;
                var prev_col_num = prev_row_num = 0;
                var dest_table = '';

                $('#layout_error').val(0);
                $("#dest_table_lower td").text("").removeClass("seater2 sleeper-horizontal2 sleeper-vertical2");
                $("#dest_table_upper td").text("").removeClass("seater2 sleeper-horizontal2 sleeper-vertical2");


                $('.source_table input[type="text"]').each(function (index, element)
                {

                    if ($(this).val() != '')
                    {
                        if (!regx.test($(this).val()))
                        {
                            //$(this).css("background-color","red");
                            $(this).val('');
                            //return false;
                        }

                        dest_table = (index <= 89) ? 'dest_table_lower' : 'dest_table_upper';

                        col_num = parseInt($(this).parent().index()) + 1;
                        row_num = parseInt($(this).parent().parent().index()) + 1;

                        var prev_index = values.indexOf($(this).val());


                        if (prev_index != -1) {

                            prev_col_num = parseInt($('.source_table input[type="text"]:eq(' + prev_index + ')').parent().index()) + 1;

                            prev_row_num = parseInt($('.source_table input[type="text"]:eq(' + prev_index + ')').parent().parent().index()) + 1;

                            col_diff = col_num - prev_col_num;
                            row_diff = row_num - prev_row_num;

                            //sleeper rule-- horizontal: row_diff = 0, col_diff=1;  vertical: row_diff = 1, col_diff=0;

                            if (((row_diff == 0) && (col_diff == 1)) || ((row_diff == 1) && (col_diff == 0))) {

                                $(this).css("background-color", "blue");

                                $('.source_table input[type="text"]:eq(' + prev_index + ')').css("background-color", "blue");

                                $('.source_table input[type="hidden"]:eq(' + index + ')').val('SL');
                                $('.source_table input[type="hidden"]:eq(' + prev_index + ')').val('SL');


                                if ((row_diff == 0) && (col_diff == 1)) {
                                    $('#' + dest_table + ' #row_' + row_num + '_col_' + col_num).remove();

                                    $('#' + dest_table + ' #row_' + prev_row_num + '_col_' + prev_col_num).attr('colspan', '2');

                                    $('#' + dest_table + ' #row_' + prev_row_num + '_col_' + prev_col_num).addClass("sleeper-horizontal2");
                                }
                                if ((row_diff == 1) && (col_diff == 0)) {
                                    $('#' + dest_table + ' #row_' + row_num + '_col_' + col_num).remove();

                                    $('#' + dest_table + ' #row_' + prev_row_num + '_col_' + prev_col_num).attr('rowspan', '2');

                                    $('#' + dest_table + ' #row_' + prev_row_num + '_col_' + prev_col_num).addClass("sleeper-vertical2");
                                }

                            } else {
                                $(this).css("background-color", "red");

                                $('.source_table input[type="text"]:eq(' + prev_index + ')').css("background-color", "red");

                                $('#' + dest_table + ' #row_' + prev_row_num + '_col_' + prev_col_num).text("").removeClass("seater2 sleeper-horizontal2 sleeper-vertical2");

                                $('#layout_error').val(1);

                            }

                        } else {
                            $(this).css("background-color", "green");

                            $('.source_table input[type="hidden"]:eq(' + index + ')').val('ST');

                            $('#' + dest_table + ' #row_' + row_num + '_col_' + col_num).text($(this).val());
                            $('#' + dest_table + ' #row_' + row_num + '_col_' + col_num).addClass("seater2");
                        }
                    } else { // if value is empty/set to empty
                        $(this).css("background-color", "white");
                    }

                    values.push($(this).val());

                });
            }
        </script>
    </body>
</html>