<?php
session_start();
 $connection=mysqli_connect("localhost","root","root","quizdatabase");

 $name=''; 
 $pwd='';
 $role='';
 $id=0;

if(isset($_GET['edit'])) {

	
      $id=$_GET['edit'];
      $get_result="SELECT * FROM users WHERE id=$id";
      $sql= mysqli_query($connection,$get_result);
      $_row=mysqli_fetch_assoc($sql);
   	  $name=$_row['username'];
      $pwd=$_row['password'];
      $role=$_row['role'];

}

if (isset($_POST['update'])) {

	$name=$_POST['username'];
	$pwd=$_POST['password'];
	$role=$_POST['role'];
  
	$update_result="UPDATE  users SET username='$name',password='$pwd',role='$role' WHERE id=$id";
    mysqli_query($connection,$update_result);
    header('Location: admin_user_detail_view.php');
     
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
                 		<input type="hidden" name="id" value=" <?php echo $id ?>">
                 		<div class="form-group">
                 				<input type="text" name="username" class="form-control" placeholder="Enter user name here"  value=" <?php echo $name ?>">
                 		</div>

                 		<div class="form-group">
                 				<input type="text" name="password" class="form-control" placeholder="Enter your email here"  value=" <?php echo $pwd ?>">
                 		</div>
                 
                 		<div class="form-group">
                 				<input type="text" name="role" class="form-control" placeholder="Enter your role"  value=" <?php echo $role ?>">
                 		</div>
                    
                    	<button type="submit" class="btn btn-primary" name="update">update record</button>
                     
                  </form>
          </div>
</body>
</html>
