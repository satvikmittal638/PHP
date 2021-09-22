<?php
    echo "<em>Logging Out</em>";
    session_start();
    session_unset();
    session_destroy();
    header("location:".$_SERVER['HTTP_REFERER']); // the user returns back to the page the user was on
?>