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
					<h1 id="title">BÁO CÁO THỐNG KÊ</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<!--<div class="row">	
		<form>
			<div class="row">
				<div class="col-lg-2" style="padding:0px;">
					<div class="form-group">
						<select class="form-control" name="criteria">
							<option value="">Chọn tiêu chí</option>
							<option value="1">Barcode</option>
						</select>
					</div>	
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						{!! Form::select('species', @$data['arr_city'],@$data['barcode'][0]['city'], array('class'=>'form-control')) !!}
					</div>	
				</div>
				<div class="col-lg-2" style="padding-left:0px;">
					<div class="form-group">
						<select class="form-control" name="time">
							<option value="">Chọn thời gian</option>
							<option value="1">Tháng</option>
							<option value="2">Quý</option>
							<option value="3">Năm</option>
						</select>
					</div>	
				</div>
				<div class="col-lg-2" style="padding-left:0px;">
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Tạo báo cáo" />
					</div>	
				</div>
			</div>
			<div class="row">
				<hr/>
				<p style="text-align:center;"><a href="#" class="btn btn-link btn-lg"><span class="glyphicon glyphicon-download-alt"></span> Tải xuống báo cáo</a></p>
			</div>
		</form>
	</div>-->
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading"><h4 style="color:#f0ad4e;">Thống kê phân loại</h4></div>
			<div class="panel-body">
				<table class="col-lg-12">						
					<tr>
						<td style="width:150px;">Ngành:</td>
						<td style="width:363px;text-align:center;"></td>
						<td style="width:150px;">Lớp:</td>
						<td style="text-align:center;"></td>								
					</tr>
					<tr>
						<td style="width:150px;">Bộ:</td>
						<td style="width:363px;text-align:center;"></td>
						<td style="width:150px;">Họ:</td>
						<td style="text-align:center;"></td>								
					</tr>
					<tr>
						<td style="width:150px;">Chi:</td>
						<td style="width:363px;text-align:center;"></td>
						<td style="width:150px;">Loài:</td>
						<td style="text-align:center;"></td>								
					</tr>						
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading"><h4 style="color:#f0ad4e;">Thống kê số lượng account</h4></div>
			<div class="panel-body">
				<table class="col-lg-12">						
					<tr>
						<td style="width:150px;">Tổng số:</td>
						<td style="width:363px;text-align:center;"></td>								
					</tr>
					<tr>
						<td style="width:150px;">Người quản trị:</td>
						<td style="width:363px;text-align:center;"></td>							
					</tr>
					<tr>
						<td style="width:150px;">Người sử dụng:</td>
						<td style="width:363px;text-align:center;"></td>								
					</tr>						
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading"><h4 style="color:#f0ad4e;">Thống kê barcode</h4></div>
			<div class="panel-body">
				<table class="col-lg-6">
					<?php foreach($data['list_city'] as $ct){ ?>
					<tr>
						<td style="width:150px;"><?php echo $ct['city_name']; ?>:</td>
						<td style="width:363px;text-align:center;"></td>								
					</tr>
					<?php } ?>
				</table>
				<table class="col-lg-6">
					<?php foreach($data['list_city'] as $ct){ ?>
					<tr>
						<td style="width:150px;"><?php echo $ct['city_name']; ?>:</td>
						<td style="width:363px;text-align:center;"></td>							
					</tr>
					<?php } ?>
					<tr>
						<td style="width:150px;"><b>Tổng số:</b></td>
						<td style="width:363px;text-align:center;"></td>							
					</tr>
				</table>
							
			</div>
		</div>
	</div>
</div>

<script>
	 $(document).ready(function () {
                
		/*$('#datepicker').datepicker({
			format: "yyyy",
		});  
		
		$(document).on('click','#datepicker',function(){
			$(this).show();
		});*/
	
	});
</script>
@endsection