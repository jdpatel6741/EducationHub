<!DOCTYPE html>
@php
	//init variables
	$url = URL::to('/')."/mytube";
	$furl = URL::to('/');

	function cnt($table,$bid)
	{
		return DB::table($table)->where(['book_id'=>$bid])->sum('visits');
	}

	function subcnt($uid)
	{
		return DB::table("tbl_ebooks_subscribe")->where(['user_id'=>$uid])->count();
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
		<title>Ebooks</title>
		<meta name="generator" content="Ebooks" />
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
			operations {
				display: none;
			}
			operations a {
				margin: 2px;
			}
			.cust div{padding: 0px 10px;}
			operations {display: none;}
			operations a {margin: 2px;}
			h2 a {color: black;text-decoration: none;}
			h2 a:hover {color: black;text-decoration: none;}
			h2 a:focus {color: black;text-decoration: none;}
		</style>
		<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/mytube/scripts.js') }}"></script>
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
	</head>
	
	<body>
		<!--Top NavigationBar-->
		@include("ebooks.navbar")

		<!--main-->
		<div id="wrap" style="min-height: 650px;">
			<div class="container" id="main">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class = "row">
							<div class = "col-sm-12 col-md-12 nopad">
								<div class="panel panel-default">
									<div class="panel-heading">
										<img src="{{ route('profile', ['uid' => encrypt($author->id)]) }}" class="img-circle" style="margin-right: 15px;">
										<label>{{ $author->name }}</label>
										<div class="pull-right">
											@auth
												@if(DB::table('tbl_ebooks_subscribe')->where(['user_id'=>$author->id])->count()==0)
													<a href="{{ route('ebooks_author_subscribe', ['uid' => encrypt($author->id),'url' => encrypt(url()->full())]) }}" class="btn btn-danger" style="margin: 8px;font-size: 14px;">
														<b>{{ subcnt($author->id) }} Subscribe</b>
													</a>
												@else
													<a href="{{ route('ebooks_author_unsubscribe', ['uid' => encrypt($author->id),'url' => encrypt(url()->full())]) }}" class="btn btn-default" style="margin: 8px;font-size: 14px;">
														<b>{{ subcnt($author->id) }} Subscribed</b>
													</a>
												@endif
											@endauth
											@guest
												<a href="{{ route('ebooks_author_subscribe', ['uid' => encrypt($author->id),'url' => encrypt(url()->full())]) }}" class="btn btn-danger" style="margin: 8px;font-size: 14px;">
													<b>{{ subcnt($author->id) }} Subscribe</b>
												</a>
											@endguest
										</div>
									</div>
									@if(!isset($books[0]))
										<div class="panel-body">
											Ooops, No Books Found
										</div>
									@endif
									@foreach($books as $book)
									<div class="panel-body">
					                    <div class="col-md-12 main-panel">
					                      <hr>
					                      <div class="col-md-3">
					                        <img src="{{ route('book_thumb', ['filename' => encrypt($book->thumbnail)]) }}" width="100%" alt="">
					                      </div>
					                      <div class="col-md-7">
					                        <h2><a href="{{ route('book_show',encrypt($book->id)) }}" target="_blank">{{ $book->title }}</a></h2>
					                        <h6>
					                          by <a href="{{ route('ebooks_author',['au_id' => encrypt($book->id)]) }}">{{ $book->user->name }}</a>
					                          <i class="counter" style="margin-left: 10px;">{{ $book->viewscount->sum('visits') }} <span class="a-icon-alt"> Views</span></i>
					                        @auth
					                          @if($book->favorite->count()==0)
					                            <a href="{{ route('ebooks_favorite_book',encrypt($book->id)) }}?url={{ encrypt(url()->current()) }}" style="margin-left: 10px;"><i class="glyphicon glyphicon-star"></i></a>
					                          @else
					                            <a href="{{ route('ebooks_remove_favorite_book',encrypt($book->id)) }}?url={{ encrypt(url()->current()) }}" style="margin-left: 10px;"><i class="glyphicon glyphicon-star" style="color: #ffa200;"></i></a>
					                          @endif
					                        @endauth
					                        @guest
					                          <a href="{{ route('ebooks_favorite_book',encrypt($book->id)) }}?url={{ encrypt(url()->current()) }}" style="margin-left: 10px;"><i class="glyphicon glyphicon-star"></i></a>
					                        @endguest
					                        </h6>
					                        <p>{{ $book->description }}</p>
					                      </div>
					                      <operations class="col-md-2">
					                        <a href="{{ route('book_show',encrypt($book->id)) }}" target="_blank" class="btn btn-success form-control">View</a>
					                        <a href="{{ route('book_show',encrypt($book->id)) }}" class="btn btn-primary form-control" download="{{ $book->title }}">Download</a>
					                      </operations>
					                    </div>
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
	</body>
</html>