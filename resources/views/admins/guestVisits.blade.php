@extends('main_admin')

@section('title', '| Guest Visits')

@section('content')

<h2 class="sub-header">{{ $user->firstname }} {{ $user->lastname }}</h2>

<div class="table-responsive">
	<table class="table table-striped margin-top">

		<thead>
			<tr>
			  <th>From</th>
			  <th>To</th>
			  <th>Employee</th>
			</tr>
		</thead>

		<tbody> 
			@foreach ($visits as $visit)
			<tr>
				<td>{{ date('H:i - j.m Y', strtotime($visit->from)) }}</td>
				<td>{{ date('H:i - j.m Y', strtotime($visit->to)) }}</td>
				<td>{{ $visit->employee_firstname }}  {{$visit->employee_lastname}} </td>
			</tr>
			@endforeach
		</tbody>

	</table>
</div>

<div>
    {{ $visits->links() }}
</div>

@endsection