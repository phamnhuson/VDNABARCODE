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
					@foreach ($errors as $error)
						<li>{{ $error[0] }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		</br>
		<div class="row">
			<div class="col-md-12" style="padding:0px">
				<div class="nav-tabs-custom" style="margin-bottom: 0px; box-shadow:none;">
					<ul class="nav nav-tabs">
						<li class='active'>
							<a href="#tab1" data-toggle='tab' id='page1'>Thông tin</a>
						</li>
						<li>
							<a href="#tab2" data-toggle='tab' id='page2'>Dữ liệu ảnh</a>
						</li>
						<li>
							<a href="#tab3" data-toggle='tab' id='page3'>File</a>
						</li>
						<li>
							<a href="#tab5" data-toggle='tab' id='page5'>Địa Phương</a>
						</li>
						<li>
							<a href="#tab4" data-toggle='tab' id='page4'>Vị trí</a>
						</li>
					</ul>
				</div>
			</div>				
		</div>
		</br>
		{!! Form::open(array('method' => (isset($data['barcode'])) ? 'PUT' : 'POST', 'enctype'=>'multipart/form-data', 'files' => true)) !!}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="tab-content col-md-12" style="padding:0px;">
				<div class="tab-pane active" id="tab1">
					<input type="hidden" name="barcode_id" value="{{ @$data['barcode'][0]['barcode_id'] }}" />
					<table class="col-lg-12">
						<tr>
							<td>
								<table width="100%" class="table table-bordered tbl">
									<tr>
										<th colspan="4">IDENTIFIERS</th>								
									</tr>
									<tr>
										<td style="width:200px;">Sample ID:</td>
										<td>{!! Form::text('sample_id', @$data['barcode'][0]['sample_id'], array('style'=>'width:100%')) !!}</td>
										<td>Field ID:</td>
										<td>{!! Form::text('field_id', @$data['barcode'][0]['field_id'], array('style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td style="width:200px;">Museun ID:</td>
										<td>{!! Form::text('museun_id', @$data['barcode'][0]['museum_id'], array('style'=>'width:100%')) !!}</td>										
										<td>Collection Code:</td>
										<td>{!! Form::text('collection_code', @$data['barcode'][0]['collection_code'], array('style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td>Deposited In:</td>
										<td colspan="3">{!! Form::text('deposited_in', @$data['barcode'][0]['deposited_in'], array('style'=>'width:100%')) !!}</td>
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
									<!--<tr>
										<td style="width:200px;">Phylum:</td>
										<td>{!! Form::text('phylum', @$data['barcode'][0]['phylum'], array('style'=>'width:100%')) !!}</td>										
										<td style="width:200px;">Class:</td>
										<td>{!! Form::text('class', @$data['barcode'][0]['class'], array('style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td>Order:</td>
										<td>{!! Form::text('order', @$data['barcode'][0]['order'], array('style'=>'width:100%')) !!}</td>
										<td>Family:</td>
										<td>{!! Form::text('family', @$data['barcode'][0]['family'], array('style'=>'width:100%')) !!}</td>										
									</tr>
									<tr>
										<td>Subfamily:</td>
										<td>{!! Form::text('subfamily', @$data['barcode'][0]['subfamily'], array('style'=>'width:100%')) !!}</td>
										<td>Genus:</td>
										<td>{!! Form::text('genus', @$data['barcode'][0]['genus'], array('style'=>'width:100%')) !!}</td>										
									</tr>-->
									<tr>
										<td>Species:</td>
										<td>{!! Form::select('species', @$data['arr_species'],@$data['barcode'][0]['species'], array('style'=>'width:100%')) !!}</td>
										<td>Common Name:</td>
										<td>{!! Form::text('common_name', @$data['barcode'][0]['common_name'], array('style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td>Scientific Name:</td>
										<td>{!! Form::text('scientific_name', @$data['barcode'][0]['scientific_name'], array('style'=>'width:100%')) !!}</td>
										<td>Vietnamese Name:</td>
										<td>{!! Form::text('vietnamese_name', @$data['barcode'][0]['vietnamese_name'], array('style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td>BIN (Cluster ID):</td>
										<td>{!! Form::text('bin', @$data['barcode'][0]['bin'], array('style'=>'width:100%')) !!}</td>
										<td colspan="2"></td>
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
										<td style="width:200px;">Voucher Status:</td>
										<td>{!! Form::text('voucher_status', @$data['barcode'][0]['voucher_status'], array('style'=>'width:100%')) !!}</td>										
										<td style="width:200px;">Reproduction:</td>
										<td>{!! Form::text('reproduction', @$data['barcode'][0]['reproduction'], array('style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td>Tissue Descriptor:</td>
										<td>{!! Form::text('tissue_type', @$data['barcode'][0]['tissue_type'], array('style'=>'width:100%')) !!}</td>
										<td>Sex:</td>
										<td>{!! Form::text('sex', @$data['barcode'][0]['sex'], array('style'=>'width:100%')) !!}</td>										
									</tr>
									<tr>
										<td>Brief Note:</td>
										<td>{!! Form::text('brief_note', @$data['barcode'][0]['brief_note'], array('style'=>'width:100%')) !!}</td>
										<td>Taxon Id:</td>
										<td>{!! Form::text('taxon_id', @$data['barcode'][0]['taxon_id'], array('style'=>'width:100%')) !!}</td>										
									</tr>
									<tr>
										<td>Life Stage:</td>
										<td>{!! Form::text('life_stage', @$data['barcode'][0]['life_stage'], array('style'=>'width:100%')) !!}</td>
										<td>Organelle:</td>
										<td>
										{!! Form::text('organelle', @$data['barcode'][0]['organelle'], array('style'=>'width:100%')) !!}
										</td>
									</tr>
									<tr>
										<td>Lineage:</td>
										<td>{!! Form::text('lineage', @$data['barcode'][0]['lineage'], array('style'=>'width:100%')) !!}</td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td>Detailed Notes:</td>
										<td colspan="3">
										{!! Form::textarea('detailed_notes', @$data['barcode'][0]['detailed_notes'], array('style'=>'width:100%','rows'=>'4','cols'=>'1')) !!}
										</td>
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
										<td style="width:200px;">Sequence Id:</td>
										<td>{!! Form::text('sequence_id', @$data['barcode'][0]['sequence_id'], array('style'=>'width:100%')) !!}</td>										
										<td style="width:200px;">Gene:</td>
										<td>{!! Form::text('gene', @$data['barcode'][0]['gene'], array('style'=>'width:100%')) !!}</td>
									</tr>
									<tr>
										<td>GenBank Accession:</td>
										<td>{!! Form::text('genbank_accession', @$data['barcode'][0]['genbank_accession'], array('style'=>'width:100%')) !!}</td>
										<td>Genome:</td>
										<td>{!! Form::text('genome', @$data['barcode'][0]['genome'], array('style'=>'width:100%')) !!}</td>										
									</tr>
									<tr>
										<td>Locus:</td>
										<td>
										{!! Form::text('locus', @$data['barcode'][0]['locus'], array('style'=>'width:100%')) !!}
										</td>
										<td>Quality:</td>
										<td>
										{!! Form::text('quality', @$data['barcode'][0]['quality'], array('style'=>'width:100%')) !!}
										</td>							
									</tr>
									<tr>
										<td>Nucleotides:</td>
										<td colspan="3">
										{!! Form::text('seq_size', @$data['barcode'][0]['seq_size'], array('style'=>'width:100%','placeholder'=>'Độ dài nucleotides')) !!}</td>
									</tr>
									<tr>
										<td colspan="4">
										{!!Form::textarea('sequence',@$data['barcode'][0]['sequence'],array('style'=>'width:100%','rows'=>'10','cols'=>'1')) !!}
										</td>
									</tr>
									<tr>
										<td>Amino Acids:</td>
										<td colspan="3">{!! Form::text('pep_size',@$data['barcode'][0]['pep_size'],array('style'=>'width:100%','placeholder'=>'Độ dài amino acids')) !!}</td>
									</tr>
									<tr>
										<td colspan="4">
											{!! Form::textarea('peptide', @$data['barcode'][0]['peptide'], array('style'=>'width:100%','rows'=>'10','cols'=>'1')) !!}											
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					
				</div>
				<div class="tab-pane" id="tab2">
					<div class="row">
						<div class="panel panel-default">
							<div class="panel-heading"><h4 style="color:#f0ad4e;">Chọn ảnh mẫu vật</h4></div>
							<div class="panel-body" id="app">
								<div class="col-md-2" id="cot_1">
									<div class="form-group" >
										<div class="upanh" id="upanh_1" data_id="1">
											<a> 
												<img class='col-md-12' style="padding:6px;margin-top:10px;margin-bottom:10px;border:2px dashed #0087F7;height:130px;width:140" id="img_1" src="{{asset('public/img/add.png')}}" alt="Chọn mẫu vật" />										
											</a>									
										</div>
										<div id="btx_1">
										</div>				
										{!! Form::file('images[]', array('class'=>'form-control imgInp','style'=>'display:none;','id'=>'imgInp_1','data_id'=>'1')) !!}
									</div>
								</div>
							</div>
						</div>						
					</div>
					<?php if(isset($data['file_img'])){ ?>					
					<div class="row">						
						<hr style="border-top: 1px solid #ddd;"/>						
					</div>
					<div class="row">
						<div class="panel panel-default">
							<div class="panel-heading"><h4 style="color:#f0ad4e;">Dữ liệu ảnh</h4></div>
							<div class="panel-body">
								<?php foreach($data['file_img'] as $ds){ ?>
									<div class="col-md-2" id="group_img_<?php echo $ds['file_id']; ?>">
										<div class="form-group">
											<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
												<img style="height:130px;width:140" src="{{asset('public/uploads/img/'.$ds['file_id'].'.jpg')}}" alt="...">
											</a>
											<button type="button" class="btn btn-danger delete" data_id="<?php echo $ds['file_id']; ?>" style="width:146px;"><span class='glyphicon glyphicon-trash'></span></button>
										</div>								
									</div>
								<?php } ?>
							</div>
						</div>						
					</div>
					<?php } ?>
				</div>
				<div class="tab-pane" id="tab3">
					<table width="100%" class="form-table">
						<tr>
							<td class="col-md-5" id="addf" style="padding:0px 5px 0px 0px;">
								<div class="form-group">
									{!! Form::file('files[]', array('class'=>'form-control file','id'=>'file_1','data_id'=>'1')) !!}
									</br>
									<button type="button" class="btn btn-success afile" id="afile_1" data_id="1"><span class="glyphicon glyphicon-plus"></span></button>
								</div>
							</td>							
							<td class="col-md-6" style="padding:0px 0px 0px 5px;">
							<table class="table table-striped table-bordered">
								<tr>
									<th style="text-align:center;width:70px;">STT</th>
									<th >Tên file</th>
									<th style="text-align:center;width:100px;">Chức năng</th>
								</tr>
								<?php if(isset($data['file_trace'])){ ?>
								<?php $i=1; ?>
								<?php foreach($data['file_trace'] as $dsf){ ?>
									<tr id="file_<?php echo $dsf['file_id']; ?>">
										<td style="text-align:center;"><?php echo $i++; ?></td>
										<td>file_<?php echo $dsf['file_id']; ?></td>
										<td style="text-align:center;">
											<button type="button" class="btn btn-danger delete_file" data_id="<?php echo $dsf['file_id'] ?>"><span class="glyphicon glyphicon-trash"></span></button>
											<a href="{{asset('public/uploads/file/'.$dsf['file_name'])}}"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download"></span></button></a>
										</td>
									</tr>
								<?php } ?>
								<?php } ?>
							</table>
							<?php if(isset($data['file_trace'])){ ?>
								<?php echo $data['file_trace']->render(); ?>
							<?php } ?>
							</td>							
					</table>
				</div>
				
				<div class="tab-pane" id="tab4">
					<div class="row">
						<div id="map" style="width: 100%; height: 700px;"></div>
					</div>
					</br>
					<table width="100%" class="form-table">
						<tr>
						<td class="col-md-6" style="padding:0px 5px 0px 0px;">
							<table class="table table-striped table-bordered">
								<tr>
									<th style="text-align:center !important;width:70px;">STT</th>
									<th style="width:179px;">Kinh độ</th>
									<th style="width:179px;">Vĩ độ</th>
									<th style="text-align:center !important;width:100px;">Chức năng</th>
								</tr>
								<?php if(isset($data['location'])){ ?>
								<?php $i=1; ?>
								<?php foreach($data['location'] as $dsf){ ?>
									<tr id="loca_<?php echo $dsf['location_id']; ?>">
										<td style="text-align:center;"><?php echo $i++; ?></td>
										<td><?php echo $dsf['longitude']; ?></td>
										<td><?php echo $dsf['latitude']; ?></td>
										<td style="text-align:center;">
											<button type="button" class="btn btn-danger delete_loca" data_id="<?php echo $dsf['location_id']; ?>"><span class="glyphicon glyphicon-trash"></span></button>											
										</td>
									</tr>
								<?php } ?>
								<?php } ?>
							</table>
							<?php if(isset($data['location'])){ ?>
								<?php echo $data['location']->render(); ?>
							<?php } ?>
						</td>
						<td class="col-md-5" style="padding:0px 0px 0px 5px;">
							<table width="100%" class="form-table" id="add_td">
									<tr>
										<td colspan="2" class="col-md-12" style="padding:0px">
											<div class="form-group">
												{!! Form::text('sector[]', @$data['barcode'][0]['sector'], array('class'=>'form-control','placeholder'=>'Khu vực')) !!}
											</div>										
										</td>
									</tr>
									<tr>
										<td class="col-md-6" style="padding:0px 5px 0px 0px;">
											<div class="form-group">
												{!! Form::text('longitude[]', @$data['barcode'][0]['longitude'], array('class'=>'form-control','placeholder'=>'Kinh độ')) !!}
											</div>										
										</td>
										<td class="col-md-6" style="padding:0px 0px 0px 5px;">
											<div class="form-group">
												{!! Form::text('latitude[]', @$data['barcode'][0]['latitude'], array('class'=>'form-control','placeholder'=>'Vĩ độ')) !!}
											</div>
										</td>
									</tr>
							</table>
							</br>
							<div class="row">
								<div class="form-group">
									<button type="button" class="btn btn-success atd" id="atd_1" data_id="1"><span class="glyphicon glyphicon-plus"></span></button>
								</div>
							</div>							
						</td>
					</table>
				</div>
				<div class="tab-pane" id="tab5">
					<table width="100%" class="form-table">					
						<td class="col-md-5" style="padding:0px 5px 0px 0px;">
							<div class="row" id="addtp">
								<div class="form-group">
									<select class="form-control" name="cities[]">
										<option value=''>Chọn tỉnh thành</option>
										<?php foreach($data['list_city'] as $ct){ ?>
											<option value="<?php echo $ct['city_id']; ?>"><?php echo $ct['city_name']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<br/>
							<div class="row">
								<div class="form-group">
									<button type="button" class="btn btn-success" id="addcity"><span class="glyphicon glyphicon-plus"></span></button>
								</div>
							</div>
						</td>
						<td class="col-md-6" style="padding:0px 0px 0px 5px;">
							<table class="table table-striped table-bordered">
								<tr>
									<th style="text-align:center;width:70px;">STT</th>
									<th >Tên địa phương</th>
									<th style="text-align:center;width:100px;">Chức năng</th>
								</tr>
								@if (isset($data['barcode']))
								<?php $i=1; ?>
								<?php foreach($data['barcode2city'] as $b2c){ ?>
									<tr id="b2c_<?php echo $b2c['id']; ?>">
										<td style="text-align:center;"><?php echo $i++; ?></td>
										<td><?php echo $b2c['city_name']; ?></td>
										<td style="text-align:center;">
											<button type="button" class="btn btn-danger delete_city" data_id="<?php echo $b2c['id'] ?>"><span class="glyphicon glyphicon-trash"></span></button>											
										</td>
									</tr>
								<?php } ?>
								@endif
							</table>
							@if (isset($data['barcode']))
								<?php echo $data['barcode2city']->render(); ?>
							@endif
						</td>
					</table>
				</div>
			</div>
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['barcode'])) Cập nhật @else Thêm mới @endif" />
			</div>
		{!! Form::close() !!}
	</div>
</div>
<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" style='margin-top:100px;'>
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-content">
            <div class="modal-body">
                <img style="width:400px;height:300px;" src="" alt="" />
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){
	var locations= <?php echo $data['loca']; ?>;
	function readURL(input, bien) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + bien).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
	
	$(document).on('change','.imgInp',function(){		
		$data_id = $(this).attr('data_id');		
        readURL(this, 'img_'+$data_id);
		$id=parseInt($data_id)+1;
		$option= "";
		$option += "<div class='col-md-2' id='cot_"+$id+"'>";
		$option += 		"<div class='form-group'>";
		$option += 			"<div class='upanh' id='upanh_" + $id + "' data_id='" + $id + "'>";
		$option +=				"<a>";
		$option +=					"<img class='col-md-12' style='padding:6px;margin-top:10px;margin-bottom:10px;border:2px dashed #0087F7;height:130px;width:140' src='{{asset('public/img/add.png')}}' alt='Chọn mẫu vật' id='img_"+$id+"' />";
		$option +=				"</a>";
		$option += 			"</div>";
		$option +=			"<div id='btx_"+$id+"'>";
		$option +=			"</div>"
		//$option	+=			"<button type='button' class='btn btn-primary xoa' style='width:140px;' data_id='" +$id+"'><span class='glyphicon glyphicon-trash'></span></button>"
		$option +=			"<input type='file' name='images[]' style='display:none' class='form-control imgInp' id='imgInp_"+ $id +"' data_id='"+$id+"'/>";
		$option += 		"</div>";
		$option += "</div>";
		$("#app").append($option);
		$(this).attr('class','form-control imgch');
		$('#upanh_'+$data_id).attr('class','change');
		$option2 ="";
		$option2 += "<button type='button' class='btn btn-warning xoa' style='width:140px;' data_id='" + $data_id + "'><span class='glyphicon glyphicon-trash'></span></button>";
		$("#btx_"+$data_id).append($option2);
    });
	
	$(document).on('change','.imgch',function(){		
		$data_id = $(this).attr('data_id');		
        readURL(this, 'img_'+$data_id);
    });

	$(document).on('click','.upanh',function(){
		$data_id = $(this).attr('data_id');		
		$('#imgInp_'+$data_id).click();
	})
	
	$(document).on('click','.change',function(){
		$data_id = $(this).attr('data_id');		
		$('#imgInp_'+$data_id).click();
	})
	
	$(document).on('click','.xoa',function(){
		$data_id = $(this).attr('data_id');
		//$('#img_'+$data_id).attr('src','');
		$('#cot_'+$data_id).remove();
	})	
	
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
	

	$(document).on('click','.afile',function(){
		$data_id = $(this).attr('data_id');
		$id = parseInt($data_id)+1;
		$('#afile_'+$data_id).remove();
		$option = "";
		$option += "<div class='form-group'>";
		$option += "<input type='file' name='files[]' class='form-control file' id='file_"+ $id +"' data_id='"+$id+"'/>";
		$option += "</br>";
		$option += "<button type='button' class='btn btn-success afile' id='afile_" + $id +"' data_id='" + $id + "'> <span class='glyphicon glyphicon-plus'></span></button>";
		$option += "</div>";
		$('#addf').append($option);
	});

	$(document).on('click','#addcity',function(){
		$option = "";
		$option += 		"<div class='form-grounp'>";
		$option +=			"<select class='form-control' name='cities[]'>";
		$option += 				"<option value=''>Chọn tỉnh thành</option>";
		$option +=				"<?php foreach($data['list_city'] as $ct){ ?>";
		$option +=					"<option value='<?php echo $ct['city_id'] ?>'><?php echo $ct['city_name'] ?></option>";
		$option +=				"<?php } ?>"		
		$option +=			"</select>";
		$option += 		"</div>";
		$('#addtp').append($option);
	});

	$(document).on('click','.atd',function(){
		$option = "";
		$option += "<tr>";
		$option += 		"<td colspan='2' class='col-md-12' style='padding:0px'>";
		$option +=			"<div class='form-group'>";
		$option +=				"<input type='text' class='form-control' name='sector[]' placeholder='Khu vực'/>";
		$option +=			"</div>";
		$option +=		"</td>";
		$option	+= "</tr>"
		$option += "<tr style='height:49px;'>";
		$option += 		"<td class='col-md-6' style='padding:0px 5px 0px 0px;'>";
		$option +=			"<div class='form-grounp'>";
		$option +=				"<input type='text' class='form-control' name='longitude[]' placeholder='Kinh độ'/>";
		$option +=			"</div>";
		$option +=		"</td>";
		$option += 		"<td class='col-md-6' style='padding:0px 0px 0px 5px;'>";
		$option +=			"<div class='form-grounp'>";
		$option +=				"<input type='text' class='form-control' name='latitude[]' placeholder='Vĩ độ'/>";
		$option +=			"</div>";
		$option +=		"</td>";
		$option += "</tr>";
		$('#add_td').append($option);
	});
	
	$(document).on('click','.delete',function(){
		id_img = $(this).attr('data_id');
		$.ajax({
			type: "GET",
			url : "/delete_img",
			data: {'id':id_img},
			dataType: 'json',
			success:function(data){
				$('#group_img_'+id_img).remove();
			}
		});
	});
	
	$(document).on('click','.delete_file',function(){
		id_file = $(this).attr('data_id');
		$.ajax({
			type: "GET",
			url : "/delete_file",
			data: {'id':id_file},
			dataType: 'json',
			success:function(data){
				$('#file_'+id_file).remove();
			}
		});
	});
	
	$(document).on('click','.delete_loca',function(){
		id_loca = $(this).attr('data_id');
		$.ajax({
			type: "GET",
			url : "/delete_loca",
			data: {'id':id_loca},
			dataType: 'json',
			success:function(data){
				$('#loca_'+id_loca).remove();
			}
		});
	});	
	
	$(document).on('click','.delete_city',function(){
		id = $(this).attr('data_id');
		$.ajax({
			type: "GET",
			url : "/delete_city",
			data: {'id':id},
			dataType: 'json',
			success:function(data){
				$('#b2c_'+id).remove();
			}
		});
	});	
	
	$(document).on('click','#page4',function(){
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
});
</script>
@endsection