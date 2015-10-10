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
	.tit{
		color:#000 !important;
	}
	a:hover, a:focus {
		text-decoration: none;
	}
</style>
<div class="box">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1" style="padding:0px;">
			@if (Session::has('responseData'))
				@if (Session::get('responseData')['statusCode'] == 1)
					<div class="alert alert-success">{{ Session::get('responseData')['message'] }}</div>
				@elseif (Session::get('responseData')['statusCode'] == 2)
					<div class="alert alert-danger">{{ Session::get('responseData')['message'] }}</div>
				@endif
			@endif
		
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="form-group">
				<h3><?php echo $data['new'][0]['subject'] ?></h3>
				<hr style="border-top: 1px solid #C3BCBC;margin-bottom:10px;" />
				<span>Được đăng: Ngày <?php echo $data['date'][2]; ?> Tháng <?php echo $data['date'][1]; ?> Năm <?php echo $data['date'][0]; ?> <?php echo $data['time'][0]; ?>:<?php echo $data['date'][1]; ?> | Viết bởi <?php echo $data['new'][0]['fullname']; ?> | </span>
				<?php if($data['new'][0]['new_file']!=null){ ?>
				<a href="/public/uploads/file/news/{{ $data['new'][0]['new_file'] }}" target="_blank" style="float:right;">Download Full text</a>
				<?php } ?>
				<hr style="border-top: 1px solid #C3BCBC;margin-top:10px;"/>
				<h4 style="margin:20px 0px 20px 0px;"><i><?php echo $data['new'][0]['summary'] ?></i></h4>
				<p><?php echo $data['new'][0]['content'] ?></p>
				
			</div>
		</div>
	</div>
	<!--
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1" style="padding:0px;">
			
			<div class="row" style="margin-bottom:0px;">
				<hr style="border-top: 1px solid #C3BCBC;"/>
				<h4><?php echo $data['count']; ?> bình Luận</h4>
				<div class="col-lg-12" style="border:1px solid #C3BCBC;background:#eee;padding:10px;">
					{!! Form::open(array('method' => 'POST' )) !!}
					<table style="width:100%" class="form-table">
						<tr style="height:49px;">
							<td class="col-lg-6" style="padding:0px 5px 0px 0px">
								{!! Form::text('fullname', null , array('class'=>'form-control','placeholder'=>'Họ và tên')) !!}
							</td>
							<td class="col-lg-6" style="padding:0px 0px 0px 5px">
								{!! Form::text('email', null, array('class'=>'form-control','placeholder'=>'Email')) !!}
							</td>
						</tr>
						<tr>
							<td colspan="2">
							{!! Form::textarea('comment', null, array('class'=>'form-control','rows'=>'3','placeholder'=>'Viết bình luận','style'=>'margin-bottom:10px;')) !!}
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="hidden" class="form-control" value="<?php echo $data['new_id']; ?>" name="new" />
								<input type="submit" class="btn btn-primary" value="Gửi bình luận" name="submit" style="float:right;"/>
							</td>
						</tr>	
					</table>
					{!! Form::close() !!}				
				</div>			
			</div>
			<div class="row">
				<div class="col-lg-12" style="border:1px solid #C3BCBC;background:#fff;padding:10px;">
					<?php foreach($data['list_comment'] as $lcm){ ?>
					<div class="form-group" style="margin-bottom:0px;">
						<b><?php echo $lcm['fullname']; ?></b>
						<p><?php echo $lcm['comment']; ?><p>
					</div>
					<hr style="border-top: 1px dashed #C3BCBC;margin: 5px 0px 5px 0px;"/>
					<?php } ?>
				</div>
			</div>
			
		</div>
	</div>-->
</div>

<script type="text/javascript">
	$(document).ready(function(){			

	});	
</script>
@endsection
