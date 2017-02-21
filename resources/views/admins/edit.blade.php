@extends('main_admin')

@section('title', '| Create User')

@section('content')

	<div class="col-md-10 col-md-offset-1">
		{!! Form::model($user, ['route' => ['admins.updateUser', $user->id], 'method' => 'PUT', 'class' => 'well form-horizontal margin-top']) !!}
			
			<fieldset>
				
				<legend class="text-center">CREATE USER</legend>

				<div class="form-group">
					<div class="col-md-3 control-label">
						{{ Form::label('firstname', 'First Name:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							{{ Form::text('firstname', null, ['class' => 'form-control']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-3 control-label">
						{{ Form::label('lastname', 'Last Name:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							{{ Form::text('lastname', null, ['class' => 'form-control']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-3 control-label">
						{{ Form::label('phone', 'Phone:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
							{{ Form::text('phone', null, ['class' => 'form-control']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-3 control-label">
						{{ Form::label('email', 'E-Mail:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							{{ Form::text('email', null, ['class' => 'form-control']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-3 control-label">
						{{ Form::label('company', 'Company:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
							{{ Form::text('company', null, ['class' => 'form-control']) }}
						</div>
					</div>
				</div>

				<div class="form-group btn-margin-top">
					<div class="col-md-8 col-md-offset-2">
						{{ Form::submit('SAVE', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-md-offset-2">
						{!! Form::open(['route' => ['admins.destroyUser', $user->id], 'method' => 'DELETE']) !!}
                  			{!! Form::submit('DELETE', ['class' => 'btn btn-danger btn-block']) !!}
               			{!! Form::close() !!}
                	</div>
					<div class="col-md-4">
						<a href="{{ route('admins.users') }}" class="btn btn-default btn-block">CANCEL</a>
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
	</div>

@endsection