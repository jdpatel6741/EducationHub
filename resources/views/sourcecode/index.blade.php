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
					<img src="http://www.logoopenstock.com/media/users/693/64839/raw/aa71e3b81f378c7e71e4191b89f5edae-android-vector-logo.jpg" style="border-radius: 10px;width:260px;height: 260px;">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
					<span class="full-uname">Android</span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
					<div class="panel-body" style="padding: 0px;">
						<span class="list-group-item"><a>Android</a></span>
						<span class="list-group-item"><a>PHP</a></span>
						<span class="list-group-item"><a>HTML</a></span>
						<span class="list-group-item"><a>CSS</a></span>
						<span class="list-group-item"><a>JS</a></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<div class="UnderlineNav user-profile-nav js-sticky top-0">
						<nav class="UnderlineNav-body" id="navbar" data-pjax="" role="navigation">

							<a href="?tab=repositories" class="UnderlineNav-item" title="Repositories">
								Repositories <span class="Counter">4</span>
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