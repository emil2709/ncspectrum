@extends('main_admin')

@section('title', '| History')

@section ('content')
  
  <h2 class="sub-header">History</h2>

  <div class="table-responsive">
    <table class="table table-striped">

      <div class="input-group margin-bottom">        
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search ...">
        <input type="hidden" id="type" value="employees">
      </div>

      <thead>
        <tr>
          <th>Type</th>
          <th>Information</th>
          <th>Time</th>
        </tr>
      </thead>

      <tbody id="searchresult"> 
        @foreach($history as $entry)       
            <tr>
              <td> {{ strtoupper($entry->type) }} </td>
              <td> {{ $entry->information }} </td>
              <td> {{ $entry->created_at }} </td>
            </tr>
        @endforeach
      </tbody>

    </table>
  </div>

@endsection