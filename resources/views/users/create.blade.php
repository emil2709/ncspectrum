@extends('main_user')

@section('title', '| Create User')

@section('content')

	<div class="col-md-10 col-md-offset-1">
		{!! Form::open(['route' => 'users.storeUser', 'class' => 'well form-horizontal margin-top', 'data-toggle' => 'validator']) !!}
			
			<fieldset>
				
				<legend class="text-center">CREATE USER</legend>

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
						{{ Form::label('phone', 'Phone:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
							{{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number here ...',
								'required', 'minlength="8"', 'maxlength="8"', 'pattern="^[0-9]{8}$"']) }}
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
							{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter E-Mail Address here ...',
								'required', 'pattern="^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$"']) }}
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group has-feedback">
					<div class="col-md-3 control-label">
						{{ Form::label('company', 'Company:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
							{{ Form::text('company', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Name here ...',
								'required', 'minlength="2"', 'maxlength="30"', 'pattern="^[A-ZÆØÅa-zæøå0-9 \-.]{2,30}$"']) }}
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
						<a href="{{ route('users.index') }}" class="btn btn-default btn-block">CANCEL</a>
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
	</div>

@endsection
