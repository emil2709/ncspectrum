@extends('main_admin')

@section('title', '| Userlog')

@section('content')

<h1>{{ $users->firstname }} {{ $users->lastname }}</h1>

<table class="table table-striped">
	<thead>
		<tr>
			<th>From</th>
			<th>To</th>
			<th>Comment</th>
		</tr>
	</thead>
	<tbody class="searchresult">
		@foreach ($users->visits as $visit)
		<tr>
			<td>{{ $visit->created_at }}</td>
			<td>{{ $visit->updated_at }}</td>
		</tr>
		@endforeach
	</tbody>
	
</table>

@endsection