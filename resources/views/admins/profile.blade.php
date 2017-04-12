@extends('main_admin')

@section('title', 'Profile')

@section('content')

	<div class="col-md-12">

		<div class="row" id="profile-avatar-row">
			<img src="/uploads/avatars/{{$admin->avatar}}" id="profile-avatar"/>
			<h2>{{$admin->firstname}} {{$admin->lastname}}</h2>
			<p>{{$admin->email}}</p>
			{{Form::button('Upload Avatar', ['data-toggle' => 'collapse', 'data-target' => '#updateAvatar', 
			'class' => 'btn btn-sm btn-default', 'id' => 'updateAvatarToggle'])}}

			<div class="collapse"  id="updateAvatar">
				{{Form::open(['route' => 'admins.updateAvatar', 'enctype' => 'multipart/form-data', 'method' => 'POST', 'data-toggle' => 'validator'])}}
					{{Form::label('Upload Profile Picture')}}
					{{Form::file('avatar', ['id' => 'avatar'])}}
					{{Form::submit('SAVE', ['class' => 'btn btn-xs btn-success', 'id' => 'updateAvatarSave' ])}}
					{{Form::button('CANCEL', ['class' => 'btn btn-xs btn-default', 'id' => 'updateAvatarCancel', 
						'data-toggle' => 'collapse', 'data-target' => '#updateAvatar'])}}
				{{Form::close()}}
			</div>
		</div>
		
		<div class="row margin-top">
			<hr/>
			<h2 class="text-center">Settings</h2>
			<div class="margin-top text-center">
				<a href="{{ URL::route('admins.editAdmin', [$admin->id]) }}" title="Edit Personalia">
					<i class="glyphicon glyphicon-user" id="profile-icons"></i>
				</a>
				<a href="{{ URL::route('admins.editAdminPassword', [$admin->id]) }}" title="Edit Password">
					<i class="glyphicon glyphicon-lock" id="profile-icons"></i>
				</a>
			</div>
		</div>

	</div>
	
@endsection