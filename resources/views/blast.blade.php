@extends('templates.master')

@section('content')
<div class="box">
	<div class="row">
		@if (!isset($blastResult))
		{!! Form::open(array('method'=>'POST', 'action'=>array('BlastController@blast'))) !!}
		<div class="col-md-12">
			<h3>Blast</h3>
			<hr/>
		</div>	
		<div class="col-md-12">	
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			
			
				<table width="100%" class="table borderless form-table">
					<tr>
						<td width="100" class="pdl-0">
							<label class="control-label">Tool</label>
							{!! Form::select('tool', array('blastn' => 'Blastn', 'tblastn' => 'tBlastn'), @$oldInput['tool'], array('class' => 'form-control')) !!}
						</td>
						<td width="100">
							<label class="control-label">Threadhold</label>
							{!! Form::text('threadshold', @$oldInput['threadshold'], array('class' => 'form-control')) !!}
						</td>
						<td width="100">
							<label class="control-label">Word size</label>
							{!! Form::select('wordsize', array('7' => '7', '11' => '11', '15' => '15'), @$oldInput['select'], array('class' => 'form-control')) !!}
						</td>
						<td width="100">
							<label class="control-label">Max target sequences</label>
							{!! Form::select('targetseqs', array('20' => '20', '50' => '50', '200' => '200', '500' => '500', '1000' => '1000'), @$oldInput['targetseqs'], array('class' => 'form-control')) !!}
						</td>
						<td width="100">
							<label class="control-label">Match/Mismatch scores</label>
							{!! Form::text('scores', @$oldInput['scores'], array('class' => 'form-control')) !!}
						</td>
					</tr>
				</table>
				
				
			
			
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Sequences</label>
				{!! Form::textarea('sequence', @$oldInput['sequence'], array('class' => 'form-control sequence-input validate-control validate-nu-sequence', 'rows' => 4, 'id' => 'onesequence')) !!}
				<p class="text-danger text-error"></p>
			</div>
		</div>	
		<div class="col-md-6">		
			<label class="control-label"><input type="checkbox" name="allowmore" onChange="document.getElementById('moresequence').disabled = !this.checked;document.getElementById('onesequence').disabled = this.checked;" /> Align two or more sequences</label>
			{!! Form::textarea('moresequence', @$oldInput['moresequence'], array('class' => 'form-control', 'rows' => 4, 'placeholder' => 'Fasta format', 'id' => 'moresequence', 'disabled' => 'true')) !!}
			<p class="text-danger text-error"></p>
		</div>
		<div class="col-md-12">
			{!! Form::submit('Blast', array('class' => 'btn btn-primary')) !!}
		</div>	
		{!! Form::close() !!}
	</div>
		
		@else
		<div class="col-md-12">
		
			<h3>Blast Results</h3>
			<hr/>
			@if (!empty($blastResult))
				<table class="table table-stripped table-bordered">
					<tr>
						<th>Species name</th>
						<th>Gene/locus</th>
						<th>Max Score</th>
						<th>Total Score</th>
						<th>Query cover</th>
						<th>Ident</th>
						<th>E-value</th>
						<th>Accession</th>
					</tr>
					@foreach ($blastResult AS $hit)
						<tr>
							<td><a href="#blast{{ $hit['itemId'] }}">{{ $hit['itemTitle'] }}</a></td>
							<td>{{ $hit['gene'] }}</td>
							<td>{{ $hit['maxScore'] }}</td>
							<td>{{ $hit['totalScore'] }}</td>
							<td>{{ $hit['queryCoverage'] }}</td>
							<td>{{ $hit['ident'] }}</td>
							<td>{{ $hit['evalue'] }}</td>
							<td><a href="{{ (isset($oldInput['allowmore']))?'#':url('viewbarcode?id='.$hit['itemId']) }}">{{ $hit['itemId'] }}</a></td>
						</tr>
					@endforeach
				</table>
				<br/>
				<h3>Alignments</h3>
				<hr/>
				@foreach ($blastResult AS $hit)
					<p>
					<a href="{{ (isset($oldInput['allowmore']))?'#':url('viewbarcode?id='.$hit['itemId']) }}" id="blast{{ $hit['itemId'] }}">{{ $hit['itemId'] }} - {{ $hit['itemTitle'] }}</a><br/>
					<b>Length:</b> {{ $hit['hitLength'] }},
					<b>Score:</b> {{ $hit['bitScore'] }} bits({{ $hit['maxScore'] }}),
					<b>Identities:</b> {{ $hit['ident'] }},
					<b>E-value:</b> {{ $hit['evalue'] }},
					<b>Gaps:</b> {{ $hit['gaps'] }}
					</p>
					<pre style="line-height:1;">@foreach ($hit['alignTop'] AS $k=>$top){{ str_pad('Query '.($hit['queryFrom']+(60)*$k), 10, ' ', STR_PAD_RIGHT) }} {{ $top }}   {{ ($k+1==$hit['totalLine'])?$hit['queryTo']:($hit['queryFrom']+(60*($k+1))-1) }}</br>           {{ $hit['alignMiddle'][$k] }}</br>{{ str_pad('Hit '.($hit['hitFrom']+($hit['hitSpace']*$k)), 10, ' ', STR_PAD_RIGHT) }} {{ $hit['alignBottom'][$k] }}   {{ ($k+1==$hit['totalLine'])?$hit['hitTo']:($hit['hitFrom']+($hit['hitSpace']*($k+1))-1) }}</br></br>@endforeach</pre>
				@endforeach
			@else
				Không có kết quả phù hợp
			@endif
			<br/><br/>
		</div>
		@endif	
	</div>
</div>	
@endsection