@extends('main_admin')

@section('title', '| Admins')

@section('content')

@if(Auth::user()->id == 1)

  <h2 class="sub-header">Administrators</h2>

  <div class="table-responsive">
    <table class="table table-striped tablesorter" id="myTable">
        
      <div class="input-group margin-bottom">        
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search ...">
        <input type="hidden" id="type" value="admins">
      </div>

      <thead>
        <tr>
          <th class="sortable-header">Firstname <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="sortable-header">Lastname <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="sortable-header">Mail <span class="glyphicon glyphicon-resize-vertical" id="sortableTable-icon"></span></th>
          <th class="not-sortable"></th>
          <th class="not-sortable"></th>
          <th class="not-sortable"></th>
        </tr>
      </thead>

      <tbody id="searchresult"> 
        @foreach($admins as $admin)       
            <tr>
              <td> {{ $admin->firstname }} </td>
              <td> {{ $admin->lastname }} </td>
              <td> {{ $admin->email }} </td>
              <td>
                <a href="{{ URL::route('admins.editAdmin', [$admin->id]) }}" title="Edit">
                  <span class="glyphicon glyphicon-edit" id="action-icons"></span>
                </a>
              </td>
              <td>
                <a href="{{ URL::route('admins.editAdminPassword', [$admin->id]) }}" title="Edit Password">
                  <span class="glyphicon glyphicon-lock" id="action-icons"></span>
                </a>
              </td>
              <td>
                <a href="{{ URL::route('admins.deleteAdmin', [$admin->id]) }}" title="Delete">
                  <span class="glyphicon glyphicon-trash" id="action-icons"></span>
                </a>
              </td>
            </tr>
        @endforeach
      </tbody>

    </table>
  </div>
  
  <div>
    {{ $admins->links() }}
  </div>

@else
  @include('partials._offlimits')

@endif

@endsection