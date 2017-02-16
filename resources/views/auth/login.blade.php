@extends('main')

@section('title', '| Admin Login')

<div class="col-md-8 col-md-offset-2">
	{!! Form::open(['route' => 'login', 'method' => 'GET', 'class' => 'well form-horizontal margin-top']) !!}
		
		<fieldset>
			
			<legend class="text-center">Admin Login</legend>

			<div class="form-group">
				<div class="col-md-4 control-label">
					{{ Form::label('username', 'Username:') }}
				</div>
				<div class="col-md-4 inputContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						{{ Form::text('username', null, ['class' => 'form-control', 
							'placeholder' => 'Enter Username here...']) }}
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-4 control-label">
					{{ Form::label('password', 'Password:') }}
				</div>
				<div class="col-md-4 inputContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						{{ Form::password('password', ['class' => 'form-control', 
							'placeholder' => 'Enter Password here...']) }}
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-4 col-md-offset-2">
					{{ Form::submit('Login', ['class' => 'btn btn-success btn-block']) }}
				</div>
				<div class="col-md-4">
					<a href="{{ route('users.index') }}" class="btn btn-default btn-block">Cancel</a>
				</div>
			</div>

		</fieldset>

	{!! Form::close() !!}
</div>