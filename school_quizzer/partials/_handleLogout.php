<?php
    session_start();
    if(session_destroy()){
        header("location: /school_quizzer/login.php ");
    }
?>