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
				<table width="100%" class="form-table">
					<tr>
						<td><label class="control-label">Công cụ</label></td>
						<td>{!! Form::select('tool', array('blastn' => 'Blastn', 'tblastn' => 'tBlastn'), null, array('class' => 'form-control')) !!}</td>
					</tr>
					<tr>
						<td><label class="control-label">Threadhold</label></td>
						<td>{!! Form::text('threadshold', null, array('class' => 'form-control')) !!}</td>
					</tr>
					<tr>
						<td><label class="control-label">Word size</label></td>
						<td>{!! Form::select('wordsize', array('7' => '7', '11' => '11', '15' => '15'), null, array('class' => 'form-control')) !!}</td>
					</tr>
					<tr>
						<td><label class="control-label">Max target sequences</label></td>
						<td>{!! Form::select('targetseqs', array('20' => '20', '50' => '50', '200' => '200', '500' => '500', '1000' => '1000'), null, array('class' => 'form-control')) !!}</td>
					</tr>
					<tr>
						<td><label class="control-label">Match/Mismatch scores</label></td>
						<td>{!! Form::text('scores', null, array('class' => 'form-control')) !!}</td>
					</tr>
				</table>
				
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