@extends('main_admin')

@section('title', '| Status')

@section ('content')

<h2 class="sub-header">Status</h2>

<div class="table-responsive">
  <table class="table table-striped margin-top tablesorter" id="myTable">

    <thead>
    	<tr>
    		<th class="sortable-header"> 
          Firstname <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span>
        </th>
        <th class="sortable-header">
          Lastname <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span>
        </th>
        <th class="sortable-header">
          Company <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span>
        </th>
        <th class="not-sortable">Status</th>
        <th class="not-sortable"></th>
    	</tr>
    </thead>

    <tbody>
    	@foreach($users as $user)
        <tr>
          <td>{{ $user->firstname }}</td>
          <td>{{ $user->lastname }}</td>
          <td>{{ $user->company }}</td>
          <td>
            <span class="glyphicon glyphicon-ok" id="checkedin" title="Checked-in"></span>
          </td>
  		    <td>   
            <a href="{{ URL::route('admins.checkout', [$user->id]) }}" title="Check-out Guest">
              <button class="btn btn-xs btn-danger btn-block">
                CHECK-OUT
              </button>
            </a>
  		    </td>
        </tr>
      @endforeach
    </tbody>

  </table>
</div>

@endsection