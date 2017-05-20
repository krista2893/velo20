<?php
  require('conn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Claim Registration | Linkham Services</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/_css/linkham.css" />
        <link rel="stylesheet" href="assets/_css/toastr.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="assets/_js/toastr.min.js"></script>
  <link rel='shortcut icon' href='favicon.png' type='image/x-icon'/ >
</head>
<body>
<br /><br />
  <div class="container-fluid">
      <div class="row text-center">
        <div class="col-md-12">
          <img src="logo.PNG" width="260" height="100" />
        </div>
      </div>
    </div>
<br /><br /
<div class="container">
 <div class="row">
  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
        <div class="panel-heading">Create User</div>
        <div class="panel-body">
             <form method="post" action="">
    <div class="form-group">
      <label for="usr">Username:</label>
      <input type="text" class="form-control" id="usr" name="txtUsername">
    </div>

    <div class="form-group">
      <label for="usr">Email:</label>
      <input type="email" class="form-control" id="usr" name="txtEmail">
    </div>

    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="txtPassword">
    </div>

    <button type="submit" class="btn btn-primary create_user pull-right" name="create_user">Create User</button>
  
    <a href="login.php">Already have an account? Login here.</a>
  </form>
        </div>


      </div>
  </div>
</div>
  
</div>



</body>
</html>

<?php
  if(!empty($_POST))
  {
   
    if(isset($_POST['create_user']))
    {

        $uname=$_POST['txtUsername'];
            $em = $_POST['txtEmail'];
            $pwrd = md5($_POST['txtPassword']);
           
            $sql = "INSERT INTO tbl_user (username, email, password)
        VALUES ('$uname', '$em', '$pwrd')";

        if ($conn->query($sql) === TRUE) {
            
            echo "<script>toastr.success('User successfully created.')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
          
      
    }

  }
          
  

?>
