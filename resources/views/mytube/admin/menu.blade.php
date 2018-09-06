@php 
  $url = URL::to('/')."/mytube/admin";
  $furl = URL::to('/'); 
@endphp
<div class="navbar-default" id="subnav">
  <div class="col-md-12">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse2">
      <ul class="nav navbar-nav navbar-left">
        <li>
          <a href="{{ $url }}/dashboard"><span class="glyphicon glyphicon-th-large"></span> Dashboard</a>
        </li>
        <li>
          <a href="{{ $url }}/postvideo"><span class="glyphicon glyphicon-play"></span> Video Post</a>
        </li>
        <li>
          <a href="{{ $url }}/videomanager"><span class="glyphicon glyphicon-film"></span> Videos Manager</a>
        </li>
        <li>
          <a href="{{ $url }}/channel"><span class="glyphicon glyphicon-globe"></span> Channels</a>
        </li>
        <li>
          <a href="{{ $url }}/favorite"><span class="glyphicon glyphicon-ok"></span> Favorites</a>
        </li>
        <li>
          <a href="{{ $url }}/subscription"><span class="glyphicon glyphicon-play-circle"></span> Subscriptions</a>
        </li>
      </ul>
    </div>
  </div>	
</div>