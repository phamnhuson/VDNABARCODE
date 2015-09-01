@extends('templates.master')

@section('title', 'Family')

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
					<h1 id="title">QUẢN LÝ DANH MỤC HỌ</h1>
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

				{!! Form::open(array('method' => (isset($data['family'])) ? 'PUT' : 'POST' )) !!}
					@if (isset($data['family']))
						<input type="hidden" name="family_id" value="{{ @$data['family'][0]['family_id'] }}" />
					@endif
					<div class="form-group">
						<label class="control-label">Bộ:</label>					
						<select name="order_id" class="form-control">
							<option>Chọn bộ</option>
							<?php foreach($data['list_order'] as $list){ ?>
								<option value="<?php echo $list['order_id'] ?>" <?php echo (isset($data['family']) && $list['order_id']==$data['family'][0]['order_id'])?'selected':'' ?>><?php echo $list['order_name'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Tên họ:</label>
						{!! Form::text('family_name', @$data['family'][0]['family_name'], array('class'=>'form-control')) !!}
					</div>
					<div class="form-group">
						<label class="control-label">mô tả:</label>
						{!! Form::text('description', @$data['family'][0]['description'], array('class'=>'form-control')) !!}
					</div>				
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['family'])) Cập nhật @else Thêm @endif" />
						@if (isset($data['family']))
							<a href="{{ url('family') }}" class="btn btn-success">Thêm mới</a>
						@endif
					</div>
				{!! Form::close() !!}
			</td>		
			<td class="col-lg-8" style="padding-right:0px;">
				<table class="table table-striped table-bordered">
					<tr>
						<th style="text-align:center !important;width:5%">STT</th>
						<th style="width:20%">Tên họ</th>
						<th style="width:40%">Mô tả</th>
						<th style="width:20%">Tên bộ</th>
						<th style="width:15%;"></th>
					</tr>
					<?php $i=1; ?>
					<?php foreach($data['list_family'] as $fmltt){ ?>
						<tr>
							<td style="text-align:center;"><?php echo $i; ?></td>						
							<td><?php echo $fmltt['family_name']; ?></td>
							<td><?php echo $fmltt['description']; ?></td>
							<td><?php echo $fmltt['order_name']; ?></td>
							<td style="text-align:center;">
								<a href="{{ asset('family?action=edit&id=').$fmltt['family_id'] }}"><button type="button" title="sửa" name="sua" class="btn btn-warning"><span class='glyphicon glyphicon-pencil'></span></button></a>
								<a href="{{ asset('family?action=delete&id=').$fmltt['family_id'] }}" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" title="xóa" name="xoa" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button></a>
							</td>
						</tr>
					<?php $i+=1; ?>
					<?php } ?>
				</table>
				<?php echo $data['list_family']->render(); ?>
			</td>
		</tr>
	</table>
</div>
@endsection