<?php
include 'includes/app.php';
include 'includes/functions.php';
session_start();

if (!isUserLoggedIn()) {
    echo "404 HTTP Error (Not Found)";
    die();
}
if (isUserHasRole("player")) {
    echo "You are not allowed to access this file";
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>admin view</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container col-lg-8">
    <div class="mt-5">
        <h1>
            Dashboard
        </h1>
        <hr>
    </div>
    <div class="float-right mt-3">
        <a href="admin_user_detail_view.php" title="view user">
            <img src="images/view_user.png" class="  img-fluid ">
        </a>
    </div>
    <div class="float-left">
        <a href="main.php" title="Question and answer">
            <img src="images/question&ans.jpg" class="img-fluid">
        </a>
    </div>
</div>

</body>
</html>