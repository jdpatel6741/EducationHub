@php
    $url = URL::to('/')."/articles";
    $furl = URL::to('/');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <style>
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>
</head>
<body>

@include('articles.navbar')

<!--Top Menubar Start-->
<div class="navbar-default" id="subnav">
    <div class="col-sm-12">
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
                    <li class="{{ isset($subject_id)==null?'active':'' }}"><a href="{{ route('articles') }}">All</a></li>
                    @foreach($subjects as $s)
                        @if(isset($subject_id) and decrypt($subject_id)==$s->id)
                            <li class="active"><a href="{{route('articles_index',['subject_id'=>encrypt($s->id),'article_id'=>encrypt(1)]) }}">{{ $s->name }}</a></li>
                        @else
                            <li><a href="{{route('articles_index',['subject_id'=>encrypt($s->id),'article_id'=>encrypt(1)]) }}">{{ $s->name }}</a></li>
                        @endif
                    @endforeach
                </li>
            </ul>
        </div>
    </div>
</div>
<!--Top Menubar End-->

<div class="container-fluid" style="margin-top: 100px;padding-top: 15px;">
    <div class="row">
        <div class="col-sm-2">
            <div class="sidenav">
                @if(isset($article))
                    @foreach ($topics as $t)
                        @if($t->id==$article->id)
                            <a href="{{ route('articles_index',['subject_id'=>encrypt($t->sid),'article_id'=>encrypt($t->id)]) }}" class="active">{{ $t->topic }}</a>
                        @else
                            <a href="{{ route('articles_index',['subject_id'=>encrypt($t->sid),'article_id'=>encrypt($t->id)]) }}">{{ $t->topic }}</a>
                        @endif
                    @endforeach
                @else
                    <a>Opps, No Topics Found</a>
                    <br>
                @endif
            </div>
        </div>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-12">
                    @if(isset($article))
                        <div>
                            <h3>{{ $article->topic }}
                                @auth
                                    @if(isset($article->favorite->id))
                                        <a href="{{ route('articles_article_removefavorite',encrypt($article->id)) }}?url={{ encrypt(route(Route::currentRouteName(),['subject_id'=>encrypt($t->sid),'article_id'=>encrypt($t->id)])) }}"><i class="glyphicon glyphicon-star" style="color: #ffa200;"></i></a>
                                    @else
                                        <a href="{{ route('articles_article_addfavorite',encrypt($article->id)) }}?url={{ encrypt(route(Route::currentRouteName(),['subject_id'=>encrypt($t->sid),'article_id'=>encrypt($t->id)])) }}"><i class="glyphicon glyphicon-star"></i></a>
                                    @endif
                                @endauth
                                @guest
                                    <a href="{{ route('articles_article_addfavorite',encrypt($article->id)) }}?url={{ encrypt(route(Route::currentRouteName(),['subject_id'=>encrypt($t->sid),'article_id'=>encrypt($t->id)])) }}"><i class="glyphicon glyphicon-star" style="color: #ffa200;"></i></a>
                                @endguest
                            </h3>
                            @if(isset($article))
                                {!! htmlentities($article->content) !!}
                            @endif
                            <div>
                                <hr>
                            </div>
                        </div>
                    @else
                        Opps, No Topic Found
                        <br>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
