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
<style>
.seat_box {
    height: 38px;
    text-align: center;
    width: 38px;
    border: 0px solid #CCC;
}
.create_table {
	overflow: hidden;
	width:100%;
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
  <div class="dashboard-wrapper"> 
    
    <!-- Top bar starts -->
    <div class="top-bar clearfix">
      <div class="row gutter">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="page-title">
            <h4>Coach Gallery - {{CoachName($id)}}</h4>
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
      <ul class="nav nav-tabs" id="friends">
        <li><a href="{{url('newcoach/'.$id)}}" id="coachinfo"> Coach Info </a></li>
        <li><a href="{{url('seatlayout/'.$id)}}"> Seat Layout</a></li>
        <li class="active"><a href="{{url('coachgallery/'.$id)}}"  >Coach Gallery</a></li>
      </ul>
     <div class="tab-content">
        <div class="tab-pane active" id="contacts">
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
					<h4>Coach Gallery </h4>
				</div>
				{!! Form::model($array, array('action' => array('FrontController@coachgallery',$id,$gallery_id), 'files'=>true, 'method' => 'POST', 'id' => 'coachgallery')) !!}
				<div class="panel-body">
					<div class="form-group">
						<label for="userName">Image Title</label>
						{!! Form::text('name',null,['class' => 'form-control','placeholder' => 'Image Title']) !!}
					</div>
					<div class="form-group">
						<label for="image">Image</label>
						<input type="file" class="form-control" name="image" id="image">
					</div>
					<div class="form-group no-margin">
					  <div class="row gutter">
						<div class="col-lg-offset-6 pull-right">
						  <button type="submit" class="btn btn-success">Save</button>
						</div>
					  </div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
			<div class="panel">
				<div class="panel-heading">
					<h4>Gallery List</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="responsiveTable" class="table table-striped table-bordered no-margin" cellspacing="0" width="100%">
							<thead>
							  <tr>
							  <th>Coach</th>
							  <th>Image Title</th>
							  <th>Entity</th>
							  <th>Action</th>
							  </tr>
							</thead>
							<tfoot>
							  <tr>
							  <th>Coach</th>
							  <th>Image Title</th>
							  <th>Image</th>
							  <th>Action</th>
							  </tr>
							</tfoot>
							<tbody>
							
							@if ($CoachGalleryList)
								@foreach($CoachGalleryList as $k=>$val)
							  <tr id="{{$val->id}}">
								<td>{{$val->name}}</td>
								<td>{{$val->name}}</td>
								<td><img src="<?php echo src_path().'coachgallery/gid/'.$id.'/mob_'.$val->coachimage; ?>" height="50" class=" img-circle-sm" alt="avatar"></td>
								<td>
								<a href="{{url('coachgallery/'.$id.'/'.$val->id)}}" title="Update" class="text-success"><i class="fa fa-pencil-square-o fa-1x"></i></a>
									<a href="javascript::void(0);" title="Delete" id="{{$val->id}}" class="text-danger deleteGallery"><i class="fa fa-trash-o fa-1x"></i></a>
								</td>	
							  </tr>
								@endforeach
							@endif	
							  
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
        	
           
            <div class="form-group no-margin">
              <div class="row gutter">
                
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

@include('includes.copy_right')
	 	@show

		@include('includes.js_common_part')
	 	@show 
<script>
		$(document).ready(function(){
			$('.newcoach').click(function(){
				var page = $(this).attr("pg");
				
			});
			
			
		});
		</script>
</body>
</html>