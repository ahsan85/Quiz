<?php
session_start();

$connection= mysqli_connect('localhost','root','root','quizdatabase');

	if(isset($_GET['delete']))
		{
			var_dump($_GET['delete']);
    		mysqli_query($connection, "DELETE FROM answers WHERE question_id=".$_GET['delete']);
    		mysqli_query($connection, "DELETE FROM questions WHERE id=".$_GET['delete']);
           	header('Location: view_questions.php');
		}
  mysqli_close($connection);
?>
