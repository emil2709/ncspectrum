@extends('main_admin')

@section('title', '| Edit Administrator Password')

@section('content')

@if(Auth::user()->id == 1 || Auth::user()->id == $admin->id)
	<div class="col-md-12">
		{!! Form::model($admin, ['route' => ['admins.updateAdminPassword', $admin->id], 'method' => 'PUT', 'data-toggle' => 'validator',
				'class' => 'form-horizontal margin-top']) !!}
			
			<fieldset>
				
				<legend class="text-center">EDIT ADMINISTRATOR PASSWORD</legend>

				<div class="form-group has-feedback">
					<div class="col-md-3 control-label">
						{{ Form::label('currentPassword', 'Current Password:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							@if(Auth::user()->id == 1)
								{{ Form::password('currentPassword', 
									['class' => 'form-control', 'placeholder' => 'System Administrator Password ...',
									'required', 'minlength="6"', 'maxlength="60"', 'pattern="^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$"']) }}
							@else
								{{ Form::password('currentPassword', 
									['class' => 'form-control', 'placeholder' => 'Current Password ...',
									'required', 'minlength="6"', 'maxlength="60"', 'pattern="^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$"']) }}
							@endif
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group has-feedback">
					<div class="col-md-3 control-label">
						{{ Form::label('password', 'New Password:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							{{ Form::password('password', ['class' => 'form-control', 'id' => 'password',
								'placeholder' => 'New Password ...', 'required', 'minlength="6"', 'maxlength="60"', 
								'pattern="^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$"']) }}
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
							{{ Form::password('password_confirmation', ['class' => 'form-control', 'data-match' => '#password',
								'data-match-error' =>'The passwords does not match.', 'placeholder' => 'Confirm Password ...',
								'required', 'minlength="6"', 'maxlength="60"', 'pattern="^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$"']) }}
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group btn-margin-top">
					<div class="col-md-4 col-md-offset-2">
						{{ Form::submit('SAVE', ['class' => 'btn btn-success btn-block']) }}
					</div>
					<div class="col-md-4">
						@if(Auth::user()->id == 1)
							<a href="{{ route('admins.admins') }}" class="btn btn-default btn-block">CANCEL</a>
						@else
							<a href="{{ route('admins.showProfile') }}" class="btn btn-default btn-block">CANCEL</a>
						@endif
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
	</div>

@else
	@include('partials._offlimits')

@endif

@endsection