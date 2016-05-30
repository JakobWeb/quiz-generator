<?php

session_start();

if (!isset($_SESSION['quiz_id'])) {
    header("location: index.php");
}

if (isset($_POST['question'])) {
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

    $sql = "INSERT INTO `questions_answers` (`id`, `quiz_id`, `question_number`, `question`, `answer_1`, `answer_2`, `answer_3`, `correct_answer`) VALUES ('$question_nr', '$question', '$answer1', '$answer2', '$answer3', '$correct_answer')";

    $result = $mysqli->query($sql) or trigger_error(mysql_error()." ".$sql);

    if ($result == true) {
        $_SESSION['quiz_question_nr'] = $_SESSION['quiz_question_nr']++;
    }
}
else {
    header("location: index.php");
}
