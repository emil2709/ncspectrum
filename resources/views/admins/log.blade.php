@extends ('main_admin')

@section ('title', '| Log')

@section ('content')

<h1>Velkommen til Log</h1>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Fistname</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		{{--@foreach ($users as $user)
			<tr>
				<td>{{ $user->firstname }}</td>

		@endforeach--}}
			@foreach ($users->visits as $visit)
				<td>{{ $visit->date }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

@endsection