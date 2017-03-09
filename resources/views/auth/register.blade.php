@extends('main_admin')

@section('title', '| Create Admin')

@section('content')

	<div class="col-md-12">
		{!! Form::open(['class' => 'form-horizontal margin-top', 'data-toggle' => 'validator']) !!}
			
			<fieldset>
				
				<legend class="text-center margin-bottom">CREATE ADMIN</legend>

				<div class="form-group has-feedback">
					<div class="col-md-3 control-label">
						{{ Form::label('firstname', 'First Name:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							{{ Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name here ...',
								'required', 'minlength="2"', 'maxlength="30"', 'pattern="^[A-ZÆØÅa-zæøå \-]{2,30}$"']) }}
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group has-feedback">
					<div class="col-md-3 control-label">
						{{ Form::label('lastname', 'Last Name:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							{{ Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name here ...',
								'required', 'minlength="2"', 'maxlength="30"', 'pattern="^[A-ZÆØÅa-zæøå \-]{2,30}$"']) }}
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group has-feedback">
					<div class="col-md-3 control-label">
						{{ Form::label('email', 'E-Mail:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-Mail Address here ...',
								'required', 'pattern="^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$"']) }}
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group has-feedback">
					<div class="col-md-3 control-label">
						{{ Form::label('password', 'Password:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							{{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 
								'placeholder' => 'Enter Password here ...', 'required', 'minlength="6"', 
								'maxlength="60"', 'pattern="^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$"']) }}
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
							{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password ...', 'data-match' => '#password', 'data-match-error' =>'The passwords does not match.', 
								'required', 'minlength="6"', 'maxlength="60"', 'pattern="^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$"']) }}
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group btn-margin-top">
					<div class="col-md-4 col-md-offset-2">
						{{ Form::submit('CREATE', ['class' => 'btn btn-primary btn-block']) }}
					</div>
					<div class="col-md-4">
						<a href="{{ route('admins.dashboard') }}" class="btn btn-default btn-block">CANCEL</a>
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
	</div>

@endsection