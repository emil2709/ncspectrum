@extends('main_admin')

@section('title', '| Delete')

@section('content')

	<div class="col-md-6 col-md-offset-3">
		<div class="com-md-12 panel-group">
			<div class="panel panel-danger margin-top">

				<div class="panel-heading">
					<strong>CONFIRM DELETION</strong>
				</div>

				<div class="panel-body">
					<table>
						<tr>
							<td>
								<span><i class="glyphicon glyphicon-user"><strong>:</strong></i></span>
								<strong>{{$user->firstname}} {{$user->lastname}}</strong>
							</td>
						</tr>
						<tr>
							<td>
								<span><i class="glyphicon glyphicon-phone"><strong>:</strong></i></span>
								<strong>{{$user->phone}}</strong>
							</td>
						</tr>
						<tr>
							<td>
								<span><i class="glyphicon glyphicon-envelope"><strong>:</strong></i></span>
								<strong>{{$user->email}}</strong>
							</td>
						</tr>
						<tr>
							<td>
								<span><i class="glyphicon glyphicon-home"><strong>:</strong></i></span>
								<strong>{{$user->company}}</strong>
							</td>
						</tr>
					</table>
					<hr/>
					<div>
						<div class="col-md-6">
							{!! Form::open(['route' => ['admins.destroyUser', $user->id], 'method' => 'DELETE']) !!}
		                  		{!! Form::submit('DELETE', ['class' => 'btn btn-danger btn-block']) !!}
		               		{!! Form::close() !!}
		                </div>
		                @if($user->company != 'ncspectrum')
							<div class="col-md-6">
								<a href="{{ route('admins.guests') }}" class="btn btn-default btn-block">CANCEL</a>
							</div>
						@else
							<div class="col-md-6">
								<a href="{{ route('admins.employees') }}" class="btn btn-default btn-block">CANCEL</a>
							</div>
						@endif
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection