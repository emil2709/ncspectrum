@extends('main_admin')

@section('title', '| Delete Administrator')

@section('content')

@if(Auth::user()->id == 1 || Auth::user()->id == $admin->id)
	<div class="col-md-10 col-md-offset-1 panel-group">
		<div class="panel panel-danger margin-top">

			<div class="panel-heading">
				<strong>DELETE CONFIRMATION</strong>
			</div>

			<div class="panel-body">
				{!! Form::open(['route' => ['admins.destroyAdmin', $admin->id], 
					'method' => 'POST', 'data-toggle' => 'validator']) !!}
					<div class="row">
						<h4 class="text-center">Are you sure?</h4>
						<hr/>
						<div class="cold-md-10 col-md-offset-1">
							<div class="col-md-12">
								<strong>{{$admin->firstname}} {{$admin->lastname}}</strong>
							</div>
							<div class="col-md-12 margin-bottom">
								<strong>{{$admin->email}}</strong>
							</div>
							<div class="form-group has-feedback">
								<div class="col-md-12 control-label">
									{{ Form::label('password', 'Confirm deletion by entering your password:') }}
								</div>
								<div class="col-md-9 inputContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
										{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'System Administrator Password ...', 'required', 'minlength="6"', 'maxlength="60"', 
											'pattern="^[A-ZÆØÅa-zæøå0-9 \-._]{6,60}$"']) }}
									</div>
									<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								</div>
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>

					<hr/>

					<div class="row">
						<div class="col-md-6">
		                  		{!! Form::submit('DELETE', ['class' => 'btn btn-danger btn-block']) !!}
		                </div>
						<div class="col-md-6">
							<a href="{{ route('admins.admins') }}" class="btn btn-default btn-block">CANCEL</a>
						</div>
					</div>
				{!! Form::close() !!}
			</div>

		</div>
	</div>

@else
	@include('partials._offlimits')

@endif

@endsection