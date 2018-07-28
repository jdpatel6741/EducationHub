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
            <a href="{{ $url }}/postebook"><span class="glyphicon glyphicon-play"></span> Ebook Post</a>
        </li>
        <li>
            <a href="{{ $url }}/booksmanage"><span class="glyphicon glyphicon-book"></span> Books Manager</a>
        </li>
        <li>
            <a href="{{ $url }}/favorite"><span class="glyphicon glyphicon-star"></span> Favorite</a>
        </li>
        <li>
            <a href="{{ route('ebooks_subscription') }}"><span class="glyphicon glyphicon-play-circle"></span> Subscribe</a>
        </li>
      </ul>
    </div>
  </div>
</div>