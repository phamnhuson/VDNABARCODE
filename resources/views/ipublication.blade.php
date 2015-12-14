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
					<h1 id="title">SUBMIT FORM FOR PUBLICATION</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<br/>
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
			{!! Form::open(array('method' => (isset($data['new'])) ? 'PUT' : 'POST', 'enctype'=>'multipart/form-data', 'files' => true)) !!}
				@if (isset($data['new']))
					<input type="hidden" class="form-control" name="id" value="{{$data['new'][0]['new_id']}}" />
				@endif
						<table style="width:100%" class="form-table">
							<tr>
								<td width="400">
									<table>
										<tr>
											<td class="col-lg-10" style="padding:0px;">
												{!! Form::textarea('subject', @$data['new'][0]['subject'], array('class'=>'form-control','rows'=>'3','placeholder'=>'Tiêu đề')) !!}
												<br>
											</td>
										</tr>
										<tr>
											<td>
												{!! Form::textarea('summary', @$data['new'][0]['summary'], array('class'=>'form-control','rows'=>'5','placeholder'=>'Nội dung tóm tắt')) !!}
											</td>
										</tr>
										<tr>
											<td>
												{!! Form::text('keyword', @$data['new'][0]['keyword'], array('class'=>'form-control','placeholder'=>'Từ khóa tìm kiếm')) !!}
											</td>
										</tr>
										<tr>
											<td>
												{!! Form::file('file', array('class'=>'form-control')) !!}
											</td>
										</tr>
										<tr>
											<td>
												<a href="inew"><button type="button" class="btn btn-primary">Thêm mới</button></a>
												<input type="submit" name="submit" class="btn btn-success" value="Gửi" />
											</td>
										</tr>
									</table>
								</td>
								<td style="padding-left:20px">
									<table class="table table-bordered table_striped">
										<tr>
											<th style="text-align:center;width:7%px;">STT</th>
											<th style="width:55%;">Tiêu đề bài viết</th>
											<th style="text-align:center;width:15%;">File</th>
											<th style="width:23%;"></th>
										</tr>
										<?php $i=1; ?>
										<?php foreach($data['list_new'] as $ln){ ?>
											<tr>
												<td style="text-align:center;"><?php echo $i++ ?></td>
												<td><?php echo $ln['subject'] ?></td>
												<td style="text-align:center;">
													<?php if($ln['new_file']!=null){ ?>
													<a href="/public/uploads/file/news/<?php echo $ln['new_file']?>/" target="_blank">tải file</a>
													<?php } ?>
												</td>
												<td align="center">
													@if (Auth::check() && Auth::user()->role==3 && $ln['status']==0)
													<a href="ipublication?action=active&id={{ $ln['new_id'] }}" class="btn btn-success btn-xs" title="Duyệt">&nbsp;<span class="glyphicon glyphicon-ok"></span>&nbsp;</a>&nbsp;
													@endif
													<a href="ipublication?action=edit&id={{ $ln['new_id'] }}" class="btn btn-default btn-xs" title="Sửa">&nbsp;<span class="glyphicon glyphicon-edit"></span>&nbsp;</a>&nbsp;
													<a href="ipublication?action=delete&id={{ $ln['new_id'] }}" onClick="return confirm('Bạn có chắc muốn xóa?');" title="Xóa" class="btn btn-danger btn-xs">&nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;</a>
												</td>
											</tr>
										<?php } ?>
									</table>
									<?php echo $data['list_new']->render(); ?>
								</td>
							</tr>
						</table>
			{!! Form::close() !!}
		</div>
	</div>
	</br></br></br>
</div>

@endsection
