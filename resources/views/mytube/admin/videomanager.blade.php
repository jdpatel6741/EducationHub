@php
	//init variables
	$url = URL::to('/')."/mytube";
	$furl = URL::to('/');

  	function cnt($table,$vid)
	{
		return DB::table($table)->where(['video_id'=>$vid])->count();
	}

	function likecnt($vid,$select)
	{
		if($select=='like')
			return DB::table('tbl_mytube_likecount')->where(['video_id'=>$vid,'status'=>1])->count();
		else
			return DB::table('tbl_mytube_likecount')->where(['video_id'=>$vid,'status'=>2])->count();
	}
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>MyTube</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/mytube/scripts.js') }}"></script>
	<style type="text/css">
		body
		{
			background-color:#f1f1f1;
		}
		.myhr
		{ 
			margin-top:15px;
			border-bottom:1px solid #d4d4d6;
		}
	</style>
</head>
<body>
	@include('mytube.admin.navbar')
	@include('mytube.admin.menu')
	<div id="wrap" style="min-height: 610px;">
		<div class="container" id="main">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="row" style="background-color:#fff;padding: 20px;">
						<h3>Video Manager</h3>
						@foreach($videos as $video)
							<div class="row myhr" style="padding: 20px;">
								<div class="col-md-2">
									<figure class="pull-left">
										<img class="media-object img-responsive"  src="{{ $url }}/thumbnail/{{ encrypt($video->thumbnail) }}">
									</figure>
								</div>
								<div class="col-md-6">
									<h4 class="list-group-item-heading">{{ $video->title }}</h4>
									<p class="list-group-item-text">{{ $video->description }}</p>
								</div>
								<div class="col-md-1" style="width: auto;">
									<p>{{ cnt('tbl_mytube_viewcount',$video->id) }} Views</p>
									<p>{{ likecnt($video->id,'like') }} Like</p>
									<p>{{ likecnt($video->id,'unlike') }} Unlike</p>
								</div>
								<div class="col-md-3" style="width: auto;">
									<a href="{{ $url }}/play/{{ encrypt($video->id) }}" class="btn btn-success" target="_blank">View</a>
									<a href="{{ $url }}/admin/videomanager/edit/{{ encrypt($video->id) }}" class="btn btn-primary">Edit</a>
									<a href="{{ $url }}/admin/videomanager/delete/{{ encrypt($video->id) }}" class="btn btn-danger">Delete</a>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	@include("mytube.footer")
</body>
</html>