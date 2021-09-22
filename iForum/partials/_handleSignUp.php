<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $error = "none";
    require '_db_connect.php'; // already in partials
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    mysqli_query($conn, "SELECT * FROM `users` WHERE user_email='$email'"); // check for a duplicate user
    if(mysqli_affected_rows($conn)!=0){
        $error = "User exists";
    }
    else if($password != $cpassword){
        $error = "Passwords do not match";  
    }else{
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $addUser = "INSERT INTO `users` ( `user_email`, `user_password`) VALUES ('$email', '$hash')";
        $result = mysqli_query($conn, $addUser);
        if($result){
            header("location: /iforum/?signupsuccess=true");
            exit();
        }
    }
    header("location: /iforum/?signupsuccess=false&error=".$error);

}
?>