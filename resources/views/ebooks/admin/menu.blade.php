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
            <a href="{{ route('postebook') }}"><span class="glyphicon glyphicon-play"></span> Post Ebook</a>
        </li>
        <li>
            <a href="{{ route('ebooks_books_manage') }}"><span class="glyphicon glyphicon-book"></span> Books Manager</a>
        </li>
        <li>
            <a href="{{ route('ebooks_favorite') }}"><span class="glyphicon glyphicon-star"></span> Favorites</a>
        </li>
        <li>
            <a href="{{ route('ebooks_subscription') }}"><span class="glyphicon glyphicon-play-circle"></span> Subscribes</a>
        </li>
      </ul>
    </div>
  </div>
</div>