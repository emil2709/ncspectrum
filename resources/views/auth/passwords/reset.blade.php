@extends('main_user')

@section('title', '| Reset Password')

@section('content')
	
	<div class="col-md-8 col-md-offset-2">
		{!! Form::open(['url' => 'password/reset', 'method' => 'POST', 'class' => 'well form-horizontal margin-top',
			'data-toggle' => 'validator']) !!}
			
			<fieldset>
				
				<legend class="text-center">Reset Password</legend>

				{{ Form::hidden('token', $token) }}

				<div class="form-group">
					<div class="col-md-2 col-md-offset-1 control-label">
						{{ Form::label('email', 'Confirm Email:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							{{ Form::email('email', null, ['class' => 'form-control', 
								'placeholder' => 'Confirm Email Address here ...',
								'required', 'pattern="^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$"']) }}
						</div>
					</div>
				</div>

				<div class="form-group has-feedback">
					<div class="col-md-2 col-md-offset-1 control-label">
						{{ Form::label('password', 'New Password:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							{{ Form::password('password', ['class' => 'form-control', 'id' => 'password',
								'placeholder' => 'Enter New Password here ...',
								'required', 'minlength="6"', 'maxlength="60"', 'pattern="^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$"']) }}
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group has-feedback">
					<div class="col-md-3 control-label">
						{{ Form::label('password_confirmation', 'Confirm Password:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							{{ Form::password('password_confirmation', ['class' => 'form-control', 
								'placeholder' => 'Confirm Password here ...',
								'data-match' => '#password', 'data-match-error' =>'The passwords does not match.', 
								'required', 'minlength="6"', 'maxlength="60"', 'pattern="^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$"']) }}
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						{{ Form::submit('RESET PASSWORD', ['class' => 'btn btn-primary btn-block']) }}
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
	</div>

@endsection