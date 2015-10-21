@extends('templates.master')
@section('title', 'Quản lý tài khoản')
@section('content')
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 class="page-title">Quản lý tài khoản</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	
	<div class="row">
		<div class="col-md-4">
		
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
			
			{!! Form::open(array('method' => (isset($user)) ? 'PUT' : 'POST' )) !!}
				@if (isset($user))
					<input type="hidden" name="id" value="{{ @$user['id'] }}" />
				@endif	
				<div class="form-group">
					<label class="control-label">Họ tên</label>
					{!! Form::text('fullname', @$user['fullname'], array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">Email</label>
					{!! Form::text('email', @$user['email'], array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">Số điện thoại</label>
					{!! Form::text('phone', @$user['phone'], array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">Tên tài khoản</label>
					{!! Form::text('user_name', @$user['user_name'], array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">Mật khẩu</label>
					{!! Form::password('password', array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">Nhập lại mật khẩu</label>
					{!! Form::password('repassword', array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">Loại tài khoản</label>
					{!! Form::select('role', $roles, @$user['role'], array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">Thứ tự ưu tiên</label>
					{!! Form::text('priority', @$user['priority'], array('class'=>'form-control')) !!}
				</div>
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($user)) Cập nhật @else Thêm @endif" />
					@if (isset($user))
						<a href="{{ url('user') }}" class="btn btn-link">Thêm mới</a>
					@endif
				</div>
			{!! Form::close() !!}
		</div>	
		<div class="col-md-8">
			<table class="table table-stripped table-bordered" style="background:#fff;margin-bottom:0;">
				<tr>
					<th>ID</th>
					<th>Họ tên</th>
					<th>Email</th>
					<th>Điện thoại</th>
					<th style="width:190px"></th>
				</tr>
				@foreach ($users AS $k=>$user)
					<tr>
						<td>{{ $user['id'] }}</td>
						<td>{{ $user['fullname'] }}</td>
						<td>{{ $user['email'] }}</td>
						<td>{{ $user['phone'] }}</td>
						<td align="center">
						<?php if($user['role']!=3 && $user['role']!=1){ ?>
						<a href="?action=accept&id={{ $user['id'] }}" class="btn btn-success btn-xs" title="Duyệt"><span class="glyphicon glyphicon-ok-sign"></span> duyệt</a>
						<?php } ?>
						<a href="?action=edit&id={{ $user['id'] }}" class="btn btn-default btn-xs" title="Sửa"><span class="glyphicon glyphicon-edit"></span> sửa</a>						
						<a href="?action=delete&id={{ $user['id'] }}" onClick="return confirm('Bạn có chắc muốn xóa?');" title="Xóa" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> xóa</a></td>
					</tr>
				@endforeach
			</table>
			{!! $users->render() !!}
		</div>
	</div>
</div>
@endsection