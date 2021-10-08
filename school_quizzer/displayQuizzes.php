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
    include 'partials/_header.php';
    ?>
    <!-- Displaying the existing quizzes -->
    <div class="container">
        <?php
        require 'partials/_handleApi.php';
        $response = makeAPICall("/quiz/get", "POST", array("assignedBy"=>$_SESSION['admin']['id']));
        foreach ($response as $quiz) {
            $name = $quiz['quizName'];
            $assignedOn = $quiz['assignedOn'];
            $quizId = $quiz['id'];
            echo 
            '
            <div class="card w-50 my-3 container-fluid">
                <div class="card-body">
                    <h5 class="card-title">'.$name.'</h5>
                    <p class="card-text">'.$assignedOn.'</p>
                    <a href="manageQuiz.php?quizid='.$quizId.'" class="btn btn-primary">Manage</a>
                </div>
            </div>
            ';
        }
    ?>

    </div>

</body>

</html>