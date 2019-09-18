<?php
session_start();

$connection=mysqli_connect('localhost','root','root','quizdatabase');
 
if(isset($_POST['submit1']))
{ 

  if (!empty($_POST['username'] && $_POST['password']  && $_POST['role'])) {
    	// $_name = $_POST['username'];
  	$_name = mysqli_real_escape_string($connection, $_POST['username']);
    $pwd = mysqli_real_escape_string($connection, $_POST['password']);
		$user_role = mysqli_real_escape_string($connection, $_POST['role']);     
		$sql_insert_data="INSERT  INTO users (username,password, role) VALUES ('$_name','$pwd','$user_role')";
		
		if(mysqli_query($connection,$sql_insert_data)){
	   	  header('Location: admin_user_detail_view.php');
		} else {
    			echo "ERROR: Could not able to execute $sql_insert_data." . mysqli_error($connection);
		}
  } else
 	 {  
 	  echo "Please Fill All Field";   	
 	 }
}
  mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title>crud</title>
</head>
<body>
    	   <div class="container mt-5">
            	  <h4>Insert Record</h4>
            	  <hr>
                  <form action="" method="post" class="form">
                 		
                 		<div class="form-group">
                 				<input type="text" name="username" class="form-control" placeholder="Enter user name here">
                 		</div>
                    <div class="form-group">
                        <input type="text" name="password" class="form-control" placeholder="Enter password">
                    </div>
                    
                 		<div class="form-group">
                 				<input type="text" name="role" class="form-control" placeholder="Enter your role">
                 		</div>
                    
                    	<button type="submit" class="btn btn-primary" name="submit1">Save record</button>
                     
                  </form>
          </div>
</body>
</html>
