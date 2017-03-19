@extends('main_admin')

@section('title', '| Delete Employee')

@section('content')

	<div class="col-md-6 col-md-offset-3">
		<div class="col-md-12 panel-group">
			<div class="panel panel-danger margin-top">

				<div class="panel-heading">
					<strong>DELETE CONFIRMATION</strong>
				</div>

				<div class="panel-body">

					<div class="row">
						<h4 class="text-center">Are you sure?</h4>
						<hr/>
						<div class="cold-md-10 col-md-offset-1">
							<div class="col-md-2">
								<span><i class="glyphicon glyphicon-user"><strong>:</strong></i></span>
							</div>
							<div class="col-md-10">
								<strong>{{$employee->firstname}} {{$employee->lastname}}</strong>
							</div>
							<div class="col-md-2">
								<span><i class="glyphicon glyphicon-phone"><strong>:</strong></i></span>
							</div>
							<div class="col-md-10">
								<strong>{{$employee->phone}}</strong>
							</div>
							<div class="col-md-2">
								<span><i class="glyphicon glyphicon-envelope"><strong>:</strong></i></span>
							</div>
							<div class="col-md-10">
								<strong>{{$employee->email}}</strong>
							</div>
							<div class="col-md-2">
								<span><i class="glyphicon glyphicon-home"><strong>:</strong></i></span>
							</div>
							<div class="col-md-10">
								<strong>{{$employee->company}}</strong>
							</div>
						</div>
					</div>

					<hr/>

					<div class="row">
						<div class="col-md-6">
							{!! Form::open(['route' => ['admins.destroyEmployee', $employee->id], 'method' => 'DELETE']) !!}
		                  		{!! Form::submit('DELETE', ['class' => 'btn btn-danger btn-block']) !!}
		               		{!! Form::close() !!}
		                </div>
						<div class="col-md-6">
							<a href="{{ route('admins.employees') }}" class="btn btn-default btn-block">CANCEL</a>
						</div>
					</div>

				</div>


			</div>
		</div>
	</div>

@endsection