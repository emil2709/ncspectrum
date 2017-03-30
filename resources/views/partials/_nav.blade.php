<nav class="navbar navbar-inverse navbar-fixed-top">

  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false"           aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('users.wip') }}">NC-Spectrum</a>
    </div>

    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" 
              aria-expanded="false" id="navbar-avatar-spacing">
            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" id="navbar-avatar"/> 
            Hello, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}!
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admins.showProfile') }}">Profile</a></li>
            <li><a href="/">Userpage</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
          </ul>
        </li>
    </div>

  </div>

</nav>
