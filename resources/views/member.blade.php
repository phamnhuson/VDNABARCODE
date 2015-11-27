@extends('templates.master')

@section('title', 'Members')

@section('content')
<div class="box">
	<div class="row">
		<div class="col-md-12">
			<h3>MEMBER</h3>
			<hr/>
			
				<!-- List group -->
				<div class="row">
					@foreach ($users AS $k => $user)
					<div class="col-md-6 <?=($k%2==0)?'pdl-0':'pdr-0';?>">
						<div class="member-info-container">
							
							<table style="width:100%">
								<tr>
									<td style="width:100px;">
										<div class="avatar-container-hover" style="background:url(<?=(file_exists(PUBLIC_PATH().'/uploads/img/user_pictures/avata_'.$user['id'].'.jpg'))? asset('public/uploads/img/user_pictures/avata_'.$user['id'].'.jpg') : asset('public/uploads/img/user_pictures/no-avatar.jpg');?>)">
										</div>
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
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right">
							{!! $users->render() !!}
						</div>	
					</div>
				</div>
		</div>
	</div>
</div>	
@endsection