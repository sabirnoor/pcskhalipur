
 <style>
 ul li{ list-style:none;}
 </style>
 <ul>
 <li><h5>Boarding from <?php echo($result[0]->cityname);?></h5></li>
 @if ($result)
		@foreach($result as $k=>$val)
<li>{{$val->location}} &nbsp;&nbsp;<span style="float:right;">{{$val->bordingtime}}</span></li>
@endforeach
	@endif
</ul>


