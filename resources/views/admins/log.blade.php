@extends('main_admin')

@section('title', '| Log')

@section('content')

<h1>Log</h1>
<table class="table table-striped">
		<div class="input-group margin-bottom">        
	        <span class="input-group-addon" id="search-addon"><i class="glyphicon glyphicon-search"></i></span>
	        <input type="text" id="search" class="form-control" placeholder="Search ...">
	        <input type="hidden" id="type" value="guests">
      	</div>
	<thead>
		<tr>
			<th>Fistname</th>
			<th>Lastname</th>
			<th>From</th>
			<th>To</th>
			<th>Comment</th>
		</tr>
	</thead>
	<tbody id="searchresult">
		<tr>
			@foreach ($users as $user)
			@foreach ($user->visits as $visit)
			<td>{{ $user->firstname }}</td>
			<td>{{ $user->lastname }}</td>
			<td>{{ $visit->created_at }}</td>
			<td>{{ $visit->updated_at }}</td>
			<td>{{ $visit->comment }}</td>
		</tr>
		@endforeach
		@endforeach
	</tbody>
	
</table>

<script>
	$('#myTable').dataTable();
</script>


@endsection