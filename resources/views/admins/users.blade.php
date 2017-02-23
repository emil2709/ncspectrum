@extends('main_admin')

@section('title', '| Users')

@section ('content')
  
  <h2 class="sub-header">Visits</h2>

  <div class="table-responsive">
    <table class="table table-striped">
        <div class="input-group custom-search-form">
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
        </tr>
      </thead>

      <tbody> 
        @foreach ($users as $user)       
            <tr>
              <td> {{ $user->firstname }} </td>
              <td> {{ $user->lastname }} </td>
              <td> {{ $user->phone }} </td>
              <td> {{ $user->email }}</td>
              <td> {{ $user->company }}</td>
              <td>
                {!! Html::linkRoute('admins.editUser', 'EDIT', [$user->id], ['class' => 'btn btn-primary btn-block']) !!}
              </td>
              <td>
                {!! Form::open(['route' => ['admins.destroyUser', $user->id], 'method' => 'DELETE']) !!}
                  {!! Form::submit('DELETE', ['class' => 'btn btn-danger btn-block']) !!}
                {!! Form::close() !!}
              </td>
            </tr>
        @endforeach
      </tbody>

    </table>
  </div>

@endsection