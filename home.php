<?php
  	include('login1.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Velocity</title>

	<!-- meta data -->
    <meta charset="utf-8">
    <meta name="description" content="Webcup Team Velocity">
  	<meta name="keywords" content="Velocity, Webcup, 2017">
  	<meta name="author" content="TeamVelocity">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end meta data -->

    <!-- CSS libraries -->
    <link rel="stylesheet" href="assets/_css/bootstrap.min.css">
   	<link rel="stylesheet" href="assets/_css/toastr.min.css" />
	<link rel="stylesheet" href="assets/_css/bootstrap-datepicker3.css" />
	<link rel="stylesheet" href="assets/_css/bootstrap-multiselect.css" />
	<link rel="stylesheet" href="assets/_css/velocity.css" />
	<link rel="stylesheet" href="assets/_css/font-awesome.css" />
	

	<!-- JS lib -->
    <script src="assets/_js/jquery.min.js"></script>
    <script src="assets/_js/bootstrap.min.js"></script>
    <script src="assets/_js/toastr.min.js"></script>
  	<script src="assets/_js/bootstrap-multiselect.js"></script>
  	<script src="assets/_js/bootstrap-datepicker.js"></script>
 	

  	<link rel='shortcut icon' href='fav.jpg' type='image/x-icon'/ >

</head>
<body>

	<div class="container-fluid">
		<div class="row text-center">
			<div class="col-md-12">
				<img src="logo.png" width="200" height="200" />
			</div>

		</div>
	</div>
	
	<br /><br />

	<div class="container">
		<div class="row">
		  	<div class="col-md-6 col-md-offset-3">
		      	<div class="panel panel-default">
		        	<div class="panel-heading">Login</div>
		        
		        	<div class="panel-body">
		            	<form method="post" action="">
		    				<div class="form-group">
						      	<label for="usr">Username:</label>
						      	<input type="text" class="form-control" id="usr" name="txtUsername">
		   	 				</div>

		 
		    				<div class="form-group">
		      					<label for="pwd">Password:</label>
		      					<input type="password" class="form-control" id="pwd" name="txtPassword">
		    				</div>

		    				<button type="submit" class="btn btn-primary create_user pull-right" name="submit">Login</button>
		  				</form>
		        	</div>
		      	</div>
		  	</div>
		</div>
	  
	</div>

</body>
</html>


