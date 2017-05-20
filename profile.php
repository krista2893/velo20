<?php
  include('session.php');
?>

<?php
  require('conn.php');
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
  	
  

  	<div id="myNav" class="overlay">
  		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  	
		<div class="overlay-content">
		    <a href="profile.php">Home</a>
		    <a href="#">About</a>
		    <a href="#">Services</a>
		    <a href="logout.php">Logout</a>
		</div>

	</div>

	<br />
	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&nbsp;&nbsp;<i class="fa fa-bars" aria-hidden="true"></i></span>

	<div class="container-fluid">
		<div class="row text-center">
			<div class="col-md-12">
				<img src="logo.png" width="200" height="200" />
				<br />
				<h3>Coming Soon...</h3> <br /><br />
				<p id="demo" style="font-size:30px"></p>
			</div>

		</div>
	</div>


	

	
	<script>
		// Set the date we're counting down to
		var countDownDate = new Date("May 20, 2017 12:00:00").getTime();

		// Update the count down every 1 second
		var countdownfunction = setInterval(function() {

		    // Get todays date and time
		    var now = new Date().getTime();
		    	
		    // Find the distance between now an the count down date
		    var distance = countDownDate - now;
		    
		    // Time calculations for days, hours, minutes and seconds
		    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		    
		    // Output the result in an element with id="demo"
		    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
		    + minutes + "m " + seconds + "s ";
		    
		    // If the count down is over, write some text 
		    if (distance < 0) {
		        clearInterval(countdownfunction);
		        document.getElementById("demo").innerHTML = "EXPIRED";
		    }
		}, 1000);
	</script>

	<script src="assets/_js/velocity.js"></script>

	
</body>
</html>

