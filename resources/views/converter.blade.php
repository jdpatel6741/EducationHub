@php
	$url = URL::to('/');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>converter - Education Hub</title>
	<meta name="generator" content="mytube" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="http:css/bootstrap.min.css">
	<style>
		body
		{
			background-color:#f1f1f1;
			height: 100%;
		}
		.container {
			margin-top: 5%;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class = "row" style="background-color:#fff;padding:20px;height: 550px;">
					<fieldset>
						<form method="post" action="{{ $url }}/convert" enctype="multipart/form-data">
							<legend>Converter</legend>
							@csrf
							<div class='row'>
								<div class='col-md-12'>
									<div class='form-group'>
										<label>Select File</label>
										<input type="file" name="sourcefile">
									</div>
									<div class='form-group'>
										<label>Select Output Type</label>
										<select name="type" class="form-control">
											<option value="{{ encrypt('mp3') }}">Mp3</option>
										</select>
									</div>
									<div class='form-group'>
										<button class="btn btn-info">Convert</button>
									</div>
								</div>
							</div>
						</form>
					</fieldset>
				</div>		
			</div>
		</div>  	
	</div>
</body>
</html>