<?php
include 'includes/app.php';
include 'includes/functions.php';
session_start();
if(!isUserLoggedIn())
{
	echo "404 HTTP Error (Not Found)";
	die();
}

if(isUserHasRole("player")) {
	echo "You are not allowed to access this file";
	die();
}
$connection =  mysqli_connect(config('database.server'),config('database.username'),config('database.password'),config('database.name'));


	if(isset($_GET['delete']))
		{
			var_dump($_GET['delete']);
    		mysqli_query($connection, "DELETE FROM answers WHERE question_id=".$_GET['delete']);
    		mysqli_query($connection, "DELETE FROM questions WHERE id=".$_GET['delete']);
           	header('Location: view_questions.php');
		}
  mysqli_close($connection);
?>
