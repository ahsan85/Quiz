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
    <title>Document</title>

</head>

<body>
    <div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#colNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="colNav">
                <ul class="navbar-nav nav" style="font-size:20px" role="tablist" id="pills-tab">
                <a class="navbar-brand" href="/">Quiz Game</a>
                    <li class="nav-item">
                        <a  class="nav-link" id="pills-C-tab" data-toggle="pill" href="#cTab" role="tab" aria-controls="pills-home" aria-selected="false"> C Mcqs Test</a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" id="pills-C++-tab" data-toggle="pill" href="#cppTab" role="tab" aria-controls="pills-profile" aria-selected="false"> C++ Mcqs Test</a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" id="pills-CSharp-tab" data-toggle="pill" href="#cSharpTab" role="tab" aria-controls="pills-profile" aria-selected="false"> C# Mcqs Test </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-Java-tab" data-toggle="pill" href="#javaTab" role="tab" aria-controls="pills-profile" aria-selected="false"> Java Mcqs Test</a>
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
    <div class="tab-content p-3" id="pills-tabContent" >
        <div class="tab-pane fade show active " id="instTab" role="tabpanel" aria-labelledby="pills-inst-tab">
       Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi eligendi libero optio, tempora dicta impedit! Voluptates commodi officiis dolores quod accusantium? Et, sint sit! Et id consequatur quaerat illum laudantium!
       Lorem ipsum dolor sit amet consectetur adipisicing elit. Et perspiciatis qui impedit quisquam, ratione reprehenderit nemo nostrum modi quis, maiores consequatur iusto voluptate eveniet! Nobis est quisquam ex ipsam eligendi.
       Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque delectus recusandae vitae similique incidunt possimus laudantium eligendi ipsam suscipit, itaque, illum voluptatum adipisci odit laboriosam blanditiis molestias doloribus officia et.
        </div>
        <div class="tab-pane fade " id="cTab" role="tabpanel" aria-labelledby="pills-C-tab">A paragraph (from the Ancient Greek παράγραφος paragraphos, "to write beside" or "written beside") is a self-contained unit of a discourse in writing dealing with a particular point or idea. A paragraph consists of one or more sentences.</div>
        <div class="tab-pane fade" id="cppTab" role="tabpanel" aria-labelledby="pills-C++-tab">..gdferh67jhgfd.</div>
        <div class="tab-pane fade" id="cSharpTab" role="tabpanel" aria-labelledby="pills-CSharp-tab">C#</div>
        <div class="tab-pane fade" id="javaTab" role="tabpanel" aria-labelledby=pills-Java-tab>java</div>
    </div>
</body>

</html>