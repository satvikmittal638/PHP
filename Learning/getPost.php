<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get and Post</title>
</head>
<body>
    <form action="/satvik/getPost.php" method="post">
    <div>
        <label for="inp_email">Email</label>
        <input type="email" name="email" id="inp_email">
    </div>

    <div>
        <label for="inp_pwd">Password</label>
        <input type="password" name="pwd" id="inp_pwd">
    </div>

    <div>
        <button type="submit">Submit</button>
    </div>
    </form>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    echo $email." with password ".$pwd;
}
?>

