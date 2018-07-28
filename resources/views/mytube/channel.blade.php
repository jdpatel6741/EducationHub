<!DOCTYPE html>
@php
	//init variables
	$url = URL::to('/')."/mytube";
	$murl = URL::to('/');

	function cnt($table,$vid)
	{
		return DB::table($table)->where(['video_id'=>$vid])->sum('visits');
	}

	function subcnt($cid)
	{
		return DB::table("tbl_mytube_subscribe")->where(['channel_id'=>$cid])->count();
	}

	function dateDiff($date)
	{
		$upload_date = new DateTime($date);
		$current_date = new DateTime(date(''));
		$diff = $upload_date->diff($current_date);
		return $diff->format('%a');
	}
@endphp
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>MyTube</title>
		<meta name="generator" content="mytube" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="{{ asset('css/styles.css') }}">		
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('icon/css/font-awesome.min.css') }}">
		<style>
			body
			{
				background-color:#f1f1f1;
			}
			.content {
				font-size: 5px;margin-top: -3px;vertical-align: middle;padding: 0px 3px;
			}
		</style>
		<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/mytube/scripts.js') }}"></script>
	</head>
	
	<body>
		<!--Top NavigationBar-->
		@include("mytube.navbar")

		<!--main-->
		<div id="wrap" style="min-height: 650px;">
			<div class="container" id="main">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class = "row">
							<div class = "col-sm-12 col-md-8 nopad">
								<div class="panel panel-default">
									<div class="panel-heading">
										<img src="{{ $murl }}/user/profile/{{ encrypt($channel->user_id) }}" class="img-circle" style="margin-right: 15px;">
										<label>{{ $channel->name }}</label>
										<div class="pull-right">
											@auth
												@if(DB::table('tbl_mytube_subscribe')->where(['channel_id'=>$channel->id,'user_id'=>Auth::user()->id])->count()==0)
													<a href="{{ $url }}/admin/subscription/subscribe/{{ encrypt($channel->id) }}/{{ encrypt(url()->full()) }}" class="btn btn-danger" style="margin: 8px;font-size: 14px;">
														<b>{{ subcnt($channel->id) }} Subscribe</b>
													</a>
												@else
													<a href="{{ $url }}/admin/subscription/unsubscribe/{{ encrypt($channel->id) }}?url={{ encrypt(url()->full()) }}" class="btn btn-default" style="margin: 8px;font-size: 14px;">
														<b>{{ subcnt($channel->id) }} Subscribed</b>
													</a>
												@endif
											@endauth
											@guest
												<a href="{{ $url }}/admin/subscription/subscribe/{{ encrypt($channel->id) }}/{{ encrypt(url()->full()) }}" class="btn btn-danger" style="margin: 8px;font-size: 14px;">
													<b>{{ subcnt($channel->id) }} Subscribe</b>
												</a>
											@endguest
										</div>
									</div>
									@if(!isset($videos[0]))
										<div class="panel-body">
											Ooops, No Videos Found
										</div>
									@endif
									@foreach($videos as $key=>$value)
										<div class="panel-body">
											<img src="{{ $url }}/thumbnail/{{ encrypt($value->thumbnail) }}" class="img-squre pull-left listimg">
											<a href="{{ $url }}/play/{{ encrypt($value->vid) }}">
												<h3 id="title">{{ $value->title }}</h3>
											</a>
											<a href="#">
												<p id="user">{{ $value->name }} <i class="fa fa-circle content"></i> {{ cnt('tbl_mytube_viewcount',$value->vid) }} views <i class="fa fa-circle content"></i> {{ datediff($value->date) }} days ago</p>
											</a>
											<p id="desc">{{ $value->description }}</p>
										</div>
									@endforeach
								</div>
							</div>				   
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<hr>
		@include('mytube.footer')
	</body>
</html>