@php 
  	$url = URL::to('/')."/mytube/admin";
  	$furl = URL::to('/');
  	
  	function cnt($table,$vid)
	{
		return DB::table($table)->where(['video_id'=>$vid])->count();
	}
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>MyTube</title>
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<style>
		body { background-color:#f1f1f1; }
		.grey { color:#767676;font-size:12px; }
		.nopad { padding-left:2px;padding-right:2px; }
		@media screen and (max-width: 699px) and (min-width: 300px) { #mytube { display:none; } }
		.form-control, .btn { border-radius: 0px; }
		.nob { border:none;font-size: 16px;color:#444; }
		.glyphicon { margin-right:10px; }
		.imguser { padding-right: 10px;width: 100px; }
		.number{ font-size:16px; }
	</style>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
	@include("mytube.admin.navbar")
	<div id="wrap" style="min-height: 725px; margin-top:-50px;">
		<div class="container" id="main">
			<div class="row">
				<div class="col-md-3 col-sm-5 leftpart" style="background-color:#fff;padding:20px;margin:10px;">
					<a href="{{ $url }}/dashboard"><h3 class="nob"><span class="glyphicon glyphicon-th-large"></span>Dashboard</h3></a>
					<a href="{{ $url }}/postvideo"><h3 class="nob"><span class="glyphicon glyphicon-play"></span>Video Post</h3></a>
					<a href="{{ $url }}/videomanager"><h3 class="nob"><span class="glyphicon glyphicon-film"></span>Video Manager</h3></a>
					<a href="{{ $url }}/channel"><h3 class="nob"><span class="glyphicon glyphicon-globe"></span>Channel</h3></a>
					<a href="{{ $url }}/favorite"><h3 class="nob"><span class="glyphicon glyphicon-ok"></span>Favorite</h3></a>
					<a href="{{ $url }}/subscription"><h3 class="nob"><span class="glyphicon glyphicon-play-circle"></span>subscription</h3></a>
				</div>
				<div class="col-md-8 col-sm-6">
					<div class="row" style="background-color:#fff;padding:20px;margin:10px;">
						<p>
							<img class="img-squre pull-left imguser" src="{{ $furl }}/user/profile/{{ encrypt(Auth::user()->id) }}">
							<h3 id="title" style="border:none;">{{ Auth::user()->name }}</h3>
						</p>
					</div>
					<div class="row" style="background-color:#fff;padding:20px;margin:10px;">
						<H4 style="color:#666;font-size:15px;">ANALYTICS</H4>
						<h6>Videos : <span class="number">{{ $data['videos'] }}</span></h6>
						<h6>Views : <span class="number">{{ $data['views'] }}</span></h6>
						<h6>Channel : <span class="number">{{ $data['channel'] }}</span></h6>
						<h6>Subscribe : <span class="number">{{ $data['subscribe'] }}</span></h6>
						<h6>Favorite : <span class="number">{{ $data['favorite'] }}</span></h6>
					</div>
				</div> 
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<hr>
	@include("mytube.footer")	
</body>
</html>