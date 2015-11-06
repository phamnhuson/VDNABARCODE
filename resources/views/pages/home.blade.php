@extends('templates.master')

@section('title', 'Home Page')

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
						<p><b>Institution of project management:</b> Vietnam Forestry University (VFU)</p>
						<p><b>Principal investigator:</b> PhD. Ha Van Huan</p>
					</div>
				</td>
					
				<td class="col-lg-8" style="padding:0px 0px 0px 8px;">
					<div class="row">
						<img style="width:100%; height:400px;" src="{{ asset('public/img/banner3.jpg') }}" />
					</div>
					<div class="row" style="background: #447639;">
						<div class="col-lg-12">
							<table class="table" id="thongke" style="color:#fff;margin-bottom:0px;background: #447639;margin:5px;">
								<tr>
									<td rowspan="4">All sequence:<?php echo ($data['barcode']+$data['gene']) ?></td>
									<td>Barcode sequence:<?php echo $data['barcode'] ?></td>
								</tr>
								<tr>
									<td>Gene sequence:<?php echo $data['gene'] ?></td>
								</tr>
								<tr>
									<td>Genome:</td>
								</tr>
								<tr>
									<td>Publications:<?php echo $data['publication'] ?></td>
								</tr>
							</table>
						</div>
					</div>
				</td>
				<td class="col-lg-2" style="padding:0px 8px 0px 8px;background-color:#969696">
					<table>
						<tr>
							<td style="padding-top:10px;">
								<span style="color:#FF0000" class="glyphicon glyphicon-star"></span>&nbsp;<span style="color:#fff">Tin tức</span>
								<hr style="border-top: 2px solid #eee;margin:10px 0px 10px 0px">
							</td>
						</tr>
						<?php foreach($data['news'] as $value){ ?>
						<tr>
							<td>
							<span style="color:#fff;" class="glyphicon glyphicon-share-alt"></span>&nbsp;<a href="publication?id=<?php echo $value['new_id'] ?>" target="_blank" style="color:#fff;font-size:10pt;text-decoration:none;"><?php echo $value['subject']; ?></a>
							</br></br>							
							</td>
						</tr>
						<?php } ?>
					</table>
				</td>
			</tr>		
		</table>
	</div>
</div>
@endsection