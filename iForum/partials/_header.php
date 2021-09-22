<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">iForum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">Contact Us</a>
                </li>

            </ul>

            <form class="d-flex" action="search.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search" name="search_query" aria-label="Search">
                <button class="btn btn-success" type="submit" >Search</button>
            </form>

            <?php
              session_start();
              // login check
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                echo '
                <p class="text-light mx-3 my-2">Welcome <strong>'.$_SESSION['username'].'</strong></p>
                <a class="btn btn-outline-success mx-2" href="partials/_handleLogout.php">Logout</a>';
              }else{
                echo '<button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                      <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>';
              }
            ?>


        </div>
    </div>
</nav>

<?php
  include 'partials/_login.php';
  include 'partials/_signUp.php';

  if(isset($_GET['signupsuccess']) ){
    if($_GET['signupsuccess']=='true')
    {
      echo '
      <div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
          <strong>Sign Up successful</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    ';
    }else{
      echo '
      <div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
          <strong>'.$_GET['error'].'</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    ';
    }
  }
?>