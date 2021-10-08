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

    <div class="container">
        <?php

    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Form handling
        }
        
        ?>

        <div class="card my-3">
            <div class="card-header">
                Question n
            </div>
            <div class="card-body">

                <form action="manageQuiz.php" method="post">
                    <input type="hidden" name="quizId" value="<?php echo $_GET['quizid']?>">
                    <div class="mb-3">
                        <textarea class="form-control" rows="2" placeholder="Question goes here"></textarea>
                    </div>


                </form>
            </div>
        </div>

    </div>




</body>

</html>