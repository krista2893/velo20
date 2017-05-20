<?php	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "velocity_webcup";

	

	$conn = new mysqli($servername, $username, $password, $dbname);
	session_start();

	$user_check=$_SESSION['login_user'];

	$sql = "select username from tbl_user where username = '".$user_check."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $row['username'];
        	$login_session = $row['username'];
    	}
	}
	if(!isset($login_session))
	{
		$conn->close();
		header('Location: index.php');
	}
?>