@extends('templates.master')

@section('content')
<script src="{{ asset('public/js/PhyloCanvas.js') }}"></script>
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
	<div class="box">
	<h3>Cây quan hệ di truyền</h3>
	<hr/>
	<div class="row">
		<div class="col-md-8" id="pc-buttons">
			<label>Kiểu hiển thị&nbsp;&nbsp;</label>
			<button id="rectangular" class="btn btn-default btn-sm">Rectangular</button>
			<button id="circular" class="btn btn-sm btn-default">Circular</button>
			<button id="radial" class="btn btn-default btn-sm">Radial</button>
			<button id="diagonal" class="btn btn-default btn-sm">Diagonal</button>
			<button id="hierarchy" class="btn btn-default btn-sm btn-info">Hierarchical</button>
		</div>
		<div class="col-md-4">
			<a href="{{ url('phylogenetictree/update') }}" class="btn btn-default pull-right"><span class="glyphicon glyphicon-refresh"></span> Cập nhật</a>
		</div>
	</div>	
	<hr/>
	<div id="phylocanvasDiv"></div>
	<br/><br/><br/>
	</div>
@endsection