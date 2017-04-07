@extends('main_admin')

@section('title', '| Employees')

@section ('content')
  
  <h2 class="sub-header">Employees</h2>

  <div class="table-responsive">
    <table class="table table-striped tablesorter" id="myTable">

      <div class="input-group margin-bottom">        
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search ...">
        <input type="hidden" id="type" value="employees">
      </div>

      <thead>
        <tr>
          <th class="sortable-header">Firstname <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="sortable-header">Lastname <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="sortable-header">Phone <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="sortable-header">Mail <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="not-sortable">Company</th>
          <th class="not-sortable"></th>
          <th class="not-sortable"></th>
          <th class="not-sortable"></th>
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
                <a href="{{ URL::route('admins.editEmployee', [$employee->id]) }}" title="Edit">
                  <span class="glyphicon glyphicon-edit"></span>
                </a>
              </td>
              <td>
                <a href="{{ URL::route('admins.employeevisits', [$employee->id]) }}" title="Employee Visits">
                  <span class="glyphicon glyphicon-th-list"></span>
                </a>              
              </td>
              <td>
                <a href="{{ URL::route('admins.deleteEmployee', [$employee->id]) }}" title="Delete">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </td>
            </tr>
        @endforeach
      </tbody>

    </table>
  </div>
  
  <div>
    {{ $employees->links() }}
  </div>

@endsection