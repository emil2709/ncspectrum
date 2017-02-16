@extends('main')

@section('title', '| Admin Login')


<div class="container col-md-8 col-md-offset-2">
	{!! Form::open(['class' => 'well form-horizontal']) !!}
		
		<fieldset>
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
		</fieldset>

	{!! Form::close() !!}
</div>