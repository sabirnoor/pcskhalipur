<?php
//echo $cityId; 
//echo $id;

?>
<style>
.table_div{ overflow:hidden; display:block;}
.table_div table{width:100%;}
.table_div table tr td{ border:1px solid #CCC; padding:3px 3px !important;}
.table_div table tr td div{padding:3px 3px; !important;}
.table_div input{text-align:right;}
</style>
<!-- Row start -->

<div class="table_div">
<input type="hidden" name="routepathId" id="routepathId" value="{{$id}}" class="form-control">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="no-margin ">
  <tr>
    <td bgcolor="#D6D6D6">Route</td>
    <td bgcolor="#D6D6D6" align="center" colspan="3">Seater fare</td>
    <td bgcolor="#D6D6D6" align="center" colspan="3">Sleeper fare</td>
    <td bgcolor="#D6D6D6" align="center" >Action</td>
  </tr>
  <tr>
    <td bgcolor="#e1edf5">&nbsp;</td>
    <td bgcolor="#e1edf5" align="center">Weekdays</td>
    <td bgcolor="#e1edf5" align="center">Weekend</td>
    <td bgcolor="#e1edf5" align="center">Seat Limit</td>
    <td bgcolor="#e1edf5" align="center">Weekdays</td>
    <td bgcolor="#e1edf5" align="center">Weekend</td>
    <td bgcolor="#e1edf5" align="center">Seat Limit</td>
    <td bgcolor="#e1edf5" align="center">Delete</td>
  </tr>
	@if ($RatecardRouteList)
		@foreach($RatecardRouteList as $k=>$val)
  <tr id={{$k}}>
    <td nowrap="nowrap">{{$val->fromcity_name}} To {{$val->tocity_name}}</td>
    <td>{!! Form::text('st_weekdays[]',$val->st_weekdays,['class' => 'form-control']) !!}</td>
	<td>{!! Form::text('st_weekend[]',$val->st_weekend,['class' => 'form-control']) !!}</td>
	<td>{!! Form::text('st_dsl[]',($val->st_dsl)?$val->st_dsl:50,['class' => 'form-control']) !!}</td>
    <td>{!! Form::text('sl_weekdays[]',$val->sl_weekdays,['class' => 'form-control']) !!}</td>
	<td>{!! Form::text('sl_weekend[]',$val->sl_weekend,['class' => 'form-control']) !!}</td>
	<td>{!! Form::text('sl_dsl[]',($val->sl_dsl)?$val->sl_dsl:50,['class' => 'form-control']) !!}</td>
	<td><span id="{{$val->id}}" class="add btn btn-xs btn-danger deleteRate">Delete</span>
	<input type="hidden" name="ratecard_routes[]" id="ratecard_routes" value="{{$val->id}}" class="form-control">
	</td>
  </tr>
		@endforeach
	@endif
  <tr>
    <td colspan="8"><span class="add btn btn-xs btn-success" data-toggle="modal" data-target="#modalForm">Add Route</span></td>
  </tr>
</table>
	
</div>

<script>
$(".addbording").on('click', function(e){
	e.preventDefault();
	var data = $('#addbording').serialize();
	//alert(data);
	if($('input[name="tocity_name"]').val() === ''){
		alert('Enter city name');
		$('input[name="tocity_name"]').focus();return false;
	}
	
	return false;
	$.ajax({
		url:$('#addservice').attr('action'),
		type:'POST',
		data:data,
		dataType:'json',
		success:function(result){
			if(result.success){
				alert(result.message);
				window.location.href = $('#routepath').attr('action');
			}else{
				alert(result.message);return false;
			}
		},
		error:function(result){
			alert('Opps something wrong!!');return false;
		}
	});
});




$(document).on('keyup', '.location' , function(){
	var index = $(this).attr('index');
	var cityId = $('#cityId').val();
	var location_arr = $('input[name="location[]"]').map(function () {
		return $(this).val();
	}).get();
	$("#location"+index).autocomplete({
	   source: '<?=url('suggestlocation')?>/'+cityId+'/'+location_arr,
	   minLength: 2,
	   select: function (event, ui) {
		   var location_id = ui.item.id;
		   if( $.inArray(ui.item.label, location_arr) > -1 ) {
			   $('#location'+index).val('');
			   alertify.error('Boarding Point already taken!');
				return false;
			}
		   $("#location_id"+index).val(location_id);
	   }
	});
	
});
</script>