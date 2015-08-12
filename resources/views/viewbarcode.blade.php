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
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Barcode</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['barcode']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Sequence</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['sequence']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Peptide</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['peptide']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Sequence size</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['seq_size']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Peptide size</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['pep_size']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Gene</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['gene']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Taxon id</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['taxon_id']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Stop</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['stop']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Quality</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['quality']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Life stage</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['life_stage']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Organelle</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['organelle']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Tissue type</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['tissue_type']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Reproduction</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['reproduction']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Notes</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['notes']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Extra info</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['extra_info']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Sex</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['sex']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Lineage</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['lineage']; ?>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
				<h4>Species</h4>
			</div>
			<div class="col-lg-9 col-lg-offset-1" style="padding:0px;">
				<?php echo $data['barcode'][0]['species_name']; ?>
			</div>
		</div>
		<!--<hr/>
		<div class="row">
			<div class="col-lg-2" style="padding:0px;text-align:right;width:125px;">
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
		<hr/>
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
</script>	
@endsection