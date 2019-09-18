<?php
session_start();

$connection=mysqli_connect('localhost','root','root','quizdatabase');

	if(isset($_GET['delete']))
		{
    		mysqli_query($connection, "DELETE FROM users WHERE id=".$_GET['delete']);
    		header('Location: admin_user_detail_view.php');
		}
  mysqli_close($connection);
?>