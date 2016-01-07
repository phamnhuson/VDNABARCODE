@extends('templates.master')

@section('title', 'Ngân hàng dữ liệu DNA Việt Nam - ViewSpecies')

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
	.tbl th{
		background:#F5F5F5;
	}
	.bold{
		    text-decoration:underline;
	}
	td{
		font-size:10pt;
	}
}
</style>
<!--<script src="{{ asset('public/js/google_map.js') }}"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 id="title">THÔNG TIN LOÀI</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<table style="width:100%">
		<tr>
			<td>
				<table width="100%" class="table table-bordered tbl">
					<tr>
						<th colspan="4">SPECIES INFORMATION</th>								
					</tr>
					<tr>
						<td style="width:20%;" class="bold">Species ID:</td>
						<td style="width:30%;"><?php echo $data['species'][0]['species_id'] ?></td>
						<td style="width:20%;" class="bold">Scientific Name</td>
						<td style="width:30%;"><?php echo $data['species'][0]['species_name'] ?></td>
					</tr>
					<tr>
						<td class="bold">Vietnamese Name:</td>
						<td><?php echo $data['species'][0]['vietnamese_name'] ?></td>																			
						<td class="bold">Other Name:</td>
						<td><?php echo $data['species'][0]['other_name'] ?></td>
					</tr>
					<tr>
						<td class="bold">Phân hạng:</td>
						<td><?php echo $data['species'][0]['rank'] ?></td>																			
						<td class="bold">Genus:</td>
						<td><?php echo $data['species'][0]['genus_name'] ?></td>
					</tr>
					<tr>
						<td class="bold">Description:</td>
						<td colspan="3"><?php echo $data['species'][0]['description'] ?></td>
					</tr>
					<tr>
						<td class="bold">Distribution:</td>
						<td colspan="3"><?php echo $data['species'][0]['distribution'] ?></td>
					</tr>
					<tr>
						<td class="bold">Function:</td>
						<td colspan="3"><?php echo $data['species'][0]['function'] ?></td>
					</tr>
					<tr>
						<td class="bold">Conserve:</td>
						<td colspan="3"><?php echo $data['species'][0]['conserve'] ?></td>
					</tr>
					<tr>
						<td class="bold">Conserve:</td>
						<td colspan="3"><?php echo $data['species'][0]['conserve'] ?></td>
					</tr>
					<tr>
						<td class="bold">Images:</td>
						<td colspan="3">
							<?php foreach($data['file_img'] as $ds){ ?>
										<img style="height:160px;width:240" src="{{asset('public/uploads/img/'.$ds['file_id'].'.jpg')}}" alt="...">											
							<?php } ?>
						</td>
					</tr>
					<tr>
						<td class="bold">Other:</td>
						<td colspan="3"><?php echo $data['species'][0]['other'] ?></td>
					</tr>
				</table>
			</td>
		</tr>					
	</table>
</div>
@endsection