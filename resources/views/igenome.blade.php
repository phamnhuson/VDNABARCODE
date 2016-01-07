@extends('templates.master')

@section('title', 'Ngân hàng dữ liệu DNA Việt Nam - Genome')

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
					<h1 id="title">Genome</h1>
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

				{!! Form::open(array('method' => (isset($data['genome'])) ? 'PUT' : 'POST' )) !!}
					@if (isset($data['genome']))
						<input type="hidden" name="genome_id" value="{{ @$data['genome'][0]['id'] }}" />
					@endif
					<div class="form-group">
						<label class="control-label">Kingdom:</label>					
						<select name="kingdom" class="form-control">
							<option>Select Kingdom</option>
							<?php foreach($data['list_kingdom'] as $kd){ ?>
								<option value="<?php echo $kd['kingdom_id'] ?>" <?php echo (isset($data['genome']) && $kd['kingdom_id']==$data['genome'][0]['kingdom'])?'selected':'' ?>><?php echo $kd['kingdom_name'] ?></option>
							<?php } ?>
						</select>
					</div>	
					<div class="form-group">
						<label class="control-label">Title:</label>
						{!! Form::text('title', @$data['genome'][0]['title'], array('class'=>'form-control')) !!}
					</div>
					<div class="form-group">
						<label class="control-label">Link:</label>
						{!! Form::text('url', @$data['genome'][0]['url'], array('class'=>'form-control')) !!}
					</div>				
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['genome'])) Update @else Add new @endif" />
						@if (isset($data['genome']))
							<a href="{{ url('igenome') }}" class="btn btn-success">New Genome</a>
						@endif
					</div>
				{!! Form::close() !!}
			</td>		
			<td class="col-lg-8" style="padding-right:0px;">
				<table class="table table-striped table-bordered">
					<tr>
						<th style="text-align:center !important;width:5%">STT</th>
						<th style="width:30%">Genome Title</th>
						<th style="width:50%">Link</th>
						<th style="width:15%;"></th>
					</tr>
					<?php $i=1; ?>
					<?php foreach($data['list_genome'] as $genome){ ?>
						<tr>
							<td style="text-align:center;"><?php echo $i; ?></td>						
							<td><?php echo $genome['title']; ?></td>
							<td><?php echo $genome['url']; ?></td>
							<td style="text-align:center;">
								<a href="{{ asset('igenome?action=edit&id=').$genome['id'] }}"><button type="button" title="sửa" name="sua" class="btn btn-warning"><span class='glyphicon glyphicon-pencil'></span></button></a>
								<a href="{{ asset('igenome?action=delete&id=').$genome['id'] }}" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" title="xóa" name="xoa" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button></a>
							</td>
						</tr>
					<?php $i+=1; ?>
					<?php } ?>
				</table>
				<?php echo $data['list_genome']->render(); ?>
			</td>
		</tr>
	</table>
</div>
@endsection