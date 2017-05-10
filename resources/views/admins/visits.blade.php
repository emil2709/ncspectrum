@extends('main_admin')

@section('title', '| Visits')

@section('content')

<h2 class="sub-header">Visits</h2>

<div class="table-responsive">
  <table class="table table-striped margin-top tablesorter" id="myTable">

    <thead>
    	<tr>
    		<th class="sortable-header">From <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></th>
    		<th class="sortable-header">To <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></th>
    		<th class="sortable-header">Employee <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></th>
    		<th class="not-sortable">Guests </th>
    	</tr>
    </thead>

      <tbody>
        @foreach($visits as $visit)
        	<tr>
            <td>{{ date('j-m-Y - H:i', strtotime($visit->from)) }}</td>
            <td>{{ date('j-m-Y - H:i', strtotime($visit->to)) }}</td>
        		<td>{{ $visit->employee_firstname }} {{ $visit->employee_lastname }}</td>
            <td>
              <span class="faint-placeholder"><i>(View All Attending Guests)</i></span>
              <a class="pull-right guest-expansion-btn" title="View Guests">
                <span class="glyphicon glyphicon-menu-hamburger" id="visit-icon"></span>
              </a>
              <div class="guest-expansion">
                @foreach($visitguests[$visit->id] as $guests)
                  @foreach($guests as $guest)
                    {{$guest[0]->firstname}} {{$guest[0]->lastname}} <br/>
                  @endforeach
                @endforeach
              </div>
            </td>
        	</tr>
        @endforeach
      </tbody>

  </table>
</div>

<div>
  {{ $visits->links() }}
</div>

@endsection