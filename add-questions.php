<?php
session_start();

if (!isset($_POST['next'])) {
    header("location: index.php");
}

?>

    <!DOCTYPE html>
    <html lang="sv">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quiz Generator | Skapa dina egna quiz gratis</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=Francois+One|Fjalla+One|Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <header>
            <?php include("includes/nav.php"); ?>
        </header>

        <div class="container">
            <div class="page-header">
                <h1>Lägg till frågor till <?php echo $_SESSION['quiz_title']; ?></h1>
            </div>


            <?php if (isset($_POST['add_question'])) {
    $question = $_POST['question'];
    $correct_answer = $_POST['answer'];
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];
    $answer3 = $_POST['answer3'];

    $question = mysql_real_escape_string($question);
    $question = stripslashes($question);
    $correct_answer = mysql_real_escape_string($correct_answer);
    $correct_answer = stripslashes($correct_answer);
    $answer1 = mysql_real_escape_string($answer1);
    $answer1 = stripslashes($answer1);
    $answer2 = mysql_real_escape_string($answer2);
    $answer2 = stripslashes($answer2);
    $answer3 = mysql_real_escape_string($answer3);
    $answer3 = stripslashes($answer3);

    $question_nr = $_SESSION['quiz_question_nr'];

    require_once("includes/db.php");
    $mysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $mysqli->set_charset("utf8");

    $sql = "INSERT INTO `questions_answers` (`quiz_id`, `question_number`, `question`, `answer_1`, `answer_2`, `answer_3`, `correct_answer`) VALUES ('{$_SESSION['quiz_id']}', '$question_nr', '$question', '$answer1', '$answer2', '$answer3', '$correct_answer')";

    $result = $mysqli->query($sql) or trigger_error(mysql_error()." ".$sql);

    if ($result == true) {
        $_SESSION['quiz_question_nr'] = $_SESSION['quiz_question_nr'] + 1;
    }
}
        else if (isset($_POST['confirm'])) {
            header("location: confirm.php");
        }
 ?>
                <form method="post" id="question_add">
                    <div class="form-group">
                        <label for="question">Fråga
                            <?php echo $_SESSION['quiz_question_nr'];?>:</label>
                        <br>
                        <input type="text" name="question" class="form-control" id="question" required>
                        <br>
                    </div>

                    <div class="form-group">
                        <input required type="radio" name="answer" id="answer" value="1">
                        <input type="text" name="answer1" id="answer1" class="form-control" placeholder="Alternativ 1">
                        <br>
                    </div>

                    <div class="form-group">
                        <input required type="radio" name="answer" id="answer" value="2">
                        <input required type="text" name="answer2" id="answer2" class="form-control" placeholder="Alternativ 2">
                        <br>
                    </div>

                    <div class="form-group">
                        <input required type="radio" name="answer" id="answer" value="3">
                        <input required type="text" name="answer3" id="answer3" class="form-control" placeholder="Alternativ 3">
                        <br>
                    </div>

                    <p>Markera det svarsalternativ som är rätt.</p>

                    <input type="submit" id="add_question" name="add_question" class="btn btn-primary btn-lg" value="Lägg till ny fråga" disabled>

                    <?php if ($_SESSION['quiz_question_nr'] != 1) { ?>
                        <input type="submit" id="confirm" name="confirm" class="btn btn-primary btn-lg" value="Klart, slutför!" formnovalidate>
                        <?php } ?>

                </form>
        </div>

        <?php include("includes/footer.php"); ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
            <script src="js/script.js"></script>
    </body>

    </html>
