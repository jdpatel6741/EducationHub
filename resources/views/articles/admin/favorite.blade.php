<!DOCTYPE html>
<html lang="en">
<head>
	<style type="text/css">
		.myhr{margin-top:15px;border-bottom:1px solid #d4d4d6;}
		a * {color: black;}
		a *:hover {color: #444;}
		.cust div{padding: 0px 10px;}
		h2 a {color: black;text-decoration: none;}
		h2 a:hover {color: black;text-decoration: none;}
		h2 a:focus {color: black;text-decoration: none;}
	</style>
</head>
<body>
	@include('articles.navbar')
	@include('articles.admin.menu')

	<div id="wrap" style="min-height: 610px;">
		<div class="container" id="main">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="row" style="background-color:#fff;padding: 20px;">
						<label style="font-size: 25px;">Favorite articles</label>
						<div class="row">
						@foreach($favorite as $fav)
							<div class="col-md-12 main-panel">
								<div class="col-md-9">
									<h4 style="border: none;">
										<a href="{{ route('articles_index',['subject_id'=>encrypt($fav->article->sid),'article_id'=>encrypt($fav->article->id)]) }}">
				                        	{{ $fav->article->topic }}
				                    	</a>
									</h4>
								</div>
								<div class="col-md-3">
									<a href="{{ route('articles_article_removefavorite',encrypt($fav->article_id)) }}?url={{ encrypt(route(Route::currentRouteName())) }}" class="btn btn-danger btn-xs">Remove</a>
								</div>
							</div>
			            @endforeach
						</div>
					</div>
				</div>
				<div class="clearfix"/></div>
			</div>
		</div>
	</div>
</body>
</html>