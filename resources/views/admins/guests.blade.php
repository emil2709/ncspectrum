@extends('main_admin')

@section('title', '| Guests')

@section ('content')
  
  <h2 class="sub-header">Guests</h2>

  <div class="table-responsive">
    <table class="table table-striped" id="sortableTable">

      <div class="input-group margin-bottom">        
        <span class="input-group-addon" id="search-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search ...">
        <input type="hidden" id="type" value="guests">
      </div>

      <thead>
        <tr>
          <th>Firstname<span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon" onclick="sortTable(0)"></span></th>
          <th>Lastname<span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon" onclick="sortTable(1)"></span></th>
          <th>Phone<span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon" onclick="sortTable(2)"></span></th>
          <th>Mail<span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon" onclick="sortTable(3)"></span></th>
          <th>Company<span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon" onclick="sortTable(4)"></span></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>

      <tbody id="searchresult"> 
        @foreach($guests as $guest)       
          <tr>
            <td> {{ $guest->firstname }} </td>
            <td> {{ $guest->lastname }} </td>
            <td> {{ $guest->phone }} </td>
            <td> {{ $guest->email }}</td>
            <td> {{ $guest->company }}</td>
            <td>
              <a href="{{ URL::route('admins.editGuest', [$guest->id]) }}" title="Edit">
                <span class="glyphicon glyphicon-edit"></span>
              </a>
            </td>
            <td>
              <a href="{{ URL::route('admins.guestvisits', [$guest->id]) }}" title="Guest Visits">
                <span class="glyphicon glyphicon-th-list"></span>
              </a>
            </td>
            <td>
              <a href="{{ URL::route('admins.deleteGuest', [$guest->id]) }}" title="Delete">
                <span class="glyphicon glyphicon-trash"></span>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  
  <div>
    {{ $guests->links() }}
  </div>

@endsection