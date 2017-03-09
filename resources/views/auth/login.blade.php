@extends('main_user')

@section('title', '| Admin Login')

@section('content')
	
	<div class="col-md-8 col-md-offset-2">
		{!! Form::open(['method' => 'POST', 'class' => 'well form-horizontal margin-top']) !!}
			
			<fieldset>
				
				<legend class="text-center">ADMIN LOGIN</legend>

				<div class="form-group">
					<div class="col-md-2 col-md-offset-1 control-label">
						{{ Form::label('email', 'Email:') }}
					</div>
					<div class="col-md-6 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							{{ Form::email('email', null, ['class' => 'form-control', 
								'placeholder' => 'Enter Email Address here ...']) }}
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
								'placeholder' => 'Enter Password here ...']) }}
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
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
	</div>

@endsection