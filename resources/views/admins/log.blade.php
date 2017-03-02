@extends ('main_admin')

@section ('title', '| Log')

@section ('content')

<h1>Velkommen til Log</h1>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Fistname</th>
			<th>Lastname</th>
			<th>Company</th>
			<th>Date</th>
			<th>From</th>
			<th>To</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
			@foreach ($user->visits as $visit)
			<tr>
				<td>{{ $user->firstname }}</td>
				<td>{{ $user->lastname }}</td>
				<td>{{ $user->company }}</td>
				<td>{{ $visit->date }}</td>
				<td>{{ $visit->from }}</td>
				<td>{{ $visit->to }}</td>
			</tr>
			@endforeach
		@endforeach
	</tbody>
</table>

@endsection