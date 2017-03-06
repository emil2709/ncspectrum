@extends('main_user')

@section('title', '| Admin Login')

@section('content')
	
	<div class="col-md-8 col-md-offset-2">
		{!! Form::open(['route' => 'login', 'method' => 'GET', 'class' => 'well form-horizontal margin-top']) !!}
			
			<fieldset>
				
				<legend class="text-center">ADMIN LOGIN</legend>

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

				<div class="form-group btn-margin-top">
					<div class="col-md-4 col-md-offset-2">
						{{ Form::submit('LOGIN', ['class' => 'btn btn-primary btn-block']) }}
					</div>
					<div class="col-md-4">
						<a href="{{ route('users.index') }}" class="btn btn-default btn-block">CANCEL</a>
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
	</div>

@endsection