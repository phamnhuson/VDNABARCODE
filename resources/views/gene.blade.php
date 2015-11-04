@extends('templates.master')

@section('title', 'Gene')

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
					<h1 id="title">QUẢN LÝ GENE</h1>
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
			{!! Form::open(array('method' => 'POST', 'enctype'=>'multipart/form-data', 'files' => true, 'class'	=> 'form-inline')) !!}
				<div class="form-group">
					<a href="{{ url('igene') }}" class="btn btn-success">Thêm mới</a>
					<label class="control-label"></label>
				</div>				
			{!! Form::close(); !!}
		</div>
		<div class="col-lg-12" style="padding:0px;">	
			<table class="table table-striped table-bordered">
				<tr>
					<th style="text-align:center !important;width:5%">STT</th>								
					<th style="width:15%">Sequence ID</th>
					<th style="width:20%">Project Name</th>
					<th style="width:18%">Gene Name</th>		
					<th style="width:15%">CDS</th>
					<th style="width:15%;">Function/Feature</th>
					<th style="width:11%;"></th>
				</tr>
				<?php $i=1; ?>
				<?php foreach($data['list_gene'] as $ge){ ?>
					<tr>
						<td style="text-align:center;"><?php echo $i; ?></td>								
						<td><?php echo $ge['sequence_id']; ?></td>
						<td><?php echo $ge['project_name']; ?></td>
						<td><?php echo $ge['gene_name']; ?></td>
						<td><?php echo $ge['cds']; ?></td>
						<td><?php echo $ge['function_feature']; ?></td>
						<td>							
							<?php if($data['role']=='3' || $ge['status']=='0'){ ?>
							<a href="igene?action=edit&id={{ $ge['sequence_id'] }}" class="btn btn-default btn-xs" title="Sửa"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
							<?php } ?>
							<?php if($data['role']=='3' || ($data['role']!='3' && $ge['status']=='0')){ ?>
							<a href="?action=delete&id={{ $ge['sequence_id'] }}" onClick="return confirm('Bạn có chắc muốn xóa?');" title="Xóa" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
							<?php } ?>							
							<?php if($data['role']=='3' && $ge['status']=='0'){ ?>
							<a style="margin-top:5px;" href="gene?action=accept&id={{ $ge['sequence_id'] }}" title="Duyệt" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok-sign"></span> Duyệt</a>
							<?php } ?>
						</td>
					</tr>
				<?php $i+=1; ?>
				<?php } ?>
			</table>
			<?php echo $data['list_gene']->render(); ?>
		</div>
	</div>
	</br></br></br>
</div>
@endsection