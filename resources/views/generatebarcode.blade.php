@extends('templates.master')

@section('title', 'Service')

@section('content')
<div class="row jform">
	<div class="col-md-12">
		<h1>Illustrative Barcode Generate</h1>
		<hr/>
		<textarea class="form-control validate-control validate-nu-sequence" rows="5" id="input-sequence" placeholder="Enter Nucleotide Sequence to generate illustrative barcode..."></textarea>
		<br/>
		<p class="text-danger text-error"></p>
		<p>
			<button type="button" class="btn btn-primary pull-right jsubmit" id="gen-barcode-btn">Generate</button>
		</p>	
		<br/>
		<div>
			<h4 id="generate-result" style="display:none;">Result:</h4>
			<canvas id="barcode-canvas"></canvas>
		</div>	
	</div>	
</div>
<script>
		

</script>
@endsection	