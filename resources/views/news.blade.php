@extends('templates.master')

@section('title', 'Barcode')

@section('content')
<style type="text/css">
	#title {
		margin-top:7px;
	}
	.row{
		margin:0px;
		margin-bottom:5px;
	}
	a:hover, a:focus {
		text-decoration: none;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<h1>PUBLICATIONS</h1>
		<hr/>
		<ol>
		<?php foreach($data['list_new'] as $ln){ ?>
			<li><a href="publication?id=<?php echo $ln['new_id'] ?>"><?php echo $ln['subject']; ?></a></li>
		<?php } ?>
		</ol>
		<?php echo $data['list_new']->render(); ?>
	</div>
</div>
</br></br></br>

@endsection
