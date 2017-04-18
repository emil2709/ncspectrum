@extends('main_admin')

@section('title', '| Dashboard')

@section('content')

  <h2 class="sub-header">Dashboard</h2>
  <div class="row margin-top">
    <div class="col-xs-6 col-sm-2 placeholder">
      <span class="glyphicon glyphicon-user"></span>
      <h4>Guests</h4>
      <a href="{{route('admins.guests')}}">{{ $users }}</a>
    </div>

    <div class="col-xs-6 col-sm-2 placeholder">
      <span class="glyphicon glyphicon-th-list"></span>
      <h4>Employees</h4>
      <a href="{{route('admins.employees')}}">{{ $employees }}</a>
    </div>

    <div class="col-xs-6 col-sm-3 placeholder">
      <span class="glyphicon glyphicon-hand-up"></span>  
      <h4>Administrators</h4>
      <a href="{{route('admins.admins')}}">{{ $admins }}</a>
    </div>

    <div class="col-xs-6 col-sm-2 placeholder">
      <span class="glyphicon glyphicon-star-empty"></span>
      <h4>Visits</h4>
      <a href="{{route('admins.visits')}}">{{ $visits }}</a>
    </div>

    <div class="col-xs-6 col-sm-2 placeholder">
      <span class="glyphicon glyphicon-globe"></span>
      <h4>Log</h4>
      <a href="{{route('admins.log')}}">{{ $log }}</a>
    </div>
  </div>

  <!-- Highchart -->
  <div class="row margin-top">
    <div class="col-md-7 col-sm-1">
      <div id="container" style="height: 300px"></div>
    </div>

    <div class="col-md-3 col-sm-3" style="border:thin">
      <h4>Checked-in</h4>
      <table class="table margin-top tablesorter" id="myTable">
        @foreach ($statuses as $status)
          <tr>
            <td>{{ $status->firstname }}</td>
            <td>{{ $status->lastname }}</td>
          </tr>
        @endforeach
      </table>
      <a href="{{route('admins.status')}}" class="btn-xs btn-danger btn-block text-center">CHECK-OUT</a>
    </div>
  </div>

  <!-- JavaScript -->
  <script type="text/javascript">
    var users = {{ json_encode($users) }};
    var employees = {{ json_encode($employees) }};
    var admins = {{ json_encode($admins) }};
  </script>

@endsection