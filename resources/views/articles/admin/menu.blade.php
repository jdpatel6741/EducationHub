@php 
  $url = URL::to('/')."/articles/admin";
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
          <a href="{{ route('articles_add') }}"><span class="glyphicon glyphicon-plus"></span> Add Article</a>
        </li>
        <li>
          <a href="{{ route('articles_manage') }}"><span class="glyphicon glyphicon-edit"></span> Manage Articles</a>
        </li>
        <li>
            <a href="{{ route('articles_favorite') }}"><span class="glyphicon glyphicon-star"></span> Favorites</a>
        </li>
      </ul>
    </div>
  </div>	
</div>