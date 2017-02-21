@extends('main_user')

@section('title', '| Overview')

@section('content')
	
	<div class="container">

		<div class="margin-top" id="welcome">
			<h1 class="text-center">Overview</h1>
		</div>

		<hr>

		<div class="col-md-8 col-md-offset-2">

			@foreach($users as $user)
			<div class="accordion margin-top">
				<h3> {{$user->firstname}}{{$user->lastename}} </h3>
				<div class="div">
					<div class="col-md-7">
						<div class="col-md-12 form-group">
							<label>Fullname: </label>
							{{$user->firstname}}
							{{$user->lastname}}
						</div>
						<div class="col-md-12 form-group">
							<label>Phone: </label>
							{{$user->phone}}
						</div>
						<div class="col-md-12 form-group">
							<label>Email: </label>
							{{$user->email}}
						</div>
						<div class="col-md-12 form-group">
							<label>Company: </label>
							{{$user->company}}
						</div>
					</div>
					<div class="well col-md-5">
						{!! Html::linkRoute('admins.edit', 'EDIT', [$user->uid], ['class' => 'btn btn-primary btn-block']) !!}
						<a href="#" class="btn btn-danger btn-block">DELETE</a>
					</div>
				</div>
			</div>
			@endforeach

			<div class="text-center">
				<a href="{{ route('users.wip') }}" class="btn btn-default btn-block">BACK TO HOME</a>
			</div>

		</div>

	</div>

@endsection