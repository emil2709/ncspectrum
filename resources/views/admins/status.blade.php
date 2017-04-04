@extends('main_admin')

@section('title', '| Status')

@section ('content')


<h2 class="sub-header">Status</h2>

  <div class="table-responsive">
    <table class="table table-striped">

      <thead>
      	<tr>
      		<th onclick="sort_table(people, 0, asc1); asc1 *= -1; asc2 = 1; asc3 = 1;">Firstname
      		<span class="glyphicon glyphicon-arrow-down"></span></th>
            <th onclick="sort_table(people, 1, asc2); asc2 *= -1; asc3 = 1; asc1 = 1;">Lastname
            <span class="glyphicon glyphicon-arrow-down"></span></th>
            <th onclick="sort_table(people, 2, asc3); asc3 *= -1; asc1 = 1; asc2 = 1;">Status
            <span class="glyphicon glyphicon-arrow-down"></span></th>
            <th>Change</th>
      	</tr>
      </thead>
      <tbody id="people">
      	<tr>
        
      	@foreach ($users as $user)
		    <td>{{ $user->firstname }} </td>
		    <td>{{ $user->lastname }}</td>
		    <td>
		        @if ($user->status)
					{{ $user->status->status }}
		        @endif
    		</td>
    		<td>
          @if ($user->status->status === 1)
            <a href="{{ URL::route('admins.checkOut', [$user->id]) }}" title="Change Status">
                <button class="btn btn-primary">Change status</button>
            </a>
          @endif
          
    		</td>
		</tr>
@endforeach
      </tbody>

@endsection