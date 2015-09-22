@extends('templates.master')

@section('title', 'Service')

@section('content')
<div class="row">
	<div class="col-md-12">
	<h1>Illustrative Barcode Generate</h1>
	<hr/>
	<textarea class="form-control" rows="5" id="input-sequence" placeholder="Enter Nucleotide Sequence to generate illustrative barcode..."></textarea>
	<br/>
	<p>
		<button type="button" class="btn btn-primary pull-right" onClick="drawBarcode('barcode-canvas', document.getElementById('input-sequence').value);">Generate</button>
	</p>	
	<br/>
	<div id="generate-result"  style="display:none;">
		<h4>Result:</h4>
		<canvas id="barcode-canvas"></canvas>
	</div>	
</div>
<script>
	function drawBarcode(element, sequence){
		var c=document.getElementById(element); 
		
		var ctx=c.getContext("2d"); 
		ctx.canvas.height = (Math.floor(sequence.length/c.offsetWidth)+1)*80;
		ctx.canvas.width  = c.parentNode.offsetWidth;
		var color;
		var bheigh = 20;
		var theigh = 10;
		
		ctx.fillStyle="black";
		ctx.fillText("0", 0, theigh);
		
		var j = 0;
		
		for(var i=0; i<sequence.length; i++)
		{
			switch(sequence[i])
			{
				case 'A': color = 'rgb(0,248,0)'; break;
				case 'T': color = 'rgb(255,0,0)'; break;
				case 'G': color = 'rgb(0,0,0)'; break;
				case 'C': color = 'rgb(0,0,248)'; break;
				default: color = 'rgb(255,255,255)'; break;
			}

			ctx.fillStyle=color;
			ctx.fillRect(j, bheigh, 1, 50);
			
			if(j == c.offsetWidth-5)
			{
				ctx.fillStyle="black";
				ctx.fillText(i+1, j-(String(i).length*5), theigh);
				console.log(i);
				bheigh = bheigh + 80;
				theigh = theigh + 80;
				j = 0;
				ctx.fillText(i+2, 0, theigh);
			}
			else
			{
				j+=2;
			}
			
		}
		ctx.fillStyle="black";
		ctx.fillText(sequence.length, j-(String(sequence.length).length*5), theigh);
		
		document.getElementById('generate-result').style.display = "block";
		
	}	

</script>
@endsection	