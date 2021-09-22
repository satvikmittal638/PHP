<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $error = "none";
    require '_db_connect.php'; // already in partials
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE user_email='$email'"); // check for a duplicate user
    while($row = mysqli_fetch_assoc($result)){
        if(password_verify($password, $row['user_password'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $email;
        }
    }
    header("location:".$_SERVER['HTTP_REFERER']); // the user returns back to the page he was on

}
?>
