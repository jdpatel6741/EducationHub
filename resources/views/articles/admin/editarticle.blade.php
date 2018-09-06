<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{background-color:#f1f1f1;}
        .grey
        {color:#767676;font-size:12px;}
        .nopad{padding-left:2px;padding-right:2px;}
        @media screen and (max-width: 699px) and (min-width: 300px){#navbar-collapse1{display:none;}}
        .form-control, .btn{border-radius: 0px;}
    </style>
</head>
<body>
@include('articles.navbar')
@include('articles.admin.menu')
<div id="wrap" style="min-height: 680px;">
    <div class="container" id="main">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class = "row" style="background-color:#fff;padding:20px;">
                    <fieldset>
                        <legend><a href="{{ route('articles_manage') }}"><i class="glyphicon glyphicon-arrow-left" style="margin: 0px 15px;"></i></a> Edit Article</legend>
                        <div id="msg"></div>
                        <form method="POST" id="data">
                            @csrf
                            <h2>Update Article  <button id="submit" type="submit" class="btn btn-success pull-right">Update</button></h2>
                            <div class="form-group">
                                <label for="topic">Topic:</label>
                                <input type="text" class="form-control" id="topic" placeholder="Enter Topic" name="topic" value="{{ $article->topic }}">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject:</label>
                                <select name="sid" class="form-control" id="subject">
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $article->sid==$subject->id?"selected":"" }}>{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="topic">Content:</label>
                                <textarea class="form-control resize" name="contents" spellcheck="false" style="height: 400px;">{{ $article->content }}</textarea>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#submit").click(function(e){
                e.preventDefault();
                $(this).prop('disabled','true');
                $.ajax({
                    url: '{{ route('articles_updatearticle',encrypt($article->id)) }}',
                    type: 'POST',
                    data: $("#data").serialize(),
                    cache: false,
                    processData: false,
                    success: function (returndata) {
                        $("#msg").html(returndata).show().fadeOut(8000);
                    }
                });
                $(this).removeAttr('disabled');
            });
        });
    </script>
</body>
</html>