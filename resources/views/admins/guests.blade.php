@extends('main_admin')

@section('title', '| Guests')

@section ('content')
  
  <h2 class="sub-header">Guests</h2>

  <div class="table-responsive">
    <table class="table table-striped tablesorter" id="myTable">

      <div class="input-group margin-bottom">        
        <span class="input-group-addon" id="search-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search ...">
        <input type="hidden" id="type" value="guests">
      </div>

      <thead>
        <tr>
          <th class="sortable-header">Firstname <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="sortable-header">Lastname <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="sortable-header">Phone <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="sortable-header">Mail <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="sortable-header">Company <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="not-sortable"></th>
          <th class="not-sortable"></th>
          <th class="not-sortable"></th>
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