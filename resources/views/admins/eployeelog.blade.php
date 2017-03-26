@extends('main_admin')

@section('title', '| Employee Log')

@section('content')

<h1>Employee Log</h1>
<table class="table table-striped">
		<div class="input-group margin-bottom">        
	        <span class="input-group-addon" id="search-addon"><i class="glyphicon glyphicon-search"></i></span>
	        <input type="text" id="search" class="form-control" placeholder="Search ...">
	        <input type="hidden" id="type" value="guests">
      	</div>
	<thead>
		<tr>
			<th>Firstname</th>
			<th>Lastname</th>
			<th>Comment</th>
			<th>From</th>
			<th>To</th>
		</tr>
	</thead>
	<tbody class="searchresult">
		<tr>
			@foreach ($visits as $visit)
			<td>{{ $visit->employee_firstname }}</td>
			<td>{{ $visit->employee_lastname }}</td>
			<td>{{ $visit->comment }}</td>
			<td>{{ $visit->from }}</td>
			<td>{{ $visit->to }}</td>
		</tr>
		@endforeach
	</tbody>

@endsection