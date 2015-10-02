@extends('templates.master')

@section('title', 'Species')

@section('content')
<style type="text/css">
	#title {
		margin-top:7px;
	}
	.row{
		margin:0px;
		margin-bottom:5px;
	}
	.tbl td{
		 border-top: 0px !important;
	}
</style>
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 id="title">QUẢN LÝ DANH MỤC LOÀI</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
</br>
<div class="box">
	<table style="width:100%" class="form-table">
		<tr>
			<td>
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
			</td>
		<tr>
		<tr>
			<td>				
				<div class="row">
					<div class="col-md-12" style="padding:0px">
						<div class="nav-tabs-custom" style="margin-bottom: 0px; box-shadow:none;">
							<ul class="nav nav-tabs">
								<li class='active'>
									<a href="#tab1" data-toggle='tab' id='page1'>Cập nhật thông tin loài</a>
								</li>
								<li>
									<a href="#tab2" data-toggle='tab' id='page1'>Danh sách loài</a>
								</li>								
							</ul>
						</div>
					</div>				
				</div>
			</td>
		</tr>		
		<tr>
			<td>
				<div class="tab-content col-md-12" style="padding:0px;">
					<div class="tab-pane active" id="tab1">
						{!! Form::open(array('method' => (isset($data['species'])) ? 'PUT' : 'POST', 'enctype'=>'multipart/form-data', 'files' => true )) !!}
							@if (isset($data['species']))
								<input type="hidden" name="species_id" value="{{ @$data['species'][0]['species_id'] }}" />
							@endif
							<table class="table tbl">
								<tr>
									<td style="width:15%;"><b>Giới:</b></td>
									<td>
										<select name="kingdom_id" id="kingdom" class="form-control">
											<option>Chọn giới</option>
											<?php foreach($data['list_kingdom'] as $list){ ?>
												<option value="<?php echo $list['kingdom_id'] ?>" <?php echo (isset($data['species']) && $list['kingdom_id']==$data['species'][0]['kingdom_id'])?'selected':'' ?>><?php echo $list['kingdom_name'] ?></option>
											<?php } ?>
										</select>
									</td>									
									<td style="width:200px;padding-left:100px"><b>Bộ:</b></td>
									<td>
										<select name="order_id" id="order" class="form-control">
											<option>Chọn bộ</option>
											<?php foreach($data['list_order'] as $list){ ?>
												<option value="<?php echo $list['order_id'] ?>" <?php echo (isset($data['species']) && $list['order_id']==$data['species'][0]['order_id'])?'selected':'' ?>><?php echo $list['order_name'] ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td><b>Ngành:</b></td>
									<td>
										<select name="phylum_id" id="phylum" class="form-control">
											<option>Chọn ngành</option>
											<?php foreach($data['list_phylum'] as $list){ ?>
												<option value="<?php echo $list['phylum_id'] ?>" <?php echo (isset($data['species']) && $list['phylum_id']==$data['species'][0]['phylum_id'])?'selected':'' ?>><?php echo $list['phylum_name'] ?></option>
											<?php } ?>
										</select>
									</td>
									<td style="padding-left:100px"><b>Họ:</b></td>
									<td>
										<select name="family_id" id="family" class="form-control">
											<option>Chọn họ</option>
											<?php foreach($data['list_family'] as $list){ ?>
												<option value="<?php echo $list['family_id'] ?>" <?php echo (isset($data['species']) && $list['family_id']==$data['species'][0]['family_id'])?'selected':'' ?>><?php echo $list['family_name'] ?></option>
											<?php } ?>
										</select>
									</td>		
								</tr>
								<tr>
									<td><b>Lớp:</b></td>
									<td>
										<select name="class_id" id="class" class="form-control">
											<option>Chọn lớp</option>
											<?php foreach($data['list_class'] as $list){ ?>
												<option value="<?php echo $list['class_id'] ?>" <?php echo (isset($data['species']) && $list['class_id']==$data['species'][0]['class_id'])?'selected':'' ?>><?php echo $list['class_name'] ?></option>
											<?php } ?>
										</select>
									</td>									
									<td style="padding-left:100px"><b>Chi:</b></td>
									<td>
										<select name="genus_id" id="genus" class="form-control">
											<option>Chọn chi</option>
											<?php foreach($data['list_genus'] as $list){ ?>
												<option value="<?php echo $list['genus_id'] ?>" <?php echo (isset($data['species']) && $list['genus_id']==$data['species'][0]['genus_id'])?'selected':'' ?>><?php echo $list['genus_name'] ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td><b>Tên khoa học:</b></td>
									<td>
										{!! Form::text('species_name', @$data['species'][0]['species_name'], array('class'=>'form-control')) !!}
									</td>
									<td style="padding-left:100px"><b>Tên khác:</b></td>
									<td>
										{!! Form::text('other_name', @$data['species'][0]['other_name'], array('class'=>'form-control')) !!}
									</td>									
								</tr>
								<tr>
									<td><b>Tên Việt Nam:</b></td>
									<td>
										{!! Form::text('vietnamese_name', @$data['species'][0]['vietnamese_name'], array('class'=>'form-control')) !!}
									</td>
									<td style="padding-left:100px"><b>Phân hạng:</b></td>
									<td>
										{!! Form::text('rank', @$data['species'][0]['rank'], array('class'=>'form-control')) !!}
									</td>
								</tr>
								<tr>
									<td colspan="4"><b>Mô tả chung:</b></td>
								</tr>
								<tr>
									<td colspan="4">{!! Form::textarea('description', @$data['species'][0]['description'], array('class'=>'form-control')) !!}</td>
								</tr>
								<tr>
									<td colspan="4"><b>Đặc điểm phân bố</b></td>
								</tr>
								<tr>
									<td colspan="4">{!! Form::textarea('distribution', @$data['species'][0]['distribution'], array('class'=>'form-control')) !!}</td>
								</tr>
								<tr>
									<td colspan="4"><b>Công dụng:</b></td>
								</tr>
								<tr>
									<td colspan="4">{!! Form::textarea('function', @$data['species'][0]['function'], array('class'=>'form-control')) !!}</td>
								</tr>
								<tr>
									<td colspan="4"><b>Khả năng kinh doanh, bảo tồn:</b></td>
								</tr>
								<tr>
									<td colspan="4">{!! Form::textarea('conserve', @$data['species'][0]['conserve'], array('class'=>'form-control')) !!}</td>
								</tr>
								<tr>
									<td colspan="4"><b>Khác:</b></td>
								</tr>
								<tr>
									<td colspan="4">{!! Form::textarea('other', @$data['species'][0]['other'], array('class'=>'form-control')) !!}</td>
								</tr>
								<tr>
									<td colspan="4">
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
									</td>
								</tr>
								<tr>								
							</table>			
							<div class="form-group">
								<input type="submit" name="submit" class="btn btn-primary" value="@if (isset($data['species'])) Cập nhật @else Thêm @endif" />
								@if (isset($data['species']))
									<a href="{{ url('genus') }}" class="btn btn-success">Thêm mới</a>
								@endif
							</div>
						{!! Form::close() !!}
					</div>
					<div class="tab-pane" id="tab2">
						<table class="table table-striped table-bordered">
							<tr>
								<th style="text-align:center !important;width:5%">STT</th>					
								<th style="width:30%">Tên loài</th>
								<th style="width:25%">Phân hạng</th>
								<th style="width:30%">Tên chi</th>
								<th style="width:15%;"></th>
							</tr>
							<?php $i=1; ?>
							<?php foreach($data['list_species'] as $sptt){ ?>
								<tr>
									<td style="text-align:center;"><?php echo $i; ?></td>						
									<td><?php echo $sptt['species_name']; ?></td>
									<td><?php echo $sptt['rank']; ?></td>
									<td><?php echo $sptt['genus_name']; ?></td>
									<td style="text-align:center;">
										<a href="{{ asset('species?action=edit&id=').$sptt['species_id'] }}"><button type="button" title="sửa" name="sua" class="btn btn-warning"><span class='glyphicon glyphicon-pencil'></span></button></a>
										<a href="{{ asset('species?action=delete&id=').$sptt['species_id'] }}" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" title="xóa" name="xoa" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button></a>
									</td>
								</tr>
							<?php $i+=1; ?>
							<?php } ?>
						</table>
						<?php echo $data['list_species']->render(); ?>
					</div>					
				</div>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
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
	$(document).on('change','#kingdom',function(){
		id = $(this).val();
		$.ajax({
			type: "GET",
			url : "/get_phylum",
			data: {'id':id},
			dataType: 'json',
			success:function(data){
				var options="";
				options+="<option>Chọn ngành</option>";
				for($i=0;$i<data.length;$i++)
				{
				options+="<option value='"+data[$i]['phylum_id']+"'>"+data[$i]['phylum_name']+"</option>";
				}
				$("#phylum").html(options);
			}
		});
	});

	$(document).on('change','#phylum',function(){
		id = $(this).val();
		$.ajax({
			type: "GET",
			url : "/get_class",
			data: {'id':id},
			dataType: 'json',
			success:function(data){
				var options="";
				options+="<option>Chọn lớp</option>";
				for($i=0;$i<data.length;$i++)
				{
				options+="<option value='"+data[$i]['class_id']+"'>"+data[$i]['class_name']+"</option>";
				}
				$("#class").html(options);
			}
		});
	});
	
	$(document).on('change','#class',function(){
		id = $(this).val();
		$.ajax({
			type: "GET",
			url : "/get_order",
			data: {'id':id},
			dataType: 'json',
			success:function(data){
				var options="";
				options+="<option>Chọn bộ</option>";
				for($i=0;$i<data.length;$i++)
				{
				options+="<option value='"+data[$i]['order_id']+"'>"+data[$i]['order_name']+"</option>";
				}
				$("#order").html(options);
			}
		});
	});
	
	$(document).on('change','#order',function(){
		id = $(this).val();
		$.ajax({
			type: "GET",
			url : "/get_family",
			data: {'id':id},
			dataType: 'json',
			success:function(data){
				var options="";
				options+="<option>Chọn họ</option>";
				for($i=0;$i<data.length;$i++)
				{
				options+="<option value='"+data[$i]['family_id']+"'>"+data[$i]['family_name']+"</option>";
				}
				$("#family").html(options);
			}
		});
	});
	
	$(document).on('change','#family',function(){
		id = $(this).val();
		$.ajax({
			type: "GET",
			url : "/get_genus",
			data: {'id':id},
			dataType: 'json',
			success:function(data){
				var options="";
				options+="<option>Chọn chi</option>";
				for($i=0;$i<data.length;$i++)
				{
				options+="<option value='"+data[$i]['genus_id']+"'>"+data[$i]['genus_name']+"</option>";
				}
				$("#genus").html(options);
			}
		});
	});
	
	$(document).on('change','#genus',function(){
		id = $(this).val();
		$.ajax({
			type: "GET",
			url : "/get_species",
			data: {'id':id},
			dataType: 'json',
			success:function(data){
				var options="";
				options+="<option>Chọn loài</option>";
				for($i=0;$i<data.length;$i++)
				{
				options+="<option value='"+data[$i]['species_id']+"'>"+data[$i]['species_name']+"</option>";
				}
				$("#species").html(options);
			}
		});
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
</script>
@endsection