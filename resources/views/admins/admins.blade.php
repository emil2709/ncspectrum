@extends('main_admin')

@section('title', '| Admins')

@section ('content')
  
  <h2 class="sub-header">Admins</h2>

  <div class="table-responsive">
    <table class="table table-striped">
        
      <div class="input-group margin-bottom">        
        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search ...">
        <input type="hidden" id="type" value="admins">
      </div>

      <thead>
        <tr>
          <th>Firstname</th>d
          <th>Lastname</th>
          <th>Mail</th>
          <th></th>
          <th></th>
        </tr>
      </thead>

      <tbody id="searchresult"> 
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