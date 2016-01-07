@extends('templates.master')

@section('title', 'Ngân hàng dữ liệu DNA Việt Nam')

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
					<h1 class="page-title">ĐƠN VỊ LIÊN KẾT</h1>
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

			{!! Form::open(array('method' => (isset($data['link'])) ? 'PUT' : 'POST' )) !!}
				@if (isset($data['link']))
					<input type="hidden" name="link_id" value="{{ @$data['link'][0]['link_id'] }}" />
				@endif
				<div class="form-group">
					<label class="control-label">Đơn vị liên kết:</label>
					{!! Form::text('link_name', @$data['link'][0]['link_name'], array('class'=>'form-control')) !!}
				</div>			
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['link'])) Cập nhật @else Thêm @endif" />
					@if (isset($data['link']))
						<a href="{{ url('link') }}" class="btn btn-success">Thêm mới</a>
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
					<th>Đơn vị</th>
					<th style="width:15%;"></th>
				</tr>
				<?php $i=1; ?>
				<?php foreach($data['list_link'] as $ct){ ?>
					<tr>
						<td style="text-align:center;"><?php echo $i; ?></td>
						<td><?php echo $ct['link_name']; ?></td>
						<td style="text-align:center;">
							<a href="{{ asset('link?action=edit&id=').$ct['link_id'] }}"><button type="button" title="sửa" name="sua" class="btn btn-warning"><span class='glyphicon glyphicon-pencil'></span></button></a>
							<a href="{{ asset('link?action=delete&id=').$ct['link_id'] }}" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" title="xóa" name="xoa" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button></a>
						</td>
					</tr>
				<?php $i+=1; ?>
				<?php } ?>
			</table>
			<?php echo $data['list_link']->render(); ?>
			</td>
		<!--</div>-->
		</tr>
	</table>
</div>
@endsection