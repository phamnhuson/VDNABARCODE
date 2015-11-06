@extends('templates.master')

@section('title', $page['subject'])

@section('content')
<style>
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
	<div class="col-md-12">
		<table class="table" id="tbl" style="border-top:0px;">
			<tr>
				<td class="col-lg-2 col-md-3" style="background:#036;padding:0px;">
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
					
				<td class="col-lg-10 col-md-9 static-page-content" style="padding: 0 20px">
					<h1>{{ $page['subject'] }}</h1>
					<hr/>
					{!! $page['content'] !!}
					<br/><br/><br/>
				</td>
			</tr>		
		</table>
	</div>
	
</div>
@endsection