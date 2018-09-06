@php
	//init variables
	$url = URL::to('/')."/ebooks/admin";
	$furl = URL::to('/');

	function dateDiff($date)
	{
		$upload_date = new DateTime($date);
		$current_date = new DateTime(date(''));
		$diff = $upload_date->diff($current_date);
		return $diff->format('%a');
	}
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<style type="text/css">
		body{background-color:#f1f1f1;}
		.myhr{margin-top:15px;border-bottom:1px solid #d4d4d6;}
		a * {color: black;}
		a *:hover {color: #444;}
		.cust div{padding: 0px 10px;}
		operations {display: none;}
		operations a {margin: 2px;}
		h2 a {color: black;text-decoration: none;}
		h2 a:hover {color: black;text-decoration: none;}
		h2 a:focus {color: black;text-decoration: none;}
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
						<label style="font-size: 25px;">Favorite Videos</label>
						<div class="row">
						@foreach($favorite as $fav)
							<div class="col-md-12 main-panel">
								<hr>
								<div class="col-md-3">
									<img src="{{ route('book_thumb',encrypt($fav->books->thumbnail)) }}" width="100%" alt="">
								</div>
								<div class="col-md-7">
									<h2>
										<a href="{{ route('book_show',encrypt($fav->books->id)) }}" target="_blank">
				                        {{ $fav->books->title }}</a>
									</h2>
									<h6>
										by <a href="{{ route('ebooks_author',['au_id' => encrypt($fav->user->id)]) }}">{{ $fav->user->name }}</a>
										<i class="counter" style="margin-left: 10px;">{{ $fav->viewscount->sum('visits') }} <span class="a-icon-alt">Views</span></i> <i class="glyphicon glyphicon-star" style="margin-left: 10px;color: #ffea00;"></i>
									</h6>
									<p>{{ $fav->books->description }}</p>
								</div>
								<operations class="col-md-2">
									@if(DB::table('tbl_ebooks_favorite')->where(['book_id'=>$fav->book_id,'user_id'=>Auth::user()->id])->count()!=0)
										<a href="{{ route('ebooks_remove_favorite_book',encrypt($fav->books->id)) }}?url={{ encrypt(url()->current()) }}" class="btn btn-default form-control">Favorited</a>
									@endif
									<a href="{{ route('book_show',encrypt($fav->books->id)) }}" target="_blank" class="btn btn-success form-control">View</a>
									<a href="{{ route('book_show',encrypt($fav->books->id)) }}" class="btn btn-primary form-control" download="{{ $fav->books->title }}">Download</a>
			                	</operations>
							</div>
			            @endforeach
						</div>
					</div>
				</div>
				<div class="clearfix"/></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".main-panel").hover(
				function() {
					$(this).find("operations").show();
				}, function() {
					$(this).find("operations").hide();
				}
			);
		});
    </script>
</body>
</html>