<!DOCTYPE html>
<html lang="en">
<head>
    <title>W3ATMIYA TUTORIAL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/articals/style.css') }}">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link href="{{ asset('summernote/summernote.css') }}" rel="stylesheet">
    <script src="{{ asset('summernote/summernote.js') }}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="images/logo.png" style="height: 60px;" />
        </div>
        <div class="col-md-6">

        </div>
    </div>

    <!--Top Menubar Start-->
    <nav class="navbar navbar-default bg-darkgrey">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-home text-white"></span></a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">New Article</a></li>
                <li><a href="#" class="text-white">View Article</a></li>
            </ul>
        </div>
    </nav>
    <!--Top Menubar End-->
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="addArticle">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h2>Post Article  <button type="submit" class="btn btn-success pull-right">Publish</button></h2>
                <div class="form-group">
                    <label for="topic">Topic:</label>
                    <input type="text" class="form-control" id="topic" placeholder="Enter Topic" name="topic">
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <select name="sid" class="form-control" id="subject">
                        <option value="1">HTML</option>
                        <option value="2">CSS</option>
                        <option value="3">JavaScript</option>
                        <option value="4">PHP</option>
                        <option value="5">Android</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="topic">Content:</label>
                    <textarea id="summernote" name="contents"></textarea>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write Your Content Here',
            tabsize: 2,
            height: 600
        });
    });
</script>
</body>
</html>
