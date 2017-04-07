@extends('main_admin')

@section('title', '| Status')

@section ('content')

<h2 class="sub-header">Status</h2>

<div class="table-responsive">
  <table class="table table-striped margin-top" id="sortableTable">

    <thead>
    	<tr>
    		<th>
          Firstname<span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon" onclick="sortTable(0)"></span>
        </th>
        <th>
          Lastname<span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon" onclick="sortTable(1)"></span>
        </th>
        <th>Status</th>
        <th></th>
    	</tr>
    </thead>

    <tbody>
    	@foreach ($users as $user)
        <tr>
          <td>{{ $user->firstname }}</td>
          <td>{{ $user->lastname }}</td>
          <td>
            <span class="glyphicon glyphicon-ok" id="checkedin" title="Checked-in"></span>
          </td>
  		    <td>   
            <a href="{{ URL::route('admins.checkout', [$user->id]) }}" title="Check-out Guest">
              <button class="btn btn-xs btn-danger btn-block">
                CHECK-OUT <span class="glyphicon glyphicon-log-out" id="checkout"></span>
              </button>
            </a>
  		    </td>
        </tr>
        @endforeach
    </tbody>

  </table>
</div>

@endsection