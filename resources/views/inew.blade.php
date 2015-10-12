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
					<h1 id="title">QUẢN LÝ BÀI VIẾT</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-md-12" style="padding:0px">
			<div class="nav-tabs-custom" style="margin-bottom: 0px; box-shadow:none;">
				<ul class="nav nav-tabs">
					<li class='active'>
						<a href="#tab1" data-toggle='tab' id='page1'>Cập nhật bài viết</a>
					</li>
					<li>
						<a href="#tab2" data-toggle='tab' id='page2'>Danh sách bài viết</a>
					</li>						
				</ul>
			</div>
		</div>				
	</div>
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
				<div class="tab-content col-md-12" style="padding:0px;">
					<div class="tab-pane active" id="tab1">
						</br>
						<table width="100%" class="form-table">
							<tr>
								<td class="col-lg-2" style="padding:0px;">
									<div class="form-group" >
										<div class="upanh" id="upanh_1" data_id="1">
											<a> 
												<img class='col-lg-12' style="padding:6px;border:2px dashed #0087F7;height:130px;width:140" id="img_1" src="@if (isset($data['new'])){{asset('public/uploads/img/new_'.$data['new'][0]['new_id'].'.jpg')}}@else{{asset('public/img/add.png')}}@endif" alt="Chọn mẫu vật" />										
											</a>									
										</div>
										<div id="btx_1">
										</div>								
										{!! Form::file('images', array('class'=>'form-control imgInp','style'=>'display:none;','id'=>'imgInp_1','data_id'=>'1')) !!}
									</div>				
								</td>
								<td class="col-lg-10" style="padding:0px;">
									<div class="row">
										<div class="form-group" >
										{!! Form::text('subject', @$data['new'][0]['subject'], array('class'=>'form-control','placeholder'=>'Tiêu đề')) !!}
										</br>
										{!! Form::textarea('summary', @$data['new'][0]['summary'], array('class'=>'form-control','rows'=>'3','placeholder'=>'Nội dung tóm tắt')) !!}
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									{!! Form::textarea('content', @$data['new'][0]['content'], array('class'=>'form-control','rows'=>'4','cols'=>'1','id'=>'content')) !!}
								</td>								
							</tr>
							<tr>
								<td colspan="2">
									<div class="col-lg-4" style="padding:0px;">
										<a href="inew"><button type="button" class="btn btn-primary">Thêm bài viết mới</button></a>
										<input type="submit" name="submit" class="btn btn-success" value="Gửi bài viết" />						
									</div>
									<div class="col-lg-8" style="padding:0px;">
									{!! Form::file('file', array('class'=>'form-control')) !!}
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div class="tab-pane" id="tab2">
						<table class="table table-bordered table_striped">
							<tr>
								<th style="text-align:center;width:5%px;">STT</th>
								<th style="width:70%;">Tiêu đề bài viết</th>
								<th style="text-align:center;width:10%;">File</th>
								<th style="width:15%;"></th>
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
										<a href="inew?action=edit&id={{ $ln['new_id'] }}" class="btn btn-default btn-xs" title="Sửa"><span class="glyphicon glyphicon-edit"></span> sửa</a>&nbsp;
										<a href="inew?action=delete&id={{ $ln['new_id'] }}" onClick="return confirm('Bạn có chắc muốn xóa?');" title="Xóa" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> xóa</a>
									</td>
								</tr>
							<?php } ?>
						</table>
						<?php echo $data['list_new']->render(); ?>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	</br></br></br>
</div>

<script type="text/javascript">
	$url=	{!! json_encode(url('/')) !!}
	var editor = CKEDITOR.replace( 'content',
		{
			filebrowserBrowseUrl : $url+'/public/ckfinder/ckfinder.html',

			filebrowserImageBrowseUrl : $url+'/public/ckfinder/ckfinder.html?type=Images',

			filebrowserFlashBrowseUrl : $url+'/public/ckfinder/ckfinder.html?type=Flash',

			filebrowserUploadUrl : $url+'/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

			filebrowserImageUploadUrl : $url+'/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

			filebrowserFlashUploadUrl : $url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
		}
	);
	CKFinder.setupCKEditor( editor, '../' ) ;

	$(document).ready(function(){			
		function readURL(input, bien) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#' + bien).attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$(document).on('change','.imgInp',function(){		
			$data_id = $(this).attr('data_id');		
			readURL(this, 'img_'+$data_id);
		});
		
		$(document).on('click','.upanh',function(){
			$data_id = $(this).attr('data_id');		
			$('#imgInp_'+$data_id).click();
		})
	});	
</script>
@endsection
