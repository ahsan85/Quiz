<?php
include 'includes/app.php';
include 'includes/functions.php';

session_start();

$_SESSION['errors'] = [];
$_SESSION['config'] = $config;

if (isUserLoggedIn()) {

    if ($_SESSION['loggedInUser']['role'] == 'admin') {
        header('Location: admin_view.php');
    } else if ($_SESSION['loggedInUser']['role'] == 'player') {
        header('Location:main.php');
    }

}


if (isset($_POST['login'])) {

    if (isset($_POST['playerName']) && isset($_POST['pwd'])) {
        $connection = mysqli_connect(config('database.server'), config('database.username'), config('database.password'), config('database.name'));
        $name = $_POST['playerName'];
        $pwd = $_POST['pwd'];
        $sql_q = "SELECT * FROM users WHERE username='$name' and password='$pwd' ";
        $query = mysqli_query($connection, $sql_q);


        $row = mysqli_fetch_assoc($query);

        if (!empty($row)) {

            $_SESSION['isLoggedIn'] = true;
            $_SESSION['loggedInUser'] = $row;


            if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
                if ($row['role'] == 'admin') {
                    header('Location: admin_view.php');
                } else if ($row['role'] == 'player') {
                    header('Location:main.php');
                }
            }
        } else {

            $_SESSION['isLoggedIn'] = false;
            $_SESSION['errors']['password'] = "Invalid username and password !";


        }


        mysqli_close($connection);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Quiz Game</title>
</head>
<style>
    body {
        background: whitesmoke;
    }

    div.row {
        height: 100vh !important;

    }

    @keyframes loginSectionKeyframe {
        0% {
            right: 0%;

        }


        100% {
            right: 50%;

        }

    }

    @keyframes helloSectionKeyframe {
        0% {
            left: 0%;
        }

        100% {
            left: 50%;
        }

    }

    #divLoginSection {
        background: white;
        position: relative;
        animation: loginSectionKeyframe 1s;
        animation-fill-mode: forwards;
    }

    #divHelloSection {
        background: linear-gradient(90deg, rgba(2, 0, 36, 0.5774509632954745) 0%, rgba(9, 9, 121, 1) 0%, rgba(61, 103, 136, 1) 0%, rgba(130, 148, 158, 1) 32%);
        position: relative;
        animation: helloSectionKeyframe 1s;
        animation-fill-mode: forwards;
    }

    @media (min-width: 0px) and (max-width: 761px) {

        #divHelloSection,
        #divLoginSection {
            animation: normal;
        }
    }

    div.main-div {
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease-in-out;
    }

    div.main-div:hover {
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.3);
    }

    h1 {
        font-size: 72px;
        background: rgb(125, 162, 108);
        background: linear-gradient(90deg, rgba(125, 162, 108, 1) 0%, rgba(121, 161, 91, 1) 15%, rgba(71, 187, 47, 1) 45%, rgba(117, 138, 97, 1) 72%, rgba(11, 9, 9, 0.717506985704438) 100%, rgba(113, 171, 99, 1) 100%);
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>

<body>

<div class="container mt-5 mb-5">
    <form action="" class="form" method="post">
        <div class="row">
            <div id="divHelloSection" style="height: 100%;" class="main-div col-md-6 col-sm-12 col-xs-12">
                <div class="col-sm-12">
                    <h3 class="text-center m-5" style="color: white">
                        Hello, Friends.

                    </h3>

                </div>
            </div>

            <div id="divLoginSection" style="height: 100%" class="main-div col-md-6 col-sm-12 col-xs-12">

                <h1 class="text-center m-5" style="font-family:URW Chancery L, cursive">
                    <img src="images\login.png" alt="login Image" class="img-responsive"> Here
                </h1>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="images\user.png" alt="user img" style="width: 23px; height:23px"
                                     class="rounded-circle img-responsive ">
                            </span>
                    </div>
                    <input type="text" class="form-control" id="playerName" name="playerName" required
                           placeholder="Enter Player Name">

                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <img src="images\key.png" alt="password img" style="width: 23px; height:23px"
                                     class="rounded-circle img-responsive ">
                            </span>
                    </div>
                    <input type="password" class="form-control" id="pwd" name="pwd" required
                           placeholder="Enter Password">
                </div>
                <?php if (isset($_SESSION['errors']['password'])) {
                    echo $_SESSION['errors']['password'];
                } ?>
                <button type="submit" name="login" class="btn btn-primary" style="width: 100%">Login</button>

            </div>

        </div>
    </form>
</div>
</body>

</html>