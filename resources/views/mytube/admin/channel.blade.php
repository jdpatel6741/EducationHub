@php
	//init variables
	$url = URL::to('/')."/mytube";
	$furl = URL::to('/');
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
	<script type="text/javascript">
		$(document).ready(function () {
			$("#add").click(function () {
				$.ajax({
					type: "get",
					url: "{{ $url }}/admin/channel/add/"+$('#name').val(),
					success: function () {
						location.reload();
					}
				});
			});
			
			$("editbtn").click(function() {
				if ($(this).html()=="Edit") {
					$(this).parent().parent().find("#channelname").show();
					$(this).parent().parent().find("channelname").hide();
					$(this).parent().find("cancelbtn").show();
					$(this).html("Save");
					$(this).attr('class','btn btn-xs btn-success');
					$(this).attr('id','savebtn');
				}
				else {
					var value = $(this).parent().parent().find("#channelname").val();
					$(this).parent().parent().find("#channelname").hide();
					$(this).parent().find("cancelbtn").hide();
					$(this).parent().parent().find("channelname").show();
					$(this).parent().parent().find("channelname").html(value);
					$(this).html("Edit");
					$(this).attr('class','btn btn-xs btn-info');
					$(this).removeAttr('id');
					$.ajax({
						url: "{{ $url }}/admin/channel/edit/"+$(this).parent().find("channelid").html()+"/"+value,
						type: "get"
					});
				}
			});

			$("cancelbtn").click(function () {
				$(this).parent().parent().find("#channelname").hide();
				$(this).parent().parent().find("channelname").show();
				$(this).parent().parent().find("#channelname").val($(this).parent().parent().find("channelname").html());
				$(this).parent().find("editbtn").html("Edit");
				$(this).parent().find("editbtn").attr('class','btn btn-xs btn-info');
				$(this).parent().find("editbtn").removeAttr('id');
				$(this).hide();
			});
		});
	</script>
	<style>
	body
	{
		background-color:#f1f1f1;
	}
	.grey
	{
		color:#767676;
		font-size:12px;
	}
	.nopad
	{
		padding-left:2px;
		padding-right:2px;
	}
	@media screen and (max-width: 699px) and (min-width: 300px)
	{
		ul.mytube{
			display:none;
		}
	}
	.form-control, .btn
	{
		border-radius: 0px;			
	}
</style>
</head>
<body>
	@include('mytube.admin.navbar')
	@include('mytube.admin.menu')
	<div id="wrap" style="min-height: 610px;">
		<div class="container" id="main">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class = "row" style="background-color:#fff;padding:20px;height: 480px;">
						<legend>Channels</legend>
						<div class='row'>
							<div class='col-sm-3'>    
								<fieldset>
									<div class='form-group'>
										<label for="basic-url">New Channel</label>
										<input class="form-control" id="name" required="true" type="text" />
									</div>
									<div class='form-group'>
										<div class="pull-left">
											<button type="button" class="btn btn-primary" id="add">Add</button>
										</div>
									</div>
								</fieldset>
							</div>
							<div class='col-sm-9'>
								<table class="table table-hover table-responsive table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Staus</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($channel as $value)
										<tr>
											<td>
												<input type="text" class="form-control" value="{{ $value->name }}" id="channelname" style="display: none;">
												<channelname>{{ $value->name }}</channelname>
											</td>
											<td>{{ $value->status==1?"active":"deactive" }}</td>
											<td>
												@php
													echo $value->status==1?"<a href='".$url."/admin/channel/deactive/".encrypt($value->id)."' class='btn btn-warning btn-xs'>Deactive</a>":"<a href='".$url."/admin/channel/active/".encrypt($value->id)."' class='btn btn-success btn-xs'>Active</a>";
												@endphp
												<editbtn class="btn btn-info btn-xs">Edit</editbtn>
												<cancelbtn class="btn btn-default btn-xs" style="display: none;">cancel</cancelbtn>
												<a href="{{ $url }}/admin/channel/delete/{{ encrypt($value->id) }}" class="btn btn-danger btn-xs">Delete</a>
												<channelid class="hidden">{{ encrypt($value->id) }}</channelid>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"/></div>
		</div>
	</div>
	<hr>
	@include("mytube.footer")
</body>
</html>