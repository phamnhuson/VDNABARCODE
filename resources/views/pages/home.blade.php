@extends('templates.master')

@section('title', 'Ngân hàng dữ liệu DNA Việt Nam - Home Page')

@section('content')
<style>
	#banner img {
		width:100%;
	}
	#header {
		margin-bottom:0;
	}
	
	#stats table td {color: #eee;}
	.left_menu li{
		list-style:none;
		height:40px;
		padding: 10px 15px 10px 20px;
		border-bottom:1px solid #fff;
	}
	.left_menu li:hover{
		background:#5580AB;		
	}
	.left_menu li a{
		color:#fff;
		text-decoration:none;		
	}
	#thongke td{
		border-top:0px;
		padding:2px;
	}
	#tbl td{
		border-top:0px;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<table class="table" id="tbl" style="border-top:0px;">
			<tr>
				<td class="col-lg-2" style="background:#036;padding:0px;">
					<div >
						<ul class="left_menu" style="padding-left:0px;">
							<li><a href="/member"><span class="glyphicon glyphicon-user"></span> &nbsp;MEMBER</a></li>
							<li><a href="/service"><span class="glyphicon glyphicon-list"></span> &nbsp;SERVICE</a></li>
							
							<li><a href="/contact"><span class="glyphicon glyphicon-earphone"></span> &nbsp;CONTACT</a></li>
							<li><a href="/help"><span class="glyphicon glyphicon-book"></span> &nbsp;HELP</a></li>
						</ul>
					</div>
					<div class="home-left-info">
						<p>
						The project is supported by the Agricultural Biotechnology Program of the Ministry of Agricultural and Rural Development, Vietnam.
						</p>
						<p><b>Institution of project management:</b> Viet Nam National Forestry University (VNUFU)</p>
						<p><b>Principal investigator:</b> PhD. Ha Van Huan</p>
					</div>
				</td>
					
				<td class="col-lg-8" style="padding:0px 0px 0px 8px;">
					<div class="row">
						<img style="width:100%; height:400px;" src="{{ asset('public/img/banner4.jpg') }}" />
					</div>
					<div class="row" style="background: #447639;color:#fff;padding: 10px;">
						<div class="col-lg-4">
							All sequence: <?php echo ($data['barcode']+$data['gene']) ?>
						</div>
						<div class="col-md-4">
							Barcode sequence: <?php echo $data['barcode'] ?><br/>
							Gene sequence: <?php echo $data['gene'] ?><br/>
							Publications: <?php echo $data['publication'] ?><br/>
							Genome: <?php echo $data['genome'] ?>
						</div>
						<div class="col-md-4">
							Page views: <?php echo $data['visitors'][0]['value'] ?><br/>
							Total users: <?php echo $data['users']; ?>
						</div>
					</div>
				</td>
				<td class="col-lg-2" style="padding:0px 8px 0px 8px;">
					<table style="width: 100%;">
						<tr>
							<td style="padding-top:10px;">
								<span style="color:#FF0000" class="glyphicon glyphicon-star"></span>&nbsp;<span style="color:#036">News</span>
								<hr style="border-top: 2px solid #eee;margin:10px 0px 10px 0px">
							</td>
						</tr>
						<?php foreach($data['news'] as $i=>$value){ ?>
						<tr>
							<td>
							<a href="publication?id=<?php echo $value['new_id'] ?>" target="_blank" style="color:#036;font-size:10pt;text-decoration:none;"><?=$i+1;?>.<?php echo $value['subject']; ?></a>
							</br></br>							
							</td>
						</tr>
						<?php } ?>
						<tr>
							<td style="padding-top:10px;">
								<span style="color:#FF0000" class="glyphicon glyphicon-star"></span>&nbsp;<span style="color:#036">Liên kết</span>
								<hr style="border-top: 2px solid #eee;margin:10px 0px 10px 0px">
							</td>
						</tr>
						<tr>
							<td style="padding-top:10px;">
								{!! Form::select('link', @$data['arr_link'],null, array('id'=>'family','class'=>'form-control')) !!}
							</td>
						</tr>
					</table>					
				</td>
			</tr>		
		</table>
	</div>
</div>
@endsection