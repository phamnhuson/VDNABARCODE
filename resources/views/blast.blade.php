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
				{!! Form::textarea('sequence', @$oldInput['sequence'], array('class' => 'form-control sequence-input validate-control validate-nu-sequence', 'rows' => 4, 'required' => 'true')) !!}
				<p class="text-danger text-error"></p>
			</div>
		</div>	
		<div class="col-md-6">		
			<label class="control-label"><input type="checkbox" name="allowmore" onChange="document.getElementById('moresequence').disabled = !this.checked;" /> Align two or more sequences</label>
			{!! Form::textarea('moresequence', @$oldInput['moresequence'], array('class' => 'form-control validate-control validate-fasta', 'rows' => 4, 'placeholder' => 'Fasta format', 'id' => 'moresequence', 'disabled' => 'true')) !!}
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
			@if (isset($blastResult['BlastOutput_iterations']) && !empty($blastResult['BlastOutput_iterations']['Iteration']['Iteration_hits']))
			<table class="table table-stripped table-bordered">
				<tr>
					<th>Description</th>
					<th>Score</th>
					<th>Max Score</th>
					<th>Query cover</th>
					<th>Ident</th>
					<th>E-value</th>
					<th>Accession</th>
				</tr>
				@if (isset($blastResult['BlastOutput_iterations']['Iteration']['Iteration_hits']['Hit'][0]))
					{{-- */ $maxScore = 0; /*--}}
					@foreach ($blastResult['BlastOutput_iterations']['Iteration']['Iteration_hits']['Hit'] AS $item)
						{{-- */ if($item['Hit_hsps']['Hsp'][0]['Hsp_bit-score'] > $maxScore) $maxScore = $item['Hit_hsps']['Hsp'][0]['Hsp_bit-score']; /*--}}
					@endforeach
					@foreach ($blastResult['BlastOutput_iterations']['Iteration']['Iteration_hits']['Hit'] AS $item)
						{{-- */ $topHsp = $item['Hit_hsps']['Hsp'][0]; /* --}}
						{{-- */ if(isset($oldInput['allowmore'])) { $itemId = $item['Hit_accession']; $itemTitle = $item['Hit_def']; } else { $itemId = explode('_', $item['Hit_def']); $itemTitle = $itemId[1]; $itemId = substr($itemId[0], 2); } /* --}}
						<tr>
							<td><a href="#blast{{ $itemId }}">{{ $itemTitle }}</a></td>
							<td>{{ $topHsp['Hsp_bit-score'] }}</td>
							<td>{{ $maxScore }}</td>
							<td>{{ round((strlen($topHsp['Hsp_qseq'])/$topHsp['Hsp_align-len'])*100, 2) }}%</td>
							<td>{{ $topHsp['Hsp_score'] }}/{{ $topHsp['Hsp_query-to'] }} ({{ round(($topHsp['Hsp_score']/$topHsp['Hsp_query-to'])*100, 2) }}%)</td>
							<td>{{ $topHsp['Hsp_evalue'] }}</td>
							<td><a href="{{ (isset($oldInput['allowmore']))?'#':url('viewbarcode?id='.$itemId) }}">ID{{ $itemId }}</a></td>
						</tr>
					@endforeach
				@else
					{{-- */ $item = $blastResult['BlastOutput_iterations']['Iteration']['Iteration_hits']['Hit'] /* --}}
					{{-- */ $topHsp = $item['Hit_hsps']['Hsp'][0]; /* --}}
					{{-- */ if(isset($oldInput['allowmore'])) { $itemId = $item['Hit_accession']; $itemTitle = $item['Hit_def']; } else { $itemId = explode('_', $item['Hit_def']); $itemTitle = $itemId[1]; $itemId = substr($itemId[0], 2); } /* --}}
					<tr>
						<td><a href="#blast{{ $itemId }}">{{ $itemTitle }}</a></td>
							<td>{{ $topHsp['Hsp_bit-score'] }}</td>
							<td>{{ $topHsp['Hsp_bit-score'] }}</td>
							<td>{{ round((strlen($topHsp['Hsp_qseq'])/$topHsp['Hsp_align-len'])*100, 2) }}%</td>
							<td>{{ $topHsp['Hsp_score'] }}/{{ $topHsp['Hsp_query-to'] }} ({{ round(($topHsp['Hsp_score']/$topHsp['Hsp_query-to'])*100, 2) }}%)</td>
							<td>{{ $topHsp['Hsp_evalue'] }}</td>
							<td><a href="{{ (isset($oldInput['allowmore']))?'#':url('viewbarcode?id='.$itemId) }}">ID{{ $itemId }}</a></td>
					</tr>
				@endif
			</table>
			<br/>
			<h3>Alignments</h3>
			<hr/>
				@if (isset($blastResult['BlastOutput_iterations']['Iteration']['Iteration_hits']['Hit'][0]))
					@foreach ($blastResult['BlastOutput_iterations']['Iteration']['Iteration_hits']['Hit'] AS $item)
						{{-- */ $topHsp = $item['Hit_hsps']['Hsp'][0]; /* --}}
						{{-- */ if(isset($oldInput['allowmore'])) { $itemId = $item['Hit_accession']; $itemTitle = $item['Hit_def']; } else { $itemId = explode('_', $item['Hit_def']); $itemTitle = $itemId[1]; $itemId = substr($itemId[0], 2); } /* --}}
						{{-- */ 	$alignTop =  str_split($topHsp['Hsp_qseq'], 60); /* --}}
						{{-- */ 	$alignMiddle =  str_split($topHsp['Hsp_midline'], 60); /* --}}
						{{-- */ 	$alignBottom =  str_split($topHsp['Hsp_hseq'], 60); /* --}}
						{{-- */ 	$alignLength = $topHsp['Hsp_align-len']; /* --}}
						{{-- */ 	$queryFrom = $topHsp['Hsp_query-from']; /* --}}
						{{-- */ 	$queryTo = $topHsp['Hsp_query-to']; /* --}}
						{{-- */ 	$hitFrom = $topHsp['Hsp_hit-from']; /* --}}
						{{-- */ 	$hitTo = $topHsp['Hsp_hit-to']; /* --}}
						{{-- */ 	$hitSpace = ($hitFrom>$hitTo)?-60:60; /* --}}
						{{-- */ 	$totalLine = ceil($alignLength/60); /* --}}
						
						<p>
						<a href="{{ (isset($oldInput['allowmore']))?'#':url('viewbarcode?id='.$itemId) }}" id="blast{{ $itemId }}">ID{{ $itemId }} - {{ $itemTitle }}</a><br/>
						<b>Length:</b> {{ $item['Hit_len'] }},
						<b>Score:</b> {{ $topHsp['Hsp_bit-score'] }} bits({{ $topHsp['Hsp_score'] }}),
						<b>Identities:</b> {{ $topHsp['Hsp_score'] }}/{{ $topHsp['Hsp_query-to'] }} ({{ round(($topHsp['Hsp_score']/$topHsp['Hsp_query-to'])*100, 2) }}%),
						<b>E-value:</b> {{ $topHsp['Hsp_evalue'] }},
						<b>Gaps:</b> {{ $topHsp['Hsp_gaps'] }}
						</p>
						<pre style="line-height:1;">@foreach ($alignTop AS $k=>$top){{ str_pad('Query '.($queryFrom+(60)*$k), 10, ' ', STR_PAD_RIGHT) }} {{ $top }}   {{ ($k+1==$totalLine)?$queryTo:($queryFrom+(60*($k+1))-1) }}</br>           {{ $alignMiddle[$k] }}</br>{{ str_pad('Hit '.($hitFrom+($hitSpace*$k)), 10, ' ', STR_PAD_RIGHT) }} {{ $alignBottom[$k] }}   {{ ($k+1==$totalLine)?$hitTo:($hitFrom+($hitSpace*($k+1))-1) }}</br></br>@endforeach</pre>
					@endforeach
				@else
					{{-- */ $item = $blastResult['BlastOutput_iterations']['Iteration']['Iteration_hits']['Hit'] /* --}}
					{{-- */ $topHsp = $item['Hit_hsps']['Hsp'][0]; /* --}}
					{{-- */ if(isset($oldInput['allowmore'])) { $itemId = $item['Hit_accession']; $itemTitle = $item['Hit_def']; } else { $itemId = explode('_', $item['Hit_def']); $itemTitle = $itemId[1]; $itemId = substr($itemId[0], 2); } /* --}}
					{{-- */		$alignTop =  str_split($topHsp['Hsp_qseq'], 60); /* --}}
					{{-- */		$alignMiddle =  str_split($topHsp['Hsp_midline'], 60); /* --}}
					{{-- */		$alignBottom =  str_split($topHsp['Hsp_hseq'], 60); /* --}}
					{{-- */		$alignLength = $topHsp['Hsp_align-len']; /* --}}
					{{-- */		$queryFrom = $topHsp['Hsp_query-from']; /* --}}
					{{-- */		$queryTo = $topHsp['Hsp_query-to']; /* --}}
					{{-- */		$hitFrom = $topHsp['Hsp_hit-from']; /* --}}
					{{-- */		$hitTo = $topHsp['Hsp_hit-to']; /* --}}
					{{-- */		$hitSpace = ($hitFrom>$hitTo)?-60:60; /* --}}
					{{-- */		$totalLine = ceil($alignLength/60); /* --}}
						
						<p>
						<a href="{{ (isset($oldInput['allowmore']))?'#':url('viewbarcode?id='.$itemId) }}" id="blast{{ $itemId }}">ID{{ $itemId }} - {{ $itemTitle }}</a><br/>
						<b>Length:</b> {{ $item['Hit_len'] }},
						<b>Score:</b> {{ $topHsp['Hsp_bit-score'] }} bits({{ $topHsp['Hsp_score'] }}),
						<b>Identities:</b> {{ $topHsp['Hsp_score'] }}/{{ $topHsp['Hsp_query-to'] }} ({{ round(($topHsp['Hsp_score']/$topHsp['Hsp_query-to'])*100, 2) }}%),
						<b>E-value:</b> {{ $topHsp['Hsp_evalue'] }},
						<b>Gaps:</b> {{ $topHsp['Hsp_gaps'] }}
						</p>
						<pre style="line-height:1;">@foreach ($alignTop AS $k=>$top){{ str_pad('Query '.($queryFrom+(60)*$k), 10, ' ', STR_PAD_RIGHT) }} {{ $top }}   {{ ($k+1==$totalLine)?$queryTo:($queryFrom+(60*($k+1))-1) }}</br>           {{ $alignMiddle[$k] }}</br>{{ str_pad('Hit '.($hitFrom+($hitSpace*$k)), 10, ' ', STR_PAD_RIGHT) }} {{ $alignBottom[$k] }}   {{ ($k+1==$totalLine)?$hitTo:($hitFrom+($hitSpace*($k+1))-1) }}</br></br>@endforeach</pre>
				@endif
			@else
				Không có kết quả phù hợp
			@endif
			<br/><br/>
		</div>
		@endif	
	</div>
</div>	
@endsection