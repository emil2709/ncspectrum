@extends('main_admin')

@section('title', '| Dashboard')

@section('content')

          <h1 class="page-header">Dashboard</h1>


           <!-- Her får vi bestemme om vi ønser placeholders eller ikke? kanskje her vi kan legge noen diagrammer? -->
          <div class="row placeholders">
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
          </div>
          <!-- Highchart -->
          <script src="https://code.highcharts.com/highcharts.js"></script>
          <script src="https://code.highcharts.com/highcharts-3d.js"></script>
          <script src="https://code.highcharts.com/modules/exporting.js"></script>

          <div id="container" style="height: 400px"></div>
        
      </div>
    </div>

<script>
      Highcharts.chart('container', {
      //var php_users = {{ $users }}
      chart: {
          type: 'pie',
          options3d: {
              enabled: true,
              alpha: 45
          }
      },
      title: {
          text: 'Contents of Highsoft\'s weekly fruit delivery'
      },
      subtitle: {
          text: '3D donut in Highcharts'
      },
      plotOptions: {
          pie: {
              innerSize: 100,
              depth: 45
          }
      },
      series: [{
          name: 'Amount',
          data: [
              ['Users', 2],
              ['Employees', 3],
          ]
      }]
  });
</script>

@endsection