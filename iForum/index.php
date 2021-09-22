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
        require 'partials/_db_connect.php';
    ?>

    <!-- Slider begins here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/featured/2400x700/?coding,programming,computer,apple"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/featured/2400x700/?coding,programming,computer,microsoft"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/featured/2400x700/?coding,programming,computer,ai"
                    class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <h1 class="text-center my-4">Browse Categories</h1>



    <!-- Category container starts here -->
    <div class="container my-4">
        <div class="row center">
            <?php
      
      $getCategories = "SELECT * FROM `categories`";
      $result = mysqli_query($conn, $getCategories);
      while($category = mysqli_fetch_assoc($result)){
          $catName = $category['category_name'];
          $catId = $category['category_id'];
      echo  '
        <div class="col-md-4 my-2">
            <div class="card" style="width: 18rem;">
                <img src="https://source.unsplash.com/500x400/?programming,'.$catName.'" class="card-img-top" alt="'.$catName.'">
                    <div class="card-body">
                        <h5 class="card-title">'.$catName.'</h5>
                        <p class="card-text">'.$category["category_description"].'</p>
                        <a href="threads.php?catid='.$catId.'" class="btn btn-primary">Explore threads</a>
                </div>
            </div>
        </div>
        ';
      }
    
      
  ?>
        </div>
    </div>


    <?php require 'partials/_footer.php'?>
</body>

</html>