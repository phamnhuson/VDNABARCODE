@extends('templates.master')

@section('content')
<div class="box">
	<div class="row">
		<div class="col-md-5">
			<h3>Blast trình tự</h3>
			<hr/>
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			
			{!! Form::open(array('method'=>'POST', 'action'=>array('BlastController@blast'))) !!}
				<div class="form-group">
					<label class="control-label">Công cụ</label>
					{!! Form::select('tool', array('blastn' => 'Blastn', 'tblastn' => 'tBlastn'), null, array('class' => 'form-control w-200')) !!}
				</div>
				
				<div class="form-group">
					<label class="control-label">Trình tự</label>
					{!! Form::textarea('sequence', null, array('class' => 'form-control', 'rows' => 5)) !!}
				</div>
				{!! Form::submit('Tìm kiếm', array('class' => 'btn btn-primary')) !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>	
@endsection