@extends('main_admin')

@section('title', '| Employee Visits')

@section('content')

<h2 class="sub-header">{{ $employee->firstname }} {{ $employee->lastname }}</h2>

<div class="table-responsive">
	<table class="table table-striped margin-top">

		<thead>
			<tr>
			  <th>From</th>
			  <th>To</th>
			  <th width="300px">Guests</th>
			</tr>
		</thead>
		
		<tbody> 
			@foreach ($visits as $visit)
			<tr>
				<td>{{ date('H:i - j.m Y', strtotime($visit->from)) }}</td>
				<td>{{ date('H:i - j.m Y', strtotime($visit->to)) }}</td>
				<td>
					<span class="faint-placeholder"><i>(View All Attending Guests)</i></span>
					<a class="pull-right guest-expansion-btn" title="View Guests">
						<span class="glyphicon glyphicon-menu-hamburger"></span>
					</a>
					<p class="guest-expansion">
						@foreach($visitguests[$visit->id] as $guests)
							@foreach($guests as $guest)
								{{$guest[0]->firstname}} {{$guest[0]->lastname}}<br/>
							@endforeach
						@endforeach
					</p>
				</td>
			</tr>
			@endforeach
		</tbody>

	</table>
</div>

@endsection