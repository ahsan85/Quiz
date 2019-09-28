<?php
include 'includes/app.php';
include 'includes/functions.php';

session_start();

$_SESSION['config'] = $config;


if (isset($_POST['logout'])) {
    session_destroy();
    $_SESSION = [];
}

if (!isUserLoggedIn()) {
    header('Location: index.php');
}

function getQuestions($questionsType = null)
{

    $questions = [];

    $connection = mysqli_connect(config('database.server'), config('database.username'), config('database.password'), config('database.name'));

    $sql = "SELECT * from questions";

    if ($questionsType != null) {
        $sql .= " WHERE type='" . $questionsType . "'";
    }

    $result = mysqli_query($connection, $sql);
    // if result is not empty && it contains few rows
    if (!empty($result) && $result->num_rows > 0) {
        // iterate over resultset and populate array
        // of questions
        while ($row = mysqli_fetch_assoc($result)) {
            $questions[] = $row;
        }
    } else {
        echo "No data has been found";
    }

    mysqli_close($connection);

    return $questions;
}


function getAnswers($questionsId = null)
{
    $answers = [];

    $connection = mysqli_connect('localhost', 'root', 'root', 'quizdatabase');

    $sql = "SELECT * from answers";

    if ($questionsId != null) {
        $sql .= " WHERE question_id='" . $questionsId . "'";
    }
    $result = mysqli_query($connection, $sql);
    if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $answers[] = $row;
        }
    } else {
        echo "0 results";
    }

    mysqli_close($connection);

    return $answers;
}

function getQuestionType()
{

    $questionType = [];

    $connection = mysqli_connect(config('database.server'), config('database.username'), config('database.password'), config('database.name'));

    $sql = "SELECT DISTINCT `type` FROM questions ORDER BY 'type'";


    $result = mysqli_query($connection, $sql);
    //dd($result);
    // if result is not empty && it contains few rows
    if (!empty($result) && $result->num_rows > 0) {
        // iterate over resultset and populate array
        // of questions
        while ($row = mysqli_fetch_assoc($result)) {
            $questionType[] = $row['type'];

        }
    } else {
        echo "No data has been found";
    }

    mysqli_close($connection);

    return $questionType;
}


// var_dump($_SESSION['loggedInUser']['role']);
// die();
if (isset($_POST['questionAnswers'])) {
    header('Location: view_questions.php');

}

$qType = getQuestionType();
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

    <title><?php echo isset($config['general']['app_name']) ? $config['general']['app_name'] : '' ?></title>

</head>

<body>
<div>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div>
            <a href="admin_view.php">
                <img src="images\back.png" class="rounded-circle img-responsive " style="width:40%">
            </a>
        </div>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#colNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="colNav">

            <ul class="navbar-nav nav" style="font-size:20px" role="tablist" id="pills-tab">
                <a class="navbar-brand float-left" href="main.php">Quiz Game</a>
                <?php
                $qType = getQuestionType();
                foreach ($qType as $item) {
                    ?>
                    <li class="nav-item">

                        <a id="<?php echo $item ?>" class="nav-link"
                           href="?type=<?php echo $item ?>"><?php echo ucfirst($item); ?> Mcqs
                            Test</a>
                    </li>


                    <?php
                }
                ?>
            </ul>


        </div>
        <?php if (isset($_SESSION['loggedInUser']) && isset($_SESSION['loggedInUser']['role'])): ?>
            <?php if ($_SESSION['loggedInUser']['role'] == 'admin') { ?>


                <div>
                    <form action="" class="form" method="post">
                        <button type="submit" name="questionAnswers" class="btn btn-primary mr-1 " style="">Questions
                        </button>
                    </form>
                </div>
            <?php } ?>
        <?php endif ?>
        <div>
            <form action="" class="form" method="post">
                <button type="submit" name="logout" class="btn btn-primary mr-1">Logout</button>
            </form>
        </div>
    </nav>

</div>
<?php
if (isset($_GET['type'])) {
    $type = $_GET['type'];

}
?>
<div class="tab-content" id="pills-tabContent">
    <?php
    if (!isset($type)) {
        ?>
        <!--    <div class="tab-pane fade show active " id="instTab" role="tabpanel" aria-labelledby="pills-inst-tab">-->
        <div>
            <h4 class="text-center">WELCOME IN QUIZ GAME</h4>
            <p style="font-size: 20px">Here, You can test your knowledge in C, C++, C# and Java. It's depend on your
                interest What you want learn. This game contain 4 tabs of Mcqs, You can also logout from session. </p>
        </div>
        <!--    </div>-->
        <?php
    } elseif (isset($_GET['type'])) {
        ?>
        <div id="<?php echo $type ?>">
            <div class="container col-lg-8">
                <br>
                <form action="check.php" method="post">

                    <?php
                    //    $questions = isset($type) ? getQuestions($_GET['type']) : [];
                    $questions = getQuestions($type);
                    $index = 1;
                    ?>
                    <!-- Starting questions foreach loop -->
                    <?php foreach ($questions as $question): ?>
                        <div class="card">
                            <?php echo $index . ". " . $question['questions']; ?>
                            <br>
                        </div>
                        <div class="mt-2">
                            <?php
                            $answers = getAnswers($question['id']);
                            ?>
                            <!-- Starting answers foreach loop -->
                            <?php foreach ($answers as $answer): ?>
                                <div>
                                    <input type="radio" name="quizcheck[<?php echo $answer['question_id']; ?>]"
                                           value="<?php echo $answer['id']; ?>">
                                    <?php echo $answer['answer']; ?>

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
        <?php
    }
    ?>
</div>

</div>

</body>

</html>



