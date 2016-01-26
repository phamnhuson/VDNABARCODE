@extends('templates.master')

@section('title', 'Ngân hàng dữ liệu DNA Việt Nam - List gene')

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
					<h1 id="title">List of genes</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">	

	<table style="font-size:11pt">
		<?php $i=1 ?>
		<?php foreach($data['list_gene'] as $lg){ ?>
			<tr>
				<td>
					<?php echo $i++ ?>.&nbsp;&nbsp;
				</td>
				<td>					
					<p style="margin-bottom:0px;">
					<b>
						<a href="viewgene?id={{ $lg['sequence_id'] }}"><?php echo $lg['sequence_id'] ?></a> - <?php echo $lg['title'] ?> [<?php echo $lg['gene_name'] ?>:<?php echo $lg['size'] ?>]
					</b>
					</p>
					<p style="margin-bottom:0px;">
						<u>project name</u>:
						<?php echo $lg['project_name'] ?>
					</p>
					<p style="margin-bottom:0px;">
						<u>codon start</u>:
						<?php echo $lg['codon_start'] ?>
					</p>
					<p style="margin-bottom:10px;">
						<u>product</u>:
						<?php echo $lg['product'] ?>
					</p>
				</td>					
			</tr>
		<?php } ?>
	</table>
	<?php echo $data['list_gene']->render(); ?>
</div>

@endsection