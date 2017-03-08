@extends ('main_admin')

@section ('title', '| Log')

@section ('content')

<h1>Log</h1>
<table id="myTable" class="tablesorter">
	<thead>
		<tr>
			<th>Fistname</th>
			<th>Lastname</th>
			<th>Date</th>
			<th>From</th>
			<th>To</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			@foreach ($users as $user)
			@foreach ($user->visits as $visit)
			<td>{{ $user->firstname }}</td>
			<td>{{ $user->lastname }}</td>
			<td>{{ $visit->date }}</td>
			<td>{{ $visit->from }}</td>
			<td>{{ $visit->to }}</td>
		</tr>
		@endforeach
		@endforeach
	</tbody>
	
</table>

<script>
	$('#myTable').dataTable();
</script>


@endsection