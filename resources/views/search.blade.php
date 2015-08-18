@extends('templates.master')

@section('content')
<div class="box">
	<div class="row">
		<div class="col-md-12">
			<div id="search">
				<div style="margin:auto;margin-top: 5px;">

					{!! Form::open(array('method'=>'POST', 'action'=>array('SearchController@search'))) !!}
									<input type="hidden" name="taxon">
									<table>
										<tbody>
											<tr>
												<td>
													{!! Form::select('search_type', array('keyword' => 'Từ khóa', 'sequence' => 'Trình tự', 'location' => 'Địa phương', 'time' => 'Thời gian'), @$searchType, array('style' => 'vertical-align: middle;', 'class' => 'selectMenu')) !!}
												</td>
												<td>
													<div id="search-control-container">
														{!! Form::text('search_content', @$searchContent, array('style'	=>	'width:620px;height: 30px;border: 0;font-size: 15px;padding-left: 10px;')) !!}
														<input type="submit" name="search" value="Tìm kiếm" style="  height: 30px;border: 0;float: right;background-color: F07C0B;color: #fff;font-size: 15px;" />
													</div>	
												</td>
											</tr>
										</tbody>
									</table>

					  {!! Form::close() !!}
				  </div>
			</div>
		</div>
		<div class="col-md-12">
			<h3>Kết quả tìm kiếm</h3>
			<hr/>
			@if (!empty($searchResult))
				<div class="search-result-container">
					<ol>
					@foreach ($searchResult AS $item)
						<li>
							<a href="viewbarcode?id={{ $item['barcode_id'] }}">{{ @$item['vietnamese_name'] }}</a> ({{ @$item['common_name'] }} - {{ @$item['scientific_name'] }})
						</li>
					@endforeach
					</ol>
				</div>	
			@else
				<p>Không tìm thấy dữ liệu phù hợp</p>
			@endif
		</div>
	</div>
</div>
@endsection