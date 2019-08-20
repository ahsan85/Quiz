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

    

    function getQuestions($questionsType = null)
    {
        $questions = [];

        $connection = mysqli_connect("localhost", "root", "root","quizdatabase");

        $sql = "SELECT * from questions";
        
        if($questionsType  != null)
        {
           $sql .= " WHERE type='".$questionsType."'";
        }
        $result = mysqli_query($connection, $sql);
        if (!empty($result) && $result->num_rows > 0) {
             // output data of each row 
            while($row = mysqli_fetch_assoc($result)) {
                 $questions[] = $row;
            }
        }
        else{
            echo "0 results";
        } 

        mysqli_close($connection); 

        return $questions;
    }


    function getAnswers($questionsId = null)
    {
        $answers = [];

        $connection = mysqli_connect("localhost", "root", "root","quizdatabase");

        $sql = "SELECT * from answers";
        
        if($questionsId  != null)
        {
           $sql .= " WHERE question_id='".$questionsId."'";
        }
        $result = mysqli_query($connection, $sql);
        if (!empty($result) && $result->num_rows > 0) {
             // output data of each row 
            while($row = mysqli_fetch_assoc($result)) {
                 $answers[] = $row;
            }
        }
        else{
            echo "0 results";
        } 

        mysqli_close($connection); 

        return $answers;
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
        <div class="tab-pane fade " id="cTab" role="tabpanel" aria-labelledby="pills-C-tab">
            <div class="container col-lg-8">
                   <form action="check.php" method="post">
                     
                         <?php $questions = getQuestions('c');  $index=1; ?>
                      
                         <?php foreach($questions as $question): ?>
                         <div class="card"><?php echo $index.". ". $question['questions']?><br></div>
                        <div >
                               <?php   $answers = getAnswers($question['id']);?>  
                               <?php foreach($answers as $answer): ?> 
                               <div> 
                                  <input type="radio" name="quizcheck[<?php echo $answer['question_id'];  ?>]" value="<?php echo $answer['id'];  ?>"> <?php echo  $answer['answer']?>  
                               </div>
                               <?php endforeach; ?> 

                               <?php $index++; endforeach; ?>
                        </div>
                      <input type="submit" name="submit" class="btn btn-primary float-right" value="submit">
                   </form>        
            </div>

        </div>
        <div class="tab-pane fade" id="cppTab" role="tabpanel" aria-labelledby="pills-C++-tab">
            
            <?php 

            $questions = getQuestions('cpp'); 
            foreach($questions as $question) {    
            ?>
  
             <div><?php echo $question['questions'] ?></div>
           
           <?php } ?>

        </div>
        <div class="tab-pane fade" id="cSharpTab" role="tabpanel" aria-labelledby="pills-CSharp-tab">
            
            <?php 
            $questions = getQuestions('csharp'); 
            foreach($questions as $question) {    
              echo '<div>'.$question['questions'].'</div>';
            } 
            ?>


        </div>
        <div class="tab-pane fade" id="javaTab" role="tabpanel" aria-labelledby=pills-Java-tab>java</div>
    </div>
</body>

</html>