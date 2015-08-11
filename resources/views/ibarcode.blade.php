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
}
</style>
<script src="{{ asset('public/js/google_map.js') }}"></script>
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
		<div class="row">
			<div class="col-lg-12" style="padding:0px">
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
							<a href="#tab4" data-toggle='tab' id='page4'>Vị trí</a>
						</li>
					</ul>
				</div>
			</div>				
		</div>
		</br>
		{!! Form::open(array('method' => (isset($data['barcode'])) ? 'PUT' : 'POST', 'enctype'=>'multipart/form-data', 'files' => true)) !!}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="tab-content col-lg-12" style="padding:0px;">
				<div class="tab-pane active" id="tab1">
					<div class="row">
						<div class="col-lg-12" style="padding:0px;">
							<div class="row">
								<div class="col-lg-9" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Sequence:</label>
										{!! Form::textarea('sequence', @$data['barcode'][0]['sequence'], array('class'=>'form-control','rows'=>'4','cols'=>'1')) !!}
									</div>
								</div>
								<div class="col-lg-2 col-lg-offset-1" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Sequence size:</label>
										{!! Form::text('seq_size', @$data['barcode'][0]['seq_size'], array('class'=>'form-control')) !!}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-9" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Peptide:</label>
										{!! Form::textarea('peptide', @$data['barcode'][0]['peptide'], array('class'=>'form-control','rows'=>'4','cols'=>'1')) !!}
									</div>
								</div>
								<div class="col-lg-2 col-lg-offset-1" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Peptide size:</label>
										{!! Form::text('pep_size', @$data['barcode'][0]['pep_size'], array('class'=>'form-control')) !!}
									</div>	
								</div>
							</div>
							<div class="row">
								<div class="col-lg-9" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Gene:</label>
										{!! Form::text('gene', @$data['barcode'][0]['gene'], array('class'=>'form-control')) !!}
									</div>
								</div>
								<div class="col-lg-2 col-lg-offset-1" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Taxon id:</label>
										{!! Form::text('taxon_id', @$data['barcode'][0]['taxon_id'], array('class'=>'form-control')) !!}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Life stage:</label>
										{!! Form::text('life_stage', @$data['barcode'][0]['life_stage'], array('class'=>'form-control')) !!}
									</div>
								</div>
								<div class="col-lg-4 col-lg-offset-1" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Organelle:</label>
										{!! Form::text('organelle', @$data['barcode'][0]['organelle'], array('class'=>'form-control')) !!}
									</div>
								</div>
								<div class="col-lg-2 col-lg-offset-1" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Quality:</label>
										{!! Form::text('quality', @$data['barcode'][0]['quality'], array('class'=>'form-control')) !!}										
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Tissue type:</label>
										{!! Form::text('tissue_type', @$data['barcode'][0]['tissue_type'], array('class'=>'form-control')) !!}
									</div>		
								</div>
								<div class="col-lg-4 col-lg-offset-1" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Barcode:</label>
										{!! Form::text('barcode', @$data['barcode'][0]['barcode'], array('class'=>'form-control')) !!}
									</div>
								</div>
								<div class="col-lg-2 col-lg-offset-1" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Reproduction:</label>
										{!! Form::text('reproduction', @$data['barcode'][0]['reproduction'], array('class'=>'form-control')) !!}
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Notes:</label>
										{!! Form::textarea('notes', @$data['barcode'][0]['notes'], array('class'=>'form-control','rows'=>'5')) !!}
									</div>	
								</div>
								<div class="col-lg-4 col-lg-offset-1" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Extra info:</label>
										{!! Form::textarea('extra_info', @$data['barcode'][0]['extra_info'], array('class'=>'form-control','rows'=>'5')) !!}
									</div>
								</div>
								<div class="col-lg-2 col-lg-offset-1" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Sex:</label>
										{!! Form::select('sex',array('0'=>'Đực','1'=>'Cái'), @$data['barcode'][0]['sex'], array('class'=>'form-control')) !!}
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-4" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Lineage:</label>
										{!! Form::text('lineage', @$data['barcode'][0]['lineage'], array('class'=>'form-control')) !!}
									</div>	
								</div>
								<div class="col-lg-4 col-lg-offset-1" style="padding:0px;">
									<div class="form-group">
										<label class="control-label">Species:</label>
										{!! Form::select('species', @$data['arr_species'],@$data['barcode'][0]['species'], array('class'=>'form-control')) !!}
									</div>	
								</div>
							</div>
							<br/>
							<div class="row">
								<div class="form-group">														
									<!--@if (isset($data['barcode']))
										<a href="{{ url('ibarcode') }}" class="btn btn-success">Thêm mới</a>
									@endif
									@if (isset($data['barcode']))
									<input type="hidden" name="barcode_id" value="{{ @$data['barcode'][0]['barcode_id'] }}" />
									<input type="hidden" name="location_id" value="{{ @$data['barcode'][0]['location_id'] }}" />
									@endif
									<a href="{{ url('barcode') }}" class="btn btn-warning">Xem danh sách</a>-->
									<input type="hidden" name="barcode_id" value="{{ @$data['barcode'][0]['barcode_id'] }}" />
									<a class="btn btn-primary" id="next2">Tiếp tục</a>
								</div>
							</div>
						</div>
					</div>					
				</div>
				<div class="tab-pane" id="tab2">
					<div class="row" id="app">
						<div class="col-lg-2" id="cot_1">
							<div class="form-group" >
								<div class="upanh" id="upanh_1" data_id="1">
									<a> 
										<img class='col-lg-12' style="padding:6px;margin-top:10px;margin-bottom:10px;border:2px dashed #0087F7;height:130px;width:140" id="img_1" src="{{asset('public/img/add.png')}}" alt="Chọn mẫu vật" />										
									</a>									
								</div>
								<div id="btx_1">
								</div>
								<!--<button type="button" class="btn btn-primary xoa" data_id="1" style="width:140px;"><span class='glyphicon glyphicon-trash'></span></button>-->
								{!! Form::file('images[]', array('class'=>'form-control imgInp','style'=>'display:none;','id'=>'imgInp_1','data_id'=>'1')) !!}
							</div>
						</div>
					</div>
					<?php if(isset($data['file_img'])){ ?>					
					<div class="row">						
						<hr style="border-top: 1px solid #ddd;"/>						
					</div>
					<div class="row">
						<?php foreach($data['file_img'] as $ds){ ?>
							<div class="col-lg-2" id="group_img_<?php echo $ds['file_id']; ?>">
								<div class="form-group">
									<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
										<img style="height:130px;width:140" src="{{asset('public/uploads/img/'.$ds['file_id'].'.jpg')}}" alt="...">
									</a>
									<button type="button" class="btn btn-danger delete" data_id="<?php echo $ds['file_id']; ?>" style="width:146px;"><span class='glyphicon glyphicon-trash'></span></button>
								</div>								
							</div>
						<?php } ?>
					</div>
					<?php } ?>
					<hr/>
					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">							
								<a class="btn btn-primary" id="next3">Tiếp tục</a>
							</div>
						</div>						
					</div>
				</div>
				<div class="tab-pane" id="tab3">
					<div class="row">
						<div class="col-lg-5" id="addf" style="padding:0px;">
							<div class="form-group">
								{!! Form::file('files[]', array('class'=>'form-control file','id'=>'file_1','data_id'=>'1')) !!}
								</br>
								<button type="button" class="btn btn-success afile" id="afile_1" data_id="1"><span class="glyphicon glyphicon-plus"></span></button>
							</div>
						</div>
						<div class="col-lg-6 col-lg-offset-1" style="padding:0px;">
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
										<td style="text-align:center;"><?php echo $i; ?></td>
										<td>file_<?php echo $dsf['file_id']; ?></td>
										<td style="text-align:center;">
											<button type="button" class="btn btn-danger delete_file" data_id="<?php echo $dsf['file_id'] ?>"><span class="glyphicon glyphicon-trash"></span></button>
											<a href="{{asset('public/uploads/file/'.$dsf['file_name'])}}"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-download"></span></button></a>
										</td>
									</tr>
								<?php } ?>
								<?php } ?>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="form-group">							
							<a class="btn btn-primary" id="next4">Tiếp tục</a>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab4">
					<div class="row">
						<div class="col-lg-6" style="padding:0px;">
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
										<td style="text-align:center;"><?php echo $i; ?></td>
										<td><?php echo $dsf['longitude']; ?></td>
										<td><?php echo $dsf['latitude']; ?></td>
										<td style="text-align:center;">
											<button type="button" class="btn btn-danger delete_loca" data_id="<?php echo $dsf['location_id']; ?>"><span class="glyphicon glyphicon-trash"></span></button>											
										</td>
									</tr>
								<?php } ?>
								<?php } ?>
							</table>
						</div>
						<div class="col-lg-5 col-lg-offset-1" style="padding:0px;">
							<div class="row">
								<div id="map" style="width: 100%; height: 300px;"></div>
							</div>
							</br>
							<div id="add_td">
								<div class="row">
									<div class="col-lg-5" style="padding:0px;">
											<div class="form-group">
												<label class="control-label">Kinh độ:</label>
												{!! Form::text('longitude[]', @$data['barcode'][0]['longitude'], array('class'=>'form-control')) !!}
											</div>
										</div>
									<div class="col-lg-5 col-lg-offset-2" style="padding:0px;">
										<div class="form-group">
											<label class="control-label">Vĩ độ:</label>
											{!! Form::text('latitude[]', @$data['barcode'][0]['latitude'], array('class'=>'form-control')) !!}
										</div>
									</div>						
								</div>
							</div>
							</br>
							<div class="row">
								<div class="form-group">
									<button type="button" class="btn btn-success atd" id="atd_1" data_id="1"><span class="glyphicon glyphicon-plus"></span></button>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['barcode'])) Cập nhật @else Thêm mới @endif" />
								</div>
							</div>
						</div>
					</div>
				</div>
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

