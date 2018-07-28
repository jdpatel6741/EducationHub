@php
	$url = URL::to('/')."/sourcecode";
	$murl = URL::to('/');
@endphp
<html>
	<head>
		<meta name="generator" content="sourcecode" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/sourcecode/inline-style.css') }}">
		<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				function getParameter(theParameter) { 
					var params = window.location.search.substr(1).split('&');
					for (var i = 0; i < params.length; i++) {
						var p=params[i].split('=');
						if (p[0] == theParameter) {
							return decodeURIComponent(p[1]);
						}
					}
					return false;
				}

				var par = getParameter("tab");
				var overview = true;
				if (par!=false) {
					$("#navbar>a").each(function() {
						if($(this).attr("title").toLowerCase()==par.toLowerCase()) {
							$(this).addClass("selected");
							$.ajax({
								type: "get",
								url: "{{ $url }}/jd/tab",
								data: {'tab':par.toLowerCase()},
								success: function (data) {
									$(par.toLowerCase()).html(data);
								}
							});
							$(par.toLowerCase()).show();
							overview = false;
						}
					});
				}
				if (overview==true || getParameter("tab")==false) {
					$("#navbar>a:first").addClass("selected");
					$.ajax({
						type: "get",
						url: "{{ $url }}/jd/tab",
						data: {'tab':'overview'},
						success: function (data) {
							$("overview").html(data);
						}
					});
					$("overview").show();
				}
			});
		</script>
	</head>

	<body>
		@include('sourcecode.header')
		<br>
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="row">
						<div class="col-md-12">
							<img src="http://via.placeholder.com/260" style="border-radius: 10px;">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<span class="full-uname">JD PATEL</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<span class="uname">jd95588</span>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-md-12">
							<span class="text">
								<svg viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M16 12.999c0 .439-.45 1-1 1H7.995c-.539 0-.994-.447-.995-.999H1c-.54 0-1-.561-1-1 0-2.634 3-4 3-4s.229-.409 0-1c-.841-.621-1.058-.59-1-3 .058-2.419 1.367-3 2.5-3s2.442.58 2.5 3c.058 2.41-.159 2.379-1 3-.229.59 0 1 0 1s1.549.711 2.42 2.088C9.196 9.369 10 8.999 10 8.999s.229-.409 0-1c-.841-.62-1.058-.59-1-3 .058-2.419 1.367-3 2.5-3s2.437.581 2.495 3c.059 2.41-.158 2.38-1 3-.229.59 0 1 0 1s3.005 1.366 3.005 4z"></path></svg> educationhub
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<span class="text">
								<svg viewBox="0 0 12 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 0C2.69 0 0 2.5 0 5.5 0 10.02 6 16 6 16s6-5.98 6-10.5C12 2.5 9.31 0 6 0zm0 14.55C4.14 12.52 1 8.44 1 5.5 1 3.02 3.25 1 6 1c1.34 0 2.61.48 3.56 1.36.92.86 1.44 1.97 1.44 3.14 0 2.94-3.14 7.02-5 9.05zM8 5.5c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"></path></svg> gujarat,india
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<span class="text">
								<svg viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg> <a>jd95588</a>
							</span>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="panel-body" style="padding: 0px;">
							<span class="list-group-item"><a>New</a></span>
							<span class="list-group-item"><a>Deleted</a></span>
							<span class="list-group-item"><a>Warnings</a></span>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<div class="UnderlineNav user-profile-nav js-sticky top-0">
								<nav class="UnderlineNav-body" id="navbar" data-pjax="" role="navigation">
									<a href="{{ $url }}/jd" class="UnderlineNav-item" title="Overview">
										Overview
									</a>
									<a href="?tab=repositories" class="UnderlineNav-item" title="Repositories">
										Repositories <span class="Counter">4</span>
									</a>
									<a href="?tab=stars" class="UnderlineNav-item" title="Stars">
										Stars <span class="Counter">0</span>
									</a>
									<a href="?tab=followers" class="UnderlineNav-item" title="Followers">
										Followers <span class="Counter">0</span>
									</a>
									<a href="?tab=following" class="UnderlineNav-item" title="Following">
										Following <span class="Counter">0</span>
									</a>
								</nav>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 hid-inner">
							<overview></overview>
							<repositories></repositories>
							<stars></stars>
							<followers></followers>
							<following></following>
						</div>
					</div>

				</div>
			</div>
		@include('sourcecode.footer')
		</div>
	</body>
</html>