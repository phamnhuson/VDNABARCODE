@extends('templates.master')

@section('title', 'Help')

@section('content')
<div class="row">
	<div class="col-md-8">
		<h1 id="search">Search</h1>
		<hr/>
		
		<p>VNDB Cung cấp 3 phương thức tìm kiếm: tìm kiếm theo từ khóa, id, và trình tự</p>
		<p><b>Tìm kiếm theo từ khóa:</b></p>
		<ul>
			<li>Bước 1: Chọn tìm kiếm theo từ khóa</li>
			<li>Bước 2: Nhập từ khóa cần tìm kiếm</li>
			<li>Bước 3: Click Tìm kiếm và theo dõi kết quả</li>
			<li>Bước 4: Click vào đường link để xem chi tiết từng kết quả</li>
		</ul>
		<p class="center">
			<br/>
			<img style="width:60%;" src="{{ asset('public/img/help/fig1.jpg') }}" />
		</p>
		<br/>
		<p><b>Tìm kiếm theo ID:</b></p>
		<ul>
			<li>Bước 1: Chọn tìm kiếm theo ID</li>
			<li>Bước 2: Nhập ID cần tìm kiếm</li>
			<li>Bước 3: Click Tìm kiếm và theo dõi kết quả</li>
			<li>Bước 4: Click vào đường link để xem chi tiết từng kết quả</li>
		</ul>
		<p class="center">
			<br/>
			<img style="width:60%;" src="{{ asset('public/img/help/fig2.jpg') }}" />
		</p>
		<br/>
		<p><b>Tìm kiếm theo trình tự:</b></p>
		<ul>
			<li>Bước 1: Chọn tìm kiếm theo trình tự</li>
			<li>Bước 2: Nhập trình tự cần tìm kiếm</li>
			<li>Bước 3: Click Tìm kiếm và theo dõi kết quả</li>
			<li>Bước 4: Click vào đường link để xem chi tiết từng kết quả</li>
		</ul>
		<p class="center">
			<br/>
			<img style="width:60%;" src="{{ asset('public/img/help/fig3.jpg') }}" />
		</p>
		<br/>
		
		
		<!-- Blast Help -->
		<h1 id="blast">Blast</h1>
		<hr/>
		<p><b>Các bước Blast trình tự:</b></p>
		<ul>
			<li>Bước 1: Chọn công cụ Blast</li>
			<li>Bước 2: Nhập các thông tin tùy chọn Blast</li>
			<li>Bước 3: Nhập trình tự</li>
			<li>Bước 4: Click vào tìm kiếm để bắt đầu Blast</li>
			<li>Bước 5: Theo dõi kết quả Blast trong bảng, click vào link để xem chi tiết</li>
		</ul>
		<p class="center">
			<br/>
			<img style="width:60%;" src="{{ asset('public/img/help/fig4.jpg') }}" />
		</p>
		<br/>
		
		<!-- Tree Help -->
		<h1 id="tree">Tree</h1>
		<hr/>
		<p><b>Các bước tạo cây quan hệ:</b></p>
		<ul>
			<li>Bước 1: Nhập dữ liệu trình tự dạng Fasta</li>
			<li>Bước 2: Click Generate để tiến hành tạo cây quan hệ</li>
			<li>Bước 3: Sau khi có kết quả, sử dụng các công cụ để điều chỉnh cây quan hệ</li>
		</ul>
		<p class="center">
			<br/>
			<img style="width:60%;" src="{{ asset('public/img/help/fig5.jpg') }}" />
		</p>
		<br/>
		
		<!-- Illustrative Barcode Help -->
		<h1 id="illustrative-barcode">Illustrative Barcode</h1>
		<hr/>
		<p><b>Các bước tạo barcode từ trình tự:</b></p>
		<ul>
			<li>Bước 1: Nhập trình tự cần tạo barcode</li>
			<li>Bước 2: Click Generate để tiến hành tạo barcode</li>
		</ul>
		<p class="center">
			<br/>
			<img style="width:60%;" src="{{ asset('public/img/help/fig6.jpg') }}" />
		</p>
		<br/>
		<br/><br/>
	</div>
	<div class="col-md-4">
		<div data-spy="affix" id="table-contents" data-offset-top="80">
			<br/>
			<ul>
				<li><a href="#search">Search</a></li>
				<li><a href="#blast">Blast</a></li>
				<li><a href="#tree">Tree</a></li>
				<li><a href="#illustrative-barcode">Illustrative Barcode</a></li>
			</ul>
		</div>
	</div>
</div>	

@endsection	