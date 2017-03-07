@extends ('main_admin')

@section ('title', '| Log')

@section ('content')
<head>

<!-- Viktig for datatable-->
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.13/datatables.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.13/b-1.2.4/b-html5-1.2.4/fh-3.1.2/r-2.1.1/se-1.2.0/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.13/b-1.2.4/b-html5-1.2.4/fh-3.1.2/r-2.1.1/se-1.2.0/datatables.min.js"></script>

</head>


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