@php 
  $url = URL::to('/')."/mytube";
  $furl = URL::to('/'); 
@endphp
<style type="text/css">
  .navbar * {
    background-color: #003399;
    color: white;
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
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse1">
      <ul class="nav navbar-nav navbar-right mytube">
          <li>
            <a href='{{ $url }}/admin/dashboard'>{{ Auth::user()->name }}</a>
          </li>
          <li>
            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="glyphicon glyphicon-off"></i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
      </ul>
    </div>	
  </div>	
</nav>