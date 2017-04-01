@extends('main_admin')

@section('title', '| Visits')

@section('content')

<h2 class="sub-header">Visits</h2>

<div class="table-responsive">
    <table class="table table-striped">

      <div class="input-group margin-bottom">        
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search ...">
        <input type="hidden" id="type" value="employees">
      </div>

      <thead>
		<tr>
			<th>Employee</th>
			<th>From</th>
			<th>To</th>
			<th>Created At</th>
			<th>Updated At</th>
		</tr>
      </thead>
      <tbody id="searchresult">
      	<tr>
      		@foreach($visits as $visit)
      		<td>{{ $visit->employee_firstname }} {{ $visit->employee_lastname }}</td>
      		<td>{{ $visit->from }}</td>
      		<td>{{ $visit->to }}</td>
      		<td>{{ $visit->created_at }}</td>
      		<td>{{ $visit->updated_at }}</td>
      	</tr>
      	@endforeach
      </tbody>

@endsection