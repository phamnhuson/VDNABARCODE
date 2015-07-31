@extends('templates.master')

@section('title', 'Genus')

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
					<h1 id="title">QUẢN LÝ DANH MỤC CHI</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-lg-4" style="padding-left:0px;">
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

			{!! Form::open(array('method' => (isset($data['genus'])) ? 'PUT' : 'POST' )) !!}
				@if (isset($data['genus']))
					<input type="hidden" name="genus_id" value="{{ @$data['genus'][0]['genus_id'] }}" />
				@endif
				<div class="form-group">
					<label class="control-label">Họ:</label>					
					<select name="family_id" class="form-control">
						<option>Chọn họ</option>
						<?php foreach($data['list_family'] as $list){ ?>
							<option value="<?php echo $list['family_id'] ?>" <?php echo (isset($data['genus']) && $list['family_id']==$data['genus'][0]['family_id'])?'selected':'' ?>><?php echo $list['family_name'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Tên chi:</label>
					{!! Form::text('genus_name', @$data['genus'][0]['genus_name'], array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">mô tả:</label>
					{!! Form::text('description', @$data['genus'][0]['description'], array('class'=>'form-control')) !!}
				</div>				
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['genus'])) Cập nhật @else Thêm @endif" />
					@if (isset($data['genus']))
						<a href="{{ url('genus') }}" class="btn btn-success">Thêm mới</a>
					@endif
				</div>
			{!! Form::close() !!}
		</div>		
		<div class="col-lg-8" style="padding-right:0px;">
			<table class="table table-striped table-bordered">
				<tr>
					<th style="text-align:center !important;width:5%">STT</th>
					<th style="width:20%">Tên chi</th>
					<th style="width:40%">Mô tả</th>
					<th style="width:20%">Tên họ</th>
					<th style="width:15%;"></th>
				</tr>
				<?php $i=1; ?>
				<?php foreach($data['list_genus'] as $gntt){ ?>
					<tr>
						<td style="text-align:center;"><?php echo $i; ?></td>						
						<td><?php echo $gntt['genus_name']; ?></td>
						<td><?php echo $gntt['description']; ?></td>
						<td><?php echo $gntt['family_name']; ?></td>
						<td style="text-align:center;">
							<a href="{{ asset('genus?action=edit&id=').$gntt['genus_id'] }}"><button type="button" title="sửa" name="sua" class="btn btn-warning"><span class='glyphicon glyphicon-pencil'></span></button></a>
							<a href="{{ asset('genus?action=delete&id=').$gntt['genus_id'] }}" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" title="xóa" name="xoa" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button></a>
						</td>
					</tr>
				<?php $i+=1; ?>
				<?php } ?>
			</table>
			<?php echo $data['list_genus']->render(); ?>
		</div>
	</div>
</div>
@endsection