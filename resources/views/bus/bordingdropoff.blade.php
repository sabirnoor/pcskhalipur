<?php
//echo $cityId; 
//echo $id;
//print_r($BordingdropoffpointList); 
?>

<!-- Row start -->
<div class="panel-body">
<div class="table-responsive">
<input type="hidden" name="cityId" id="cityId" value="{{$cityId}}" class="form-control">
<input type="hidden" name="routepathId" id="routepathId" value="{{$id}}" class="form-control">
	<table class="table table-bordered no-margin " id="RowsGroup">
		<thead>
			<tr>
				<th>Boarding Point </th>
				<th>Hours</th>
				<th>Minute</th>
				<th>AM/PM</th>
				<th>&nbsp;</th>
				<th>Set Primary</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if($BordingdropoffpointList){
				foreach($BordingdropoffpointList as $k=>$value){	
				
			?>
			<tr id="Row<?=$k?>">
				<td><input type="text" name="location[]" id="location<?=$k?>" value="<?=$value->location?>" class="form-control">
				<input type="hidden" name="location_id[]" id="location_id<?=$k?>" value="<?=$value->location_id?>" class="form-control">
				<input type="hidden" name="bordingdropoffpoint_id[]" id="bordingdropoffpoint_id<?=$k?>" value="<?=$value->id?>" class="form-control"></td>
				<td><select class="form-control" name="Hours[]" id="Hours<?=$k?>">
					<?php for($i=1;$i<13;$i++){ $i2 = ($i <=9)?'0'.$i:$i;?>
						<option value="<?=$i2?>" <?=($value->hours == $i2)?'selected':''?>><?=$i2?></option>
					<?php } ?>
				</select>
				</td>
				<td>
				<select class="form-control" name="Minute[]" id="Minute<?=$k?>">
					<?php for($i=0;$i<60;$i++){$i2 = ($i <=9)?'0'.$i:$i; ?>
						<option value="<?=$i2?>" <?=($value->minute == $i2)?'selected':''?>><?=$i2?></option>
					<?php } ?>
				</select>
				</td>
				<td>
				<select class="form-control" name="ampm[]" id="ampm<?=$k?>">
					<option value="AM" <?=($value->ampm == 'AM')?'selected':''?>>AM</option>
					<option value="PM" <?=($value->ampm == 'PM')?'selected':''?>>PM</option>
				</select>
				</td>
				<td>
				<div class="checkbox checkbox-inline">
				<input type="checkbox" name="next_day<?=$k?>" <?=($value->next_day == '1')?'checked':''?> id="next_day<?=$k?>" value="1" class="field">
				  <label for="next_day<?=$k?>">Next day</label>
				</div>
				</td>
				<td>
				<div class="checkbox checkbox-inline">
				<input type="checkbox" name="primary<?=$k?>" id="primary<?=$k?>" <?=($value->setprimary == '1')?'checked':''?> value="1" class="field primary check">
				  <label for="primary<?=$k?>">Primary </label>
				</div>
				</td>
				<td><span class="btn btn-xs btn-danger deleteRow" id="<?=$value->id?>" index="<?=$k?>"><span class="icon-trash"></span></span></td>
			</tr>
			<?php 
				}
			}
			?>
		</tbody>
	</table>
	<table width="100%" border="0" class="table">
		<tr>
		  <td align="right"><span class="add btn btn-xs btn-success" id="addButton">Add More</span></td>
		</tr>
    </table>
</div>

</div>

<div class="modal fade" id="addNewLocation" tabindex="-1" role="dialog" aria-labelledby="addNewLocation">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closepopup()"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Bus Station Location</h4>
			</div>
			<div class="modal-body">
				{!! Form::model(null, array('action' => array('FrontController@addbusstationAjax',$id),'files'=>true, 'method' => 'POST', 'id' => 'SaveNewLocation')) !!}
					<input class="form-control" name="entity_type" type="hidden" value="busstation">
					<input class="form-control" name="index" id="index" type="hidden">
					<div class="form-group">
						<label class="control-label">City Name:</label>
						{!! Form::text('city_name',null,['class' => 'form-control','placeholder' => 'Type city', 'id' => 'city_name']) !!}
						{!! Form::hidden('city_id',null,['class' => 'form-control','id' => 'city_id']) !!}
					</div>
					<div class="form-group">
						<label class="control-label">Bus Station Name:</label>
						{!! Form::text('name',null,['class' => 'form-control','placeholder' => 'Enter Name', 'id' => 'name']) !!}
					</div>
					
					<div class="form-group">
						<label class="control-label">Full Address:</label>
						{!! Form::text('address',null,['class' => 'form-control', 'id' => 'address']) !!}
					</div>
					<div class="form-group">
						<label class="control-label">Landmark:</label>
						{!! Form::text('landmark',null,['class' => 'form-control', 'id' => 'landmark']) !!}
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-info addNewLocation">Add</button>
			</div>
		</div>
	</div>
</div>

