<html>
    <head>
        <title>@yield('title')</title>
		<!--<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">-->
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
				<div class="row" style="background:#F5F5F5;margin-bottom:0px !important;">
					<div class="col-lg-10 col-lg-offset-1">
						<div class="row">
							<div id="logo" class="col-lg-3" style="margin-top:10px;">
								<a href="/"><img src="{{ asset('public/img/medLogo.png') }}" /></a>	
							</div>
							<div class="col-lg-7" style="text-align:center">
								<div class="row">
									<h3 style="color:#F90000;margin-top:10px;">CƠ SỞ DỮ LIỆU MÃ VẠCH SINH VẬT VIỆT NAM</h3>
								</div>
								<div class="row" style="margin-bottom:5px;">
									<span style="color:#006599;font-size: 18px;">VIET NAM BIOBARCODE DATABASE (VNBD)</span>
								</div>
							</div>
						</div>
					</div>
				</div>				
				<div class="row" style="background:#036">
					<div class="col-lg-10 col-lg-offset-1">
						<div class="col-lg-12">
							<nav class="navbar navbar-default" style="margin-bottom:0px;border:0px;">
							  <div class="container-fluid" style="padding:0px;">
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
								  <ul class="nav navbar-nav">
									<li class="active"><a href="#">HOME <span class="sr-only">(current)</span></a></li>
									<li><a href="#">INTRODUCTION</a></li>
									<li class="dropdown">
									  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DATABASES <span class="caret"></span></a>
									  <ul class="dropdown-menu" style="border:0px;">
										<li><a href="#">DNA BARCODE</a></li>
										<li><a href="#">PRINMERS</a></li>
										<li><a href="#">PUBLICATIONS</a></li>
										<!--<li role="separator" class="divider"></li>
										<li><a href="#">Separated link</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="#">One more separated link</a></li>-->
									  </ul>
									</li>									
									<li class="dropdown">
									  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SEARCH <span class="caret"></span></a>
									  <ul class="dropdown-menu" style="border:0px;">
										<li><a href="#">KEY WORD</a></li>
										<li><a href="#">SAMPLE ID</a></li>
										<li><a href="#">SEQUENCES</a></li>
									  </ul>
									</li>
									<li class="dropdown">
									  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TOOLS <span class="caret"></span></a>
									  <ul class="dropdown-menu" style="border:0px;">
										<li><a href="#">BLAST</a></li>
										<li><a href="#">TREE</a></li>
										<li><a href="#">ILLUSTRATIVE BARCODE</a></li>
									  </ul>
									</li>
									<li class="dropdown">
									  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SUBMIT <span class="caret"></span></a>
									  <ul class="dropdown-menu" style="border:0px;">
										<li><a href="#">FORM</a></li>
									  </ul>
									</li>
									<li><a href="#">SERVICE</a></li>
									<li><a href="#">MEMBERS</a></li>
									<li><a href="#">LINK</a></li>
									<li><a href="#">HELF</a></li>
									<li><a href="#">LOGIN</a></li>
								  </ul>								  								 
								</div><!-- /.navbar-collapse -->
							  </div><!-- /.container-fluid -->
							</nav>
						</div>
					</div>
				</div>
			</div>
			</br>
			<div class="container" style="width:100%;padding:0px;">
				<div class="row">
					<div class="col-lg-10 col-lg-offset-1">
						@yield('content')
					</div>
				</div>
			</div>
			<div id="footer" style="background:#036;min-height:38px;bottom:0;">
				
			</div>
		<!--</div>-->
    </body>
</html>