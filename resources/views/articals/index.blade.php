<!DOCTYPE html>
<html lang="en">
<head>
    <title>W3ATMIYA TUTORIAL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <style>
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-md-6">
        <img src="/images/logo.png" style="height: 60px;" />
    </div>
    <div class="col-md-6">

    </div>
</div>

<!--Top Menubar Start-->
<nav class="navbar navbar-default bg-darkgrey">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-home text-white"></span></a>
        </div>
        <ul class="nav navbar-nav">
            @foreach ($subjects as $s)
                <li class="act ive"><a href="/sub/{{ $s->id }}" class="text-white">{{ $s->name }}</a></li>
            @endforeach
        </ul>
    </div>
</nav>
<!--Top Menubar End-->

<!--Top Sidebar Start-->
<div class="vertical-menu" style="position: absolute;">
    @foreach ($topics as $t)
        <a href="/top/{{ $t->id }}" class="act ive">{{ $t->topic }}</a>
    @endforeach
</div>
<!--Top Sidebar End-->


<div class="content">
    <div class="row">
        <div class="col-md-11">

            <div>
                @if(isset($article[0]))
                    {!! $article[0]->content !!}
                @endif
                <div>

                    <hr>
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
