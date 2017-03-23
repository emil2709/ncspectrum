@extends('main_user')

@section('title', '| Visit')

@section('content')

	<div class="col-md-10 col-md-offset-1">
		{!! Form::open(['route' => 'users.storeVisit', 'class' => 'well form-horizontal margin-top', 'data-toggle' => 'validator']) !!}
			
			<fieldset>
				
				<legend class="text-center">VISIT</legend>

				<div class="row">
					<div class="row">
						@foreach($users as $user)
							<div class="col-md-12 text-center">
								<span id="names">{{$user->firstname}} {{$user->lastname}}</span>
								<span> - {{$user->company}}</span>
								{{ Form::hidden('users[]', $user->id) }}
							</div>
						@endforeach
					</div>
				</div>

				<hr/>

				<div class="form-group">
					<div class="col-md-3 control-label">
						{{ Form::label('employees', 'Who Are You Visiting?') }}
					</div>
					<div class="col-md-6 inputContainer">
						<select required class="form-control" name="employees">
							<option selected disabled>Choose here</option>
							@foreach($employees as $employee)
								<option value="{{$employee->id}}">{{$employee->firstname.' '.$employee->lastname}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<hr/>

				<div class="form-group btn-margin-top">
					<div class="col-md-4 col-md-offset-2">
						{{ Form::submit('CHECK IN', ['class' => 'btn btn-primary btn-block']) }}
					</div>
					<div class="col-md-4">
						<a href="{{ route('users.index') }}" class="btn btn-default btn-block">CANCEL</a>
					</div>
				</div>

			</fieldset>

		{!! Form::close() !!}
	</div>

@endsection