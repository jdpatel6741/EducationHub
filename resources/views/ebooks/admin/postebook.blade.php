@php 
  $url = URL::to('/')."/ebooks/admin";
  $furl = URL::to('/');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Ebooks</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<style>
		body { background-color:#f1f1f1; }
		.grey { color:#767676;font-size:12px; }
		.nopad { padding-left:2px; padding-right:2px; }
		@media screen and (max-width: 699px) and (min-width: 300px) { ul.mytube{ display:none; } }
		.form-control, .btn { border-radius: 0px; }
	</style>
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#bookcoverpage").hide();
			$("#selectcover").click(function () {
				$("#bookcover").click();
			});
			$("#selectbook").click(function () {
				$("#book").click();
			});

			$("#bookcover").change(function (e) {
				$("#cname").show();
				var reader = new FileReader();
			    reader.onload = function(e) {
			      $('#thumbnail').attr('src', e.target.result);
			    }
			    reader.readAsDataURL(e.target.files[0]);
				$("#bookcoverpage").show();
			});
			$("#book").change(function (e) {
				$("#bname").show();
				$("#BookName").html(e.target.files[0].name);
			});

			var req = null;
			$("#submit").click(function(e){
				$(this).prop('disabled','true');
				var started_at = new Date();
				var uploaded_size = $("#complete");
				var tot = $("#total");
				var uploadspeed = $("#speed");
				var per = $("#percent");
				var formData = new FormData($("#videodata")[0]);
				req = $.ajax({
					url: 'postebook/post',
					type: 'POST',
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					beforeSend : function() {
						$("#progressbar").show();
						per.text('0%');
		            },
		            xhr : function () {
		            	var xhr = $.ajaxSettings.xhr();
		            	xhr.upload.addEventListener('progress', function(event) {
		                    var percent = 0;
		                    var position = event.loaded || event.position;
		                    var total = event.total;
		                    tot.text(((total/1024)/1024).toFixed(2)+"MB");
		                    if (event.lengthComputable) {
		                        uploaded_size.text((position/1048576).toFixed(2)+"MB");
		                    	percent = Math.ceil(position / total * 100);
		                        var seconds_elapsed =   ( new Date().getTime() - started_at.getTime() )/1000;
		                        var bytes_per_second =  seconds_elapsed ? position / seconds_elapsed : 0 ;
		                        var Kbytes_per_second = Math.round(bytes_per_second / 1000);
		                        if (Kbytes_per_second<1024) {
		                            uploadspeed.text(Kbytes_per_second+"KB");
		                        }
		                        else {
		                            uploadspeed.text((Kbytes_per_second/1024).toFixed(2)+"MB");
		                        }
		                        var remaining_bytes = total - position;
		                        var seconds_remaining = seconds_elapsed ? remaining_bytes / bytes_per_second : 'calculating' ;
		                        $("#second_remaining").text(convertTime(seconds_remaining));
		                    }
		                    $("#progress").css('width',percent+"%");
		                    per.html(percent+"%");
		            	}, true);
		            	return xhr;
		            },
					success: function (returndata) {
						$("#progressbar").fadeOut(5000);
						$("#msg").html(returndata);
						if (returndata=="<div class='alert alert-success'>successfully video uploaded</div>") {
							$("#reset").click();
						}
					}
				});
				$(this).removeAttr('disabled');
			});

			$("#cancelupload").click(function () {
				if (req != null) {
					req.abort();
					$("#progressbar").fadeOut(5000);
				}
			});

			function convertTime(sec) {
			    var hours = Math.floor(sec/3600);
			    (hours >= 1) ? sec = sec - (hours*3600) : hours = '00';
			    var min = Math.floor(sec/60);
			    (min >= 1) ? sec = sec - (min*60) : min = '00';
			    (sec < 1) ? sec='00' : void 0;
			    (min.toString().length == 1) ? min = '0'+min : void 0;
			    (sec.toString().length == 1) ? sec = '0'+sec : void 0;
			    return Math.round(hours)+' hours '+Math.round(min)+' minutes '+Math.round(sec)+' seconds left';
			}
		});
	</script>
</head>
<body>
	<!--Top NavigationBar-->
    @include('ebooks.navbar')
	@include('ebooks.admin.menu')

	<div id="wrap" style="min-height: 680px;">
		<div class="container" id="main">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class = "row" style="background-color:#fff;padding:20px;">
						<fieldset>
							<legend>Publish Ebook</legend>
							<div id="msg"></div>
							<div class="col-md-12" id="progressbar" style="display: none;">
								<div class="progress">
									<div class="progress-bar progress-bar-info progress-bar-striped active" style="width: 0%;" id="progress">
										<label id="percent">0%</label>
									</div>
								</div>
								<div class="col-md-1 pull-right">
									<button id="cancelupload" class="btn btn-danger btn-xs">cancel</button>
								</div>
								<div class="col-md-5 pull-right">
									<label id="second_remaining">0</label>
								</div>
								<div class="col-md-2 pull-right">
									<label id="speed">0</label>
									<label> /Sec</label>
								</div>
								<div class="col-md-3 pull-right">
									<label id="complete">0</label>
									/
									<label id="total">0</label>
								</div>
							</div>

							<form id="videodata" enctype="multipart/form-data" method="POST">
								@csrf
								<div class='col-sm-3'>
									<div class='form-group'>
										<label>Select Book Coverpage</label>
										<br>
										<button type="button" class="btn btn-info" id="selectcover">Select</button>
										<input class="hide" type="file" name="coverimage" id="bookcover" accept="image">
									</div>
									<br>
									<div class='form-group' id="bookcoverpage">
										<label for="user_title">Book Coverpage</label>
										<img src="" alt="thumbnail" id="thumbnail" style="width: 100%;">
									</div>
									<br>
									<div class='form-group'>
										<label>Select Book</label>
										<br>
										<button type="button" class="btn btn-info" id="selectbook">Select Book</button>
										<input class="hide" type="file" name="book" id="book" accept="image">
									</div>
									<div class='form-group' id="bname" style="display: none;">
										<label>Book Name</label>
										<br>
										<span id="BookName"></span>
									</div>
								</div>
								<div class='col-sm-9'>
									<div class='col-sm-8'>
										<div class='form-group'>
											<label for="title">Title</label>
											<input class="form-control" id="title" name="title" required="true" size="30" type="text" value=""/>
										</div>
										<div class='form-group'>
											<label for="title">Description</label>
											<textarea class="form-control" name="description" required="true"></textarea>
										</div>
										<div class="pull-left">
											<button id="submit" type="button" name="submit" value="submit" class="btn btn-primary">Publish</button>
											<button type="reset" class="btn btn-danger" id="reset">Reset</button>
										</div>
									</div>
									<div class='col-sm-4'>
										<div class='form-group'>
											<label for="title">Categories</label>
											<select class="form-control" name="category_id" id="sel1">
												@foreach($category as $value)
													<option value="{{ encrypt($value->id) }}">{{ $value->name }}</option>
												@endforeach
											</select>
										</div>
										<div class='form-group'>
											<label for="title">Privacy</label>
											<select class="form-control" name="privacy"  id="sel1">
												<option value="public">public</option>
												<option value="private">private</option>
											</select>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</body>
</html>