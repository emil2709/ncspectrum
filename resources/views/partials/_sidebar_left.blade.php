<div class="container-fluid">
  <div class="row">

    <div class="col-sm-3 col-lg-2 sidebar">

      <ul class="nav nav-sidebar">
        <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : null }}">
          <a href="{{ route('admins.dashboard') }}">Dashboard</a>
        </li>
        <li class="{{ Request::segment(2) === 'guests' ? 'active' : null }}">
          <a href="{{ route('admins.guests') }}">Guests</a>
        </li>
        <li class="{{ Request::segment(2) === 'employees' ? 'active' : null }}">
          <a href="{{ route('admins.employees') }}">Employees</a>
        </li>
        <li class="{{ Request::segment(2) === 'admins' ? 'active' : null }}">
          <a href="{{ route('admins.admins') }}">Admins</a>
        </li>
        <li class="{{ Request::segment(2) === 'visits' ? 'active' : null }}">
          <a href="">Visits</a>
        </li>
      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="#">Create Guest</a></li>
        <li><a href="#">Create Employee</a></li>
        <li><a href="#">Create Admin</a></li>
        <li><a href="#">Create Visit</a></li>
      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="#">Status</a></li>
        <li><a href="#">History</a></li>
        <li><a href="#">Database</a></li>
      </ul>
      
    </div>

  </div>
</div>