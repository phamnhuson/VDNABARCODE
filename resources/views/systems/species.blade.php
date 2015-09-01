@extends('templates.master')

@section('title', 'Species')

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
					<h1 id="title">QUẢN LÝ DANH MỤC LOÀI</h1>
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

				{!! Form::open(array('method' => (isset($data['species'])) ? 'PUT' : 'POST' )) !!}
					@if (isset($data['species']))
						<input type="hidden" name="species_id" value="{{ @$data['species'][0]['species_id'] }}" />
					@endif
					<div class="form-group">
						<label class="control-label">Chi:</label>					
						<select name="genus_id" class="form-control">
							<option>Chọn chi</option>
							<?php foreach($data['list_genus'] as $list){ ?>
								<option value="<?php echo $list['genus_id'] ?>" <?php echo (isset($data['species']) && $list['genus_id']==$data['species'][0]['genus_id'])?'selected':'' ?>><?php echo $list['genus_name'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">Tên loài:</label>
						{!! Form::text('species_name', @$data['species'][0]['species_name'], array('class'=>'form-control')) !!}
					</div>
					<div class="form-group">
						<label class="control-label">mô tả:</label>
						{!! Form::text('description', @$data['species'][0]['description'], array('class'=>'form-control')) !!}
					</div>				
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['species'])) Cập nhật @else Thêm @endif" />
						@if (isset($data['species']))
							<a href="{{ url('genus') }}" class="btn btn-success">Thêm mới</a>
						@endif
					</div>
				{!! Form::close() !!}
			</td>		
			<td class="col-lg-8" style="padding-right:0px;">
				<table class="table table-striped table-bordered">
					<tr>
						<th style="text-align:center !important;width:5%">STT</th>					
						<th style="width:20%">Tên loài</th>
						<th style="width:40%">Mô tả</th>
						<th style="width:20%">Tên chi</th>
						<th style="width:15%;"></th>
					</tr>
					<?php $i=1; ?>
					<?php foreach($data['list_species'] as $sptt){ ?>
						<tr>
							<td style="text-align:center;"><?php echo $i; ?></td>						
							<td><?php echo $sptt['species_name']; ?></td>
							<td><?php echo $sptt['description']; ?></td>
							<td><?php echo $sptt['genus_name']; ?></td>
							<td style="text-align:center;">
								<a href="{{ asset('species?action=edit&id=').$sptt['species_id'] }}"><button type="button" title="sửa" name="sua" class="btn btn-warning"><span class='glyphicon glyphicon-pencil'></span></button></a>
								<a href="{{ asset('species?action=delete&id=').$sptt['species_id'] }}" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" title="xóa" name="xoa" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button></a>
							</td>
						</tr>
					<?php $i+=1; ?>
					<?php } ?>
				</table>
				<?php echo $data['list_species']->render(); ?>
			</td>
		</tr>
	</table>
</div>
@endsection