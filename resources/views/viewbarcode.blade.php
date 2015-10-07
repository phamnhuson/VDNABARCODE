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
	.tbl{
		margin-bottom:0px;
		border:0px !important;
	}
	.tbl th{
		background:#90A1CA;
		border:0px !important;
	}
	.tbl td{
		border:0px !important;
		
	}
	.bold{
		text-decoration:underline;
	}
	table {
		table-layout: fixed;
	}
	td{
		font-size:10pt;
		padding:2px !important;
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
					<h1 id="title">MẪU BẢN GHI DNA BARCODE
						<a href="{{ url('download_data?id='.$data['barcode']['barcode_id'].'&type=json') }}" target="_blank" class="btn btn-danger btn-xs pull-right" style="margin-left:5px;">JSON <span class="glyphicon glyphicon-save"></span></a>
								<a href="{{ url('download_data?id='.$data['barcode']['barcode_id'].'&type=tsv') }}" target="_blank" class="btn btn-success btn-xs pull-right">TSV <span class="glyphicon glyphicon-save"></span></a>
					</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<table width="100%">
		<tr>
			<td style="width:75%">
				<table>
					<tr>
						<td>
							<table width="100%" class="table table-bordered tbl2" style="margin-bottom:0px">
								<tr>
									<td class="bold">Title:</td>
									<td colspan="3"><?php echo $data['barcode']['title'] ?></td>
								</tr>
								<tr>
									<td class="bold">Barcode Id:</td>
									<td colspan="3"><?php echo $data['barcode']['barcode_id'] ?></td>
								</tr>
								<tr>
									<td class="bold">Authors:</td>
									<td colspan="3"><?php echo $data['barcode']['authors'] ?></td>
								</tr>
								<tr>
									<td style="width:20%;" class="bold">Address:</td>
									<td style="width:30%;"><?php echo $data['barcode']['address'] ?></td>
									<td style="width:20%;" class="bold">Phone:</td>
									<td style="width:30%;"><?php echo $data['barcode']['phone'] ?></td>
								</tr>
								<tr>																			
									<td class="bold">Submitted date:</td>
									<td><?php echo $data['barcode']['submitted_date'] ?></td>
									<td class="bold">Email:</td>
									<td><?php echo $data['barcode']['email'] ?></td>
								</tr>					
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%" class="table table-bordered tbl">
								<tr>
									<th colspan="4">IDENTIFIERS:</th>								
								</tr>
								<tr>
									<td style="width:20%;" class="bold">Sample ID:</td>
									<td style="width:30%;"><?php echo $data['barcode']['sample_id'] ?></td>
									<td style="width:20%;" class="bold">Museun ID:</td>
									<td style="width:30%;"><?php echo $data['barcode']['museum_id'] ?></td>
								</tr>
								<tr>
									<td class="bold">Field ID:</td>
									<td><?php echo $data['barcode']['field_id'] ?></td>																			
									<td class="bold">Collection Code:</td>
									<td><?php echo $data['barcode']['collection_code'] ?></td>
								</tr>
								<tr>
									<td class="bold">Deposited In:</td>
									<td colspan="3"><?php echo $data['barcode']['deposited_in'] ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%" class="table table-bordered tbl">
								<tr>
									<th colspan="4">TAXONOMY:</th>								
								</tr>
								<tr>
									<td style="width:20%;" class="bold">Phylum:</td>
									<td style="width:30%;"><?php echo $data['barcode']['phylum_name'] ?></td>			
									<td style="width:20%;" class="bold">Subfamily:</td>
									<td style="width:30%;"><?php echo $data['barcode']['subfamily'] ?></td>
								</tr>
								<tr>
									<td class="bold">Class:</td>
									<td><?php echo $data['barcode']['class_name'] ?></td>
									<td class="bold">Genus:</td>
									<td><?php echo $data['barcode']['genus_name'] ?></td>																			
								</tr>
								<tr>
									<td class="bold">Order:</td>
									<td><?php echo $data['barcode']['order_name'] ?></td>									
									<td class="bold">Species:</td>
									<td><?php echo $data['barcode']['species_name'] ?></td>	
								</tr>
								<tr>	
									<td class="bold">Family:</td>
									<td><?php echo $data['barcode']['family_name'] ?></td>
									<td class="bold">BIN (Cluster ID):</td>
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
									<th colspan="4">SPECIMEN DETAILS:</th>								
								</tr>
								<tr>
									<td style="width:20%;" class="bold">Voucher Status:</td>
									<td style="width:30%;"><?php echo $data['barcode']['voucher_status'] ?></td>										
									<td style="width:20%;" class="bold">Reproduction:</td>
									<td style="width:30%;"><?php echo $data['barcode']['reproduction'] ?></td>
								</tr>
								<tr>
									<td class="bold">Tissue Type:</td>
									<td><?php echo $data['barcode']['tissue_type'] ?></td>
									<td class="bold">Sex:</td>
									<td><?php echo $data['barcode']['sex'] ?></td>										
								</tr>
								<tr>
									<td class="bold">Brief Note:</td>
									<td><?php echo $data['barcode']['brief_note'] ?></td>
									<td class="bold">Life Stage:</td>
									<td><?php echo $data['barcode']['life_stage'] ?></td>
									<!--<td class="bold">Taxon Id:</td>
									<td><?php // echo $data['barcode']['taxon_id'] ?></td>-->								
								</tr>
								<!--<tr>
									<td class="bold">Life Stage:</td>
									<td><?php // echo $data['barcode']['life_stage'] ?></td>
									<td class="bold">Organelle:</td>
									<td><?php // echo $data['barcode']['organelle'] ?></td>
								</tr>-->
								<!--<tr>
									<td class="bold">Lineage:</td>
									<td><td colspan="2"></td>
								</tr>-->
								<tr>
									<td class="bold">Detailed Notes:</td>
									<td colspan="3"><?php echo $data['barcode']['detailed_notes'] ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%" class="table table-bordered tbl">
								<tr>
									<th colspan="4">COLLECTION DATA:</th>								
								</tr>
								<tr>
									<td style="width:20%;" class="bold">Country:</td>
									<td style="width:30%;"><?php echo $data['barcode']['country'] ?></td>										
									<td style="width:20%;" class="bold">Date Collected:</td>
									<td style="width:30%;"><?php echo $data['barcode']['date_collected'] ?></td>
								</tr>
								<tr>
									<td class="bold">Province State:</td>
									<td><?php echo $data['barcode']['province_state'] ?></td>
									<td class="bold">Collectors:</td>
									<td><?php echo $data['barcode']['collectors'] ?></td>										
								</tr>
								<tr>
									<td class="bold">Region/Country:</td>
									<td colspan="3"><?php echo $data['barcode']['region_country'] ?></td>								
								</tr>
								<tr>
									<td class="bold">Sector:</td>
									<td colspan="3"><?php echo $data['barcode']['sector'] ?></td>
								</tr>
								<tr>
									<td class="bold">Exact Site:</td>
									<td colspan="3"><?php echo $data['barcode']['exact_site'] ?></td>
								</tr>
								<tr>
									<td class="bold">Latitude:</td>
									<td><?php echo $data['barcode']['latitude'] ?></td>
									<td class="bold">Elevation:</td>
									<td><?php echo $data['barcode']['elevation'] ?></td>	
								</tr>
								<tr>
									<td class="bold">Longitude:</td>
									<td><?php echo $data['barcode']['longitude'] ?></td>
									<td class="bold">Elv.Accuracy:</td>
									<td><?php echo $data['barcode']['elv_accuracy'] ?></td>	
								</tr>
								<tr>
									<td class="bold">Coord.Source:</td>
									<td><?php echo $data['barcode']['coord_source'] ?></td>
									<td class="bold">Depth:</td>
									<td><?php echo $data['barcode']['depth'] ?></td>	
								</tr>
								<tr>
									<td class="bold">Coord.Accuracy:</td>
									<td><?php echo $data['barcode']['coord_source'] ?></td>
									<td class="bold">Depth Accuracy:</td>
									<td><?php echo $data['barcode']['depth_accuracy'] ?></td>	
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%" class="table table-bordered tbl">
								<tr>
									<th colspan="4">PRIMERS:</th>								
								</tr>
								<tr>
									<td style="width:20%;" class="bold">Forward Primer Name:</td>
									<td style="width:15%;"><?php echo $data['barcode']['fprimername'] ?></td>										
									<td style="width:20%;" class="bold">Sequence (5'-3'):</td>
									<td style="width:45%;"><?php echo $data['barcode']['fprimer'] ?></td>
								</tr>
								<tr>
									<td class="bold">Reverse Primer Name:</td>
									<td><?php echo $data['barcode']['rprimername'] ?></td>
									<td class="bold">Sequence (5'-3'):</td>
									<td><?php echo $data['barcode']['rprimer'] ?></td>										
								</tr>					
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%" class="table table-bordered tbl">
								<tr>
									<th colspan="1">SEQUENCE:</th>
									<th colspan="3"><?php echo $data['barcode']['gene'] ?></th>
								</tr>
								<tr>
									<td style="width:20%;" class="bold">Sequence Id:</td>
									<td style="width:30%;"><?php echo $data['barcode']['sequence_id'] ?></td>										
									<td style="width:20%;" class="bold">GenBank Accession:</td>
									<td style="width:30%;"><?php echo $data['barcode']['genbank_accession'] ?></td>
								</tr>
								<tr>
									<td class="bold">Last Updated:</td>
									<td><?php echo $data['barcode']['last_updated'] ?></td>
									<td class="bold">Genome:</td>
									<td><?php echo $data['barcode']['genome'] ?></td>										
								</tr>
								<tr>
									<td class="bold">Locus:</td>
									<td><?php echo $data['barcode']['locus'] ?></td>
									<td class="bold">Quality:</td>
									<td><?php echo $data['barcode']['quality'] ?></td>							
								</tr>
								<tr>
									<td class="bold">Nucleotides:</td>
									<td colspan="3"><?php echo $data['barcode']['seq_size'] ?></td>
								</tr>
								<tr>
									<td colspan="4"><?php echo $data['barcode']['sequence'] ?></td>
								</tr>
								<tr>
									<td class="bold">Amino Acids:</td>
									<td colspan="3"><?php echo $data['barcode']['pep_size'] ?></td>
								</tr>
								<tr>
									<td colspan="4">
										<?php echo $data['barcode']['peptide'] ?>											
									</td>
								</tr>
								<tr>
									<td colspan="4" class="bold">Illustrative Barcode:</td>
								</tr>
								<tr>
									<td colspan="4"><div><canvas id="barcode-canvas"></canvas></div></td>
								</tr>
							</table>
						</td>
					</tr>
					
				</table>
			</td>
			<td style="width:25%;padding-left:10px;">
				<table style="width:100%">					
					<tr>
						<td>
							<a href="/viewspecies?id=<?php echo $data['barcode']['species'] ?>" target="_blank">Thông tin về loài (species information)</a>
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
												<div class="form-group">
													<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
														<img style="height:160px;width:240" src="{{asset('public/uploads/img/'.$ds['file_id'].'.jpg')}}" alt="...">
													</a>					
												</div>								
										<?php } ?>
									</td>
								</tr>
							</table>
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
		  zoom: 5,
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
<script>
	var sequence = "<?php echo preg_replace( "/\r|\n/", "", $data['barcode']['sequence']) ?>";
	
	function drawBarcode(element, sequence){
		var c=document.getElementById(element); 
		sequence = sequence.trim().replace(/(\s|\r\n|\n|\r)/gm,"").toUpperCase();
		var ctx=c.getContext("2d"); 
		ctx.canvas.height = (Math.floor(sequence.length/c.offsetWidth)+1)*80;
		ctx.canvas.width  = c.parentNode.offsetWidth;
		var color;
		var bheigh = 20;
		var theigh = 10;
		
		ctx.fillStyle="black";
		ctx.fillText("0", 0, theigh);
		
		var j = 0;
		
		for(var i=0; i<sequence.length; i++)
		{
			switch(sequence[i])
			{
				case 'A': color = 'rgb(0,248,0)'; break;
				case 'T': color = 'rgb(255,0,0)'; break;
				case 'G': color = 'rgb(0,0,0)'; break;
				case 'C': color = 'rgb(0,0,248)'; break;
				default: color = 'rgb(255,255,255)'; break;
			}

			ctx.fillStyle=color;
			ctx.fillRect(j, bheigh, 1, 50);
			
			if(j >= c.offsetWidth-6)
			{
				ctx.fillStyle="black";
				ctx.fillText(i+1, j-(String(i).length*6), theigh);
				// console.log(i);
				bheigh = bheigh + 80;
				theigh = theigh + 80;
				j = 0;
				ctx.fillText(i+2, 0, theigh);
			}
			else
			{
				j+=2;
			}
			
		}
		ctx.fillStyle="black";
		ctx.fillText(sequence.length, j-(String(sequence.length).length*6), theigh);
	}	
	
	drawBarcode('barcode-canvas', sequence);
	
</script>
@endsection