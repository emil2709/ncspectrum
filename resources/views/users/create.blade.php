@extends('main_user')

@section('title', '| Create new user')

@section('content')

	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-primary margin-top">

			<div class="panel panel-heading text-center">
				<div class="panel-title">CREATE NEW USER</div>
			</div>

			<div class="panel panel-body">
				<div class="col-md-12">
					{!! Form::open(['route' => 'users.store']) !!}
						
						<div class="form-group">
							{{ Form::label('firstname', 'First Name:') }}
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								{{ Form::text('firstname', null, ['class' => 'form-control', 
									'placeholder' => 'Enter First Name here...']) }}
							</div>
						</div>
	
						<div class="form-group">
							{{ Form::label('lastname', 'Last Name:') }}
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								{{ Form::text('lastname', null, ['class' => 'form-control', 
									'placeholder' => 'Enter Last Name here...']) }}
							</div>
						</div>
						
						<div class="form-group">
							{{ Form::label('phone', 'Phone:') }}
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
								{{ Form::text('phone', null, ['class' => 'form-control', 
									'placeholder' => 'Enter Phone Number here...']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('email', 'E-Mail:') }}
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								{{ Form::text('email', null, ['class' => 'form-control', 
									'placeholder' => 'Enter E-Mail Address here...']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('company', 'Company:') }}
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
								{{ Form::text('company', null, ['class' => 'form-control', 
									'placeholder' => 'Enter Company Name here...']) }}
							</div>
						</div>

						<div class="form-group">
							<div class="btn-margin-top">
								<div class="row">
									<div class="col-md-5 col-md-offset-1">
										{{ Form::submit('CREATE', ['class' => 'btn btn-success btn-block']) }}
									</div>
									<div class="col-md-5">
										<a href="{{ route('users.index') }}" class="btn btn-default btn-block">CANCEL</a>
									</div>
								</div>
							</div>
						</div>

					{!! Form::close() !!}
				</div>
			</div>

		</div>
	</div>

@endsection
