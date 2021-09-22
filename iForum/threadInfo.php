<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>iForum - Everything answered</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
    <?php require 'partials/_header.php'; 
        require 'partials/_db_connect.php'?>

    <!-- Comment post handling -->
    <?php
        if(isset($_POST['comment'])){
            $content = $_POST['comment'];
            $threadid = $_GET['threadid']; // already in the url
            // Saving from XSS attack
            str_replace("<", "&lt;",$content);
            str_replace(">", "&gt;",$content);
            // Getting user id
            $getUserid = "SELECT * from `users` where `user_email`='".$_SESSION['username']."'";
            $result = mysqli_query($conn, $getUserid);
            $userId = mysqli_fetch_assoc($result)['user_id'];
        

            $addComment = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`) VALUES ('$content', '$threadid', '$userId');";
            $result = mysqli_query($conn, $addComment);
            if($result){
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Comment added successfully</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
            }
        }
    ?>

    <!-- Setting the info about the thread after fetching data from the db -->
    <?php 
        if(isset($_GET['threadid']))
        {   
            $threadid = $_GET['threadid'];
            $getThreadByid = "SELECT * FROM `threads` WHERE thread_id=".$threadid; 
            $result = mysqli_query($conn, $getThreadByid);
            while($thread = mysqli_fetch_assoc($result)) // runs once only
            {
                $threadTitle = $thread['thread_title'];
                $threadDesc = $thread['thread_description'];

                echo '
                <div class="container my-4">
                    <div class="jumbotron">
                        <h1 class="display-4 text-center">'.$threadTitle.'</h1>
                        <p class="lead text-center">'.$threadDesc.'</p>
                        <hr class="my-4">
                        <p class="text-center">Rules appear here</p>
        
                    </div>  
                </div>
            ';
            }
            
        }
        

    ?>





    <?php
        // Checking for a logged in user
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
            echo '<div class="container">
            <!-- Gives the access to the current URL along with request parameters -->
            <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
                <div class="form-group my-2">
                    <div class="form-group my-3">
                        <label for="comment">Answer politely</label>
                        <textarea class="form-control" id="comment" rows="2" name="comment"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-success text-center">Post</button>
            </form>

        </div>';
        }else{
            echo "<p class='text-center'><strong>You must be logged in to post a comment</strong></p>";
        }

    ?>


    <h1 class="my-3 text-center">Browse Answers</h1>
    <div class="container">
        <?php  
            if(isset($_GET['threadid']))
            {
                $getCommentsByThread = "SELECT * FROM `comments` WHERE thread_id=$threadid";
                $result = mysqli_query($conn, $getCommentsByThread);
                // if there exist some thread in the given category
                if(mysqli_affected_rows($conn) >= 1){
                    while($comment = mysqli_fetch_assoc($result)){
                        // TODO display user name instead of time
                        $commentTime = strftime(" on %F at %R", strtotime($comment['timestamp']));
                        $commentContent = $comment['comment_content'];
                        $commentBy = $comment['comment_by'];
                        $getPostedBy = "SELECT * FROM `users` WHERE `user_id`=".$commentBy;
                        $user = mysqli_fetch_assoc(mysqli_query($conn, $getPostedBy));

                        echo ' 
                        <div class="media my-4">
                            <img class="mr-3" src="images/user.png" width="50px" alt="">
                            By <strong>'.$user['user_email'].'</strong>'.$commentTime.'
                            <div class="media-body">
                                '.$commentContent.'
                            </div>
                        </div>
                    ';
                    }
                }else{
                    echo "<em>Be the first one to answer</em>";
                }
            }
        ?>

    </div>

    <?php require 'partials/_footer.php'?>
</body>

</html>