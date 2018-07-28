@php 
  $url = URL::to('/')."/mytube";
  $furl = URL::to('/');
@endphp
<style type="text/css">
  @media screen and (max-width: 768px) {
    .pull-left {
      float: none !important;
    }
  }
  .navbar * {
    background-color: #003399;
    color: white;
  }
  #srch-term {
    background-color:white !important;
    color:black;
  }
  .navbar a:hover {
    text-decoration: none;
    background-color: transparent !important;
    color: white;
  }
</style>
<nav class="navbar navbar-fixed-top header">
  <div class="col-md-12">
    <div class="navbar-header">
      <a href="{{ $furl }}" class="navbar-brand"><i class="glyphicon glyphicon-home"></i></a>
      <a href="{{ $url }}" class="navbar-brand">MyTube</a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse1">
        <i class="glyphicon glyphicon-circle-arrow-right"></i>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse1">
      <form class="navbar-form pull-left" action="{{ $url }}" method="GET">
        <div class="input-group" style="max-width:470px;">
          <input type="text" class="form-control" placeholder="Search" name="search" id="srch-term">
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right mytube">
        <li><a href="{{ $furl }}/converter"><strong>Mp4 to Mp3 Convert</strong></a></li>
        @auth
          <li>
            <a href='{{ $url }}/admin/dashboard' id='mytube'>{{ Auth::user()->name }}</a>
          </li>
        @endauth
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-bell"></i></a>
            <ul class="dropdown-menu">
              <li><a href="#"><span class="badge pull-right">40</span>Link</a></li>
              <li><a href="#"><span class="badge pull-right">2</span>Link</a></li>
              <li><a href="#"><span class="badge pull-right">0</span>Link</a></li>
              <li><a href="#"><span class="label label-info pull-right">1</span>Link</a></li>
              <li><a href="#"><span class="badge pull-right">13</span>Link</a></li>
            </ul>
          </li>
          @guest
          <li>
            <a href="{{ $furl }}/login"><i class="glyphicon glyphicon-user"></i></a>
          </li>
          @endguest
          @auth
          <li>
            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="glyphicon glyphicon-off"></i></a>
          </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          @endauth
      </ul>
    </div>	
  </div>	
</nav>