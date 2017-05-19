@extends('main_admin')

@section('title', '| Edit Administrator')

@section('content')

@if(Auth::user()->id == 1 || Auth::user()->id == $admin->id)
	
	<h2 class="sub-header text-center">Edit Administrator</h2>
	{!! Form::model($admin, ['route' => ['admins.updateAdmin', $admin->id], 'method' => 'PUT', 'data-toggle' => 'validator',
			'class' => 'form-horizontal margin-top']) !!}
		
		<fieldset>

			<div class="form-group has-feedback">
				<div class="col-md-3 control-label">
					{{ Form::label('firstname', 'First Name:') }}
				</div>
				<div class="col-md-6 inputContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						{{ Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name here ...',
							'required', 'minlength="2"', 'maxlength="30"', 'pattern="^[A-Za-z \-]{2,30}$"']) }}
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
							'required', 'minlength="2"', 'maxlength="30"', 'pattern="^[A-Za-z \-]{2,30}$"']) }}
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
							'required', 'pattern="^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"']) }}
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
				<div class="help-block with-errors"></div>
			</div>

			@if(Auth::user()->id == 1)
				@if(Auth::user()->id == $admin->id)
					<div class="form-group btn-margin-top">
						<div class="col-md-4 col-md-offset-2">
							{{ Form::submit('SAVE', ['class' => 'btn btn-success btn-block']) }}
						</div>
						<div class="col-md-4">
							<a href="{{ route('admins.showProfile') }}" class="btn btn-default btn-block">CANCEL</a>
						</div>
					</div>
				@else
					<div class="form-group btn-margin-top">
						<div class="col-md-8 col-md-offset-2">
							{{ Form::submit('SAVE', ['class' => 'btn btn-success btn-block']) }}
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4 col-md-offset-2">
							{!! Html::linkRoute('admins.deleteAdmin', 'DELETE', [$admin->id], 
								['class' => 'btn btn-danger btn-block']) !!}
			        	</div>
						<div class="col-md-4">
							<a href="{{ route('admins.admins') }}" class="btn btn-default btn-block">CANCEL</a>
						</div>
					</div>
				@endif

			@else
				<div class="form-group btn-margin-top">
					<div class="col-md-4 col-md-offset-2">
						{{ Form::submit('SAVE', ['class' => 'btn btn-success btn-block']) }}
					</div>
					<div class="col-md-4">
						<a href="{{ route('admins.showProfile') }}" class="btn btn-default btn-block">CANCEL</a>
					</div>
				</div>
			@endif

			</div>

		</fieldset>

	{!! Form::close() !!}

@else
	@include('partials._offlimits')
	
@endif

@endsection