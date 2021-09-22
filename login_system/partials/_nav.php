<?php
// session is already started in other scripts
$loggedIn = isset($_SESSION['loggedIn']) && isset($_SESSION['loggedIn']);


echo 
'<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">phpLOGIN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">';

        if($loggedIn){
          echo '<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/login_system/welcome.php">Home</a>
          </li>';
          echo '<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/login_system/logout.php">Logout</a>
          </li>';
        }else{

          echo '<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/login_system/login.php">Login</a>
          </li>';
          echo '<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/login_system/signUp.php">Sign Up</a>
          </li>';
        }
        



      echo '</ul>
    
    </div>
  </div>
</nav>';
?>