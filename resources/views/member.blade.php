@extends('templates.master')

@section('title', 'Members')

@section('content')
<div class="box">
	<div class="row">
		<div class="col-md-12">
			<h3>MEMBER</h3>
			<hr/>
			<div class="panel panel-default">
				<!-- List group -->
				<ul class="list-group">
					@foreach ($users AS $user)
					<li class="list-group-item">
						<div style="overflow:hidden;">
						<img width="150" height="200" class="pull-left" src="<?=(file_exists(PUBLIC_PATH().'/uploads/img/user_pictures/avata_'.$user['id'].'.jpg'))? asset('public/uploads/img/user_pictures/avata_'.$user['id'].'.jpg') : asset('public/uploads/img/user_pictures/no-avatar.jpg');?>" />
						<div class="member-info">
							<h4 style="color:blue;">{{ $user['degree'] }} {{ $user['fullname'] }}</h4>
							<p><b>Cơ quan: </b>{{ $user['work_place'] }}</p>
							<p><b>ĐT: </b>{{ $user['phone'] }}</p>
							<p><b>E.mail: </b>{{ $user['email'] }}</p>
							<p><b>Lĩnh vực nghiên cứu: </b>{{ $user['research'] }}</p>
						</div>	
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>	
@endsection