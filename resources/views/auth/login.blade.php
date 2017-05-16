@extends('main_user')

@section('title', '| Administrator Login')

@section('content')
	
	<div class="col-md-8 col-md-offset-2">
		{!! Form::open(['method' => 'POST', 'class' => 'well form-horizontal margin-top', 'data-toggle' => 'validator']) !!}
			
			<fieldset>
				
				<legend class="text-center">ADMINISTRATOR LOGIN</legend>

				<div class="form-group">
					<div class="col-md-2 col-md-offset-1 control-label">
						{{ Form::label('email', 'Email:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							{{ Form::email('email', null, ['class' => 'form-control', 
								'placeholder' => 'Enter Email Address here ...', 
								'required', 'pattern="^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆØÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$"']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-2 col-md-offset-1 control-label">
						{{ Form::label('password', 'Password:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							{{ Form::password('password', ['class' => 'form-control', 
								'placeholder' => 'Enter Password here ...',
								'required', 'minlength="6"', 'maxlength="60"', 'pattern="^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$"']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						{{ Form::checkbox('remember') }}
						{{ Form::label('remember', 'Remember me') }}
					</div>
					<div class="col-md-6 col-md-offset-3">
						{{ Form::submit('LOGIN', ['class' => 'btn btn-primary btn-block']) }}
						<a href="{{Route('password.request')}}">Forgot My Password</a>
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
	</div>

@endsection