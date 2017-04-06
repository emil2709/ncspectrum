@extends('main_admin')

@section('title', '| History')

@section ('content')
  
  <h2 class="sub-header">Log</h2>

  <div class="table-responsive">
    <table class="table table-striped margin-top tablesorter" id="myTable">

      <thead>
        <tr>
          <th class="sortable-header">Type <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="not-sortable">Information</th>
          <th class="sortable-header">Time <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></th>
        </tr>
      </thead>

      <tbody> 
        @foreach($log as $entry)       
            <tr>
              <td> {{ strtoupper($entry->type) }} </td>
              <td> {{ $entry->information }} </td>
              <td> {{ date('j.m Y - H:i', strtotime($entry->created_at)) }} </td>
            </tr>
        @endforeach
      </tbody>

    </table>
  </div>

  <div>
    {{ $log->links() }}
  </div>

@endsection