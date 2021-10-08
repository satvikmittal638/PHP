<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <title>School Quizzer | Web Admin</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>

    <?php
    session_start();
    if(isset($_SESSION['admin'])){
        header("location: /school_quizzer/");
        exit();
    }


    require 'partials/_handleApi.php';
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $credentials = array("email" => $_POST['email'], "password" => $_POST['password']);
        $response = makeAPICall("/admin/login", "POST", $credentials);
        if ($response) {
            session_start();
            $_SESSION['admin'] = $response;
            header("location: /school_quizzer/");
        } else {
            echo "Login unsuccessful";
        }
    }

    ?>


    <div class="container">
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="InputPassword">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>