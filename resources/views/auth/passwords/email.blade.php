@extends('main_user')

@section('title', '| Passwordreset Request')

@section('content')
	
	<div class="col-md-10 col-md-offset-1">

		@if(session('status'))
			<div class="alert alert-success alert-margin-top" role="alert">
				<strong>Success! </strong> <br/> {{ session('status') }}
			</div>
		@endif

		{!! Form::open(['url' => 'password/email', 'method' => 'POST', 'class' => 'well form-horizontal margin-top', 
			'data-toggle' => 'validator']) !!}
			
			<fieldset>
				
				<legend class="text-center">Send Reset Request</legend>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-3 inputContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							{{ Form::email('email', null, ['class' => 'form-control', 
								'placeholder' => 'Enter Email Address here ...',
								'required', 'pattern="^[A-ZÆØÅa-zæøå0-9._-]+@[A-ZÆØÅa-zæøå0-9.-]+\.[A-ZÆØÅa-zæøå]{2,}$"']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						{{ Form::submit('SEND', ['class' => 'btn btn-primary btn-block']) }}
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
		
	</div>

@endsection