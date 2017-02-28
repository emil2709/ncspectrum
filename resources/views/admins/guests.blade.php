@extends('main_admin')

@section('title', '| Guests')

@section ('content')
  
  <h2 class="sub-header">Guests</h2>

  <div class="table-responsive">
    <table class="table table-striped">
        <div class="input-group custom-search-form margin-bottom">
          <input type="text" name="search" class="form-control" placeholder="Search ...">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default-sm">
              <i class="fa fa-search"></i>
            </button>
          </span>
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
        </tr>
      </thead>

      <tbody> 
        @foreach($guests as $guest)       
            <tr>
              <td> {{ $guest->firstname }} </td>
              <td> {{ $guest->lastname }} </td>
              <td> {{ $guest->phone }} </td>
              <td> {{ $guest->email }}</td>
              <td> {{ $guest->company }}</td>
              <td>
                <a href="{{{ URL::route('admins.editUser', [$guest->id]) }}}"><span class="glyphicon glyphicon-edit"></span></a>
              </td>
              <td>
                <a href="{{{ URL::route('admins.showUser', [$guest->id]) }}}"><span class="glyphicon glyphicon-trash"></span></a>
              </td>
            </tr>
        @endforeach
      </tbody>

    </table>
  </div>
  @foreach($guest->status as $status)
  <ul>
    <li>{{ $status->user_id }}</li>
  </ul>
  @endforeach


@endsection