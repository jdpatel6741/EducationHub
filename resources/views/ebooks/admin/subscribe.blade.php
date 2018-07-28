@php 
  $url = URL::to('/')."/ebooks/admin";
  $furl = URL::to('/');
@endphp

    <!--Top NavigationBar-->
    @include('ebooks.navbar')
	@include('ebooks.admin.menu')

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
	<style type="text/css">
		body{background-color:#f1f1f1;}
		.myhr{margin-top:15px;border-bottom:1px solid #d4d4d6;}
		a * {color: black;}
		a *:hover {color: #444;}
		.cust div{padding: 0px 10px;}
	</style>
</head>
<body>
	@include('ebooks.navbar')
	@include('ebooks.admin.menu')
	<div id="wrap" style="min-height: 610px;">
		<div class="container" id="main">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="row" style="background-color:#fff;padding: 20px;">
						<h3>Subscribed Authors</h3>
						<div class="row">
						@foreach($subscription as $sub)
							<a href="{{ route('ebooks_author',encrypt($sub->user_id)) }}" target="_blank">
								<div class="col-md-2">
									<div class="row cust">
										<div class="col-md-12">
											<img class="img-responsive"  src="{{ route('profile',encrypt($sub->user->id)) }}" width="100%">
										</div>
										<div class="col-md-12">
											<label style="max-height: 40px;overflow: hidden;">{{ $sub->user->name }}</label>
										</div>
										<div class="col-md-12">
											<a href="{{ route('ebooks_author_unsubscribe', ['uid' => encrypt($sub->user_id),'url' => encrypt(url()->full())]) }}" class="btn btn-danger form-control">Unsubscribe</a>
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
</body>
</html>