var locations= <?php echo $data['loca']; ?>;

$(document).ready(function(){
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
		$option += "<div class='col-lg-2' id='cot_"+$id+"'>";
		$option += 		"<div class='form-group'>";
		$option += 			"<div class='upanh' id='upanh_" + $id + "' data_id='" + $id + "'>";
		$option +=				"<a>";
		$option +=					"<img class='col-lg-12' style='padding:6px;margin-top:10px;margin-bottom:10px;border:2px dashed #0087F7;height:130px;width:140' src='{{asset('public/img/add.png')}}' alt='Chọn mẫu vật' id='img_"+$id+"' />";
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
		$option2 += "<button type='button' class='btn btn-primary xoa' style='width:140px;' data_id='" + $data_id + "'><span class='glyphicon glyphicon-trash'></span></button>";
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
	
	$(document).on('click','#next2',function(){
		$('#page2').click();
	})
	
	$(document).on('click','#next3',function(){
		$('#page3').click();
	})
	
	$(document).on('click','#next4',function(){
		$('#page4').click();
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
	
	
	$(document).on('click','.atd',function(){
		$option = "";
		$option += "<div class='row'>";
		$option += 		"<div class='col-lg-5' style='padding:0px;'>";
		$option +=			"<div class='form-grounp'>";
		$option +=				"<label class='control-label'>Kinh độ:</label>";
		$option +=				"<input type='text' class='form-control' name='longitude[]'/>";
		$option +=			"</div>";
		$option +=		"</div>";
		$option += 		"<div class='col-lg-5 col-lg-offset-2' style='padding:0px;'>";
		$option +=			"<div class='form-grounp'>";
		$option +=				"<label class='control-label'>vĩ độ:</label>";
		$option +=				"<input type='text' class='form-control' name='latitude[]'/>";
		$option +=			"</div>";
		$option +=		"</div>";
		$option += "</div>";
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
	//////////


    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-33.923036, 151.259052),
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