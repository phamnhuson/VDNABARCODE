@extends('templates.master')

@section('title', 'Ngân hàng dữ liệu DNA Việt Nam - Genome')

@section('content')
<style type="text/css">
	#title {
		margin-top:7px;
	}
	.row{
		margin:0px;
		margin-bottom:5px;
	}
	#lightbox .modal-content {
    display: inline-block;
    text-align: center;   
}

	#lightbox .close {
		opacity: 1;
		color: rgb(255, 255, 255);
		background-color: rgb(25, 25, 25);
		padding: 5px 8px;
		border-radius: 30px;
		border: 2px solid rgb(255, 255, 255);
		position: absolute;
		top: -15px;
		right: -55px;
		
		z-index:1032;
	}
	
	 #map-canvas {
        height: 100%;
        margin: 0;
        padding: 0;
      }
	hr{
		border-top: 1px solid #BCBCBC;
	}
	h4{
		#000 !important;
		margin:0px;
	}
	.panel-default{
		border-color: #B5D2FF !important;
	}
	.panel-heading{
		background-color: #fff !important;
		border-color: #B5D2FF !important;
	}
	.panel-body table td{
		padding:5px;
		border-bottom: 1px solid #eee;
	}
}
</style>
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<ol class="breadcrumb">
						@foreach ($breadcrumbs AS $k=>$item)
							@if ($k != count($breadcrumbs)-1)
								<li><a href="{{ @$item['url'] }}">{{ $item['name'] }}</a></li>	
							@else
								<li class="active">{{ $item['name'] }}</li>
							@endif
						@endforeach
					</ol>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">	
	<div class="row">
		<div class="col-md-12">
			@if (isset($kingdom))
				@foreach ($kingdom as $kd)
					<p><a href="/genome/{{ $kd['kingdom_id'] }}">{{ $kd['kingdom_name'] }}</a></p>
				@endforeach
			@else
				@foreach ($genome as $kd)
					<p><a href="{{ $kd['url'] }}" target="_blank">{{ $kd['kingdom_name'] }}</a></p>
				@endforeach
				
				{!! $genome->render() !!}
			@endif
		</div>	
	</div>	
</div>

@endsection