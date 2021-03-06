@extends('templates.master')

@section('title', 'Ngân hàng dữ liệu DNA Việt Nam - DNA Barcode')

@section('content')
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
		@foreach ($breadcrumbs AS $i => $item)
			<?php $a=$i; ?>
			@if ($i == count($breadcrumbs)-1)
				{{-- */ $title = $item['name']; /* --}}
				<li class="active">{{ $item['name'] }}</li>
			@else
				<li><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
			@endif
		@endforeach
		</ol>
		<h4 id="title">{{ $title }}</h4>
		<hr/>
	</div>
	<div class="col-md-12">
		<ul style="padding-left:20px;">
		@foreach ($resource AS $item)
			@if ($cat == 'genus')
				<li><a href="{{ $item->url }}">{{ $item->name }}</a></li>
			@else
			<li><a href="{{ $item->url }}">{{ $item->name }}&nbsp;({{ $item->count }})</a></li>
			@endif
		@endforeach
		</ul>
	</div>	
	<div class="col-md-12">
		{!! $resource->render() !!}
	</div>
</div>

@endsection