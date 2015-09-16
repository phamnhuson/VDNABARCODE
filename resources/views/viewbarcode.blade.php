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
	.tbl th{
		background:#F5F5F5;
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
					<h1 id="title">MẪU BẢN GHI TRÊN VNBIOBARCODE</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<table class="col-lg-12">
		<tr>
			<td>
				<table width="100%" class="table table-bordered tbl">
					<tr>
						<th colspan="4">IDENTIFIERS</th>								
					</tr>
					<tr>
						<td style="width:20%;">Barcode ID:</td>
						<td style="width:30%;"><?php echo $data['barcode']['barcode_id'] ?></td>
						<td style="width:20%;">Field ID:</td>
						<td style="width:30%;"><?php echo $data['barcode']['field_id'] ?></td>
					</tr>
					<tr>
						<td>Museun ID:</td>
						<td><?php echo $data['barcode']['museum_id'] ?></td>										
						<td>Collection Code:</td>
						<td><?php echo $data['barcode']['collection_code'] ?></td>
					</tr>
					<tr>
						<td>Deposited In:</td>
						<td colspan="3"><?php echo $data['barcode']['deposited_in'] ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" class="table table-bordered tbl">
					<tr>
						<th colspan="4">TAXONOMY</th>								
					</tr>
					<tr>
						<td style="width:20%;">Phylum:</td>
						<td style="width:30%;"><?php echo $data['barcode']['phylum_name'] ?></td>										
						<td style="width:20%;">Class:</td>
						<td style="width:30%;"><?php echo $data['barcode']['class_name'] ?></td>
					</tr>
					<tr>
						<td>Order:</td>
						<td><?php echo $data['barcode']['order_name'] ?></td>
						<td>Family:</td>
						<td><?php echo $data['barcode']['family_name'] ?></td>										
					</tr>
					<tr>
						<td>Genus:</td>
						<td><?php echo $data['barcode']['genus_name'] ?></td>
						<td>Species:</td>
						<td><?php echo $data['barcode']['species_name'] ?></td>	
					</tr>
					<tr>						
						<td>Common Name:</td>
						<td><?php echo $data['barcode']['common_name'] ?></td>
						<td>Scientific Name:</td>
						<td><?php echo $data['barcode']['scientific_name'] ?></td>
					</tr>
					<tr>						
						<td>Vietnamese Name:</td>
						<td><?php echo $data['barcode']['vietnamese_name'] ?></td>
						<td>BIN (Cluster ID):</td>
						<td><?php echo $data['barcode']['bin'] ?></td>
					</tr>
					<tr>
						<td colspan="4"><i>* Barcode Index Numbers(BIN): cluster barcode sequence to create OTUs that closely reflect species groupings</i></td>										
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" class="table table-bordered tbl">
					<tr>
						<th colspan="4">SPECIMEN DETAILS</th>								
					</tr>
					<tr>
						<td style="width:20%;">Voucher Status:</td>
						<td style="width:30%;"><?php echo $data['barcode']['voucher_status'] ?></td>										
						<td style="width:20%;">Reproduction:</td>
						<td style="width:30%;"><?php echo $data['barcode']['reproduction'] ?></td>
					</tr>
					<tr>
						<td>Tissue Type:</td>
						<td><?php echo $data['barcode']['tissue_type'] ?></td>
						<td>Sex:</td>
						<td><?php echo $data['barcode']['sex'] ?></td>										
					</tr>
					<tr>
						<td>Brief Note:</td>
						<td><?php echo $data['barcode']['brief_note'] ?></td>
						<td>Taxon Id:</td>
						<td><?php echo $data['barcode']['taxon_id'] ?></td>										
					</tr>
					<tr>
						<td>Life Stage:</td>
						<td><?php echo $data['barcode']['life_stage'] ?></td>
						<td>Organelle:</td>
						<td><?php echo $data['barcode']['organelle'] ?></td>
					</tr>
					<tr>
						<td>Lineage:</td>
						<td><td colspan="2"></td>
					</tr>
					<tr>
						<td>Detailed Notes:</td>
						<td colspan="3"><?php echo $data['barcode']['detailed_notes'] ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" class="table table-bordered tbl">
					<tr>
						<th colspan="4">SEQUENCE</th>								
					</tr>
					<tr>
						<td style="width:20%;">Sequence Id:</td>
						<td style="width:30%;"><?php echo $data['barcode']['sequence_id'] ?></td>										
						<td style="width:20%;">Gene:</td>
						<td style="width:30%;"><?php echo $data['barcode']['gene'] ?></td>
					</tr>
					<tr>
						<td>GenBank Accession:</td>
						<td><?php echo $data['barcode']['genbank_accession'] ?></td>
						<td>Genome:</td>
						<td><?php echo $data['barcode']['genome'] ?></td>										
					</tr>
					<tr>
						<td>Locus:</td>
						<td><?php echo $data['barcode']['locus'] ?></td>
						<td>Quality:</td>
						<td><?php echo $data['barcode']['quality'] ?></td>							
					</tr>
					<tr>
						<td>Nucleotides:</td>
						<td colspan="3"><?php echo $data['barcode']['seq_size'] ?></td>
					</tr>
					<tr>
						<td colspan="4"><?php echo $data['barcode']['sequence'] ?></td>
					</tr>
					<tr>
						<td>Amino Acids:</td>
						<td colspan="3"><?php echo $data['barcode']['pep_size'] ?></td>
					</tr>
					<tr>
						<td colspan="4">
							<?php echo $data['barcode']['peptide'] ?>											
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" class="table table-bordered tbl">
					<tr>
						<th colspan="4">IMAGES</th>								
					</tr>
					<tr>
						<td colspan="4">
							<?php foreach($data['file_img'] as $ds){ ?>
								<div class="col-lg-3">
									<div class="form-group">
										<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
											<img style="height:160px;width:240" src="{{asset('public/uploads/img/'.$ds['file_id'].'.jpg')}}" alt="...">
										</a>					
									</div>								
								</div>
							<?php } ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" class="table table-bordered tbl">
					<tr>
						<th colspan="4">LOCATION</th>								
					</tr>
					<tr>
						<td colspan="4">
							<div id="map" style="width: 100%; height: 700px;"></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>		
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