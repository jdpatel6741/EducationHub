@php
    //init variables
    $url = URL::to('/')."/ebooks";
    $furl = URL::to('/');
@endphp
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>MyTube</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body{background-color:#f1f1f1;}
        .grey
        {color:#767676;font-size:12px;}
        .nopad{padding-left:2px;padding-right:2px;}
        @media screen and (max-width: 699px) and (min-width: 300px){ul.mytube{display:none;}}
        .form-control, .btn{border-radius: 0px;}
    </style>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mytube/scripts.js') }}"></script>
    <script type="text/javascript">
        $("document").ready(function(){
            $("#selectfile").click(function () {
                $("#fileToUpload").click();
            });
            $("#fileToUpload").change(function (e) {
                $("#vname").show();
                $("#vidname").html(e.target.files[0].name);
            });
            $("#submit").click(function(e){
                $(this).prop('disabled','true');
                var formData = new FormData($("#videodata")[0]);
                $.ajax({
                    url: '{{ route('ebooks_books_updatebook',encrypt($book->id)) }}',
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (returndata) {
                        $("#msg").html(returndata).show().fadeOut(8000);
                    }
                });
                $(this).removeAttr('disabled');
            });
        });
    </script>
</head>
<body>
@include('ebooks.navbar')
@include('ebooks.admin.menu')
<div id="wrap" style="min-height: 680px;">
    <div class="container" id="main">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class = "row" style="background-color:#fff;padding:20px;">
                    <fieldset>
                        <legend><a href="{{ route('ebooks_books_manage') }}"><i class="glyphicon glyphicon-arrow-left" style="margin: 0px 15px;"></i></a> Edit Book Information</legend>
                        <div id="msg"></div>
                        <form id="videodata" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class='col-sm-3'>
                                <div class='form-group'>
                                    <label for="user_title">Thumbnail</label>
                                    <img src="{{ route('book_thumb',encrypt($book->thumbnail)) }}" alt="thumbnail" id="thumbnail">
                                </div>
                                <br>
                                <div class='form-group'>
                                    <embed src="{{ route('book_show',encrypt($book->id)) }}" width="100%" height="300" type='application/pdf'>
                                </div>
                            </div>
                            <div class='col-sm-9'>
                                <div class='col-sm-8'>
                                    <div class='form-group'>
                                        <label for="title">Title</label>
                                        <input class="form-control" id="title" name="title" required="true" size="30" type="text" value="{{ $book->title }}"/>
                                    </div>
                                    <div class='form-group'>
                                        <label for="title">Description</label>
                                        <textarea class="form-control" name="description" required="true">{{ $book->description }}</textarea>
                                    </div>
                                    <div class="pull-left">
                                        <button id="submit" type="button" name="submit" value="update" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Update</button>
                                    </div>
                                </div>
                                <div class='col-sm-4'>
                                    <div class='form-group'>
                                        <label for="title">Categories</label>
                                        <select class="form-control" name="category_id" id="sel1">
                                            @foreach($category as $value)
                                                <option value="{{ encrypt($value->id) }}" {{ $value->id==$book->category_id?"selected":"" }}>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class='form-group'>
                                        <label for="title">Privacy</label>
                                        <select class="form-control" name="privacy"  id="sel1">
                                            <option value="public" {{ $book->privacy=="public"?"selected":"" }}>public</option>
                                            <option value="private" {{ $book->privacy=="private"?"selected":"" }}>private</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</body>
</html>