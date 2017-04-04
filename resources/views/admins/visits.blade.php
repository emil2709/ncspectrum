@extends('main_admin')

@section('title', '| Visits')

@section('content')

<h2 class="sub-header">Visits</h2>

<div class="table-responsive">
  <table class="table table-striped margin-top">

    <thead>
    	<tr>
    		<th>From</th>
    		<th>To</th>
    		<th>Employee</th>
    		<th>Guests</th>
    	</tr>
    </thead>

      <tbody>
        @foreach($visits as $visit)
        	<tr>
            <td>{{ date('H:i - j.m Y', strtotime($visit->from)) }}</td>
            <td>{{ date('H:i - j.m Y', strtotime($visit->to)) }}</td>
        		<td>{{ $visit->employee_firstname }} {{ $visit->employee_lastname }}</td>
            <td>
              <span class="faint-placeholder"><i>(View All Attending Guests)</i></span>
              <a class="pull-right guest-expansion-btn" title="View Guests">
                <span class="glyphicon glyphicon-menu-hamburger" id="expansion-icon"></span>
              </a>
              <p class="guest-expansion">
                @foreach($visitguests[$visit->id] as $guests)
                  @foreach($guests as $guest)
                    {{$guest[0]->firstname}} {{$guest[0]->lastname}}<br/>
                  @endforeach
                @endforeach
              </p>
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