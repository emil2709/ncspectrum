@extends('main_admin')

@section('title', '| Employees')

@section ('content')
  
  <h2 class="sub-header">Employees</h2>

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
        @foreach($employees as $employee)       
            <tr>
              <td> {{ $employee->firstname }} </td>
              <td> {{ $employee->lastname }} </td>
              <td> {{ $employee->phone }} </td>
              <td> {{ $employee->email }}</td>
              <td> {{ $employee->company }}</td>
              <td>
                <a href="{{ URL::route('admins.editUser', [$employee->id]) }}"><span class="glyphicon glyphicon-edit"></span></a>
              </td>
              <td>
                <a href="{{ URL::route('admins.showUser', [$employee->id]) }}"><span class="glyphicon glyphicon-trash"></span></a>
              </td>
            </tr>
        @endforeach
      </tbody>

    </table>
  </div>

@endsection