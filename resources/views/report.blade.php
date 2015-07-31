@extends('templates.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-7">
			<h3>Báo cáo dữ liệu barcode</h3>
			
			<form>
				<table class="table" style="border:0;">
					<tr>
						<td><select class="form-control"><option>Chọn tiêu chí</option></select></td>
						<td><select class="form-control"><option>Chọn địa điểm</option></select></td>
						<td><select class="form-control"><option>Chọn thời gian</option></select></td>
						<td><input type="submit" class="btn btn-primary" value="Tạo báo cáo" /></td>
					</tr>
				</table>	
			</form>
			<hr/>
			<br/>
			<p style="text-align:center;"><a href="#" class="btn btn-link btn-lg"><span class="glyphicon glyphicon-download-alt"></span> Tải xuống báo cáo</a></p>
			<br/>
		</div>
	</div>
</div>	
@endsection