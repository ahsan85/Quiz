<?php
session_start();

if (isset($_POST['addQ'])) {
 header('Location: add_questions.php');
}


  function getQuestions()
    {
        $questions = [];

        $connection = mysqli_connect('localhost','root','root','quizdatabase');
       
        $sql = "SELECT * from questions";
        
      
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


?>
<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
    <div>
         <div class="bg-dark">
            <div class="float-left">
            <a href="main.php">
                <img src="images\back.png" class="rounded-circle  ml-2 mt-4" style="width:40%">
            </a>   
          </div>
    	 <form method="POST" class="">
    	 	<button class="btn btn-primary  float-right mr-2 mt-4" type="submit" name="addQ">+ Questions</button>
    	 </form>
         <span class="text-center m-4 font-weight-bold " style="color: white"> <h1>Questions & Answers</h1></span>
    	  
          </div>     
         <div>
    	   	      <table class="table table-bordered ">
    	 	 			
                        <tbody>
                        	  <tr>
                        	     	<td>
                                    <?php

                                    $questions = getQuestions();

                                    $index=1;  
                                ?>
                                <!-- Starting questions foreach loop -->
                                <?php foreach($questions as $question): ?>
                                <div class="card">   
                                    <?php echo $index.". ". $question['questions']; ?> <a href="edit_questions.php?edit=<?php echo $question['id'];   ?>">Edit</a> <a href="delete_questions.php?delete=<?php echo $question['id'];  ?>">Delete</a>
  
                                   
                                </div>

                                <div>
                                    <?php  
                                      
                                        $answers = getAnswers($question['id']);

                                     ?>  
                                    <!-- Starting answers foreach loop -->
                                    <?php $_index=1; foreach($answers as $answer): ?> 
                                        <div> 
                                             <span type="radio" name="quizcheck[<?php echo $answer['question_id'];  ?>]" value="<?php echo $answer['question_id'];  ?>"> </span>
                                             <?php echo  $_index.". ".  $answer['answer']; ?>  
                                         </div>
                                    <!--  Ending answers foreach loop -->
                                    <?php $_index++;  endforeach; ?>  
                                  
                                </div>
                                 <!-- Ending questions foreach loop -->
                                 <?php 
                                        $index++; 
                                        endforeach; 
                                ?>

                        	  	   </td>

                        	  </tr>

                        </tbody>
    	 		  </table>
          </div>




    </div>
</body>
</html>