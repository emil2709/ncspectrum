@extends('main_admin')

@section('title', '| Admins')

@section ('content')
  
  <h2 class="sub-header">Admins</h2>

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
          <th>Mail</th>
          <th></th>
          <th></th>
        </tr>
      </thead>

      <tbody> 
        @foreach($admins as $admin)       
            <tr>
              <td> {{ $admin->firstname }} </td>
              <td> {{ $admin->lastname }} </td>
              <td> {{ $admin->email }} </td>
              <td> 
                <a href="#"><span class="glyphicon glyphicon-edit"></span></a> 
              </td>
              <td> 
                <a href="#"><span class="glyphicon glyphicon-trash"></span></a> 
              </td>
            </tr>
        @endforeach
      </tbody>

    </table>
  </div>

@endsection