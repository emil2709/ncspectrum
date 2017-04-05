@extends('main_admin')

@section('title', '| Guest Visits')

@section('content')

<h2 class="sub-header">{{ $user->firstname }} {{ $user->lastname }}</h2>

<div class="table-responsive">
	<table class="table table-striped margin-top" id="sortableTable">

		<thead>
			<tr>
			  <th>From</th>
			  <th>To</th>
			  <th>Employee<span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon" onclick="sortTable(0)"></th>
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