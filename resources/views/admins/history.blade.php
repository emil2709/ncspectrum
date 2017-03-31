@extends('main_admin')

@section('title', '| History')

@section ('content')
  
  <h2 class="sub-header">History</h2>

  <div class="table-responsive">
    <table class="table table-striped margin-top" id="sortableTable">

      <thead>
        <tr>
          <th onclick="sortTable(0)">Type</th>
          <th onclick="sortTable(1)">Information</th>
          <th onclick="sortTable(2)">Time</th>
        </tr>
      </thead>

      <tbody> 
        @foreach($history as $entry)       
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
    {{ $history->links() }}
  </div>

@endsection