@extends ('main_admin')

@section ('title', '| Loguser')

@section ('content')

<h1>{{ $users->firstname }} {{ $users->lastname }}</h1>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Date</th>
			<th>From</th>
			<th>To</th>
			<th>Comment</th>
		</tr>
	</thead>
	<tbody class="searchresult">
		@foreach ($users->visits as $visit)
		<tr>
			<td>{{ $visit->date }}</td>
			<td>{{ $visit->from }}</td>
			<td>{{ $visit->created_at }}</td>
			<td>{{ $visit->updated_at }}</td>
		</tr>
		@endforeach
	</tbody>
	
</table>

@endsection