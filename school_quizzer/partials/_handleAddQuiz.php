<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $startDate = $_POST['startDate'];
    $startTime = $_POST['startTime'];
    $dateTimeFrom = $startDate . 'T' . $startTime;

    $endDate = $_POST['endDate'];
    $endTime = $_POST['endTime'];
    $dateTimeTo = $endDate . 'T' . $endTime;

    // removing from POST
    unset($_POST['startDate']);
    unset($_POST['startTime']);
    unset($_POST['endDate']);
    unset($_POST['endTime']);

    // Adding final dateTime objects to the Post Super global
    $_POST['dateTimeFrom'] = $dateTimeFrom;
    $_POST['dateTimeTo'] = $dateTimeTo;

    require '_handleApi.php';
    $response = makeAPICall("/quiz/addQuiz", "POST_JSON", json_encode($_POST));

    if($response){
        header("location: /school_quizzer/assignNewQuiz.php?quizid=".$response['id']);
    }
}
