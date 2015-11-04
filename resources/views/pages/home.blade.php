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
					
				<td class="col-lg-10" style="padding:0px 0px 0px 8px;">
					<div class="row">
						<img style="width:100%; height:400px;" src="{{ asset('public/img/banner3.jpg') }}" />
					</div>
					<div class="row" style="background: #447639;">
						<div class="col-lg-12">
							<table class="table" id="thongke" style="color:#fff;margin-bottom:0px;background: #447639;margin:5px;">
								<tr>
									<td class="col-lg-3"></td>
									<td class="col-lg-3"></td>
									<td class="col-lg-3"></td>
									<td class="col-lg-3"></td>
								</tr>
								<tr>
									<td colspan="2" style="font-size: 14pt;color: #95E2FE;padding-left:90px;">Sequence statics</td>
									<td colspan="2" style="font-size: 14pt;color: #95E2FE;padding-left:20px;">Species coverage (formally describle)</td>
								</tr>
								<tr>
									<td style="padding-left: 40px;">All Sequence:</td>
									<td style="text-align:center;"><?php echo $data['barcode'] ?></td>
									<td style="padding-left: 60px;">Plants:</td>
									<td style="text-align:center;"><?php echo $data['plantae'] ?></td>
								</tr>
								<tr>
									<td style="padding-left: 40px;">Barcode Sequence:</td>
									<td style="text-align:center;"><?php echo $data['barcode'] ?></td>
									<td style="padding-left: 60px;">Animals:</td>
									<td style="text-align:center;"><?php echo $data['Animalia'] ?></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td style="padding-left: 60px;">Fungi & Other Life</td>
									<td style="text-align:center;">0</td>
								</tr>
							</table>
						</div>
					</div>
				</td>
			</tr>		
		</table>
	</div>
</div>
@endsection