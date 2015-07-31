@extends('templates.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h3>Liên hệ</h3>
			<hr/>
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
			
			{!! Form::open(array('method'=>'POST', 'action'=>array('ContactController@store'))) !!}
				<div class="form-group">
					<label class="control-label">Tiêu đề</label>
					{!! Form::text('subject', null, array('class' => 'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">Email</label>
					{!! Form::text('email', null, array('class' => 'form-control')) !!}
				</div>
				<div class="form-group">
					<label class="control-label">Nội dung</label>
					{!! Form::textarea('content', null, array('class' => 'form-control', 'rows' => 5)) !!}
				</div>
				{!! Form::submit('Gửi', array('class' => 'btn btn-primary')) !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>	
@endsection