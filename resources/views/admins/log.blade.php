@extends('main_admin')

@section('title', '| History')

@section ('content')
  
  <h2 class="sub-header">Log</h2>

  <div class="table-responsive">
    <table class="table table-striped margin-top" id="sortableTable">

      <thead>
        <tr>
          <th>Type<span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon" onclick="sortTable(0)"></span></th>
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