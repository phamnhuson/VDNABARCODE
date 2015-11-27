@extends('templates.master')

@section('title', 'Gene')

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
	/*.bold{
		text-decoration:underline;
	}*/
	table {
		table-layout: fixed;
	}
	table {
		table-layout: fixed;
	}
	td{
		font-size:10pt;
		
	}	
	table{
		word-wrap: break-word;
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
					<h1 id="title">Gene</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<table width="100%" class="table table-striped table-bordered">
		<tr>
			<td style="width:200px;">Title:</td>
			<td colspan="2"><b><?php echo $data['gene'][0]['title'] ?></b></td>
		</tr>
		<tr>
			<td>Sequence ID:</td>
			<td><?php echo $data['gene'][0]['sequence_id'] ?></td>
			<td><a href="http://www.ncbi.nlm.nih.gov/gquery/?term=<?=$data['gene'][0]['sequence_id'];?>" target="_blank">Genbank Accession</a></td>
		</tr>
		<tr>
			<td>Source organism:</td>
			<td colspan="2"><?php echo $data['gene'][0]['source_organism'] ?></td>
			
		</tr>
		<tr>
			<td >Author(s):</td>
			<td colspan="2"><?php echo $data['gene'][0]['author'] ?></td>
		</tr>
		<tr>
			<td >Address:</td>
			<td colspan="2"><?php echo $data['gene'][0]['address'] ?></td>
		</tr>
		<tr>
			<td>Project name:</td>
			<td><?php echo $data['gene'][0]['project_name'] ?></td>
			<td>Level: <?php echo $data['gene'][0]['level'] ?></td>
		</tr>
		<tr>
			<td>Published:</td>
			<td colspan="2"><?php echo $data['gene'][0]['published'] ?></td>
		</tr>
		<tr>
			<td>Gene name(or DNA fragment)</td>
			<td><?php echo $data['gene'][0]['gene_name'] ?></td>	
			<td>Size: <?php echo $data['gene'][0]['size'] ?></br>Mol type: <?php echo $data['gene'][0]['mol_type'] ?></br></td>	
		</tr>									
		<tr>
			<td>CDS</td>
			<td>
				<?php echo $data['gene'][0]['cds'] ?>
			</td>
			<td>
				Size: <?php echo $data['gene'][0]['cds_size'] ?></br>
				Codon start: <?php echo $data['gene'][0]['codon_start'] ?></br>
				Product: <?php echo $data['gene'][0]['product'] ?></br>
			</td>
		</tr>
		<tr>
			<td>Function/Feature:</td>
			<td colspan="2"><?php echo $data['gene'][0]['function_feature'] ?></td>
		</tr>
		<tr>
			<td colspan="3">Nucleotide sequence</td>
		</tr>
		<tr>
			<td colspan="3">
				<?php echo $data['gene'][0]['nucleotide_sequence'] ?>
			</td>
		</tr>
		<tr>
			<td colspan="3">Amino acid sequence</td>
		</tr>
		<tr>
			<td colspan="3">
				<?php echo $data['gene'][0]['amino_acid_sequence'] ?>
			</td>
		</tr>
	</table>
</div>

@endsection