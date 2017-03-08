@extends('main_user')

@section('title', '| Admin Login')

@section('content')
	
	<div class="col-md-8 col-md-offset-2">
		{!! Form::open(['method' => 'GET', 'class' => 'well form-horizontal margin-top']) !!}
			
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
					<div class="col-md-2 col-md-offset-1">
						{{ Form::label('remember', 'Remember me:') }}
					</div>
					<div class="col-md-6">
							{{ Form::checkbox('remember') }}
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