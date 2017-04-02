@extends('main_admin')

@section('title', '| History')

@section ('content')
  
  <h2 class="sub-header">Log</h2>

  <div class="table-responsive">
    <table class="table table-striped margin-top" id="sortableTable">

      <thead>
        <tr>
          <th onclick="sortTable(0)"> Type<span class="glyphicon glyphicon-sort"></span> </th>
          <th>Information</th>
          <th>Time</th>
        </tr>
      </thead>

      <tbody> 
        @foreach($log as $entry)       
            <tr>
              <td> {{ strtoupper($entry->type) }} </td>
              <td> {{ $entry->information }} </td>
              <td> {{ date('H:i - j.m Y', strtotime($entry->created_at)) }} </td>
            </tr>
        @endforeach
      </tbody>

    </table>
  </div>

  <div>
    {{ $log->links() }}
  </div>

@endsection