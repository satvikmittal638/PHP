<?php
$isInserted = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require 'partials/_dbConnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordAgain = $_POST['passwordAgain'];

    // Checking for an already existing username
    $checkExistence = "SELECT * FROM `user` WHERE `username`= '$username'";
    $numRows = mysqli_num_rows(mysqli_query($conn, $checkExistence));
    $isNotDuplicate = $numRows==0; 
    $passwordsMatch = $password == $passwordAgain; 

    if($passwordsMatch && $isNotDuplicate){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        // storing hash
        $insert = "INSERT INTO `user` (`username`, `password`) VALUES ( '$username', '$hash')";
        $isInserted = mysqli_query($conn, $insert); 
    }
}

function showError($msg) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    $msg
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
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

    <title>Sign Up</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
    <?php
    require 'partials/_nav.php';
    // only works if the isInserted variable was initialized
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if($isInserted){
            showError("<strong>Hey $username</strong> Your account was successfully created.");
            }
        // first checks for duplicacy     
        else if(!$isNotDuplicate){
            showError("Username <strong>$username</strong> already exists");
        }
        
        else if(!$passwordsMatch){
            showError("<strong>Passwords do no match</strong>");
        }
            
            
    }
    ?>



    <div class="container">
        <h1 class="text-center">Sign up to our website now</h1>
        <form action="/login_system/signUp.php" method="POST">
            <div class="mb-3">
                <label for="inpUsername" class="form-label">Username</label>
                <input type="text" class="form-control" maxlength=30 id="inpUsername" aria-describedby="emailHelp" name="username">
            </div>
            <div class="mb-3">
                <label for="inpPwd" class="form-label">Password</label>
                <input type="password" class="form-control" maxlength=30 id="inpPwd" name="password">
            </div>
            <div class="mb-3">
                <label for="inpPwdAgain" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" maxlength=30 id="inpPwdAgain" name="passwordAgain">
                <div id="emailHelp" class="form-text">Make sure you enter the same password again</div>

            </div>
           
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>