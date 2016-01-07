@extends('templates.master')

@section('title', 'Ngân hàng dữ liệu DNA Việt Nam - Introduction')

@section('content')
<div class="row">
	<div class="col-md-12">
		<h1>INTRODUCTION</h1>
		<hr/>
		<p>
		Nhằm xây dựng cơ sở dữ liệu mã vạch ADN (DNA barcode) quốc gia cho các loài sinh vật Việt Nam, phục vụ công tác nghiên cứu khoa học, đào tạo, quản lý nhà nước và quản lý thương mại nguồn tài nguyên sinh vật của Việt Nam, năm 2014, Bộ Nông nghiệp và PTNT đã phê duyệt Đề tài <b>“Xây dựng cơ sở dữ liệu mã vạch ADN (DNA barcode) cho một số loài cây lâm nghiệp gỗ lớn, lâm sản ngoài gỗ có giá trị kinh tế”</b>, đây là nhiệm vụ khoa học công nghệ cấp Nhà nước, thuộc chương trình Công nghệ sinh học trong Nông nghiệp, Thủy sản do Bộ Nông nghiệp và PTNT quản lý. Đề tài giao cho: </p>
		<p>Cơ quan chủ trì: <b>Trường Đại học Lâm nghiệp Việt Nam</b></p>
		<p>Chủ nhiệm đề tài: <b>TS. Hà Văn Huân</b></p>
		<p><b>Cơ quan phối hợp: </b></p>
		<ul>
			<li>Viện Công nghệ sinh học – VAST (Trưởng nhóm Bioinformatics TS. Nguyễn Cường);</li>
			<li>Viện Nghiên cứu Hệ gen – VAST (Trưởng nhóm TS. Lê Thị Thu Hiền);</li>
			<li>Viện Nghiên cứu Giống và CNSH lâm nghiệp – VAFS (Trưởng nhóm TS. Trần Hồ Quang).</li>
		</ul>
		<p>
		Một trong những nội dung quan trọng của đề tài là <b>“Thiết kế, xây dựng phần mềm 
		quản lý và khai thác cơ sở dữ liệu mã vạch ADN“</b>, sản phẩm của nghiên cứu này là 
		phần mềm <b>VNBD</b> (Viet Nam Biobarcode Database – Cơ sở dữ liệu sinh vật Việt Nam).</p>
		<p><b>VNBD</b> cho phép lưu trữ hàng triệu bản ghi của các đoạn ADN mã vạch (DNA 
		barcode) của các loài sinh vật, mẫu vật với các thông tin mô tả chi tiết, cụ thể kèm theo; </p>
		<p><b>VNDB có 03 cơ sở dữ liệu về:</b></p>
		<ol>
			<li>DNA barcode: Gồm các đoạn mã vạch ADN, dữ liệu này là kết quả nghiên cứu 
		của các nhà khoa học, nhóm nghiên cứu;</li>
			<li>Primers: Gồm các trình tự nucleotide và các thông tin có liên quan của các mồi 
		(primer) để nhân bản các đoạn mã vạch ADN, dữ liệu này do các nhà khoa học, 
		nhóm nghiên cứu đăng ký;</li>
			<li>Publications: Gồm các ấn phẩm đã được xuất bản có liên quan đến DNA barcode, 
		dữ liệu này do các tác giả upload.</li>
		</ol>
		<p>
		Đồng thời <b>VNBD</b> cũng tích hợp nhiều công cụ hữu ích như: Công cụ <b>Search</b> theo 
		Key works, Barcode ID, Sequence; <b>Blast</b> (so sánh một trình tự nucleotide bất kỳ với các 
		trình tự nucleotide trong <b>VNBD</b> và giữa các trình tự nucleotide của các mẫu phân tích); 
		Tạo cây quan hệ di truyền (Tree) giữa các mẫu phân tích; Chuyển hóa trình tự nucleotide 
		thành phổ mã vạch (<b>Illustravive Barcode</b>),...</p>
		<p>
		<b>VNBD</b> còn liên kết các thành viên quan tâm đến DNA barcode thông qua mục 
		Member link. Các nhà khoa học, sinh viên, học viên, cán bộ quản lý,... có thể đăng ký 
		vào mục Member link để được giới thiệu, chia sẻ và trao đổi kinh nghiệm trong lĩnh vực 
		DNA barcode.</p>
		<p>
		Để <b>VNBD</b> được hoàn hảo hơn, phục vụ tốt nhất cho tất cả các đối tượng có liên quan, 
		Nhóm nghiên cứu rất mong nhận được ý kiến đóng góp của các nhà khoa học và các bạn 
		đồng nghiệp.</p>

		<p>Trân trọng cảm ơn!</p>
		<div class="row">
			<div class="col-md-4 col-md-offset-8" align="center">
				<p>TM Nhóm NC</p>
				<br/><br/>
				<p>TS. Hà Văn Huân</p>
			</div>
		</div>	
		<br/><br/><br/>
	</div>
	
</div>
@endsection