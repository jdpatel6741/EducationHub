@php 
  $url = URL::to('/')."/sourcecode";
  $furl = URL::to('/'); 
@endphp
<style type="text/css">
  @media screen and (max-width: 768px) {
    .pull-left {
      float: none !important;
    }
  }
  #srch-term {
    background-color: rgba(255,255,255,0.125);
    border: 0px;
    box-shadow: none;
    color: white;
  }
  .navbar-nav > li > #cust_a {
    padding-top: 10px !important;
    padding-bottom: 10px !important;
  }
</style>
  
<nav class="navbar navbar-inverse" style="border-radius: 0px;margin-bottom: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="{{ $furl }}" class="navbar-brand"><i class="glyphicon glyphicon-home"></i></a>
      <a href="{{ $url }}" class="navbar-brand">Source Codes</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li>
          <a id="cust_a">
          <form action="{{ $url }}" method="GET" style="padding: 0px;margin: 0px;">
            <input type="text" class="form-control" placeholder="Search" name="search" id="srch-term">
            <button class="hide" type="submit"></button>
          </form>
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @auth
          <li>
            <a href='{{ $url }}/{{ Auth::user()->name }}'>{{ Auth::user()->name }}</a>
          </li>
          <li style="padding-top: 3px;">
            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="glyphicon glyphicon-off"></i></a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        @endauth
        @guest
          <li>
            <a href="{{ $furl }}/login"><i class="glyphicon glyphicon-user"></i></a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>