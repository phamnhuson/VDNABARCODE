@extends('templates.master')

@section('title', 'City')

@section('content')
<style type="text/css">
	.row{
		margin:0px;
		margin-bottom:5px;
	}	
</style>
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 class="page-title">City Console</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<table width="100%" class="form-table">
		<tr>
			<td class="col-md-4" style="padding-left:0px;">
		<!--<div class="col-md-4" style="padding-left:0px;">-->
			@if (Session::has('responseData'))
				@if (Session::get('responseData')['statusCode'] == 1)
					<div class="alert alert-success">{{ Session::get('responseData')['message'] }}</div>
				@elseif (Session::get('responseData')['statusCode'] == 2)
					<div class="alert alert-danger">{{ Session::get('responseData')['message'] }}</div>
				@endif
			@endif
		
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			{!! Form::open(array('method' => (isset($data['city'])) ? 'PUT' : 'POST' )) !!}
				@if (isset($data['city']))
					<input type="hidden" name="city_id" value="{{ @$data['city'][0]['city_id'] }}" />
				@endif
				<div class="form-group">
					<label class="control-label">City name:</label>
					{!! Form::text('city_name', @$data['city'][0]['city_name'], array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">Zipcode:</label>
					{!! Form::text('zipcode', @$data['city'][0]['zipcode'], array('class'=>'form-control')) !!}
				</div>				
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['city'])) Cập nhật @else Thêm @endif" />
					@if (isset($data['city']))
						<a href="{{ url('city') }}" class="btn btn-success">Thêm mới</a>
					@endif
				</div>
			{!! Form::close() !!}
		<!--</div>-->
			</td>
			<td class="col-md-8" style="padding-right:0px;">
		<!--<div class="col-md-8" style="padding-right:0px;">-->
			<table class="table table-striped table-bordered">
				<tr>
					<th style="text-align:center !important;width:5%">STT</th>
					<th>City</th>
					<th style="width:20%">Zipcode</th>
					<th style="width:15%;"></th>
				</tr>
				<?php $i=1; ?>
				<?php foreach($data['list_city'] as $ct){ ?>
					<tr>
						<td style="text-align:center;"><?php echo $i; ?></td>
						<td><?php echo $ct['city_name']; ?></td>
						<td><?php echo $ct['zipcode']; ?></td>
						<td style="text-align:center;">
							<a href="{{ asset('city?action=edit&id=').$ct['city_id'] }}"><button type="button" title="sửa" name="sua" class="btn btn-warning"><span class='glyphicon glyphicon-pencil'></span></button></a>
							<a href="{{ asset('city?action=delete&id=').$ct['city_id'] }}" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" title="xóa" name="xoa" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button></a>
						</td>
					</tr>
				<?php $i+=1; ?>
				<?php } ?>
			</table>
			<?php echo $data['list_city']->render(); ?>
			</td>
		<!--</div>-->
		</tr>
	</table>
</div>
@endsection