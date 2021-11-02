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
    $responseQuizAdd = makeAPICall("/quiz/addQuiz", "POST_JSON", json_encode($_POST));
    

    if($responseQuizAdd){
        // assigning the quizzes by making quizStudent relations in the Db
        makeAPICall("/student/assign", "POST",array('quizId'=>$responseQuizAdd['id'] , 
        "schoolClass"=>$_POST['schoolClass']));
        header("location: /school_quizzer/manageQuiz.php?quizid=".$responseQuizAdd['id']);
    }
}