@extends('main_admin')

@section('title', '| Guests')

@section ('content')
  
  <h2 class="sub-header">Guests</h2>

  <div class="table-responsive">
    <table class="table table-striped">

      <div class="input-group margin-bottom">        
        <span class="input-group-addon" id="search-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search ...">
        <input type="hidden" id="type" value="guests">
      </div>

      <thead>
        <tr>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Phone</th>
          <th>Mail</th>
          <th>Company</th>
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
              <a href="{{ URL::route('admins.editUser', [$guest->id]) }}" title="Edit">
                <span class="glyphicon glyphicon-edit"></span>
              </a>
            </td>
            <td>
              <a href="{{ URL::route('admins.userlog', [$guest->id]) }}" title="Log">
                <span class="glyphicon glyphicon-th-list"></span>
              </a>
            </td>
            <td>
              <a href="{{ URL::route('admins.showUser', [$guest->id]) }}" title="Delete">
                <span class="glyphicon glyphicon-trash"></span>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection