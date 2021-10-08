<?php
    // TODO Verify user details
    session_start();
    $_SESSION['username'] = "satvik@email.com";
    $_SESSION['pwd'] = "password";
    echo "You are logged in successfully";
?>