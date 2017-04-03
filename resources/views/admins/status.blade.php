@extends('main_admin')

@section('title', '| Status')

@section ('content')

<h2 class="sub-header">Status</h2>

  <div class="table-responsive">
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
      		<th>Status</th>
      	</tr>
      </thead>
      <tbody id="searchresult">
      	<tr>
      	@foreach ($users as $user)
		    <td>{{ $user->firstname }} </td>
		    <td>{{ $user->lastname }}</td>
		    <td>
		        @if ($user->status)
		            {{ $user->status->status }}
		        @endif
    		</td>
		</tr>
@endforeach
      </tbody>

@endsection