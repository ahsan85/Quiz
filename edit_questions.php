<?php
session_start();
$question='';
$option1='';
$option2='';
$option3='';
$option4='';
$opType='';
$id=0;

$connection= mysqli_connect('localhost','root','root','quizdatabase');

 if (isset($_GET['edit'])) {
   $id=$_GET['edit'];
   // var_dump($id);
   // die();
   $getQuestionsFromDB="SELECT * FROM questions WHERE id=$id";
   $row=mysqli_query($connection,$getQuestionsFromDB);
   $_row=mysqli_fetch_assoc($row);
   $question=$_row['questions'];
   $opType=$_row['type'];
   if ($row) {
    // sql to get answers from database by question id
   $ansSql="SELECT * FROM answers WHERE question_id=$id";
   $result = mysqli_query($connection,$ansSql);
  // if result is not empty && it contains few rows
   if (!empty($result) && $result->num_rows > 0) {

   }
   $_row=mysqli_fetch_assoc($row);
   $option1=$_row['answer'];
   $option2=$_row['answer'];
   $option3=$_row['answer'];
   $option4=$_row['answer'];
  
 }
}
// if(isset($_POST['updateQuestion']))
// { 
//   $id=$_GET['edit'];
 
//   if (!empty($_POST['ques'])  &&  !empty($_POST['answers']) && !empty($_POST['correct']) && !empty($_POST['opType']) || $_POST['opType']=='c' || $_POST['opType']=='cpp' || $_POST['opType']=='c#'|| $_POST['opType']=='java') {
//      // var_dump($_POST);
//    //   die();
//       $q = mysqli_real_escape_string($connection, $_POST['ques']);

//       $_opType = mysqli_real_escape_string($connection, $_POST['opType']);
//       $_correct = $_POST['correct'];
       
//     $sql_update_question="UPDATE questions  SET questions='$q',type='$_opType',answer_id=null WHERE id='$id'";
          

//         if(mysqli_query($connection,$sql_update_question)){
//           //$recently_stored_question_id = ....
//           $recently_stored_question_id = mysqli_insert_id($connection);
          
//            $_answers=$_POST['answers'];
           
//           foreach ($_answers as $key => $value) {
           
             
//             $answers = mysqli_real_escape_string($connection, $value);
//             $id = mysqli_insert_id($connection);
//             $sql_update_answers="UPDATE answers SET answer='$answers', question_id='$recently_stored_question_id' WHERE id= ";

//             mysqli_query($connection,$sql_update_answers);

            
//             // get latest insert id of answer and store in some variable 
//             // so we can use it later.

//             // this is going to be the correct answer of 
//             // above question,
//             // just check if the option key exists in the correct options array
//             // no need to worry about the value.
            
//             if(isset($_correct[$key]))
//             {

//                 $recently_stored_answer_id = mysqli_insert_id($connection);
//                // var_dump($recently_stored_answer_id);
//                 $update_answer_query="UPDATE questions SET answer_id='$recently_stored_answer_id' WHERE id='$recently_stored_question_id'";
//                  mysqli_query($connection,$update_answer_query);
//                 // update question with the correct option/answer id 
//               // by using last inserted question id and last inserted 
//               // answer id. 

//             }
//           }
//           header('Location: view_questions.php');
//         } else {
//                 echo "ERROR: Could not able to execute $sql_insert_data." . mysqli_error($connection);
//         }
//    }
//    else
//      {  
//       echo "Please Fill All Field";     
//      }
// }
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
     	<h1>Update Questions</h1>
     	<hr>
     	<form class="form" method="post">
        <input type="hidden" name="id" value=" <?php echo $id ?>">
     				<div class="form-group">
     						<input type="" name="ques" class="form-control" placeholder="Type Question Here " value=" <?php echo $question ?>">
     				</div>
     				<div class="form-group">
                <label>
                  Option 1 
                  <input type="checkbox" name="correct[option1]" class="check">
                </label>
     						<input type="" name="answers[option1]" class="form-control" placeholder="Type 1st Answer" value=" <?php echo $option1 ?>">
     				</div>
     				<div class="form-group">
                <label>
                    Option 2 
                  <input type="checkbox" name="correct[option2]" class="check">
                </label>
     						<input type="" name="answers[option2]" class="form-control" placeholder="Type 2nd Answer" value=" <?php echo $option2 ?>">
     				</div>
     				<div class="form-group">
               <label>
                    Option 3
                  <input type="checkbox" name="correct[option3]" class="check">
                </label>
     						<input type="" name="answers[option3]" class="form-control" placeholder="Type 3rd Answer" value=" <?php echo $option3 ?>">
     				</div>
     				<div class="form-group">
                <label>
                    Option 4
                  <input type="checkbox" name="correct[option4]" class="check">
                </label>
     						<input type="" name="answers[option4]" class="form-control" placeholder="Type 4th Answer" value=" <?php echo $option4 ?>">
     				</div>
     				<div class="form-group">
     						<input type="" name="opType" class="form-control col-lg-2" placeholder="Write Question Type" value=" <?php echo $opType ?>">	
     				</div>
     				<button type="submit"  name="updateQuestion" class="btn btn-primary float-right">Save Question</button>
        </form>
     </div>
</body>
</html>