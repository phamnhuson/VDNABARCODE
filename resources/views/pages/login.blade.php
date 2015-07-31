
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
	<table>
		<tr>
			<td>
				<div id="loginInfo">
					<h1 style="margin-top:0px;">Barcode of Life Data Systems</h1>
					<h3>Workbench for DNA Barcoding Data</h3>
					<ul>
						<li>Manage</li>
						<li> Archive</li>
						<li>Mine</li>
						<li>Analyze</li>
						<li>Publish</li>
						<li>Share</li>
					</ul>

					<p>&nbsp;</p>
					<h4 style="width:500px;"><em>Advancing Species Identification and Discovery</em></h4>

				</div>
			</td>
			<td>
				<div id="loginPanel">
				@if (!empty($erv))
					<div class="alert alert-danger">
						<strong>Whoops!</strong> There were some problems with your input.<br><br>
						<ul>
							@foreach ($erv as $error)
								<li>{{ $error[0] }}</li>
							@endforeach
						</ul>
					</div>
				@endif
					<form id="loginForm" name="loginForm" method="POST" action='login'>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div>
							<p>
								Email<br>
								<input type="text" style="width:241px;height:30px;" name="email" ><br>
							</p>
							<p>
								Password<br>
								<input type="password" style="width:241px;height:30px;" name="password">
							</p>
						</div>
						<p>
							<input id="loginButton" type="submit" value="Log In" name='login' class="btn btn-warning">
							<input type="hidden" name="destination" value="">
							<input type="hidden" name="loginType" value="">
						</p>
						<a href="/index.php/MAS_Management_ForgotPassword">Forgot your password?</a><br/>
						<a class="popup-medium" href="/index.php/MAS_Management_NewUserApp">Create Account</a>
					</form>
					<!--<script type="text/javascript" language="JavaScript">
						$('input[name="name"]').focus();  //place cursor focus on username field
					</script>-->
				</div>
			</td>
		</tr>
	</table>
</div>	
@endsection
