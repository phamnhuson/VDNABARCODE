@extends('templates.master')
@section('title', 'Sao lưu dữ liệu')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<h1 class="page-title">Sao lưu dữ liệu</h1>
			<table class="table table-stripped table-bordered">
				<tr>
					<th>Tên file</th>
					<th>Ngày tạo</th>
					<th>Dung lượng</th>
					<th>Thao tác</th>
				</tr>
				@foreach ($fileData AS $file)
					<tr>
						<td>{{ $file['name'] }}</td>
						<td>{{ $file['time'] }}</td>
						<td>{{ $file['size'] }}</td>
						<td><a href="{{ $file['link'] }}" target="_blank"><span class="glyphicon glyphicon-save"></span> Tải xuống</a></td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>	

@endsection