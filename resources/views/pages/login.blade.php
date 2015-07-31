
@extends('templates.master')

@section('title', 'Login')

@section('content')
<style type="text/css">
	#loginPanel {
		margin: 40px;
		padding: 20px;
		border: 1px solid #AAAAAA;
		display: inline-block;
	}
</style>
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 ></h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<table style="margin:auto;">
		<tr>
			<td>
				<div id="loginPanel">
				<p style="font-size:15px;"><b>Đăng nhập</b></p>
				<hr/>
				@if (Session::has('responseData'))
					@if (Session::get('responseData')['statusCode'] == 2)
						<div class="alert alert-danger">{{ Session::get('responseData')['message'] }}</div>
					@endif
				@endif
				
					{!! Form::open() !!}
						
						<div>
							<p>
								<label class="control-label">Email</label>
								<input type="text" class="form-control" style="width:300px;height:30px;" name="email" ><br>
							</p>
							<p>
								<label class="control-label">Password</label>
								<input type="password" class="form-control" style="width:300px;height:30px;" name="password">
							</p>
						</div>
						<br/>
						<p>
							<input id="loginButton" type="submit" value="Đăng nhập" name='login' class="btn btn-primary">
							<input type="hidden" name="destination" value="">
							<input type="hidden" name="loginType" value="">
						</p>
						
					{!! Form::close() !!}
					<!--<script type="text/javascript" language="JavaScript">
						$('input[name="name"]').focus();  //place cursor focus on username field
					</script>-->
				</div>
				<br/><br/><br/><br/><br/><br/>
			</td>
		</tr>
	</table>
</div>	
@endsection
