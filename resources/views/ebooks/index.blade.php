@php
  $url = URL::to('/')."/ebooks";
  $furl = URL::to('/');

  function dateDiff($date)
  {
    $upload_date = new DateTime($date);
    $current_date = new DateTime(date(''));
    $diff = $upload_date->diff($current_date);
    return $diff->format('%a');
  }
@endphp

    <!--Top NavigationBar-->
    @include('ebooks.navbar')

    <style type="text/css">
      #navbar * {
        background-color: #f5f5f5 !important;
        color: black;
      }
      operations {
        display: none;
      }
      operations a {
        margin: 2px;
      }
      h6 a {
        text-decoration: none;
        color: black;
      }
      .cust div{padding: 0px 10px;}
      operations {display: none;}
      operations a {margin: 2px;}
      h2 a {color: black;text-decoration: none;}
      h2 a:hover {color: black;text-decoration: none;}
      h2 a:focus {color: black;text-decoration: none;}
    </style>

    <script type="text/javascript">
      $(document).ready(function() {
        $(".main-panel").hover(
          function() {
            $(this).find("operations").show();
          }, function() {
            $(this).find("operations").hide();
          }
        );
      });
    </script>

    <div class="navbar navbar-default" id="navbar">
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
              <li class="{{ Route::input('category_id')==''?'active':'' }}"><a href='{{ $url }}'>General</a></li>
              <?php $cathead = "General"; ?>
              @foreach($category as $key=>$value)
                @if($value->id==Route::input('category_id'))
                  @php $cathead = $value->name; @endphp
                  <li class="active"><a href='#'>{{ $value->name }}</a></li>
                @else
                  <li><a href='{{ $url."/".$value->id }}'>{{ $value->name }}</a></li>
                @endif
              @endforeach
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container" style="margin-top:60px;">
      <div class="row">
        <div class = "col-sm-12 col-md-12 nopad">
          <div class="panel panel-default">
            <div class="panel-heading">
              {{ $cathead }}
            </div>
            <div class="panel-body">
              About {{ $books->count() }} results
              <div class="row" style="background-color:#fff;">
                <div class="row">
                  @foreach($books as $book)
                    <div class="col-md-12 main-panel">
                      <hr>
                      <div class="col-md-3">
                        <img src="{{ route('book_thumb', ['filename' => encrypt($book->thumbnail)]) }}" width="100%" alt="">
                      </div>
                      <div class="col-md-7">
                        <h2><a href="{{ route('book_show',encrypt($book->id)) }}" target="_blank">{{ $book->title }}</a></h2>
                        <h6>
                          by <a href="{{ route('ebooks_author',['au_id' => encrypt($book->user->id)]) }}">{{ $book->user->name }}</a>
                          <i class="counter" style="margin-left: 10px;">{{ $book->viewscount->sum('visits') }} <span class="a-icon-alt"> Views</span></i>
                        @auth
                          @if($book->favorite->count()==0)
                            <a href="{{ $url }}/admin/favorite/add/{{ encrypt($book->id) }}?url={{ encrypt(url()->current()) }}" style="margin-left: 10px;"><i class="glyphicon glyphicon-star"></i></a>
                          @else
                            <a href="{{ $url }}/admin/favorite/remove/{{ encrypt($book->id) }}?url={{ encrypt(url()->current()) }}" style="margin-left: 10px;"><i class="glyphicon glyphicon-star" style="color: #ffa200;"></i></a>
                          @endif
                        @endauth
                        @guest
                          <a href="{{ $url }}/admin/favorite/add/{{ encrypt($book->id) }}?url={{ encrypt(url()->current()) }}" style="margin-left: 10px;"><i class="glyphicon glyphicon-star"></i></a>
                        @endguest
                        </h6>
                        <p>{{ $book->description }}</p>
                      </div>
                      <operations class="col-md-2">
                        <a href="{{ route('book_show',encrypt($book->id)) }}" target="_blank" class="btn btn-success form-control">View</a>
                        <a href="{{ route('book_show',encrypt($book->id)) }}" class="btn btn-primary form-control" download="{{ $book->title }}">Download</a>
                      </operations>
                    </div>
                  @endforeach
                </div>
              </div>
              {{ $books->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>