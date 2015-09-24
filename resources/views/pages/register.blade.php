@extends('templates.master')

@section('title', 'Kingdom')

@section('content')
<style type="text/css">
	#title {
		margin-top:7px;
	}
	.row{
		margin:0px;
		margin-bottom:5px;
	}
	#register{
		padding: 20px;
		border: 1px solid #AAAAAA;
	}
</style>
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 id="title">Tạo tài khoản</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<table style="width:100%" class="form-table">
		<tr>
			<td class="col-lg-6" style="padding-left:0px;">
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

				{!! Form::open(array('method' => (isset($data['user'])) ? 'PUT' : 'POST', 'enctype'=>'multipart/form-data', 'files' => true )) !!}
				@if (isset($data['user']))
					<input type="hidden" name="user_id" value="{{ @$data['user'][0]['id'] }}" />
				@endif	
				<table id="">
				<tr>
					<td class="col-lg-8" style="padding-top:15px;padding-left:0px;">
						<div class="form-group">
							<label class="control-label">Tên người dùng:</label>
							{!! Form::text('fullname', @$data['user'][0]['fullname'], array('class'=>'form-control')) !!}
						</div>
						<?php if(isset($data['user'])){ ?>
						<div class="form-group">
							<label class="control-label">Email:</label>
							{!! Form::text('email', @$data['user'][0]['email'], array('class'=>'form-control','readonly')) !!}
						</div>	
						<?php }else{ ?>
						<div class="form-group">
							<label class="control-label">Email:</label>
							{!! Form::text('email', @$data['user'][0]['email'], array('class'=>'form-control')) !!}
						</div>
						<?php } ?>
						<div class="form-group">
							<label class="control-label">Số điện thoại:</label>
							{!! Form::text('phone', @$data['user'][0]['phone'], array('class'=>'form-control')) !!}
						</div>
						<div class="form-group">
							<label class="control-label">Nơi công tác:</label>
							{!! Form::text('work_place', @$data['user'][0]['work_place'], array('class'=>'form-control')) !!}
						</div>
						<div class="form-group">
							<label class="control-label">Lĩnh vực nghiên cứu:</label>
							{!! Form::text('research', @$data['user'][0]['research'], array('class'=>'form-control')) !!}
						</div>
						<?php if(isset($data['user'])){ ?>
							<div class="form-group">
								<label class="control-label">Mật khẩu cũ:</label>
								{!! Form::text('password_old', null, array('class'=>'form-control')) !!}
							</div>
						<?php } ?>
						<div class="form-group">
							<label class="control-label">Mật khẩu:</label>
							{!! Form::text('password', null, array('class'=>'form-control')) !!}
						</div>
						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-primary"  value="@if (isset($data['user'])) Cập nhật tài khoản @else Tạo tài khoản @endif" />
						</div>
					</td>
					<td class="col-lg-4" style="padding-top:15px">
						<div class="form-group" >
							<div id="upanh">
								<a> 
									<img class='col-md-12' style="padding:6px;border:2px dashed #0087F7;height:200px;width:150" id="img" 
								    <?php if(isset($data['user'])){ ?> src="{{asset('public/uploads/img/avata_'.$data['user'][0]['id'].'.jpg')}}" <?php }else{ ?> src="{{asset('public/img/add.png')}}"<?php } ?> alt="Chọn ảnh" />
									
								</a>									
							</div>			
							{!! Form::file('avata', array('class'=>'form-control','style'=>'display:none;','id'=>'imgInp')) !!}
						</div>
					</td>
				</tr>
				</table>
				{!! Form::close() !!}
			</td>		
			<td class="col-lg-8" style="padding-right:0px;">
				
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">

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
	
	$(document).on('change','#imgInp',function(){
        readURL(this, 'img');
    });

	$(document).on('click','#upanh a',function(){
		$('#imgInp').click();
	});
});
</script>

@endsection