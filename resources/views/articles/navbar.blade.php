<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Articals</title>
    <meta name="generator" content="Articals">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/css/font-awesome.min.css') }}">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<style>
  body {
    background-color:#fff;
  }
  .content {
    font-size: 5px;margin-top: -3px;vertical-align: middle;padding: 0px 3px;
  }
  @media screen and (max-width: 768px) {
    .pull-left {
      float: none !important;
    }
  }
  .navbar * {
    background-color: rgb(255, 0, 102) !important;
    color: white;
  }
  .navbar a:hover {
    text-decoration: none;
    background-color: transparent !important;
    color: white;
  }
  #srch-term {
    background-color:white !important;
    color:black;
  }
</style>
<nav class="navbar navbar-fixed-top header">
  <div class="col-md-12">
    <div class="navbar-header">
      <a href="{{ $furl }}" class="navbar-brand"><i class="glyphicon glyphicon-home"></i></a>
      <a href="{{ route('articles') }}" class="navbar-brand">Articals</a>
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
        @auth
          <li>
            <a href='{{ $furl }}/ebooks/admin/postebook' id='mytube'>{{ Auth::user()->name }}</a>
          </li>
        @endauth
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