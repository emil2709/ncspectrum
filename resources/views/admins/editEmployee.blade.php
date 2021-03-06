@extends('main_admin')

@section('title', '| Edit Employee')

@section('content')

	<h2 class="sub-header text-center">Edit Employee</h2>
	{!! Form::model($employee, ['route' => ['admins.updateEmployee', $employee->id], 'method' => 'PUT', 
		'data-toggle' => 'validator', 'class' => 'form-horizontal margin-top']) !!}
		
		<fieldset>

			<div class="form-group has-feedback">
				<div class="col-md-3 control-label">
					{{ Form::label('firstname', 'First Name:') }}
				</div>
				<div class="col-md-6 inputContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						{{ Form::text('firstname', null, ['class' => 'form-control',
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
						{{ Form::text('lastname', null, ['class' => 'form-control',
							'required', 'minlength="2"', 'maxlength="30"', 'pattern="^[A-Za-z \-]{2,30}$"']) }}
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
							'required', 'pattern="^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"']) }}
					</div>
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
					{!! Html::linkRoute('admins.deleteEmployee', 'DELETE', [$employee->id], ['class' => 'btn btn-danger btn-block']) 
					!!}
            	</div>
				<div class="col-md-4">
					<a href="{{ route('admins.employees') }}" class="btn btn-default btn-block">CANCEL</a>
				</div>
			</div>

		</fieldset>

	{!! Form::close() !!}

@endsection