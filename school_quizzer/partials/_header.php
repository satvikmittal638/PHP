<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location: /school_quizzer/login.php");
    exit();
}

include 'partials/_modalNewQuiz.php';
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">School Quizzer</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

      
        
    
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage Quizzes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
           
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addQuizModal" href="">Assign a Quiz</a></li>
            <li><a class="dropdown-item" href="/school_quizzer/displayQuizzes.php">Previously assigned quizzes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
    
      </ul>

      
      <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <p class="text-white mx-2 my-2">Welcome <strong><?php echo $_SESSION['admin']['name'] ?></strong></p>
        <a href="partials/_handleLogout.php"><button class="btn btn-outline-success mx-2">Logout</button></a>
    </div>
  </div>
</nav>