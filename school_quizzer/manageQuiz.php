<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <title>School Quizzer | Web Admin</title>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>
    <?php
    include 'partials/_header.php';
    ?>

    <div class="container">
        <?php
        require 'partials/_handleApi.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['quizId'] = $_GET['quizid'];
            $response = makeAPICall("/quiz/addQuestion", "POST_JSON", json_encode($_POST));
            if ($response) {
                echo "Question added successfully";
            }
        }

        ?>

        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="form-group grid my-3">
            <div class="mb-3">
                <textarea class="form-control" id="FormControlTextarea1" rows="2" placeholder="Question" name="question"></textarea>
            </div>
            <div class="mb-3 col-3">
                <input type="text" class="form-control my-2" placeholder="Option A" name="option1">
                <input type="text" class="form-control my-2" placeholder="Option B" name="option2">
                <input type="text" class="form-control my-2" placeholder="Option C" name="option3">
                <input type="text" class="form-control my-2" placeholder="Option D" name="option4">
            </div>

            <div class="col-2">
                <label for="correctOption">Select the correct option</label>
                <select class="form-select" id="correctOption" name="correctOption">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary my-auto">Submit</button>
        </form>
    </div>

    <div class="container">
        <div class="accordion" id="accordionQuestions">
            <?php
            $response = makeAPICall("/quiz/" . $_GET['quizid'], "GET", null);

            if($response){
                $qno = 1;
                foreach ($response as $question) {
    
                    echo '<div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Question ' . $qno . '
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            <p>' . $question['question'] . '</p>';
    
    
    
    
    
                    // displaying the options
                    for ($x = 'A', $y = 1; $x <= 'D'; $x++, $y++) {
    
                        if ($x == $question['correctOption'])
                            $isChecked = "checked";
                        else
                            $isChecked = "";
    
                        echo
                        '<div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="optionCheck" ' . $isChecked . ' disabled>
                            <label class="form-check-label" for="optionCheck">
                                ' . $question['option' . $y] . '
                            </label>
                        </div>';
                    }
    
    
                    echo    
                    '</div>
                    </div>
                    </div>';
                    $qno++;
                }
            }else{
                echo "No questions were assigned";
            }
            ?>



        </div>
    </div>








</body>

</html>