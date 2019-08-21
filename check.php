<?php

$connection = mysqli_connect("localhost", "root", "root","quizdatabase");
if(isset($_POST['submit']))
{
   if(!empty($_POST['quizcheck']))
  {
      $attemp=count($_POST['quizcheck']);
  }

  $select=$_POST['quizcheck']; 
  $sql="SELECT * FROM questions";
  $q=mysqli_query($connection, $sql);
  $result=0;
  while($row=mysqli_fetch_array($q))
  {
    if(isset($select[$row['id']]))
    {
       $correctAnswerId = $row['answer_id'];
       $selectedAnswerId =  $select[$row['id']];

       if($correctAnswerId == $selectedAnswerId)
       {
           $result++;
           
       }
    }
  }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div>
         <div class="container bg-dark">
                <h1 class=" text-center font-weight-bold" style="color:white">RESULT</h1>
         
                 <div class="row bg-info">
                      <div class="col-lg-6  text-center">
                            <div>
                                    <h4>You have attempted <?php echo  $attemp ?> questions out of 10</h4>
                            </div>
                      </div>
                     <div class="col-lg-6 text-center">
                            <div>
                                    <h4>Your score is <?php echo  $result ?></h4>
                            </div>
                      </div>
                 </div>
         </div>    
    </div>
   
</body>
</html>