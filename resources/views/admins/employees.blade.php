@extends('main_admin')

@section('title', '| Employees')

@section ('content')
  
  <h2 class="sub-header">Employees</h2>

  <div class="table-responsive">
    <table class="table table-striped">

      <div class="input-group margin-bottom">        
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search ...">
        <input type="hidden" id="type" value="employees">
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

      <tbody id="searchresult"> 
        @foreach($employees as $employee)       
            <tr>
              <td> {{ $employee->firstname }} </td>
              <td> {{ $employee->lastname }} </td>
              <td> {{ $employee->phone }} </td>
              <td> {{ $employee->email }}</td>
              <td> {{ $employee->company }}</td>
              <td>
                <a href="{{ URL::route('admins.editUser', [$employee->id]) }}" title="Edit">
                  <span class="glyphicon glyphicon-edit"></span>
                </a>
              </td>
              <td>
                <a href="#" title="Log">
                  <span class="glyphicon glyphicon-th-list"></span>
                </a>
              </td>
              <td>
                <a href="{{ URL::route('admins.showUser', [$employee->id]) }}" title="Delete">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </td>
            </tr>
        @endforeach
      </tbody>

    </table>
  </div>

@endsection