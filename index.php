<?php include('session.php'); ?>
<?php require('conn.php'); ?>

<?php
	if(!isset($_SESSION['login_user']))
	{		
		header("Location: home.php");
	}
	else
	{		
		header("Location: profile.php");
	}
	
?>
