<?php
include 'includes/app.php';
include 'includes/functions.php';
session_start();
if(!isUserLoggedIn())
{
    echo "404 HTTP Error (Not Found)";
    die();
}

if(isUserHasRole("player"))
{
    echo "You are not allowed to access this file";
    die();
}

  
$connection=mysqli_connect(config('database.server'),config('database.username'),config('database.password'),config('database.name'));
// show all records
$_SESSION['isLoggedIn'] = true;

$sql_record="SELECT * FROM users";
$result=mysqli_query($connection,$sql_record);

if(isset($_POST['add_rec']))
{
  header('Location: add_user.php');
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
     <form method="post">
         <div class="container mt-5">
                <h2>Users Detail<input class="btn btn-primary float-right" type="submit" name="add_rec" value="Add Record" ></h2>
                <hr>
                 <br>
                 <table class="table table-bordered">
                  <thead>
                       <tr>
                    		 <th>User Name</th>
                             <th>Password</th>
                   			 <th>Role</th>
                   			 <th>Edit</th>
                 		     <th>Delete</th>
                       </tr>
                    </thead>
                    <tbody>
                      <?php
                              while ($row = mysqli_fetch_assoc($result)) {
                               ?>  
                               <tr>
                                  <td><?php echo $row['username'];   ?></td>
                                   <td><?php echo $row['password'];   ?></td>
                                  <td><?php echo $row['role'];   ?></td>

                                  <td><a href="edit_user.php?edit=<?php echo $row['id'] ;  ?>">Edit</a></td>
                                   <?php if($_SESSION['loggedInUser']['id']!== $row['id']): ?>
                                  <td><a href="delete_user.php?delete=<?php echo $row['id'] ;  ?>">Delete</a></td>
                                   <?php endif ?>
                                 </tr>
                        <?php
                            }
                      ?>
                    </tbody>
               </table>
         
         </div>
     </form>
</body>
</html>

