@extends('main_admin')

@section('title', '| Dashboard')

@section('content')

  <h2 class="sub-header">Dashboard</h2>
  <div class="row margin-top">
    <div class="col-xs-6 col-sm-2 placeholder">
      <h4>Guests</h4>
      <span class="glyphicon glyphicon-user"></span>
      <a href="{{route('admins.guests')}}" class="pull-right" id="action-icons">{{ $guests }}</a>
    </div>

    <div class="col-xs-6 col-sm-2 placeholder">
      <h4>Employees</h4>
      <span class="glyphicon glyphicon-briefcase"></span>
      <a href="{{route('admins.employees')}}" class="pull-right" id="action-icons">{{ $employees }}</a>
    </div>

    <div class="col-xs-6 col-sm-2 placeholder">  
      <h4>Administrators</h4>
      <span class="glyphicon glyphicon-star-empty"></span>
      <a href="{{route('admins.admins')}}" class="pull-right" id="action-icons">{{ $admins }}</a>
    </div>

    <div class="col-xs-6 col-sm-2 placeholder">
      <h4>Visits</h4>
      <span class="glyphicon glyphicon-home"></span>
      <a href="{{route('admins.visits')}}" class="pull-right" id="action-icons">{{ $visits }}</a>
    </div>

    <div class="col-xs-6 col-sm-2 placeholder">
      <h4>Log entries</h4>
      <span class="glyphicon glyphicon-list-alt"></span>
      <a href="{{route('admins.log')}}" class="pull-right" id="action-icons">{{ $log }}</a>
    </div>

    <div class="col-xs-6 col-sm-2 placeholder">
      <h4>Latest Visit</h4>
      {{ date('j-m-Y - H:i', strtotime($latestVisit)) }}</a>
    </div>
  </div>

  <!-- Highchart -->
  <div class="row margin-top">
    <div class="col-md-7 col-sm-1">
      <div id="piechart" style="height: 330px"></div>
    </div>

    <div class="col-md-5 col-sm-3 text-center" style="border:thin">
      <caption class="text-center"><h4>Checked-In Guests</h4></caption>
      <table class="table" id="dashboard-status">
        @foreach ($invisit as $visitor)
          <tr>
            <td><div class="pull-left">{{ $visitor->firstname }} {{ $visitor->lastname }}</div></td>
            <td><div class="pull-left" id="td-guest">{{ $visitor->company }}</div></td>
          </tr>
        @endforeach
      </table>
      <a href="{{route('admins.status')}}" class="btn-xs btn-danger btn-block text-center">CHECK-OUT</a>
    </div>
  </div>

  <!-- JavaScript -->
  <script type="text/javascript">
    var guests = {{ json_encode($guests) }};
    var employees = {{ json_encode($employees) }};
    var admins = {{ json_encode($admins) }};
  </script>

@endsection