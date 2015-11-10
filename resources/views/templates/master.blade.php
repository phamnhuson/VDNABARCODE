<html>
    <head>
        <title>@yield('title')</title>
		<link rel="stylesheet" href="{{ asset('public/css/style.css?v=1.4') }}">
		<link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('public/css/jquery.dataTables.min.css') }}">
		
		<script src="{{ asset('public/js/jquery.min.js') }}"></script>
		<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('public/js/app.js?v=1.1') }}"></script>
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
								<div id="logo" style="" class="col-lg-2 col-md-2">
									<a href="/"><img style="width:100px;margin:10px 0;" src="{{ asset('public/img/logo.jpg') }}" /></a>	
								</div>
								<div class="col-lg-10 col-md-10">
									<!--<div class="header-title">
										<span><b>CƠ SỞ DỮ LIỆU MÃ VẠCH SINH VẬT VIỆT NAM</b></span><br/>
										<span>VIET NAM BIOBARCODE DATABASE (VNBD)</span>
									</div>	-->
									<div class="header-title" style="font-size: 18px;padding:0;">
										<p class="center" style="font-size:38px;margin-bottom: 0;margin-top: 5px;margin-right:20%;">Vietnam DNA Data Bank</p>
										<p class="right" style="color: #D41D1D;margin-right:20%;"><b>Ngân hàng dữ liệu DNA Việt Nam</b></p>
									</div>	
								</div>
							</div>
						</div>
					</div>				
				</div>	
				<div class="row" style="background:#036">
					<div class="col-lg-12 col-md-12">
						<div class="container">
							<div class="row" style="margin-bottom:0;">
								<div class="col-md-12 col-lg-12">
									<nav class="navbar navbar-default" id="main-menu" style="margin-bottom:0px;border:0px;">
									  <div class="container-fluid">
										<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;position: relative;">
										  <ul class="nav navbar-nav">
											<li class="active"><a href="/">HOME <span class="sr-only">(current)</span></a></li>
											<li><a href="/introduction">INTRODUCTION</a></li>
											<li class="dropdown">
											  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DATABASES <span class="caret"></span></a>
											  <ul class="dropdown-menu" style="border:0px;">
												<li><a href="/dnabarcode">DNA Barcode</a></li>
												<li><a href="listgene">Gene</a></li>
												<li><a href="#">Genome</a></li>
												<li><a href="/publication">Publications</a></li>
												<!--<li role="separator" class="divider"></li>
												<li><a href="#">Separated link</a></li>
												<li role="separator" class="divider"></li>
												<li><a href="#">One more separated link</a></li>-->
											  </ul>
											</li>									
											<li id="search-dropdown">
											  <a href="javascript:void(0);">SEARCH <span class="caret"></span></a>
											</li>
											<li class="dropdown">
											  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TOOLS <span class="caret"></span></a>
											  <ul class="dropdown-menu" style="border:0px;">
												<li><a href="/blast">Blast</a></li>
												<li><a href="/treeview">Tree</a></li>
												<li><a href="/illustrativebarcode">Illustrative Barcode</a></li>
												<li><a href="javascript:void(0);">DNA Analysis</a></li>
											  </ul>
											</li>
											
											<li class="dropdown">
											  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SUBMIT <span class="caret"></span></a>
											  <ul class="dropdown-menu" style="border:0px;">
												<li><a href="@if (Auth::check()) /barcode @else /login @endif">Form for DNA Barcode</a></li>
												@if (Auth::check())
													<li class=""><a href="/ipublication">Form for Publication</a></li>
													<li class="dropdown">
														<a href="/gene">Form for Gene</a>
													</li>
													<li class=""><a href="#">Form for Genome</a></li>
												@endif
											  </ul>
											</li>
											
											
											@if (Auth::check() && Auth::user()->role==3)
											<li class="dropdown">
												<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">System <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="/inew">Posts</a></li>
													<li><a href="/error">Error Logs</a></li>
												</ul>
											</li>
											<li class="dropdown">
												<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catalog <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="/user">Tài khoản</a></li>
													<li><a href="/city">Danh mục địa phương</a></li>
													<li><a href="/kingdom">Danh mục phân giới</a></li>
													<li><a href="/phylum">Danh mục phân ngành</a></li>
													<li><a href="/class">Danh mục phân lớp</a></li>
													<li><a href="/order">Danh mục phân bộ</a></li>
													<li><a href="/family">Danh mục phân họ</a></li>
													<li><a href="/genus">Danh mục phân chi</a></li>
													<li><a href="/species">Danh mục phân loài</a></li>
												</ul>
											</li>
																				
											@endif
											
											@if (Auth::check())
											<li class=""><a href="/register?action=edit">Account</a></li>
											<li class=""><a href="/logout">Logout</a></li>
											@else
											<li class=""><a href="/login">Login</a></li>
											@endif
										  </ul>	

										  <div class="search-box" id="menu-search-box">
											{!! Form::open(array('method'=>'GET', 'action'=>array('SearchController@search'))) !!}
														<table>
															<tbody>
																<tr>
																	<td>
																		{!! Form::select('search_type', array('barcode' => 'DNA Barcode', 'gen' => 'Gene Data', 'genome' => 'Genome Data', 'public' => 'Public Data', 'member' => 'Member'), @$searchType, array('style' => 'vertical-align: middle;', 'class' => 'selectMenu')) !!}
																	</td>
																	<td>
																		<div id="search-control-container">
																			{!! Form::text('search_content', @$searchContent, array('style'	=>	'width:620px;height: 30px;border: 0;font-size: 15px;padding-left: 10px;', 'placeholder' => 'Tìm kiếm theo ID, từ khóa...', 'class' => '')) !!}
																			<input type="submit" value="Tìm kiếm" class="search-button" />
																		</div>	
																	</td>
																</tr>
															</tbody>
														</table>
										  {!! Form::close() !!}
										  </div>
										  
										</div><!-- /.navbar-collapse -->
										
									  </div><!-- /.container-fluid -->
									</nav>
								</div>	
							</div>	
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
				Viện Công nghệ sinh học Lâm nghiệp – Trường Đại học Lâm nghiệp
				<br/>DC: Xuân Mai, Chương Mỹ, Hà Nội - ĐT. 01223441300 (Hà Văn Huân) - E.mail: hvhuanbiotech@gmail.com
			</div>
		<!--</div>-->
		<script>
			// $('.search-dropdown').on('click', function (event) {
				// $(this).parent('ul.dropdown-menu').toggleClass('open');
				// $(this).parents('li.dropdown').toggleClass('open');
			// });
			// $('body').on('click', function (e) {
				// if (!$('li.search-dropdown').is(e.target) && $('li.search-dropdown').has(e.target).length === 0 && $('.open').has(e.target).length === 0) {
					// $('li.search-dropdown').removeClass('open');
				// }
			// });
			$('#search-dropdown').click(function(){
				$(this).find('.dropdown-menu').toggleClass('open');
			});
		</script>
    </body>
</html>