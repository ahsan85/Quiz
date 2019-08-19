<?php
   session_start();
      
   if(isset($_POST['logout']))
   {
      $_SESSION['isLoggedIn'] = false;
   }

   if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == false)
    {
        header('Location: index.php');
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
    <script>
    function activeCMcqs() {
        document.getElementById("cMcqs").style.display = "block";
    }
    </script>
    <title>Document</title>

</head>

<body>
    <div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark  ">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#colNav">

                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse" id="colNav">
                <ul class="navbar-nav" style="font-size:20px">
                <a class="navbar-brand" href="#">Quiz Game</a>
                    <li class="nav-item">
                        <a href="#cMcqs" class="nav-link" onclick="activeCMcqs()"> C Mcqs Test</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"> C++ Mcqs Test</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"> C# Mcqs Test </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"> Java Mcqs Test</a>
                    </li>

                </ul>
            </div>
            <div>
                <form action="" class="form" method="post">
                    <button type="submit" name="logout" class="btn btn-primary " style="width: 100%">Logout</button>
                </form>
            </div>
        </nav>

    </div>
    <div id="cMcqs" style="Display:none">


    </div>
</body>

</html>