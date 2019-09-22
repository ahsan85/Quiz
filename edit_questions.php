<?php
include 'includes/app.php';
include 'includes/functions.php';
session_start();
if(!isUserLoggedIn())
{
    echo "404 HTTP Error (Not Found)";
    die();
}

if(isUserHasRole("player")) {
    echo "You are not allowed to access this file";
    die();
}

$question = '';
$answers = [];
$id = 0;

$connection =  mysqli_connect(config('database.server'),config('database.username'),config('database.password'),config('database.name'));


if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  // var_dump($id);
  // die();
  $getQuestionsFromDB = "SELECT * FROM questions WHERE id=$id";
  $row = mysqli_query($connection, $getQuestionsFromDB);
  $question = mysqli_fetch_assoc($row);
  if ($row) {
    // sql to get answers from database by question id
    $ansSql = "SELECT * FROM answers WHERE question_id=$id";
    $result = mysqli_query($connection, $ansSql);
    // if result is not empty && it contains few rows
    if (!empty($result) && $result->num_rows > 0) {
      // iterate over resultset and populate array 
      // of answers
      while ($row = mysqli_fetch_assoc($result)) {
        $answers[] = $row;
      }
    }
  }
}
if(isset($_POST['updateQuestion']))
{ 
  $id=$_GET['edit'];

  if (!empty($_POST['ques'])  &&  !empty($_POST['answers']) && !empty($_POST['correct']) && !empty($_POST['opType']) || $_POST['opType']=='c' || $_POST['opType']=='cpp' || $_POST['opType']=='c#'|| $_POST['opType']=='java') {
     // var_dump($_POST);
   //   die();
      $q = mysqli_real_escape_string($connection, $_POST['ques']);

      $_opType = mysqli_real_escape_string($connection, $_POST['opType']);
      $_correct = $_POST['correct'];

      $sql_update_question="UPDATE questions  SET questions='$q',type='$_opType',answer_id=null WHERE id='$id'";


        if(mysqli_query($connection,$sql_update_question)){
          //$recently_stored_question_id = ....
          $recently_stored_question_id = mysqli_insert_id($connection);

           $_answers=$_POST['answers'];

          foreach ($_answers as $key => $value) {


            $answers = mysqli_real_escape_string($connection, $value);
          
            $sql_update_answers="UPDATE answers SET answer='$answers' WHERE id='$key' ";

            mysqli_query($connection,$sql_update_answers);
            var_dump(mysqli_query($connection,$sql_update_answers));

            // get latest insert id of answer and store in some variable 
            // so we can use it later.

            // this is going to be the correct answer of 
            // above question,
            // just check if the option key exists in the correct options array
            // no need to worry about the value.

            if(isset($_correct[$key]))
            {
              
                
               // var_dump($recently_stored_answer_id);
                $update_answer_query="UPDATE questions SET answer_id='$key' WHERE id='$id'";
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
    $(document).ready(function() {
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
        <input type="" name="ques" class="form-control" placeholder="Type Question Here " value=" <?php echo $question['questions'] ?>">
      </div>
      <!-- Starting answers foreach loop -->
      <?php foreach ($answers as $answer) : ?>
        <div class="form-group">
          <label>
            Option
            <input type="checkbox" name="correct[<?php echo $answer['id']; ?>]" class="check" <?php if ($question['answer_id'] == $answer['id']) echo 'checked'; ?> />
          </label>
          <input type="" name="answers[<?php echo $answer['id']; ?>]" class="form-control" placeholder="Type Answer" value="<?php echo $answer['answer'] ?>">
        </div>
      <?php endforeach; ?>

      <div class="form-group">
        <label>
          Option Type
        </label>
        <input type="" name="opType" class="form-control col-lg-2" placeholder="Write Question Type" value=" <?php echo $question['type'] ?>">
      </div>
      <button type="submit" name="updateQuestion" class="btn btn-primary float-right">Save Question</button>
    </form>
  </div>
</body>

</html>