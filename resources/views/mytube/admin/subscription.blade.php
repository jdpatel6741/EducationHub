@php
	//init variables
	$url = URL::to('/')."/mytube";
	$furl = URL::to('/');
	$subscription = $data['subscription'];

  	function cnt($table,$id)
	{
		return DB::table($table)->where(['channel_id'=>$id])->count();
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
		body{background-color:#f1f1f1;}
		.myhr{margin-top:15px;border-bottom:1px solid #d4d4d6;}
		a * {color: black;}
		a *:hover {color: #444;}
		.cust div{padding: 0px 10px;}
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
						<h3>Subscribed Channels</h3>
						<div class="row">
						@foreach($subscription as $sub)
							<a href="{{ $url }}/channel/{{ encrypt($sub->channel_id) }}" target="_blank">
								<div class="col-md-2">
									<div class="row cust">
										<div class="col-md-12">
											<img class="img-responsive"  src="{{ $furl }}/user/profile/{{ encrypt($sub->id) }}" width="100%">
										</div>
										<div class="col-md-12">
											<label style="max-height: 40px;overflow: hidden;">{{ $sub->cname }}</label>
										</div>
										<div class="col-md-12">
											<span>{{ cnt('tbl_mytube_subscribe',$sub->channel_id) }} Views</span>
											<a href="{{ $url }}/admin/subscription/unsubscribe/{{ encrypt($sub->channel_id) }}" class="btn btn-danger btn-xs">Unsubscribe</a>
										</div>
									</div>
								</div>
							</a>
						@endforeach
						</div>
					</div>
				</div>
				<div class="clearfix"/></div>
			</div>
		</div>
	</div>
	<hr>
	@include("mytube.footer")
</body>
</html>