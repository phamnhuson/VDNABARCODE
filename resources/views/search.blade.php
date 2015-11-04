@extends('templates.master')
@section('title', 'Search: '.$searchContent)
@section('content')
<div class="box">
	<div class="row">
		<div class="col-md-12">
			<div id="search">
				<div style="margin:auto;margin-top: 5px;">
					{!! Form::open(array('method'=>'GET', 'action'=>array('SearchController@search'))) !!}
							<table>
								<tbody>
									<tr>
										<td>
											{!! Form::select('search_type', array('barcode' => 'DNA Barcode', 'gen' => 'Gene Data', 'genome' => 'Genome Data', 'public' => 'Public Data', 'member' => 'Member'), @$searchType, array('style' => 'vertical-align: middle;', 'class' => 'selectMenu', 'id' => 'search-type')) !!}
										</td>
										<td>
											<div id="search-control-container">
												{!! Form::text('search_content', @$searchContent, array('style'	=>	'width:620px;height: 30px;border: 0;font-size: 15px;padding-left: 10px;')) !!}
												<input type="submit" value="Tìm kiếm" class="search-button" />
											</div>	
										</td>
									</tr>
								</tbody>
							</table>
					  {!! Form::close() !!}
				  </div>
			</div>
		</div>
		@if (isset($searchContent))
		<div class="col-md-12">
			<h3>Kết quả tìm kiếm</h3>
			<hr/>
			@if ( $searchResult->count() > 0 )
				<div class="search-result-container">
					@if ($searchType == 'barcode')
						<ol>
						@foreach ($searchResult AS $item)
							<li class="search-result-item">
								<p><b><a href="viewbarcode?id={{ $item['barcode_id'] }}">ID{{ $item['barcode_id'] }}</a> - {{ @$item['species_name'] }} [{{ @$item['gene'] }}:{{ @$item['seq_size'] }}]</b></p>
								<p><u>Taxonomy</u>: {{ @$item['phylum_name'] }}, {{ @$item['class_name'] }}, {{ @$item['order_name'] }}, {{ @$item['family_name'] }}, {{ @$item['genus_name'] }}</p>
								<p><u>Identifiers</u>: {{ @$item['genbank_accession'] }}</p>
								<p><u>Depository</u>: {{ @$item['deposited_in'] }}</p>
							</li>
						@endforeach
						</ol>
					@elseif ($searchType == 'public')
						<ol>
						@foreach ($searchResult AS $k => $public)
							<li><a href="publication?id={{ $public['new_id'] }}">{{ $public['subject'] }}</a></li>
						@endforeach
						</ol>	
					@elseif ($searchType == 'member')
						<div class="row">
							@foreach ($searchResult AS $k => $user)
							<div class="col-md-6 <?=($k%2==0)?'pdl-0':'pdr-0';?>">
								<div class="member-info-container">
									
									<table style="width:100%">
										<tr>
											<td style="width:100px;">
												<img width="90" height="120" class="pull-left" src="<?=(file_exists(PUBLIC_PATH().'/uploads/img/user_pictures/avata_'.$user['id'].'.jpg'))? asset('public/uploads/img/user_pictures/avata_'.$user['id'].'.jpg') : asset('public/uploads/img/user_pictures/no-avatar.jpg');?>" />
											</td>
											<td>
												<div class="member-info" style="width:100%">
													<h4 style="color:blue;">{{ $user['degree'] }} {{ $user['fullname'] }}<?php if($user['file']==1){ ?>
													<a href="/public/uploads/file/user_cv/cv_{{ $user['id'] }}.pdf" target="_blank" class="pull-right more-info">More information</a>
													<?php } ?></h4>
													<p><b>Cơ quan: </b>{{ $user['work_place'] }}</p>
													<p><b>ĐT: </b>{{ $user['phone'] }}</p>
													<p><b>E.mail: </b>{{ $user['email'] }}</p>
													<p><b>Lĩnh vực nghiên cứu: </b>{{ $user['research'] }}</p>
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
							@endforeach
						</div>
					@endif
				</div>	
				<div class="search-pagination">
					<div class="col-md-12">
						{!! $searchResult->appends(['search_type' => $searchType, 'search_content' => $searchContent])->render() !!}
					</div>	
				</div>
			@else
				<p>Không tìm thấy dữ liệu phù hợp</p>
			@endif
			<br/>
		</div>
		@endif
	</div>
</div>
@endsection