<script>
$("#city_name").autocomplete({
   source: '<?=url('suggestcity')?>',
   minLength: 2,
   select: function (event, ui) {
	   var CountryId = ui.item.id;
	   $("#city_id").val(CountryId);
   },
   open: function(){
		setTimeout(function () {
			$('.ui-autocomplete').css('z-index', 99999999999999);
		}, 0);
	}
});
$(".addNewLocation").on('click', function(e){
	e.preventDefault();
	var data = $('#SaveNewLocation').serialize();
	var index = $('#index').val();
	if($('#SaveNewLocation input[name="city_name"]').val() === ''){
		alertify.error('Enter city name');
		$('#SaveNewLocation input[name="city_name"]').focus();return false;
	}
	if($('#SaveNewLocation input[name="city_id"]').val() === ''){
		alertify.error('Enter valid city name');
		$('#SaveNewLocation input[name="city_id"]').focus();return false;
	}
	if($('#SaveNewLocation input[name="name"]').val() === ''){
		alertify.error('Enter bus station name');
		$('#SaveNewLocation input[name="name"]').focus();return false;
	}
	if($('#SaveNewLocation input[name="name"]').val() === ''){
		alertify.error('Enter bus station name');
		$('#SaveNewLocation input[name="name"]').focus();return false;
	}
	if($('#SaveNewLocation input[name="address"]').val() === ''){
		alertify.error('Enter full address');
		$('#SaveNewLocation input[name="address"]').focus();return false;
	}
	if($('#SaveNewLocation input[name="landmark"]').val() === ''){
		alertify.error('Enter landmark/near by');
		$('#SaveNewLocation input[name="landmark"]').focus();return false;
	}
	
	$.ajax({
		url:$('#SaveNewLocation').attr('action'),
		type:'POST',
		data:data,
		dataType:'json',
		success:function(result){
			if(result.success){
				alert(result.message);
				$("#location_id"+index).val(result.insertid);
				$("#location"+index).val(result.name);
				$('#addNewLocation').modal('hide');
			}else{
				alert(result.message);return false;
			}
		},
		error:function(result){
			alert('Opps something wrong!!');return false;
		}
	});
});

<?php if(!empty($BordingdropoffpointList)){ ?>
var counter = <?=count($BordingdropoffpointList)?>;
<?php }else{ ?>
var counter = 0;
<?php } ?>
$("#addButton").click(function () {
	var newTextBoxTr = $(document.createElement('tr')).attr("id", 'Row' + counter);
	newTextBoxTr.after().html('<td><input index="'+counter+'" type="text" placeholder="Type Location" name="location[]" id="location'+counter+'" class="form-control location">'+
				'<input type="hidden" index="'+counter+'" name="location_id[]" id="location_id'+counter+'"></td>'+
				'<td><select class="form-control" name="Hours[]" id="Hours'+counter+'">'+
				'	<?php for($i=1;$i<13;$i++){ $i2 = ($i <=9)?'0'.$i:$i; ?>'+
				'		<option value="<?=$i2?>" ><?=$i2?></option>'+
				'	<?php } ?>'+
				'</select>'+
				'</td>'+
				'<td>'+
				'<select class="form-control" name="Minute[]" id="Minute'+counter+'">'+
				'	<?php for($i=0;$i<60;$i++){ $i2 = ($i <=9)?'0'.$i:$i; ?>'+
				'		<option value="<?=$i2?>" ><?=$i2?></option>'+
				'	<?php } ?>'+
				'</select>'+
				'</td>'+
				'<td>'+
				'<select class="form-control" name="ampm[]" id="ampm'+counter+'">'+
				'	<option value="AM">AM</option>'+
				'	<option value="PM" >PM</option>'+
				'</select>'+
				'</td>'+
				'<td>'+
				'<div class="checkbox checkbox-inline">'+
				'<input type="checkbox" name="next_day'+counter+'" id="next_day'+counter+'" value="1" class="field">'+
				'  <label for="next_day'+counter+'">Next day</label>'+
				'</div>'+
				'</td>'+
				'<td>'+
				'<div class="checkbox checkbox-inline">'+
				'<input type="checkbox" name="primary'+counter+'" id="primary'+counter+'" value="1" class="field primary check">'+
				'  <label for="primary'+counter+'">Primary </label>'+
				'</div>'+
				'</td>'+
		'<td><span class="remove btn btn-xs btn-danger"><span class="icon-trash"></span></span></td>');
	newTextBoxTr.appendTo("#RowsGroup");
		if(counter === 0){
            $('.remove').hide();
        }	
	counter++;
});
$("#RowsGroup").on('click','.remove',function(){
	$(this).parent().parent().remove();
});
<?php if($BordingdropoffpointList->isEmpty()){ ?>
$('#addButton').trigger('click');
<?php } ?>


function addNewLocation(index){
	$('#index').val(index);
	$("#addNewLocation").modal();
}
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
			if(location_id === 0){
				$("#location_id"+index).val(location_id);
				$("#location"+index).val('');
				addNewLocation(index);
			}else{
				$("#location_id"+index).val(location_id);
			}
	   }
	});
	
});
</script>