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
    <?php 
        require 'partials/_db_connect.php';
        require 'partials/_header.php';
    ?>



    <!-- Search results -->

    <?php
        $search_query = $_GET['search_query'];
        $searchThreads = "SELECT * FROM threads WHERE MATCH(thread_title, thread_description) AGAINST ('$search_query')";
        $result = mysqli_query($conn, $searchThreads);

        if(mysqli_affected_rows($conn)>=1)
        {   

            echo '
            <h2 class="text-center my-4">Search results for "<em>'.$_GET['search_query'].'</em>"</h2>
            ';
            while($row = mysqli_fetch_assoc($result)){
                echo '
                <div class="container bg-light my-3">
                    <h3 class="text-center"><a class="text-dark" href="threadInfo.php?threadid='.$row['thread_id'].'">'.$row['thread_title'].'</a></h3>
    
                    <p class="my-2 text-center">'.$row['thread_description'].'</p>
                </div>
                ';
            }
        }else{
            echo '<h2 class="text-center my-4">No results were found</h2>';
        }


    ?>
    
    


    <?php require 'partials/_footer.php'?>
</body>

</html>