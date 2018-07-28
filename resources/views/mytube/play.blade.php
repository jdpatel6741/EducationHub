@php
	//init variables
	$url = URL::to('/')."/mytube";
	$murl = URL::to('/');

	function dateDiff($date)
	{
		$upload_date = new DateTime($date);
		$current_date = new DateTime(date(''));
		$diff = $upload_date->diff($current_date);
		return $diff->format('%a');
	}

	function cnt($table,$vid)
	{
		return DB::table($table)->where(['video_id'=>$vid])->sum('visits');
	}

	function likecnt($vid,$select)
	{
		if($select=='like')
			return DB::table('tbl_mytube_likecount')->where(['video_id'=>$vid,'status'=>1])->count();
		else
			return DB::table('tbl_mytube_likecount')->where(['video_id'=>$vid,'status'=>2])->count();
	}

	function cont($table,$vid)
	{
		return DB::table($table)->where(['video_id'=>$vid])->count();
	}

	function subcnt($cid)
	{
		return DB::table("tbl_mytube_subscribe")->where(['channel_id'=>$cid])->count();
	}
@endphp
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>MyTube</title>
	<meta name="generator" content="mytube"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/mytube/internal-style.css') }}">
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			
			function theatermode(vari) {
				document.cookie = "viewmode=TheaterMode";
				$("#idfortheatermode").show();
				$("#videotag").appendTo("#idfortheatermode");
				$("#videotag>video").css("width","100%");
				var hei = ($(window).height()*70)/100;
				$("#videotag>video").css("height",hei);
				$("#maindiv").css("padding-top","20px");
				$(".navbar *").css("background-color","black");
				$("#srch-term").css("background-color","white");
				$(".navbar").css("border","none");
				$(".navbar-brand").css("color","white");
				$("#navbar-collapse1 *").css("color","white");
				$("#srch-term").css("color","black");
				vari.html("<i class='glyphicon glyphicon-fullscreen' style='color:white;'></i> NormalMode");
			}

			function normalmode(vari) {
				document.cookie = "viewmode=NormalMode";
				$("#idfortheatermode").hide();
				$("#videotag").appendTo("#defaultmode");
				$("#videotag>video").css("width","100%");
				$("#videotag>video").css("height","10%");
				$("#maindiv").css("padding-top","75px");
				$(".navbar *").css("background-color","#003399");
				$(".navbar-brand").css("color","white");
				$("#navbar-collapse1 *").css("color","white");
				vari.html("<i class='glyphicon glyphicon-fullscreen' style='color:white;'></i> TheaterMode");
			}

			if (getCookie('viewmode')=="TheaterMode") {
				theatermode($("#mode"));
			}
			else {
				normalmode($("#mode"));
			}

			$("#mode").click(function() {
				if (this.innerText==" TheaterMode") {
					theatermode($("#mode"));
				}
				else {
					normalmode($("#mode"));
				}
			});

			$("#playvideo").prop('volume',getCookie('volume'));

			$("#playvideo").change(function() {
				document.cookie = "volume="+document.getElementById("playvideo").volume+"";
			});
		});
	</script>
