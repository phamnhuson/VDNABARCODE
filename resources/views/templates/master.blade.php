<html>
    <head>
        <title>@yield('title')</title>
		<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('public/css/jquery.dataTables.min.css') }}">
		
		<script src="{{ asset('public/js/jquery.min.js') }}"></script>
		<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('public/js/app.js') }}"></script>
    </head>
    <body style="background-color:#f0f6fa">
		<div id="header">
			<div class="box">
				<div id="logo">					
					<a href="/"><img src="{{ asset('public/img/medLogo.png') }}" /></a>
				</div>
				<div id="mainNav">
					<ul style='margin-top:10px;'>
						@if (Auth::check() && Auth::user()->role==3)
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quản lý danh mục <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="/user">Tài khoản</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="/city">Danh mục địa phương</a></li>
								<li><a href="/class">Danh mục phân lớp</a></li>
								<li><a href="/order">Danh mục phân bộ</a></li>
								<li><a href="/family">Danh mục phân họ</a></li>
								<li><a href="/genus">Danh mục phân chi</a></li>
								<li><a href="/species">Danh mục phân loài</a></li>
							</ul>
						</li>
						@endif
						<li class=""><a href="/contact">Giới thiệu</a></li>
						<li class=""><a href="/contact">Liên hệ</a></li>
						
						@if (Auth::check())
						<li class=""><a href="/logout">Đăng xuất</a></li>
						@else
						<li class=""><a href="/login">Đăng nhập</a></li>
						@endif
					</ul>
				</div>

			</div>
		</div>
		<div class="container" style="width:100%;padding:0px;">
			@yield('content')
		</div>
		<div id="footer">
			<div class="box">
			<table style="width: 800px;">
				<tr>
				<td valign="top" class="footerMenu">

					<h4>Databases</h4>
					<ul>
					<li><a href="/index.php/Public_BINSearch?searchtype=records">Public Data Portal</a></li>
					<li><a href="/index.php/TaxBrowser_Home">Taxonomy Browser</a></li>
					<li><a href="/index.php/Public_Publication_PublicationSearch">Publications</a></li>
					<li><a href="/index.php/Public_Primer_PrimerSearch">Primers</a></li>
					</ul>

				</td>
				<td valign="top" class="footerMenu">

					<h4>Resources</h4>
					<ul>
					<li><a href="/index.php/resources/handbook?chapter=1_gettingstarted.html">Documentation</a></li>
					<li><a href="/libhtml/docs/bold.pdf">Citing BOLD</a></li>
					<li><a href="/index.php/NewsFeed">News and Events</a></li>
					<li><a href="/index.php/datarelease">Data Releases</a></li>
					</ul>

				</td>
				<td valign="top" class="footerMenu">

					<h4>Organization</h4>
					<ul>
					<li><a href="/index.php/Resources/whatIsBOLD">About Us</a></li>
					<li><a href="/index.php/Resources/ContactUs">Contact Us</a></li>
					</ul>

				</td>
				<td valign="top" class="footerMenu">

					<h4>Community</h4>
					<ul>
					<li><a href="/index.php/NewsFeed">News &amp; Events</a></li>
					<li><a href="http://connect.barcodeoflife.net/group/boldsystems">Connect</a></li>
					</ul>

				</td>
				<td valign="top" class="footerMenu">

					<h4>Partners</h4>
					<ul>
					<li><a href="http://www.ibol.org">iBOL</a></li>
					<li><a href="http://barcodeoflife.org">CBOL</a></li>
					<li><a href="http://ccdb.ca">CCDB</a></li>
					<li><a href="http://www.ncbi.nlm.nih.gov">GenBank</a></li>
					<li><a href="http://www.eol.org">EOL</a></li>
					<li><a href="http://www.gbif.org">GBIF</a></li>
					</ul>

				</td>
				</tr>
				<tr>
				<td colspan="5" id="copyright">
					<!-- TODO: Magnoliatize this whole section, should the year be dynamic? yes I think so -->
					Copyright © 2014 BOLD Systems. All rights reserved.&nbsp
				</td>
				</tr>
			</table>
			</div><!--/.box-->
		</div>
    </body>
</html>