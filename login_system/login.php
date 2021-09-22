<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require 'partials/_dbConnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $selectUser = "SELECT * FROM `user` WHERE `username`='$username'";
    $result = mysqli_query($conn, $selectUser);
    if(mysqli_num_rows($result) == 1)
    {   
        $row = mysqli_fetch_assoc($result);
        echo var_dump(password_verify($password, $row['password']));
        if(password_verify($password, $row['password'])){
            $userExists = true;
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
        }
    }
    else
    {
        $userExists = false;
        header("location: signUp.php");
        exit();
    }
}
// always redirect to welcome if logged in
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
    header("location: welcome.php");
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Login</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
    <?php
    require 'partials/_nav.php';
    if(isset($userExists)){

        if($userExists){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Hey $username</strong> you are now logged in.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        }else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Invalid login attempt</strong> Sorry the credentials entered are invalid.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        }
    }
    ?>



    <div class="container">
        <h1 class="text-center">Login Now</h1>
        <form action="/login_system/login.php" method="POST">
            <div class="mb-3">
                <label for="inpUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="inpUsername" aria-describedby="emailHelp" name="username">
            </div>
            <div class="mb-3">
                <label for="inpPwd" class="form-label">Password</label>
                <input type="password" class="form-control" id="inpPwd" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>