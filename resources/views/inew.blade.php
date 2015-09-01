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
				</table>
				</br>
				<div class="row">
					{!! Form::textarea('content', @$data['new'][0]['content'], array('class'=>'form-control','rows'=>'4','cols'=>'1','id'=>'content')) !!}
				</div>
				</br>
				<div class="row">
					<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['new'])) Cập nhật bài viết @else Thêm bài viết @endif" />
					@if (isset($data['new']))
						<input type="hidden" class="form-control" name="id" value="{{$data['new'][0]['new_id']}}" />
					@endif
				</div>
				<hr style="border-top: 1px solid #CECECE"/>
				<div class="row">
					<table class="table table-bordered table_striped">
						<tr>
							<th style="text-align:center;width:60px;">STT</th>
							<th style="width:340px;">Tiêu đề bài viết</th>
							<th style="width:530px;">Nội dung tóm tắt</th>
							<th style="width:128px;"></th>
						</tr>
						<?php $i=1; ?>
						<?php foreach($data['list_new'] as $ln){ ?>
							<tr>
								<td style="text-align:center;"><?php echo $i++ ?></td>
								<td><?php echo $ln['subject'] ?></td>
								<td><?php echo $ln['summary'] ?></td>
								<td align="center">
									<a href="inew?action=edit&id={{ $ln['new_id'] }}" class="btn btn-default btn-xs" title="Sửa"><span class="glyphicon glyphicon-edit"></span> sửa</a>&nbsp;
									<a href="inew?action=delete&id={{ $ln['new_id'] }}" onClick="return confirm('Bạn có chắc muốn xóa?');" title="Xóa" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> xóa</a>
								</td>
							</tr>
						<?php } ?>
					</table>
					<?php echo $data['list_new']->render(); ?>
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
