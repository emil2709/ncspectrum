<div class="container-fluid">
  <div class="row">

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
        @if(Auth::user()->id == 1)
          <li class="{{ Request::segment(2) === 'admins' ? 'active' : null }}">
            <a href="{{ route('admins.admins') }}">Admins</a>
          </li>
        @endif
        <li class="{{ Request::segment(2) === 'visits' ? 'active' : null }}">
          <a href="">Visits</a>
        </li>
      </ul>
      <ul class="nav nav-sidebar">
        <li class="{{ Request::segment(2) === 'guest' && Request::segment(3) === 'create' ? 'active' : null }}">
          <a href="{{ route('admins.createGuest') }}">Create Guest</a>
        </li>
        <li class="{{ Request::segment(2) === 'employee' && Request::segment(3) === 'create' ? 'active' : null }}">
          <a href="{{ route('admins.createEmployee') }}">Create Employee</a>
        </li>
        @if(Auth::user()->id == 1)
          <li class="{{ Request::segment(2) === 'register' ? 'active' : null }}"">
            <a href="{{ route('register') }}">Create Admin</a>
          </li>
        @endif
          <li class="{{ Request::segment(2) === 'visit' && Request::segment(3) === 'create' ? 'active' : null }}">
            <a href="{{ route('admins.createVisit') }}">Create Visit</a>
          </li>
      </ul>
      <ul class="nav nav-sidebar">
        <li><a href="">Status</a></li>
        <li class="{{ Request::segment(2) === 'log' ? 'active' : null }}">
          <a href="{{ route('admins.log') }}">Log</a>
        </li>
        <li><a href="#">Database</a></li>
      </ul>
      
   

  </div>
</div>