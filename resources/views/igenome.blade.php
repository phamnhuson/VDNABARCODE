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
	#lightbox .modal-content {
    display: inline-block;
    text-align: center;   
}

	#lightbox .close {
		opacity: 1;
		color: rgb(255, 255, 255);
		background-color: rgb(25, 25, 25);
		padding: 5px 8px;
		border-radius: 30px;
		border: 2px solid rgb(255, 255, 255);
		position: absolute;
		top: -15px;
		right: -55px;
		
		z-index:1032;
	}
	h4{
		#000 !important;
		margin:0px;
	}
	.panel-default{
		border-color: #B5D2FF !important;
	}
	.panel-heading{
		background-color: #fff !important;
		border-color: #B5D2FF !important;
	}
	.panel-body table td{
		padding:5px;
		border-bottom: 1px solid #eee;
	}
	.tbl th{
		background:#F5F5F5;
	}
	td{
		font-size:10pt;
	}
	.form-control2{		
		height:28px !important;
		border:1px solid #aaa;
		border-radius:4px;
		padding:4px;
	}

}
</style>
<!--<script src="{{ asset('public/js/google_map.js') }}"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 id="title">CẬP NHẬT DỮ LIỆU GENOME</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<div class="row">
		
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
		</br>
		{!! Form::open(array('method' => 'PUT')) !!}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="tab-content col-md-12" style="padding:0px;">
				<div class="tab-pane active" id="tab1">
					<table class="col-lg-6 col-md-6">
						<tr>
							<td>
								<table width="100%" class="table table-bordered tbl">
									<tr>
										<th>Kingdom</th>
										<th>Link</th>
									</tr>
									@foreach ($genome AS $geno)
									<tr>
										<td>{{ $geno['kingdom_name'] }}</td>
										<td><input type="text" class="form-control" name="url[{{ $geno['id'] }}]" value="{{ $geno['url'] }}" /></td>
									</tr>
									@endforeach
								</table>
							</td>
						</tr>						
					</table>					
				</div>
				
			</div>
			<div class="form-group">
				<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Cập nhật" />
			</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection