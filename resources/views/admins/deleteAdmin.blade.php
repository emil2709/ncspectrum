@extends('main_admin')

@section('title', '| Delete Administrator')

@section('content')

@if(Auth::user()->id == 1 && $admin->id != 1)
	<div class="col-md-10 col-md-offset-1 panel-group">
		<div class="panel panel-danger margin-top">

			<div class="panel-heading">
				<strong>DELETE CONFIRMATION</strong>
			</div>

			<div class="panel-body">
				{!! Form::open(['route' => ['admins.destroyAdmin', $admin->id], 
					'method' => 'POST', 'data-toggle' => 'validator']) !!}
					<div class="row">
						<h3 class="text-center">Are you sure?</h3>
						<hr/>
						<div class="cold-md-10 col-md-offset-1">
							<div>
								<div class="col-md-1">
									<span><i class="glyphicon glyphicon-user delete-icon"></i></span>
								</div>
								<div class="col-md-11">
									{{$admin->firstname}} {{$admin->lastname}}
								</div>
							</div>
							<div>
								<div class="col-md-1">
									<span><i class="glyphicon glyphicon-envelope delete-icon"></i></span>
								</div>
								<div class="col-md-11 margin-bottom">
									{{$admin->email}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12 control-label">
									{{ Form::label('password', 'Confirm deletion by entering your password:') }}
								</div>
								<div class="col-md-9 inputContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
										{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'System Administrator Password ...', 'required', 'minlength="6"', 'maxlength="60"', 
											'pattern="^[A-Za-z0-9 \-._]{6,60}$"']) }}
									</div>
								</div>
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