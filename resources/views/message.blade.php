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
</style>
<div id="subheader" style='height:49px;'>
	<div class="box">
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<h1 id="title">QUẢN LÝ BÌNH LUẬN</h1>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-lg-12" style="padding:0px;">
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
			<table class="table table-striped table-bordered">
				<tr>
					<th style="text-align:center !important;width:5%">STT</th>
					<th style="width:15%">Người gửi</th>					
					<th style="width:15%">Tiêu đề</th>
					<th style="width:45%">Nội dung</th>
					<th style="width:10%;text-align:center;">Trạng thái</th>
					<th style="width:10%;">Chức năng</th>
				</tr>
				<?php $i=1; ?>
				<?php foreach($data['list_message'] as $lm){ ?>
					<tr>
						<td style="text-align:center;"><?php echo $i; ?></td>
						<td><?php echo $lm['email']; ?></td>		
						<td><?php echo $lm['subject']; ?></td>
						<td><?php echo $lm['content']; ?></td>
						<td style="text-align:center;">
							<span class="label label-<?php echo ($lm['status']==0)?'warning':'success' ?>"><?php echo ($lm['status']==0)?'Chưa trả lời':'Đã trả lời' ?></span>
						</td>
						<td align="center">
							<button class="btn btn-primary mod" title="trả lời" data_id="<?php echo $lm['id']; ?>" data_email="<?php echo $lm['email']; ?>"><span class="glyphicon glyphicon-send"></span></button>							
						</td>
					</tr>
				<?php $i+=1; ?>
				<?php } ?>
			</table>
			<?php echo $data['list_message']->render(); ?>
		</div>
	</div>
	</br></br></br>
</div>
<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" style='margin-top:100px;'>
        <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nội dung trả lời</h4>
            </div>
			{!! Form::open(array('method' => 'PUT', 'enctype'=>'multipart/form-data', 'files' => true)) !!}
            <div class="modal-body">				
					{!! Form::textarea('answers', null, array('class'=>'form-control','rows'=>'4','cols'=>'1')) !!}		
					<input type="hidden" name="id_message" id="id_message" value="" />
					<input type="hidden" name="email_message" id="email_message" value="" />					
            </div>
			<div class="modal-footer">               
                <!--<input type="submit" name="submit" class="btn btn-primary" data-dismiss="modal" value="Trả lời">-->
				<input type="submit" name="submit" class="btn btn-primary" value="Trả lời">
            </div>
			{!! Form::close() !!}
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.mod',function(){
			$data_id = $(this).attr('data_id');
			$data_email = $(this).attr('data_email');
			$('#id_message').attr('value',$data_id);
			$('#email_message').attr('value',$data_email);
			$('#lightbox').modal({
				backdrop: true
			});			
		});
	});
</script>
@endsection
