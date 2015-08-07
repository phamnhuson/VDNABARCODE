@extends('templates.master')
@section('content')
<div id="subheader" style="height:49px;">
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tbody><tr>
				<td>
					<h1 class="page-title">Lịch sử lỗi</h1>
				</td>
			</tr>
		</tbody></table>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-md-12">
			<textarea class="form-control" rows="15">{{ $logContent }}</textarea>
			<br/>
			{!! Form::open(array('method'=>'POST', 'action'=>array('ErrorController@clear'))) !!}
				<input type="submit" name="submit" class="btn btn-primary pull-right" value="Xóa lịch sử" />
			{!! Form::close() !!}
		</div>
	</div>	
</div>
@endsection