@extends('templates.master')

@section('content')
<div class="box">
	<div class="row">
		<div class="col-md-12">
			<div id="search">
				<div style="margin:auto;margin-top: 5px;">

					
						@if ($searchType == 'sequence')
							{!! Form::open(array('method'=>'POST', 'action'=>array('SearchController@search'))) !!}
							<label class="control-label">Search by Sequence</label>
							<input type="hidden" name="search_type" value="sequence" />
							{!! Form::textarea('search_content', @$searchContent, array('class' => 'form-control sequence-input', 'rows' => '5')) !!}
							<br/>
							<input type="submit" name="search" value="Search" class="search-button pull-right" />
						@else
							{!! Form::open(array('method'=>'GET', 'action'=>array('SearchController@search'))) !!}
									<table>
										<tbody>
											<tr>
												<td>
													{!! Form::select('search_type', array('keyword' => 'Từ khóa', 'id' => 'Barcode ID'), @$searchType, array('style' => 'vertical-align: middle;', 'class' => 'selectMenu')) !!}
												</td>
												<td>
													<div id="search-control-container">
														{!! Form::text('search_content', @$searchContent, array('style'	=>	'width:620px;height: 30px;border: 0;font-size: 15px;padding-left: 10px;')) !!}
														<input type="submit" name="search" value="Tìm kiếm" class="search-button" />
													</div>	
												</td>
											</tr>
										</tbody>
									</table>
						@endif
					  {!! Form::close() !!}
				  </div>
			</div>
		</div>
		@if (isset($searchContent))
		<div class="col-md-12">
			<h3>Kết quả tìm kiếm</h3>
			<hr/>
			@if (!empty($searchResult))
				<div class="search-result-container">
					<ol>
					@foreach ($searchResult AS $item)
						<li>
							<a href="viewbarcode?id={{ $item['barcode_id'] }}">{{ @$item['vietnamese_name'] }}</a> ({{ @$item['other_name'] }} - {{ @$item['species_name'] }})
						</li>
					@endforeach
					</ol>
				</div>	
			@else
				<p>Không tìm thấy dữ liệu phù hợp</p>
			@endif
		</div>
		@endif
	</div>
</div>
@endsection