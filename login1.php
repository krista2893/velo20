<?php
	session_start();
	$errors = '';
	if(isset($_POST['submit']))
	{
		if(empty($_POST['txtUsername']) || empty($_POST['txtPassword']))
		{
			$errors = "Username Or password is empty";
		}
		else
		{
			$uname = $_POST['txtUsername'];
			$password = md5($_POST['txtPassword']);

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "velocity_webcup";


			$conn = new mysqli($servername, $username, $password, $dbname);
			$sql = "SELECT count(*) as count FROM tbl_user WHERE username = '".$uname."' AND password = '" . $password . "'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) 
			{
	    
	    		while($row = $result->fetch_assoc()) 
	    		{
			       	$_SESSION['login_user'] = $uname;
					header("location: profile.php");
			    }
			} 
			else 
			{
			    $errors = "Username or password is invalid";
			}		

		}
	}	

?>
