@extends('templates.master')

@section('title', 'Class')

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
					<h1 id="title">QUẢN LÝ PHÂN LỚP</h1>
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

			{!! Form::open(array('method' => (isset($data['class'])) ? 'PUT' : 'POST' )) !!}
				@if (isset($data['class']))
					<input type="hidden" name="class_id" value="{{ @$data['class'][0]['class_id'] }}" />
				@endif
				<div class="form-group">
					<label class="control-label">Ngành:</label>					
					<select name="phylum_id" class="form-control">
						<option>Chọn ngành</option>
						<?php foreach($data['list_phylum'] as $pl){ ?>
							<option value="<?php echo $pl['phylum_id'] ?>" <?php echo (isset($data['class']) && $pl['phylum_id']==$data['class'][0]['phylum_id'])?'selected':'' ?>><?php echo $pl['phylum_name'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Tên lớp:</label>
					{!! Form::text('class_name', @$data['class'][0]['class_name'], array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">mô tả:</label>
					{!! Form::text('description', @$data['class'][0]['description'], array('class'=>'form-control')) !!}
				</div>				
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['class'])) Cập nhật @else Thêm @endif" />
					@if (isset($data['class']))
						<a href="{{ url('class') }}" class="btn btn-success">Thêm mới</a>
					@endif
				</div>
			{!! Form::close() !!}
		</div>		
		<div class="col-lg-8" style="padding-right:0px;">
			<table class="table table-striped table-bordered">
				<tr>
					<th style="text-align:center !important;width:5%">STT</th>
					<th style="width:20%">Tên lớp</th>
					<th style="width:40%">Mô tả</th>
					<th style="width:20%">Tên ngành</th>
					<th style="width:15%;"></th>
				</tr>
				<?php $i=1; ?>
				<?php foreach($data['list_class'] as $cltt){ ?>
					<tr>
						<td style="text-align:center;"><?php echo $i; ?></td>						
						<td><?php echo $cltt['class_name']; ?></td>
						<td><?php echo $cltt['description']; ?></td>
						<td><?php echo $cltt['phylum_name']; ?></td>
						<td style="text-align:center;">
							<a href="{{ asset('class?action=edit&id=').$cltt['class_id'] }}"><button type="button" title="sửa" name="sua" class="btn btn-warning"><span class='glyphicon glyphicon-pencil'></span></button></a>
							<a href="{{ asset('class?action=delete&id=').$cltt['class_id'] }}" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" title="xóa" name="xoa" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button></a>
						</td>
					</tr>
				<?php $i+=1; ?>
				<?php } ?>
			</table>
			<?php echo $data['list_class']->render(); ?>
		</div>
	</div>
</div>
@endsection