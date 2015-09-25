@extends('templates.master')

@section('title', 'Generate Phylogenetic Tree')

@section('content')
<script src="{{ asset('public/js/PhyloCanvas.js') }}"></script>

	<div class="box">
		<h3>Generate Phylogenetic Tree</h3>
		<hr/>
		<div class="row">
			<div class="col-md-12">
				{!! Form::open(array('action' => array('TreeviewController@create'))) !!}
					<label class="control-label">Sequences in Fasta format</label>
					{!! Form::textarea('sequence', @$sequence, array('class' => 'form-control validate-control validate-fasta', 'rows' => '5')) !!}
					<p class="text-danger text-error"></p>
					<br/>
					{!! Form::submit('Generate', array('class' => 'btn btn-primary pull-right')) !!}
					<br/><br/>
				{!! Form::close() !!}
			</div>
		</div>
		@if (isset($phyloData))
		<script type="text/javascript">
			$(document).ready(function(){
				// Initializing tree object
				var phylocanvas = new PhyloCanvas.Tree('phylocanvasDiv');
				phylocanvas.setTreeType('rectangular');
				//phylocanvas.setSize('1000', '2000');
				var newick_str = "{{ $phyloData }}";
				phylocanvas.load(newick_str);
				
				$('#pc-buttons .btn').click(function(e){
					$('#pc-buttons .btn').removeClass('btn-info');
					$('#pc-buttons .btn').addClass('btn-default');
					$(this).addClass('btn-info');
					phylocanvas.setTreeType(this.id);
				});
				
			});
		</script>
		<div class="row">
			<div class="col-md-8" id="pc-buttons">
				<label>Display&nbsp;&nbsp;</label>
				<button id="rectangular" class="btn btn-default btn-sm">Rectangular</button>
				<button id="circular" class="btn btn-sm btn-default">Circular</button>
				<button id="radial" class="btn btn-default btn-sm">Radial</button>
				<button id="diagonal" class="btn btn-default btn-sm">Diagonal</button>
				<button id="hierarchy" class="btn btn-default btn-sm btn-info">Hierarchical</button>
			</div>
		</div>	
		<hr/>
		<div id="phylocanvasDiv"></div>
		<br/><br/><br/>
		@endif
	</div>
@endsection