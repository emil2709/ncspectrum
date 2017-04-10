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
        
      </div>
    </div>

@endsection