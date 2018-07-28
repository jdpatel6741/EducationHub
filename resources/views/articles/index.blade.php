@php
    $url = URL::to('/')."/articles";
    $furl = URL::to('/');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Articles</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/articals/style.css') }}">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
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
                    <li><a href="{{ route('articles') }}">All</a></li>
                    @foreach($subjects as $s)
                        <li><a href="{{ route('articles_index',['subject_id'=>encrypt($s->id),'article_id'=>encrypt(1)]) }}">{{ $s->name }}</a></li>
                    @endforeach
                </li>
            </ul>
        </div>
    </div>
</div>
<!--Top Menubar End-->

<div class="container-fluid" style="margin-top: 100px;padding-top: 15px;">
    <div class="row">
        <div class="col-md-2">
            <div class="sidenav">
                @if(isset($article->id))
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
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12">
                    @if(isset($article))
                        <div>
                            <h3>{{ $article->topic }}</h3>
                            @if(isset($article))
                                {!! $article->content !!}
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

        <script>
            $(document).ready(function() {
                $('#summernote').summernote();
            });
        </script>
</body>
</html>
