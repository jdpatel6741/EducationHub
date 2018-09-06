<!DOCTYPE html>
<html lang="en">
<body>
@include('articles.navbar')
@include('articles.admin.menu')
<div class="container" id="main">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('articles_add_article') }}">
                @csrf
                <h2>Post Article  <button type="submit" class="btn btn-success pull-right">Publish</button></h2>
                <div class="form-group">
                    <label for="topic">Topic:</label>
                    <input type="text" class="form-control" id="topic" placeholder="Enter Topic" name="topic">
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <select name="sid" class="form-control" id="subject">
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="topic">Content:</label>
                    <textarea class="form-control resize" name="contents" style="height: 400px;"></textarea>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>