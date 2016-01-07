@extends('templates.master')

@section('title', 'Ngân hàng dữ liệu DNA Việt Nam - Gene')

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
	td{
		font-size:10pt;
	}
	.form-control2{		
		height:28px !important;
		border:1px solid #aaa;
		border-radius:4px;
		padding:4px;
	}

}
</style>
<!--<script src="{{ asset('public/js/google_map.js') }}"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 id="title">CẬP NHẬT DỮ LIỆU BARCODE</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<div class="row">
		
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
		</br>
		{!! Form::open(array('method' => (isset($data['gene'])) ? 'PUT' : 'POST', 'enctype'=>'multipart/form-data', 'files' => true)) !!}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="tab-content col-md-12" style="padding:0px;">
				<div class="tab-pane active" id="tab1">
					<table class="col-lg-12">
						<tr>
							<td>
								<table width="100%" class="table table-bordered tbl">
									<tr>
										<td >Title:</td>
										<td colspan="6" style="width:85%;">{!! Form::text('title', @$data['gene'][0]['title'], array('class'=>'form-control2','style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td >Sequence ID:</td>
										<?php if((isset($data['gene']))){ ?>
										<td colspan="6">{!! Form::text('sequence_id', @$data['gene'][0]['sequence_id'], array('class'=>'form-control2','style'=>'width:100%','disable')) !!}</td>
										<?php }else{ ?>
											<td colspan="6">{!! Form::text('sequence_id', @$data['gene'][0]['sequence_id'], array('class'=>'form-control2','style'=>'width:100%')) !!}</td>
										<?php } ?>
									</tr>
									<tr>
										<td >Genbank Accession:</td>
										<?php if((isset($data['genbank_accession']))){ ?>
										<td colspan="6">{!! Form::text('genbank_accession', @$data['gene'][0]['genbank_accession'], array('class'=>'form-control2','style'=>'width:100%','disable')) !!}</td>
										<?php }else{ ?>
											<td colspan="6">{!! Form::text('genbank_accession', @$data['gene'][0]['genbank_accession'], array('class'=>'form-control2','style'=>'width:100%')) !!}</td>
										<?php } ?>
									</tr>
									<tr>
										<td >Source organism:</td>
										<td colspan="6">{!! Form::text('source_organism', @$data['gene'][0]['source_organism'], array('class'=>'form-control2','style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td >Author(s):</td>
										<td colspan="6">{!! Form::text('author', @$data['gene'][0]['author'], array('class'=>'form-control2','style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td >Address:</td>
										<td colspan="6">{!! Form::text('address', @$data['gene'][0]['address'], array('class'=>'form-control2','style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td style="width:20%;">Project name:</td>
										<td colspan="4" style="width:60%;">{!! Form::text('project_name', @$data['gene'][0]['project_name'], array('class'=>'form-control2','style'=>'width:100%')) !!}</td>										
										<td style="width:10%;">Level:</td>
										<td style="width:10%;">{!! Form::text('level', @$data['gene'][0]['level'], array('class'=>'form-control2','style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td>Published:</td>
										<td colspan="6">{!! Form::text('published', @$data['gene'][0]['published'], array('class'=>'form-control2','style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td>Gene name(or DNA fragment)</td>
										<td colspan="2">{!! Form::textarea('gene_name', @$data['gene'][0]['gene_name'], 		array('class'=>'form-control','style'=>'width:100%','rows'=>'3')) !!}
										</td>
										<td style="width:10%;">Size</td>
										<td style="width:10%;">{!! Form::text('size', @$data['gene'][0]['size'], 		array('class'=>'form-control2','style'=>'width:100%')) !!}
										</td>
										<td>Mol type:</td>
										<td>
											<?php if(!isset($data['gene'])){ ?>
												{!! Form::radio('mol_type','DNA',true) !!}&nbsp;DNA</br>
												{!! Form::radio('mol_type','cDNA') !!}&nbsp;cDNA</br>
												{!! Form::radio('mol_type','mRNA') !!}&nbsp;mRNA
											<?php }else{ ?>
												<?php if($data['gene'][0]['mol_type']=='DNA'){ ?>
													{!! Form::radio('mol_type','DNA',true) !!}&nbsp;DNA</br>
												<?php }else{ ?>
													{!! Form::radio('mol_type','DNA') !!}&nbsp;DNA</br>
												<?php } ?>
												<?php if($data['gene'][0]['mol_type']=='cDNA'){ ?>
													{!! Form::radio('mol_type','cDNA',true) !!}&nbsp;cDNA</br>
												<?php }else{ ?>
													{!! Form::radio('mol_type','cDNA') !!}&nbsp;cDNA</br>
												<?php } ?>
												<?php if($data['gene'][0]['mol_type']=='mRNA'){ ?>
													{!! Form::radio('mol_type','mRNA',true) !!}&nbsp;mRNA</br>
												<?php }else{ ?>
													{!! Form::radio('mol_type','mRNA') !!}&nbsp;mRNA</br>
												<?php } ?>
											<?php } ?>
										</td>										
									</tr>									
									<tr>
										<td rowspan="3">CDS</td>
										<td rowspan="3">{!! Form::textarea('cds', @$data['gene'][0]['cds'], 		array('class'=>'form-control','style'=>'width:100%','rows'=>'6')) !!}</td>
										<td style="width:10%">Size:</td>
										<td colspan="4">
											{!! Form::text('cds_size', @$data['gene'][0]['cds_size'], 		array('class'=>'form-control2','style'=>'width:100%')) !!}
										</td>
									</tr>
									<tr>
										<td>Codon start:</td>
										<td colspan="4">
											{!! Form::text('codon_start', @$data['gene'][0]['codon_start'], 		array('class'=>'form-control2','style'=>'width:100%')) !!}
										</td>
									</tr>
									<tr>
										<td>Product:</td>
										<td colspan="4">
											{!! Form::text('product', @$data['gene'][0]['product'], 		array('class'=>'form-control2','style'=>'width:100%')) !!}
										</td>
									</tr>
									<tr>
										<td>Function/Feature:</td>
										<td colspan="6">{!! Form::text('function_feature', @$data['gene'][0]['function_feature'], array('class'=>'form-control2','style'=>'width:100%')) !!}
										</td>
									</tr>
									<tr>
										<td colspan="8">Nucleotide sequence</td>
									</tr>
									<tr>
										<td colspan="8">
											{!! Form::textarea('nucleotide_sequence', @$data['gene'][0]['nucleotide_sequence'], 		array('class'=>'form-control','style'=>'width:100%','rows'=>'6')) !!}
										</td>
									</tr>
									<tr>
										<td colspan="8">Amino acid sequence</td>
									</tr>
									<tr>
										<td colspan="8">
											{!! Form::textarea('amino_acid_sequence', @$data['gene'][0]['amino_acid_sequence'], 		array('class'=>'form-control','style'=>'width:100%','rows'=>'6')) !!}
										</td>
									</tr>
								</table>
							</td>
						</tr>						
					</table>					
				</div>
				
			</div>
			<div class="form-group">
				<input type="submit" name="submit" id="submit" class="btn btn-primary" value="@if (isset($data['gene'])) Cập nhật @else Thêm mới @endif" />
			</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection