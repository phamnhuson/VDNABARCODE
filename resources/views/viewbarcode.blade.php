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
<!--<script src="{{ asset('public/js/google_map.js') }}"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 id="title">THÔNG TIN BARCODE</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading"><h4 style="color:#e17009;">Thông Tin Barcode</h4></div>
					<div class="panel-body">
						<table class="col-lg-12">
							<tr>
								<td style="width:150px;">Sequence:</td>
								<td colspan="3"><?php echo $data['barcode'][0]['sequence']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Peptide:</td>
								<td colspan="3"><?php echo $data['barcode'][0]['peptide']; ?></td>								
							</tr>							
							<tr>
								<td style="width:150px;">Sequence size:</td>
								<td style="width:363px;text-align:center;"><?php echo $data['barcode'][0]['seq_size']; ?></td>
								<td style="width:150px;">Peptide size:</td>
								<td style="text-align:center;"><?php echo $data['barcode'][0]['pep_size']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Barcode:</td>
								<td style="width:363px;text-align:center;"><?php echo $data['barcode'][0]['barcode']; ?></td>
								<td style="width:150px;">Taxon id:</td>
								<td style="text-align:center;"><?php echo $data['barcode'][0]['taxon_id']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Start:</td>
								<td style="width:363px;text-align:center;"><?php echo $data['barcode'][0]['start']; ?></td>
								<td style="width:150px;">Stop:</td>
								<td style="text-align:center;"><?php echo $data['barcode'][0]['stop']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Life stage:</td>
								<td style="width:363px;text-align:center;"><?php echo $data['barcode'][0]['life_stage']; ?></td>
								<td style="width:150px;">Organelle:</td>
								<td style="text-align:center;"><?php echo $data['barcode'][0]['organelle']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Tissue type:</td>
								<td style="width:363px;text-align:center;"><?php echo $data['barcode'][0]['tissue_type']; ?></td>
								<td style="width:150px;">Reproduction:</td>
								<td style="text-align:center;"><?php echo $data['barcode'][0]['reproduction']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Sex:</td>
								<td style="width:363px;text-align:center;"><?php echo $data['barcode'][0]['sex']; ?></td>
								<td style="width:150px;">Lineage:</td>
								<td style="text-align:center;"><?php echo $data['barcode'][0]['lineage']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Species name:</td>
								<td style="width:363px;text-align:center;"><?php echo $data['barcode'][0]['species']; ?></td>
								<td style="width:150px;">Scientific name:</td>
								<td style="text-align:center;"><?php echo $data['barcode'][0]['scientific_name']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Vietnamese name:</td>
								<td style="width:363px;text-align:center;"><?php echo $data['barcode'][0]['vietnamese_name']; ?></td>
								<td style="width:150px;">Quality:</td>
								<td style="text-align:center;"><?php echo $data['barcode'][0]['quality']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Gene:</td>
								<td colspan="3"><?php echo $data['barcode'][0]['gene']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Notes:</td>
								<td colspan="3"><?php echo $data['barcode'][0]['notes']; ?></td>								
							</tr>
							<tr>
								<td style="width:150px;">Extra info:</td>
								<td colspan="3"><?php echo $data['barcode'][0]['extra_info']; ?></td>								
							</tr>
						</table>
					</div>
			</div>
		</div>
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading"><h4 style="color:#e17009;">Ảnh</h4></div>
					<div class="panel-body">
						<?php foreach($data['file_img'] as $ds){ ?>
							<div class="col-lg-3">
								<div class="form-group">
									<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
										<img style="height:160px;width:240" src="{{asset('public/uploads/img/'.$ds['file_id'].'.jpg')}}" alt="...">
									</a>					
								</div>								
							</div>
						<?php } ?>
					</div>
			</div>
		</div>
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading"><h4 style="color:#e17009;">Vị trí</h4></div>
					<div class="panel-body">
						<div id="map" style="width: 100%; height: 700px;"></div>
					</div>
			</div>
		</div>
		<!--<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:150px;">
				<h4>Files</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<table class="table table-striped table-bordered">
					<tr>
						<th style="text-align:center;width:70px;">STT</th>
						<th >Tên file</th>
					</tr>
					<?php if(isset($data['file_trace'])){ ?>
					<?php $i=1; ?>
					<?php foreach($data['file_trace'] as $dsf){ ?>
						<tr id="file_<?php echo $dsf['file_id']; ?>">
							<td style="text-align:center;"><?php echo $i; ?></td>
							<td><?php echo $dsf['file_name']; ?></td>
						</tr>
					<?php } ?>
					<?php } ?>
				</table>
			</div>
		</div>-->
</div>
<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" style='margin-top:100px;'>
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-content">
            <div class="modal-body">
                <img style="width:600px;height:400px;" src="" alt="" />
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	var $lightbox = $('#lightbox');
    
    $('[data-target="#lightbox"]').on('click', function(event) {
        var $img = $(this).find('img'), 
            src = $img.attr('src'),
            alt = $img.attr('alt'),
            css = {
                'maxWidth': $(window).width() - 100,
                'maxHeight': $(window).height() - 100
            };
    
        $lightbox.find('.close').addClass('hidden');
        $lightbox.find('img').attr('src', src);
        $lightbox.find('img').attr('alt', alt);
        $lightbox.find('img').css(css);
    });
    
    $lightbox.on('shown.bs.modal', function (e) {
        var $img = $lightbox.find('img');
            
        $lightbox.find('.modal-dialog').css({'width': $img.width()});
        $lightbox.find('.close').removeClass('hidden');
    });
	
	$(document).ready(function(){
		var locations= <?php echo $data['loca']; ?>;
		var map = new google.maps.Map(document.getElementById('map'), {
		  zoom: 6,
		  center: new google.maps.LatLng(16.450001,107.583336),
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		var infowindow = new google.maps.InfoWindow();

		var marker, i;

		for (i = 0; i < locations.length; i++) {  
		  marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map
		  });

		  google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
			  infowindow.setContent(locations[i][0]);
			  infowindow.open(map, marker);
			}
		  })(marker, i));
		}	
	});
</script>	
@endsection