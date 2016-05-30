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

    <div class="jumbotron">
        <div class="container">
            <h1>Skapa dina egna quiz</h1>
            <p>Gratis, snabbt och enkelt. Kom igång på under 5 minuter.</p>
            <p><a class="btn btn-primary btn-lg" href="create-quiz.php" role="button">Skapa quiz</a></p>
        </div>
    </div>

    <div class="col-md-6">
        <table class="table table-striped">
            <caption>Senast skapade quiz</caption>
            <thead>
                <tr>
                    <td>Quiz</td>
                    <td>Frågor</td>
                    <td>Skapare</td>
                    <td>Datum & tid</td>
                </tr>
            </thead>
            <tbody>
                <?php require_once("includes/db.php");
    $mysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $mysqli->set_charset("utf8");

    $sql = "SELECT quiz.id, quiz.timestamp, quiz.title, quiz.creator, questions_answers.question_number, questions_answers.quiz_id, COUNT(questions_answers.question_number) AS number_questions FROM quiz INNER JOIN questions_answers ON quiz.id = questions_answers.quiz_id ORDER BY quiz.timestamp DESC LIMIT 5";

    $result = $mysqli->query($sql) or trigger_error(mysql_error()." ".$sql);

    while ($row = $result->fetch_assoc()) {?>
                    <tr>
                        <td>
                            <a href="quiz.php?id=<?php echo $row['id']; ?>">
                                <?php echo $row['title']; ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $row['number_questions']; ?>
                        </td>
                        <td>
                            <?php echo $row['creator']; ?>
                        </td>
                        <td>
                            <?php echo substr($row['timestamp'], 0, 16); ?>
                        </td>
                    </tr>
                    <?php }
                $result->free();
                $mysqli->close();?>
            </tbody>
        </table>
    </div>

    <div class="col-md-6">
        <table class="table table-striped">
            <caption>Topplista</caption>
            <thead>
                <tr>
                    <td>Plats</td>
                    <td>Namn</td>
                    <td>Frågor</td>
                    <td>Quiz</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Jakob</td>
                    <td>10 / 10 (100%)</td>
                    <td>IT-quiz</td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php include("includes/footer.php"); ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
</body>

</html>
