@extends('templates.master')

@section('title', 'Barcode')

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
					<h1 id="title">QUẢN LÝ BARCODE</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-lg-12" style="padding:0px;">
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
			<div class="form-group">				
				<a href="{{ url('ibarcode') }}" class="btn btn-success">Thêm mới</a>
			</div>
			<table class="table table-striped table-bordered">
				<tr>
					<th style="text-align:center !important;width:5%">STT</th>
					<th style="width:10%">Barcode</th>					
					<th style="width:15%">Taxon_id</th>
					<th style="width:15%">Tên loài</th>
					<th style="width:15%">Tên khoa học</th>
					<th style="width:15%">Tên tiếng việt</th>
					<th style="width:10%">Chất lượng</th>
					<th style="width:15%;"></th>
				</tr>
				<?php $i=1; ?>
				<?php foreach($data['list_barcode'] as $bc){ ?>
					<tr>
						<td style="text-align:center;"><?php echo $i; ?></td>
						<td><?php echo $bc['barcode']; ?></td>		
						<td><?php echo $bc['taxon_id']; ?></td>
						<td><?php echo $bc['species_name']; ?></td>
						<td><?php echo $bc['scientific_name']; ?></td>
						<td><?php echo $bc['vietnamese_name']; ?></td>
						<td><?php echo $bc['quality']; ?></td>
						<td align="center">
							<a href="ibarcode?action=edit&id={{ $bc['barcode_id'] }}" class="btn btn-default btn-xs" title="Sửa"><span class="glyphicon glyphicon-edit"></span> sửa</a>&nbsp;
							<a href="?action=delete&id={{ $bc['barcode_id'] }}" onClick="return confirm('Bạn có chắc muốn xóa?');" title="Xóa" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> xóa</a>
						</td>
					</tr>
				<?php $i+=1; ?>
				<?php } ?>
			</table>
			<?php echo $data['list_barcode']->render(); ?>
		</div>
	</div>
	</br></br></br>
</div>
@endsection