</head>
<body>
	@include('mytube.navbar')

	<!--main-->
	<div id="idfortheatermode"></div>
	<div id="wrap" style="min-height: 650px;padding: 0px 6%;">
		<div class="row">
			<div class="container-fluid" id="maindiv">
				<div class="col-md-12 col-sm-12">
					<div class="row">
						<div class="col-sm-12 col-md-8">
							<div class="panel panel-default">
								<div id="defaultmode">
									<div class="panel-thumbnail" id="videotag">
										<video width="100%" autoplay="true" controls autobuffer src="{{ $url }}/video/{{ encrypt($vid) }}" id="playvideo">
										</video>
									</div>
								</div>
								<div class="panel-body">
									<span type="button" class="btn btn-primary btn-xs pull-right" id="mode">
										<i class="glyphicon glyphicon-fullscreen" style="color:#fff;"></i> TheaterMode
									</span>
									<p class="lead">{{ $video->title }}</p>
									<div class="col-md-8" style="padding:0px;">
											<div class="col-md-2">
												<img class="img-circle" src="{{ $murl }}/user/profile/{{ encrypt($user->id) }}">
											</div>
											<div class="col-md-10">
												<a href="{{ $url }}/channel/{{ encrypt($video->id) }}">
													<h3 id="title">{{ $video->name }}</h3>
												</a>
												@auth
													@if(DB::table('tbl_mytube_favorite')->where(['video_id'=>$vid,'user_id'=>Auth::user()->id])->count()==0)
														<a href="{{ $url }}/admin/favorite/add/{{ encrypt($vid) }}?url={{ encrypt(url()->current()) }}" class="label label-danger">Favorite</a>
													@else
														<a href="{{ $url }}/admin/favorite/remove/{{ encrypt($vid) }}?url={{ encrypt(url()->current()) }}" class="label label-default">Favorited</a>
													@endif
												@endauth
												@guest
													<a href="{{ $url }}/admin/favorite/add/{{ encrypt($vid) }}?url={{ encrypt(url()->current()) }}" class="label label-danger">Favorite</a>
												@endguest
												<a href="{{ $murl }}/download/videos/{{ encrypt($video->url) }}" class="label label-success">Download</a>
												<a href="{{ $url }}/video/convert/{{ encrypt($video->url) }}" class="label label-info" >Mp3Download</a>
											</div>
									</div>	
									<div class="col-md-4" style="padding:0px;">
										<h3 class="text-right" style="border:0px;margin:0px;padding:0px;">{{ cnt('tbl_mytube_viewcount',$vid) }} views</h3>
										<div class="pull-right" style="padding-top:5px;">
											@auth
												@if(DB::table('tbl_mytube_likecount')->where(['video_id'=>$vid,'user_id'=>Auth::user()->id,'status'=>1])->count()!=0)
													<a href="{{ $url }}/video/removelikeunlike/{{ encrypt($vid) }}?url={{ encrypt(url()->current()) }}" class="btn btn-primary btn-sm">
														<span class="glyphicon glyphicon-thumbs-up" style="color: white;"></span> {{ likecnt($vid,'like') }}
													</a>
												@else
													<a href="{{ $url }}/video/like/{{ encrypt($vid) }}?url={{ encrypt(url()->current()) }}" class="btn btn-default btn-sm">
														<span class="glyphicon glyphicon-thumbs-up"></span> {{ likecnt($vid,'like') }}
													</a>
												@endif
											@endauth
											@guest
												<a href="{{ $url }}/video/like/{{ encrypt($vid) }}?url={{ encrypt(url()->current()) }}" class="btn btn-default btn-sm">
													<span class="glyphicon glyphicon-thumbs-up"></span> {{ likecnt($vid,'like') }}
												</a>
											@endguest
											&nbsp;  &nbsp;
											@auth
												@if(DB::table('tbl_mytube_likecount')->where(['video_id'=>$vid,'user_id'=>Auth::user()->id,'status'=>2])->count()!=0)
													<a href="{{ $url }}/video/removelikeunlike/{{ encrypt($vid) }}?url={{ encrypt(url()->current()) }}" class="btn btn-primary btn-sm">
														<span class="glyphicon glyphicon-thumbs-down" style="color: white;"></span> {{ likecnt($vid,'unlike') }}
													</a>
												@else
													<a href="{{ $url }}/video/unlike/{{ encrypt($vid) }}?url={{ encrypt(url()->current()) }}" class="btn btn-default btn-sm">
														<span class="glyphicon glyphicon-thumbs-down"></span> {{ likecnt($vid,'unlike') }}
													</a>
												@endif
											@endauth
											@guest
												<a href="{{ $url }}/video/unlike/{{ encrypt($vid) }}?url={{ encrypt(url()->current()) }}" class="btn btn-default btn-sm">
													<span class="glyphicon glyphicon-thumbs-down"></span> {{ likecnt($vid,'unlike') }}
												</a>
											@endguest

											@auth
												@if(DB::table('tbl_mytube_subscribe')->where(['channel_id'=>$video->id,'user_id'=>Auth::user()->id])->count()==0)
													<a href="{{ $url }}/admin/subscription/subscribe/{{ encrypt($video->id) }}/{{ encrypt(url()->full()) }}" class="btn btn-danger">
														<b>{{ subcnt($video->id) }} Subscribe</b>
													</a>
												@else
													<a href="{{ $url }}/admin/subscription/unsubscribe/{{ encrypt($video->id) }}?url={{ encrypt(url()->full()) }}" class="btn btn-default">
														<b>{{ subcnt($video->id) }} Subscribed</b>
													</a>
												@endif
											@endauth
											@guest
												<a href="{{ $url }}/admin/subscription/subscribe/{{ encrypt($video->id) }}/{{ encrypt(url()->full()) }}" class="btn btn-danger">
													<b>{{ subcnt($video->id) }} Subscribe</b>
												</a>
											@endguest
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-body">
									<h5 style="font-weight:bold;">
										Published on {{ date('d-m-Y', strtotime($video->date)) }}
									</h5>
									{{ $video->description }}
								</div>
							</div>
							<div class="panel panel-default">
								<form action="{{ $url }}/video/postcomment" method="post">
									<div class="panel-body">
										@csrf
										<input type="hidden" name="url" value="{{ encrypt(url()->current()) }}">
										<h5 style="font-weight:bold;">Comments</h5>
										@guest
											<img src="//placehold.it/150x150" class="img-circle pull-left" style="margin-right:14px;">
										@endguest
										@auth
											<img src="{{ $murl }}/user/profile/{{ encrypt(Auth::user()->id) }}" class="img-circle pull-left" style="margin-right:14px;">
										@endauth
										<input type="hidden" name="vid" value="{{ encrypt($vid) }}">
										<textarea name="comment" class="form-control" style="inline-size: auto;width: 90%;" placeholder="Add a public comment..."></textarea>
										<div class="clearfix"></div>
										<div>
											<button class="btn btn-primary pull-right" style="margin:10px;" type="submit" name="submit" value="submit">Post</button>
										</div>
										<br><br>
									</div>
								</form>
								<hr>
								@foreach($comment as $c)
									<div class="row" style="padding: 10px;">
										<div class="col-md-12">
											<div class="col-sm-2" style="width: auto;">
												<img src="{{ $murl }}/user/profile/{{ encrypt($c->user_id) }}" class="img-circle pull-left">
											</div>
											<div class="col-sm-10">
												<a href="#">{{ $c->name }}</a>
												<span style="font-weight:normal;color:#767676;margin-left:5px;"> 
													{{ dateDiff($c->date) }} Days Ago
												</span>
												<br>
												<span>{{ $c->comment }}</span>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
						<!--/video on right sidebar -->  
						<div class = "col-sm-12 col-md-4 nopad">
							<div class="panel panel-default">
								@foreach($videos as $vd)
									<div class="panel-body">
										<img src="{{ $url }}/thumbnail/{{ encrypt($vd->thumbnail) }}" class="img-squre pull-left listimg">
										<a href="{{ $url }}/play/{{ encrypt($vd->vid) }}">
											<h3 id="title">{{ $vd->title }}</h3>
										</a>
										<p id="user">{{ DB::table('tbl_mytube_channel')->where(['id'=>$vd->channel_id])->first()->name }}</p>
										<p id="user">{{ cnt('tbl_mytube_viewcount',$vd->vid) }} views</p>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	@include('mytube.footer')
</body>
</html>