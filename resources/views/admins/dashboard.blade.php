@extends('main_admin')

@section('title', '| Dashboard')

@section('content')
  <h1 class="page-header">Dashboard</h1>

    <div class="col-xs-6 col-sm-3 placeholder">
      <span class="glyphicon glyphicon-user"></span>
      <h4>Registered users</h4>
      <a href="guests">{{ $users }}</a>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder">
    <span class="glyphicon glyphicon-th-list"></span>
      <h4>Registered employees</h4>
      <a href="guests">{{ $employees }}</a>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder">
    <span class="glyphicon glyphicon-star-empty"></span>
      <h4>Visits</h4>
      <a href="visits">{{ $visits }}</a>
    </div>
    <div class="col-xs-6 col-sm-3 placeholder">
    <span class="glyphicon glyphicon-globe"></span>
      <h4>Log </h4>
      <a href="log">{{ $log }}</a>
    </div>
  <!-- Highchart -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/highcharts-3d.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <div class="col-md-7 col-sm-1">
    <div id="container" style="height: 350px"></div>
  </div>

  <div class="col-md-4 col-sm-4" style="border:thin">
  <h4>Checked-in</h4>
  <table class="table margin-top tablesorter" id="myTable">
    @foreach ($statuses as $status)
    <tr>
      <td>{{ $status->firstname }}</td>
      <td>{{ $status->lastname }}</td>
    </tr>
    @endforeach
  </table>
  <a href="status"><button type="button" class="btn btn-primary">Edit</button></a>

  </div>



  

   


{{ Html::script('js/cake-highcharts.js') }}

@endsection