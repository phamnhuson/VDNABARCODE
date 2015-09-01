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
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading"><h4 style="color:#f0ad4e;">Thống kê phân loại</h4></div>
			<div class="panel-body">
				<table class="col-lg-12">						
					<tr>
						<td style="width:150px;">Ngành:</td>
						<td style="width:363px;text-align:center;"><?php echo $data['count_phylum'][0]['count_phylum']; ?></td>
						<td style="width:150px;">Lớp:</td>
						<td style="text-align:center;"><?php echo $data['count_class'][0]['count_class']; ?></td>								
					</tr>
					<tr>
						<td style="width:150px;">Bộ:</td>
						<td style="width:363px;text-align:center;"><?php echo $data['count_order'][0]['count_order']; ?></td>
						<td style="width:150px;">Họ:</td>
						<td style="text-align:center;"><?php echo $data['count_family'][0]['count_family']; ?></td>								
					</tr>
					<tr>
						<td style="width:150px;">Chi:</td>
						<td style="width:363px;text-align:center;"><?php echo $data['count_genus'][0]['count_genus']; ?></td>
						<td style="width:150px;">Loài:</td>
						<td style="text-align:center;"><?php echo $data['count_species'][0]['count_species']; ?></td>								
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
						<td style="width:363px;text-align:center;"><?php echo $data['count_account']; ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td style="width:150px;">Người quản trị:</td>
						<td style="width:363px;text-align:center;"><?php echo $data['count_admin']; ?></td>		
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td style="width:150px;">Người sử dụng:</td>
						<td style="width:363px;text-align:center;"><?php echo $data['count_user']; ?></td>
						<td></td>
						<td></td>
					</tr>						
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading"><h4 style="color:#f0ad4e;">Thống kê barcode</h4></div>
			<div class="panel-body">
				<div class="row">
				<table class="col-lg-12">
					<tr>
						<td style="width:150px;">Tổng số:</td>
						<td style="width:363px;text-align:center;"><?php echo $data['total_barcode'][0]['count_barcode']; ?></td>
						<td></td>
						<td></td>
					</tr>
				</table>
				</div>
				<div class="row">				
				<table class="col-lg-6">
					<?php foreach($data['tk_city'] as $key=>$ct){ ?>
					<?php if($key%2==0){ ?>
					<tr>
						<td style="width:150px;"><?php echo $ct['city_name']; ?>:</td>
						<td style="width:363px;text-align:center;"><?php echo $ct['count']; ?></td>								
					</tr>
					<?php } ?>
					<?php } ?>
				</table>
				<table class="col-lg-6">
					<?php foreach($data['tk_city'] as $key=>$ct){ ?>
					<?php if($key%2==1){ ?>
					<tr>
						<td style="width:150px;"><?php echo $ct['city_name']; ?>:</td>
						<td style="width:363px;text-align:center;"><?php echo $ct['count']; ?></td>					
					</tr>
					<?php } ?>
					<?php } ?>
				</table>		
				</div>
			</div>
		</div>
	</div>
	<!--<div class="row">
		<hr/>
		<p style="text-align:center;"><a href="#" class="btn btn-link btn-lg"><span class="glyphicon glyphicon-download-alt"></span> Tải xuống báo cáo</a></p>
	</div>-->
</div>

@endsection