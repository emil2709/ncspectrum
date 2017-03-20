@extends('main_admin')

@section('title', '| History')

@section ('content')
  
  <h2 class="sub-header">History</h2>

  <div class="table-responsive">
    <table class="table table-striped margin-top">

      <thead>
        <tr>
          <th>Type</th>
          <th>Information</th>
          <th>Time</th>
        </tr>
      </thead>

      <tbody> 
        @foreach($history as $entry)       
            <tr>
              <td> {{ strtoupper($entry->type) }} </td>
              <td> {{ $entry->information }} </td>
              <td> {{ $entry->created_at }} </td>
            </tr>
        @endforeach
      </tbody>

    </table>

    <div>
      {{ $history->links() }}
    </div>

  </div>

@endsection