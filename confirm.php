<?php
session_start();

if (!isset($_SESSION['quiz_id'])) {
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
    </head>

    <body>
        <header>
            <h1>Quiz Generator</h1>
        </header>

        <h1>Quizet <?php echo $_SESSION['quiz_title']; ?> har skapats!</h1>


        <p>Dela länken <a href="http://localhost/quiz_generator/quiz.php?id=<?php echo $_SESSION['quiz_id']; ?>">http://localhost/quiz_generator/quiz.php?id=<?php echo $_SESSION['quiz_id']; ?></a> med dina vänner!
        </p>

        Antal frågor:
        <?php echo $_SESSION['quiz_question_nr'] - 1; ?>
            <p>För att redigera det här quizet, gå till länken som har skickats till din mail
                <?php echo $_SESSION['user_email']; ?>.</p>

            <footer>&copy; 2016 Quiz Generator</footer>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>

    </html>
