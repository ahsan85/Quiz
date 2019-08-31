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
                                    <h4>
                                       <?php
                                            if($result>8)
                                            {
                                                 echo "Congratulation! Your score is ".$result;
                                         ?>
                                                <script>
                                                     $(function() {
                                                     $("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
                                                       });
                                                 </script>
                                                     
                                                    <!-- Modal -->
                                                 <div class="modal fade" id="myModal" role="dialog">
                                                       <div class="modal-dialog">
                                                     
                                                            <!-- Modal content-->
                                                           <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <h5>Congratulation! Do You Want To Play Next Round</h5>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                          <a  href="" data-dismiss="modal" style="text-decoration: none; color: black; margin-right: 65%"  onclick="self.close()"><h5>Close</h5></a>
                                                                          <a href="main.php" style="text-decoration: none; color: black"><h5>Next</h5></a>
                                                                    </div>
                                                             </div>
                                                     
                                                       </div>
                                                 </div>
                                             <?php
                                            }  
                                            else if($result==0)
                                            {
                                              echo "Sorry! You are fail";
                                             ?>
                                                <script>
                                                    $(function() {
                                                    $("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
                                                    });
                                                    </script>
                                                     
                                                    <!-- Modal -->
                                                      <div class="modal fade" id="myModal" role="dialog">
                                                           <div class="modal-dialog">
                                                     
                                                            <!-- Modal content-->
                                                              <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <h1>Sorry! You are fail</h1>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                          <a  href="" data-dismiss="modal" style="text-decoration: none; color: black; margin-right: 65%"  onclick="self.close()"><h5>Close</h5></a>
                                                                          <a href="main.php" style="text-decoration: none; color: black"><h5>Play Again</h5></a>
                                                                    </div>
                                                              </div>
                                                     
                                                            </div>
                                                      </div>
                                             <?php
                                            }    
                                        ?>
                                    </h4>
                            </div>
                      </div>
                 </div>
         </div>    
    </div>
   
</body>
</html>