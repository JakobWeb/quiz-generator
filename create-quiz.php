<?php
session_start();
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
                <h1>Skapa quiz</h1>
                <small>Uppge först lite information om ditt quiz. Texten visas för användarna.</small>
            </div>

            <?php if (isset($_POST['next'])) {
        $title =  $_POST['title'];
        $description = $_POST['description'];
        $creator = $_POST['creator'];
        $email = $_POST['email'];

        $title = mysql_real_escape_string($title);
        $title = stripslashes($title);
        $description = mysql_real_escape_string($description);
        $description = stripslashes($description);
        $creator = mysql_real_escape_string($creator);
        $creator = stripslashes($creator);
        $email =  mysql_real_escape_string($email);
        $email = stripslashes($email);

        $token = uniqid();

        $_SESSION['quiz_title'] = $title;
        $_SESSION['quiz_token'] = $token;
        $_SESSION['quiz_question_nr'] = 1;
        $_SESSION['user_email'] = $email;


    require_once("includes/db.php");
    $mysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $mysqli->set_charset("utf8");

    $sql = "INSERT INTO `quiz` (`title`, `description`, `creator`, `email`, `token`) VALUES ('$title', '$description', '$creator', '$email', '$token')";

    $result = $mysqli->query($sql) or trigger_error(mysql_error()." ".$sql);

    $_SESSION['quiz_id'] = $mysqli->insert_id;

    if ($result == true) {
        header("Location: add-questions.php");
    }
    else {
        echo "Error";
    }
} ?>


                <form method="post">
                    <div class="form-group">
                        <label for="title">Titel*</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Beskrivning*</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="creator">Skapare*</label>
                        <input type="text" name="creator" id="creator" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-postadress* (Visas ej)</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <button name="next" class="btn btn-primary btn-lg">Vidare</button>
                </form>
        </div>


        <?php include("includes/footer.php"); ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
            <script src="js/script.js"></script>
    </body>

    </html>
