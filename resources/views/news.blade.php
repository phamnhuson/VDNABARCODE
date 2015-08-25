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
<!--<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 id="title">QUẢN LÝ BÀI VIẾT</h1>
				</td>
			</tr>
		</table>
	</div>
</div>-->
<div class="box">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1" style="padding:0px;">
			<div class="panel panel-default" style="margin-bottom: 0px;">
				<div class="panel-heading"><h4 style="color:#f0ad4e;">Tin tức</h4></div>
				<div class="panel-body" id="app">
					<?php foreach($data['list_new'] as $ln){ ?>
					<div class="form-group">
						<hr style="border-top: 1px solid #C3BCBC;margin:10px 0px 10px 0px;" />
						<div class="row">
							<a href="news?id=<?php echo $ln['new_id'] ?>"><h3 style="margin:0px;"><?php echo $ln['subject']; ?></h3></a>
						</div>
						<hr style="border-top: 1px solid #C3BCBC;margin:10px 0px 10px 0px;" />
						<div class="row">
							<div class="col-lg-12" style="border:1px solid #C3BCBC;border-radius:5px;background:#eee;padding:10px;margin-bottom:5px;">
								<span>Được đăng: <?php echo $ln['created']; ?> | Viết bởi <?php echo $ln['fullname']; ?> |</span>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3" style="padding:0px;">
								<img style="padding:0px 10px 0px 0px; height:150px;" class='col-lg-12' src="{{asset('public/uploads/img/new_'.$ln['new_id'].'.jpg')}}" alt="Chọn ảnh" />
							</div>
							<div class="col-lg-9" style="padding:0px;">
								<?php echo $ln['summary']; ?>
							</div>
						</div>
					</div>
					<?php } ?>
					
				</div>
			</div>
			<?php echo $data['list_new']->render(); ?>
		</div>
	</div>
	</br></br></br>
</div>

<script type="text/javascript">
	$(document).ready(function(){			

	});	
</script>
@endsection
