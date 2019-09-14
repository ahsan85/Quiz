<?php
session_start();

$connection= mysqli_connect('localhost','root','root','quizdatabase');
 
if(isset($_POST['addQuestion']))
{ 
 
  if (!empty($_POST['ques'])  &&  !empty($_POST['answers']) && !empty($_POST['correct']) && !empty($_POST['opType']) || $_POST['opType']=='c' || $_POST['opType']=='cpp' || $_POST['opType']=='c#'|| $_POST['opType']=='java') {
     // var_dump($_POST);
   //   die();
      $q = mysqli_real_escape_string($connection, $_POST['ques']);

      $_opType = mysqli_real_escape_string($connection, $_POST['opType']);
      $_correct = $_POST['correct'];
       
     $sql_insert_question="INSERT  INTO questions (questions,type,answer_id) VALUES ('$q', '$_opType',null)";
          

        if(mysqli_query($connection,$sql_insert_question)){
          //$recently_stored_question_id = ....
          $recently_stored_question_id = mysqli_insert_id($connection);
          
           $_answers=$_POST['answers'];
           
          foreach ($_answers as $key => $value) {
           
            $answers = mysqli_real_escape_string($connection, $value);
            $sql_insert_answers="INSERT  INTO answers (answer,question_id) VALUES ('$answers','$recently_stored_question_id')";
            mysqli_query($connection,$sql_insert_answers);

            
            // get latest insert id of answer and store in some variable 
            // so we can use it later.

            // this is going to be the correct answer of 
            // above question,
            // just check if the option key exists in the correct options array
            // no need to worry about the value.
            
            if(isset($_correct[$key]))
            {

                $recently_stored_answer_id = mysqli_insert_id($connection);
               // var_dump($recently_stored_answer_id);
                $update_answer_query="UPDATE questions SET answer_id='$recently_stored_answer_id' WHERE id='$recently_stored_question_id'";
                 mysqli_query($connection,$update_answer_query);
                // update question with the correct option/answer id 
              // by using last inserted question id and last inserted 
              // answer id. 

            }
          }
          header('Location: view_questions.php');
        } else {
                echo "ERROR: Could not able to execute $sql_insert_data." . mysqli_error($connection);
        }
   }
   else
     {  
      echo "Please Fill All Field";     
     }
}
  mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('.check').click(function() {
        $('.check').not(this).prop('checked', false);
    });
});
</script>
	<title></title>
</head>
<body>
     <div class="container">
     	<hr>
     	<h1>Insert Questions</h1>
     	<hr>
     	<form class="form" method="post">
     				<div class="form-group">
     						<input type="" name="ques" class="form-control" placeholder="Type Question Here ">
     				</div>
     				<div class="form-group">
                <label>
                  Option 1 
                  <input type="checkbox" name="correct[option1]" class="check">
                </label>
     						<input type="" name="answers[option1]" class="form-control" placeholder="Type 1st Answer ">
     				</div>
     				<div class="form-group">
                <label>
                    Option 2 
                  <input type="checkbox" name="correct[option2]" class="check">
                </label>
     						<input type="" name="answers[option2]" class="form-control" placeholder="Type 2nd Answer">
     				</div>
     				<div class="form-group">
               <label>
                    Option 3
                  <input type="checkbox" name="correct[option3]" class="check">
                </label>
     						<input type="" name="answers[option3]" class="form-control" placeholder="Type 3rd Answer">
     				</div>
     				<div class="form-group">
                <label>
                    Option 4
                  <input type="checkbox" name="correct[option4]" class="check">
                </label>
     						<input type="" name="answers[option4]" class="form-control" placeholder="Type 4th Answer">
     				</div>
     				<div class="form-group">
     						<input type="" name="opType" class="form-control col-lg-2" placeholder="Write Question Type">	
     				</div>
     				<button type="submit"  name="addQuestion" class="btn btn-primary float-right">Save Question</button>
        </form>
     </div>
</body>
</html>