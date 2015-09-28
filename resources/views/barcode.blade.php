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
		</div>
		<div class="col-lg-12" style="padding:0px;">			
			{!! Form::open(array('method' => 'POST', 'action'=>array('IbarcodeController@importFromFile'), 'enctype'=>'multipart/form-data', 'files' => true, 'class'	=> 'form-inline')) !!}
				<div class="form-group">
					<a href="{{ url('ibarcode') }}" class="btn btn-success">Thêm mới</a>
					<label class="control-label">&nbsp;&nbsp;hoặc&nbsp;&nbsp;</label>
				</div>
				<div class="form-group">				
					{!! Form::file('tsv'); !!}
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span> Nhập dữ liệu</button>
				</div>	
			{!! Form::close(); !!}
		</div>
		<div class="col-lg-12" style="padding:0px;">	
			<table class="table table-striped table-bordered">
				<tr>
					<th style="text-align:center !important;width:5%">STT</th>								
					<th style="width:13%">Gene</th>
					<th style="width:20%">Sequence ID</th>
					<th style="width:15%">GenBank Accession</th>		
					<!--<th style="width:15%">Taxon ID</th>-->
					<th style="width:30%">Species</th>
					<th style="width:17%;"></th>
				</tr>
				<?php $i=1; ?>
				<?php foreach($data['list_barcode'] as $bc){ ?>
					<tr>
						<td style="text-align:center;"><?php echo $i; ?></td>								
						<td><?php echo $bc['gene']; ?></td>
						<td><?php echo $bc['sequence_id']; ?></td>
						<td><?php echo $bc['genbank_accession']; ?></td>
						<!--<td><?php echo $bc['taxon_id']; ?></td>-->
						<td><?php echo $bc['species_name']; ?></td>
						<td align="center">
							<?php if($data['role']=='3' && $bc['status']=='0'){ ?>
							<a href="accept?id={{ $bc['barcode_id'] }}" title="Duyệt" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-sign"></span> Duyệt</a>
							<?php } ?>
							<?php if($data['role']=='3' || $bc['status']=='0'){ ?>
							<a href="ibarcode?action=edit&id={{ $bc['barcode_id'] }}" class="btn btn-default btn-xs" title="Sửa"><span class="glyphicon glyphicon-edit"></span> sửa</a>
							<?php } ?>
							<?php if($data['role']=='3'){ ?>
							<a href="?action=delete&id={{ $bc['barcode_id'] }}" onClick="return confirm('Bạn có chắc muốn xóa?');" title="Xóa" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> xóa</a>
							<?php } ?>
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