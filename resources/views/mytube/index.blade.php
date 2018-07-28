<!DOCTYPE html>
@php
	//init variables
	$url = URL::to('/')."/mytube";

	function cnt($table,$vid)
	{
		return DB::table($table)->where(['video_id'=>$vid])->sum('visits');
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

		<!--Categories Menu-->
		<div class="navbar-default" id="subnav">
			<div class="col-md-12">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Categories Part-->
				<div class="collapse navbar-collapse" id="navbar-collapse2">
					<ul class="nav navbar-nav">
						<li class="{{ Route::input('cid')==''?'active':'' }}"><a href='{{ $url }}'>General</a></li>
						<?php $cathead = "General"; ?>
						@foreach($category as $key=>$value)
							@if($value->id==Route::input('cid'))
								@php $cathead = $value->name; @endphp
								<li class="active"><a href='#'>{{ $value->name }}</a></li>
							@else
								<li><a href='{{ $url."/".$value->id }}'>{{ $value->name }}</a></li>
							@endif
						@endforeach
					</ul>
				</div>	
			</div>
		</div>

		<!--main-->
		<div id="wrap" style="min-height: 650px;">
			<div class="container" id="main">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class = "row">
							<div class = "col-sm-12 col-md-8 nopad">
								<div class="panel panel-default">
									<div class="panel-heading">
										{{ $cathead }}
									</div>
									<div class="panel-body">
										About {{ $videos->total() }} results
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
											<a href="{{ $url }}/channel/{{ encrypt($value->id) }}">
												<p id="user">{{ $value->name }} <i class="fa fa-circle content"></i> {{ cnt('tbl_mytube_viewcount',$value->vid) }} views <i class="fa fa-circle content"></i> {{ datediff($value->date) }} days ago</p>
											</a>
											<p id="desc">{{ $value->description }}</p>
										</div>
									@endforeach
								</div>
								{{ $videos->links() }}
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