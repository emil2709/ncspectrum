<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="nav-side-menu">
<div id="profile-avatar-row-side">
      <a href='{{ route('admins.showProfile') }}'><img src="/uploads/avatars/{{ Auth::user()->avatar }}" id="profile-avatar-side"/></a>
    </div>

<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  <div class="menu-list">

      <ul id="menu-content" class="menu-content collapse out">
        <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : null }}">
          <a href="{{ route('admins.dashboard') }}"><i class="glyphicon glyphicon-dashboard"></i>Dashboard</a>
        </li>

        <li class="{{ Request::segment(2) === 'guests' ? 'active' : null }}">
          <a href="{{ route('admins.guests') }}"><i class="glyphicon glyphicon-user"></i>Guests</a>
        </li>

        <li class="{{ Request::segment(2) === 'employees' ? 'active' : null }}">
          <a href="{{ route('admins.employees') }}"><i class="glyphicon glyphicon-briefcase"></i>Employees</a>
        </li>

        @if(Auth::user()->id == 1)
          <li class="{{ Request::segment(2) === 'admins' ? 'active' : null }}">
            <a href="{{ route('admins.admins') }}"><i class="glyphicon glyphicon-star-empty"></i>Administrators</a>
          </li>
        @endif

        <li class="{{ Request::segment(2) === 'visits' ? 'active' : null }}">
          <a href="{{ route('admins.visits') }}"><i class="glyphicon glyphicon-home"></i>Visits</a>
        </li>

        <li data-toggle="collapse" data-target="#products" class="collapsed">
            <a href="#"><i class="glyphicon glyphicon-plus-sign"></i>Create<span class="arrow"></span></a>
        </li>

        <ul class="sub-menu collapse" id="products">
          <li class="{{ Request::segment(2) === 'guest' && Request::segment(3) === 'create' ? 'active' : null }}">
            <a href="{{ route('admins.createGuest') }}"><i class="glyphicon glyphicon-chevron-right"></i>Guest</a>
          </li>
          
          <li class="{{ Request::segment(2) === 'employee' && Request::segment(3) === 'create' ? 'active' : null }}">
            <a href="{{ route('admins.createEmployee') }}"><i class="glyphicon glyphicon-chevron-right"></i>Employee</a>
          </li>
          
          @if(Auth::user()->id == 1)
          <li class="{{ Request::segment(2) === 'register' ? 'active' : null }}">
            <a href="{{ route('register') }}"><i class="glyphicon glyphicon-chevron-right"></i>Admin</a>
          </li>
          @endif
        </ul>
    
        <li class="{{ Request::segment(2) === 'status' ? 'active' : null }}">
          <a href="{{ route('admins.status') }}"><i class="glyphicon glyphicon-ok-circle"></i>Status</a>
        </li>

        <li class="{{ Request::segment(2) === 'log' ? 'active' : null }}">
          <a href="{{ route('admins.log') }}"><i class="glyphicon glyphicon-list-alt"></i>Log</a>
        </li>

     </ul> 
  </div>
</div>