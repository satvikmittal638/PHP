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
    <!-- Adding a thread under a category into the db -->
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['thread_title']) && isset($_POST['thread_description'])){
                $threadTitle = $_POST['thread_title'];
                $threadDesc =  $_POST['thread_description'];
                // Saving from XSS attack
                str_replace("<", "&lt;",$threadDesc);
                str_replace(">", "&gt;",$threadDesc);

                str_replace("<", "&lt;",$threadTitle);
                str_replace(">", "&gt;",$threadTitle);

                $categoryid = $_GET['catid']; // already appended in the URL

                // Getting user id
                $getUserid = "SELECT * from `users` where `user_email`='".$_SESSION['username']."'";
                $result = mysqli_query($conn, $getUserid);
                $userId = mysqli_fetch_assoc($result)['user_id'];
                
                // Inserting the thread
                $addThread = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_catid`, `thread_userid`) VALUES ('$threadTitle', '$threadDesc', '$categoryid', '$userId')";
                $result = mysqli_query($conn, $addThread);
                if($result){
                    echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Thread started successfully</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  ';
                }
            }
        }
    ?>




    <!-- Setting the info about the category after fetching data from the db -->
    <?php 
        if(isset($_GET['catid']))
        {   
            $catid = $_GET['catid'];
            $getLanguageByid = "SELECT * FROM `categories` WHERE category_id=".$catid; 
            $result = mysqli_query($conn, $getLanguageByid);
            while($category = mysqli_fetch_assoc($result)) // runs once only
            {
                $catName = $category['category_name'];
                $catDesc = $category['category_description'];
                $rules = "
                <ul>
                    <li>No Spam / Advertising / Self-promote in the forums.</li>
                    <li>Do not post copyright-infringing material.</li>
                    <li>Do not post “offensive” posts, links or images.</li>
                    <li>Do not cross post questions</li>
                    <li>Do not PM users asking for help</li>
                    <li>Remain respectful of other members at all times</li>
                </ul> 
                ";
                echo '
                <div class="container my-4">
                    <div class="jumbotron">
                        <h1 class="display-4 text-center">'.$catName.'</h1>
                        <p class="lead text-center">'.$catDesc.'</p>
                        <hr class="my-4">
                        '.$rules.'
                    </div>  
                </div>
            ';
            }
            
        }


    ?>



    <div class="container">
        <!-- Checking for a logged in user -->
        <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                // Making the POST request to this url only
                echo  '<div class="container">
                <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                    <div class="form-group my-2">
                        <label for="inputTitle">Problem Title</label>
                        <input type="text" class="form-control" name="thread_title" id="inputTitle"
                            aria-describedby="titleHelp" placeholder="Enter title">
                        <small id="titleHelp" class="form-text text-muted">Keep the title short and crisp</small>
    
                        <div class="form-group my-4">
                            <label for="inputDesc">Describe your issue</label>
                            <textarea class="form-control" id="inputDesc" rows="3" name="thread_description"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success text-center my-3">Ask Now</button>
                </form>
    
            </div>';
            }else{
                echo "<p class='text-center'><em>You must be logged in to start a thread</em></p>";
            }
        ?>



        <h1 class="my-3">Browse Questions</h1>

        <!-- Displaying Question under a category -->
        <?php
            // catid is already received above
            if(isset($catid) && $catid!=NULL){

                $getThreadsByCategory = "SELECT * FROM `threads` WHERE thread_catid=$catid";
                $result = mysqli_query($conn, $getThreadsByCategory);

                // if there exist some thread in the given category
                if(mysqli_affected_rows($conn) >= 1){
                    while($thread = mysqli_fetch_assoc($result)){
                        $threadId = $thread['thread_id'];
                        $threadTitle = $thread['thread_title'];
                        $threadDesc = $thread['thread_description'];
                        $threadUserId = $thread['thread_userid'];

                        $getPostedBy = "SELECT * FROM `users` WHERE `user_id`=".$threadUserId;
                        $user = mysqli_fetch_assoc(mysqli_query($conn, $getPostedBy));


                        echo ' 
                        <div class="media my-4">
                        <img class="mr-3" src="images/user.png" width="50px" alt="">
                        '.$user['user_email'].' at '.$thread['timestamp'].'
                        <div class="media-body">
                            <h5 class="mt-0"><a href="threadInfo.php?threadid='.$threadId.'" class="text-dark">'.$threadTitle.'</a></h5>
                             '.$threadDesc.'
                             </div>
                        </div>
                    ';
                    }
                }else{
                    echo "<em>No questions</em>";
                }

            }
        ?>


    </div>

    <?php require 'partials/_footer.php'?>
</body>

</html>