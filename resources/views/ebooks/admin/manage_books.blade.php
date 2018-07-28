@php
    //init variables
    $url = URL::to('/')."/ebooks/admin";
    $furl = URL::to('/');

    function dateDiff($date)
    {
        $upload_date = new DateTime($date);
        $current_date = new DateTime(date(''));
        $diff = $upload_date->diff($current_date);
        return $diff->format('%a');
    }

    function cnt($table,$bid)
	{
		return DB::table($table)->where(['book_id'=>$bid])->count();
	}
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Ebooks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mytube/scripts.js') }}"></script>
    <style type="text/css">
        body{background-color:#f1f1f1;}
        .myhr{margin-top:15px;border-bottom:1px solid #d4d4d6;}
        a * {color: black;}
        a *:hover {color: #444;}
    </style>
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
</head>
<body>
@include('ebooks.navbar')
@include('ebooks.admin.menu')
<div id="wrap" style="min-height: 610px;">
    <div class="container" id="main">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="row" style="background-color:#fff;padding: 20px;">
                    <h3>Books Manager</h3>
                    @foreach($books as $book)
                        <div class="row myhr" style="padding: 20px;">
                            <div class="col-md-2">
                                <figure class="pull-left">
                                    <img class="media-object img-responsive"  src="{{ route('book_thumb',encrypt($book->thumbnail)) }}">
                                </figure>
                            </div>
                            <div class="col-md-6">
                                <h4 class="list-group-item-heading">{{ $book->title }}</h4>
                                <p class="list-group-item-text">{{ $book->description }}</p>
                            </div>
                            <div class="col-md-1" style="width: auto;">
                                <p>{{ cnt('tbl_ebooks_views',$book->id) }} Views</p>
                                <p>{{ $book->privacy }}</p>
                            </div>
                            <div class="col-md-3" style="width: auto;">
                                <a href="{{ route('book_show',encrypt($book->id)) }}" class="btn btn-success" target="_blank">View</a>
                                <a href="{{ route('ebooks_books_edit',encrypt($book->id)) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('ebooks_books_deletebook',encrypt($book->id)) }}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>