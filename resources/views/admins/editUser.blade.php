@extends('main_admin')

@section('title', '| Edit')

@section('content')

	<div class="col-md-10 col-md-offset-1">
		{!! Form::model($user, ['route' => ['admins.updateUser', $user->id], 'method' => 'PUT', 'data-toggle' => 'validator',
				'class' => 'well form-horizontal margin-top']) !!}
			
			<fieldset>
				
				<legend class="text-center">EDIT USER</legend>

				<div class="form-group has-feedback">
					<div class="col-md-3 control-label">
						{{ Form::label('firstname', 'First Name:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							{{ Form::text('firstname', null, ['class' => 'form-control',
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
							{{ Form::text('lastname', null, ['class' => 'form-control',
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
							{{ Form::text('phone', null, ['class' => 'form-control',
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
							{{ Form::text('email', null, ['class' => 'form-control',
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
						@if($user->company != 'ncspectrum')
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
								{{ Form::text('company', null, ['class' => 'form-control',
									'required', 'minlength="2"', 'maxlength="30"', 'pattern="^[A-ZÆØÅa-zæøå0-9 \-.]{2,30}$"']) }}
							</div>
						@else
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
								{{ Form::text('company', null, ['class' => 'form-control',
									'required', 'readonly', 'minlength="2"', 'maxlength="30"', 
									'pattern="^[A-ZÆØÅa-zæøå0-9 \-.]{2,30}$"',]) }}
							</div>
						@endif
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group btn-margin-top">
					<div class="col-md-8 col-md-offset-2">
						{{ Form::submit('SAVE', ['class' => 'btn btn-success btn-block']) }}
						{{ Form::close() }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-md-offset-2">
						{!! Html::linkRoute('admins.showUser', 'DELETE', [$user->id], ['class' => 'btn btn-danger btn-block']) !!}
                	</div>
					<div class="col-md-4">
						@if($user->company != 'ncspectrum')
							<a href="{{ route('admins.guests') }}" class="btn btn-default btn-block">CANCEL</a>
						@else
							<a href="{{ route('admins.employees') }}" class="btn btn-default btn-block">CANCEL</a>
						@endif
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
	</div>

@endsection