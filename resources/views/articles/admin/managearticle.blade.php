<!DOCTYPE html>
<html lang="en">
<body>
@include('articles.navbar')
@include('articles.admin.menu')
<div id="wrap" style="min-height: 610px;">
    <div class="container" id="main">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="row" style="background-color:#fff;padding: 20px;">
                    <h3>Articles Manager</h3>
                    @foreach($articles as $article)
                        <div class="row" style="padding: 20px;">
                            <div class="col-md-8">
                                <label>{{ $article->topic }}</label>
                            </div>
                            <div class="col-md-1" style="width: auto;">
                                <p>{{-- cnt('tbl_ebooks_views',$book->id) --}}0 Views</p>
                            </div>
                            <div class="col-md-3" style="width: auto;">
                                <a href="{{ route('articles_index',['subject_id'=>encrypt($article->sid),'article_id'=>encrypt($article->id)]) }}" class="btn btn-success" target="_blank">View</a>
                                <a href="{{ route('article_edit',encrypt($article->id)) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('articles_article_deletearticle',encrypt($article->id)) }}" class="btn btn-danger">Delete</a>
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