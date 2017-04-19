@extends('main_admin')

@section('title', '| Guest Visits')

@section('content')

<h2 class="sub-header">{{ $guest->firstname }} {{ $guest->lastname }}</h2>

<div class="table-responsive">
	<table class="table table-striped margin-top tablesorter" id="myTable">

		<thead>
			<tr>
			  <th class="sortable-header">From <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></th>
			  <th class="sortable-header">To <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></th>
			  <th class="sortable-header">Employee <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></th>
			</tr>
		</thead>

		<tbody> 
			@foreach ($visits as $visit)
				<tr>
					<td>{{ date('j.m Y - H:i', strtotime($visit->from)) }}</td>
					<td>{{ date('j.m Y - H:i', strtotime($visit->to)) }}</td>
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