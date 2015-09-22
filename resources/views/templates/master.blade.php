<html>
    <head>
        <title>@yield('title')</title>
		<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('public/css/jquery.dataTables.min.css') }}">
		
		<script src="{{ asset('public/js/jquery.min.js') }}"></script>
		<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('public/js/app.js') }}"></script>
		<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
		<script src="{{ asset('public/ckfinder/ckfinder.js') }}"></script>
    </head>
    <body >
		<!--<div style="width:78%; margin-left:11%; background:#fff">-->
			<div id="header">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 top-header">
							<div class="row">
								<div id="logo" class="col-lg-3">
									<a href="/"><img src="{{ asset('public/img/medLogo.png') }}" /></a>	
								</div>
								<div class="col-lg-7">
									<div class="header-title">
										<span><b>CƠ SỞ DỮ LIỆU MÃ VẠCH SINH VẬT VIỆT NAM</b></span><br/>
										<span>VIET NAM BIOBARCODE DATABASE (VNBD)</span>
									</div>	
								</div>
							</div>
						</div>
					</div>				
				</div>	
				<div class="row" style="background:#036">
					<div class="col-lg-10 col-lg-offset-1">
						<div class="col-lg-12 col-md-12">
							<nav class="navbar navbar-default" id="main-menu" style="margin-bottom:0px;border:0px;">
							  <div class="container-fluid" style="padding:0px;">
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
								  <ul class="nav navbar-nav">
									<li class="active"><a href="/">HOME <span class="sr-only">(current)</span></a></li>
									<li><a href="/introduction">INTRODUCTION</a></li>
									<li class="dropdown">
									  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DATABASES <span class="caret"></span></a>
									  <ul class="dropdown-menu" style="border:0px;">
										<li><a href="/list">DNA BARCODE</a></li>
										<li><a href="#">PRINMERS</a></li>
										<li><a href="/publication">PUBLICATIONS</a></li>
										<!--<li role="separator" class="divider"></li>
										<li><a href="#">Separated link</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="#">One more separated link</a></li>-->
									  </ul>
									</li>									
									<li class="dropdown">
									  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SEARCH <span class="caret"></span></a>
									  <ul class="dropdown-menu" style="border:0px;">
										<li><a href="/search/keyword">KEY WORD</a></li>
										<li><a href="/search/id">SAMPLE ID</a></li>
										<li><a href="/search/sequence">SEQUENCES</a></li>
									  </ul>
									</li>
									<li class="dropdown">
									  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TOOLS <span class="caret"></span></a>
									  <ul class="dropdown-menu" style="border:0px;">
										<li><a href="/blast">BLAST</a></li>
										<li><a href="/treeview">TREE</a></li>
										<li><a href="/illustrativebarcode">ILLUSTRATIVE BARCODE</a></li>
									  </ul>
									</li>
									
									<li class="dropdown">
									  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SUBMIT <span class="caret"></span></a>
									  <ul class="dropdown-menu" style="border:0px;">
										<li><a href="/contact">FORM</a></li>
									  </ul>
									</li>
									
									@if (Auth::check() && Auth::user()->role==3)
									<li class="dropdown">
										<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hệ thống <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="/inew">Posts</a></li>
											<li><a href="/error">Error Logs</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">danh mục <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="/user">Tài khoản</a></li>
											<li><a href="/city">Danh mục địa phương</a></li>
											<li><a href="/class">Danh mục phân lớp</a></li>
											<li><a href="/order">Danh mục phân bộ</a></li>
											<li><a href="/family">Danh mục phân họ</a></li>
											<li><a href="/genus">Danh mục phân chi</a></li>
											<li><a href="/species">Danh mục phân loài</a></li>
										</ul>
									</li>
									<li class=""><a href="/barcode">Barcode</a></li>
									@endif
									@if (Auth::check())
									<li class=""><a href="/logout">Logout</a></li>
									@else
									<li class=""><a href="/login">Login</a></li>
									@endif
								  </ul>								  								 
								</div><!-- /.navbar-collapse -->
							  </div><!-- /.container-fluid -->
							</nav>
						</div>
					</div>
				</div>
			</div>
			</br>
			<div id="main-content">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							@yield('content')
						</div>
					</div>
				</div>
			</div>	
			<div id="footer">
				Copyright © 2015 VNBiobarcode. All rights reserved. 
			</div>
		<!--</div>-->
    </body>
</html>