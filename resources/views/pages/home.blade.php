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
	#tbl_link{
		height: 300px;
		overflow-y:scroll;
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
						<p><b>Institution of project management:</b> Viet Nam National University of Forestry (VNUF)</p>
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
							<td style="text-align:justify">
							<a href="publication?id=<?php echo $value['new_id'] ?>" target="_blank" style="color:#036;font-size:10pt;text-decoration:none;"><?=$i+1;?>.<?php echo $value['subject']; ?></a>
							</br></br>							
							</td>
						</tr>
						<?php } ?>
						<tr>
							<td style="padding-top:10px;">
								<span style="color:#FF0000" class="glyphicon glyphicon-star"></span>&nbsp;<span style="color:#036">Cooperating agencies</span>								
								<hr style="border-top: 2px solid #eee;margin:10px 0px 10px 0px">
							</td>
						</tr>
						<tr>
							<td style="padding-top:10px;text-align:center;">
								<button id="view_lk" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;Xem chi tiết</button>								
							</td>
						</tr>
					</table>					
				</td>
			</tr>		
		</table>
	</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Danh sách đơn vị liên kết</h4>
      </div>
      <div class="modal-body" id="tbl_link">
        <table class="table table-striped table-bordered">
			<tr>
				<th style="text-align:center;">STT</th>
				<th style="text-align:center;">Tên Đơn vị</th>
				<th style="text-align:center;">Website</th>
			</tr>
			<?php $i=0; ?>
			<?php foreach($data['list_link'] as $value){ ?>
				<tr>
					<td style="text-align:center;"><?php echo $i++; ?></td>
					<td><?php echo $value['link_name']; ?></td>
					<td><a href="<?php echo $value['url']; ?>" target="_blank"><?php echo $value['url']; ?></a></td>
				</tr>
			<?php } ?>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection