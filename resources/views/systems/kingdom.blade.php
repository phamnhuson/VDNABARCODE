@extends('templates.master')

@section('title', 'Kingdom')

@section('content')
<style type="text/css">
	#title {
		margin-top:7px;
	}
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
					<h1 id="title">Kingdom Console</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<table style="width:100%" class="form-table">
		<tr>
			<td class="col-lg-4" style="padding-left:0px;">
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

				{!! Form::open(array('method' => (isset($data['kingdom'])) ? 'PUT' : 'POST' )) !!}
					@if (isset($data['kingdom']))
						<input type="hidden" name="kingdom_id" value="{{ @$data['kingdom'][0]['kingdom_id'] }}" />
					@endif				
					<div class="form-group">
						<label class="control-label">Tên giới:</label>
						{!! Form::text('kingdom_name', @$data['kingdom'][0]['kingdom_name'], array('class'=>'form-control')) !!}
					</div>
					<div class="form-group">
						<label class="control-label">mô tả:</label>
						{!! Form::text('description', @$data['kingdom'][0]['description'], array('class'=>'form-control')) !!}
					</div>				
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['kingdom'])) Cập nhật @else Thêm @endif" />
						@if (isset($data['kingdom']))
							<a href="{{ url('kingdom') }}" class="btn btn-success">Thêm mới</a>
						@endif
					</div>
				{!! Form::close() !!}
			</td>		
			<td class="col-lg-8" style="padding-right:0px;">
				<table class="table table-striped table-bordered">
					<tr>
						<th style="text-align:center !important;width:5%">STT</th>
						<th style="width:40%">Giới</th>
						<th style="width:40%">Mô tả</th>
						<th style="width:15%;"></th>
					</tr>
					<?php $i=1; ?>
					<?php foreach($data['list_kingdom'] as $pltt){ ?>
						<tr>
							<td style="text-align:center;"><?php echo $i; ?></td>						
							<td><?php echo $pltt['kingdom_name']; ?></td>
							<td><?php echo $pltt['description']; ?></td>
							<td style="text-align:center;">
								<a href="{{ asset('kingdom?action=edit&id=').$pltt['kingdom_id'] }}"><button type="button" title="sửa" name="sua" class="btn btn-warning"><span class='glyphicon glyphicon-pencil'></span></button></a>
								<a href="{{ asset('kingdom?action=delete&id=').$pltt['kingdom_id'] }}" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" title="xóa" name="xoa" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button></a>
							</td>
						</tr>
					<?php $i+=1; ?>
					<?php } ?>
				</table>
				<?php echo $data['list_kingdom']->render(); ?>
			</td>
		</tr>
	</table>
</div>
@endsection