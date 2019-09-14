<?php
  include 'config.php';
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

        $connection = mysqli_connect('localhost','root','root','quizdatabase');
       
        $sql = "SELECT * from questions";
        
        if($questionsType  != null)
        {
           $sql .= " WHERE type='".$questionsType."'";
        }

        $result = mysqli_query($connection, $sql);
        // if result is not empty && it contains few rows
        if (!empty($result) && $result->num_rows > 0) {
             // iterate over resultset and populate array 
            // of questions
            while($row = mysqli_fetch_assoc($result)) {
                 $questions[] = $row;
            }
        }
        else{
            echo "No data has been found";
        } 

        mysqli_close($connection); 

        return $questions;
    }


    function getAnswers($questionsId = null)
    {
        $answers = [];

        $connection = mysqli_connect('localhost','root','root','quizdatabase');

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


if (isset($_POST['questionAnswers'])) {
     header('Location: view_questions.php');
    
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
                    <a class="navbar-brand" href="/main.php">Quiz Game</a>
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
                    <button type="submit" name="questionAnswers" class="btn btn-primary mr-1 " style="">Questions</button>
                </form>
            </div>
            <div>       
                <form action="" class="form" method="post">
                    <button type="submit" name="logout" class="btn btn-primary mr-1" >Logout</button>
                </form>
            </div>
        </nav>

    </div>
    <div class="tab-content p-3" id="pills-tabContent" >
          
          <div class="tab-pane fade show active " id="instTab" role="tabpanel" aria-labelledby="pills-inst-tab">
                <div> 
                    <h4 class="text-center">WELCOME IN QUIZ GAME</h4>
                    <p style="font-size: 20px">Here, You can test your knowledge in C, C++, C# and Java. It's depend on your interest What you want learn. This game contain 4 tabs of Mcqs, You can also logout from session. </p>
                </div>
          </div>
          
          <div class="tab-pane fade " id="cTab" role="tabpanel" aria-labelledby="pills-C-tab">
                <div class="container col-lg-8">
                        <form action="check.php" method="post">
                     
                                <?php 
                                    $questions = getQuestions('c');
                                    $index=1;  
                                ?>
                                <!-- Starting questions foreach loop -->
                                <?php foreach($questions as $question): ?>
                                <div class="card">
                                    <?php echo $index.". ". $question['questions']; ?>
                                    <br>
                                </div>
                                <div>
                                    <?php  
                                        $answers = getAnswers($question['id']);
                                     ?>  
                                    <!-- Starting answers foreach loop -->
                                    <?php foreach($answers as $answer): ?> 
                                        <div> 
                                             <input type="radio" name="quizcheck[<?php echo $answer['question_id'];  ?>]" value="<?php echo $answer['id'];  ?>"> 
                                             <?php echo  $answer['answer']; ?>  
                                         </div>
                                    <!--  Ending answers foreach loop -->
                                    <?php endforeach; ?>  
                                </div>
                                 <!-- Ending questions foreach loop -->
                                 <?php 
                                        $index++; 
                                        endforeach; 
                                ?>
                                <br>
                                <input type="submit" name="submit" class="btn btn-primary" value="submit">
                        </form>        
                </div>

          </div>
          
          <div class="tab-pane fade" id="cppTab" role="tabpanel" aria-labelledby="pills-C++-tab">
                 <div class="container col-lg-8">
                        <form action="check.php" method="post">
                     
                                <?php 
                                    $questions = getQuestions('cpp');
                                    $index=1;  
                                ?>
                                <!-- Starting questions foreach loop -->
                                <?php foreach($questions as $question): ?>
                                <div class="card">
                                    <?php echo $index.". ". $question['questions']; ?>
                                    <br>
                                </div>
                                <div>
                                    <?php  
                                        $answers = getAnswers($question['id']);
                                     ?>  
                                    <!-- Starting answers foreach loop -->
                                    <?php foreach($answers as $answer): ?> 
                                        <div> 
                                             <input type="radio" name="quizcheck[<?php echo $answer['question_id'];  ?>]" value="<?php echo $answer['id'];  ?>"> 
                                             <?php echo  $answer['answer']; ?>  
                                         </div>
                                    <!--  Ending answers foreach loop -->
                                    <?php endforeach; ?>  
                                </div>
                                 <!-- Ending questions foreach loop -->
                                <?php 
                                        $index++; 
                                        endforeach; 
                                ?>
                                <br>
                                <input type="submit" name="submit" class="btn btn-primary" value="submit">
                        </form>        
                   </div>
          </div>
          
          <div class="tab-pane fade" id="cSharpTab" role="tabpanel" aria-labelledby="pills-CSharp-tab">
                     <div class="container col-lg-8">
                        <form action="check.php" method="post">
                     
                                <?php 
                                    $questions = getQuestions('c');
                                    $index=1;  
                                ?>
                                <!-- Starting questions foreach loop -->
                                <?php foreach($questions as $question): ?>
                                <div class="card">
                                    <?php echo $index.". ". $question['questions']; ?>
                                    <br>
                                </div>
                                <div>
                                    <?php  
                                        $answers = getAnswers($question['id']);
                                     ?>  
                                    <!-- Starting answers foreach loop -->
                                    <?php foreach($answers as $answer): ?> 
                                        <div> 
                                             <input type="radio" name="quizcheck[<?php echo $answer['question_id'];  ?>]" value="<?php echo $answer['id'];  ?>"> 
                                             <?php echo  $answer['answer']; ?>  
                                         </div>
                                    <!--  Ending answers foreach loop -->
                                    <?php endforeach; ?>  
                                </div>
                                 <!-- Ending questions foreach loop -->
                                <?php 
                                        $index++; 
                                        endforeach; 
                                ?>
                                <br>
                                <input type="submit" name="submit" class="btn btn-primary" value="submit">
                        </form>        
                </div>
          </div>
          
          <div class="tab-pane fade" id="javaTab" role="tabpanel" aria-labelledby="pills-Java-tab">
                  <div class="container col-lg-8">
                        <form action="check.php" method="post">
                     
                                <?php 
                                    $questions = getQuestions('c');
                                    $index=1;  
                                ?>
                                <!-- Starting questions foreach loop -->
                                <?php foreach($questions as $question): ?>
                                <div class="card">
                                    <?php echo $index.". ". $question['questions']; ?>
                                    <br>
                                </div>
                                <div>
                                    <?php  
                                        $answers = getAnswers($question['id']);
                                     ?>  
                                    <!-- Starting answers foreach loop -->
                                    <?php foreach($answers as $answer): ?> 
                                        <div> 
                                             <input type="radio" name="quizcheck[<?php echo $answer['question_id'];  ?>]" value="<?php echo $answer['id'];  ?>"> 
                                             <?php echo  $answer['answer']; ?>  
                                        </div>
                                    <!--  Ending answers foreach loop -->
                                    <?php endforeach; ?>  
                                </div>
                                 <!-- Ending questions foreach loop -->
                                 <?php 
                                        $index++; 
                                        endforeach; 
                                ?>
                                <br>
                                <input type="submit" name="submit" class="btn btn-primary" value="submit">
                        </form>        
                </div>
          </div>
    
    </div>
</body>

</html>