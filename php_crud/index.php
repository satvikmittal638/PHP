<?php

// Connecting to the db
$serverName = "localhost";
$uname = "root";
$pwd = "";
$dbName = "db_notes";
$tblNames = ["tbl_notes"];
$conn = mysqli_connect($serverName, $uname, $pwd, $dbName);

if(!$conn){
  die(mysqli_error($conn));
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(isset($_POST['idEdit'])){
    // Updating the notes
    $idEdit = $_POST['idEdit'];
    $titleEdit = $_POST['titleEdit'];
    $descEdit = $_POST['descEdit'];
    $update = "UPDATE `tbl_notes` SET `title` = '$titleEdit' , `description` = '$descEdit' WHERE `id` = $idEdit";
    $result = mysqli_query($conn, $update);
    if($result){
      echo "Updated successfully";
    }
    else{
      echo "Can't update due to ".mysqli_error($conn);
    }
    
  } 
  else{
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $insert = "INSERT INTO `tbl_notes` (`title`, `description`) VALUES ('$title', '$desc')";
    $isDataInserted = mysqli_query($conn, $insert);
    if($isDataInserted){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Note was added successfully</strong> 
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div> ";
           
    }
  }
}


if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $delete = "DELETE FROM `tbl_notes` WHERE `id`=$id";
  $isDeleted = mysqli_query($conn, $delete);
  if($isDeleted){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Note was deleted successfully</strong> 
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div> ";
  }else{
    
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <!-- DataTable Linkings -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
  <script>

    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>




  <title>sNotes - Note taking made handy</title>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
    crossorigin="anonymous"></script>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="/php_crud/index.php" method="POST">

            <input type="hidden" name="idEdit" id="idEdit">

            <div class="mb-3 my-5">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 mt-5">
              <label for="desc" class="form-label">Description</label>
              <textarea class="form-control" id="descEdit" rows="3" name="descEdit"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Note</button>

          </form>
        </div>

      </div>
    </div>
  </div>

  <div class="container">

    <form action="/php_crud/index.php" method="POST">
      <div class="mb-3 my-5">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-3 mt-5">
        <label for="desc" class="form-label">Description</label>
        <textarea class="form-control" id="desc" rows="3" name="desc"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>

  <div class="container">
    <table class="table my-4" id="myTable">
      <thead>
        <tr>
          <th scope="col">S No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
            $select = "SELECT * FROM `tbl_notes`";
            $records = mysqli_query($conn, $select);
            $sno = 1;
            while($row = mysqli_fetch_assoc($records)){
              echo  
              "<tr>
                <th scope='row'>".$sno."</th>
                <td>".$row['title']."</td>
                <td>".$row['description']."</td>
                <td><button class='edit btn btn-sm btn-primary' id=".$row['id'].">Edit</button>
                  <button class='delete btn btn-sm btn-primary' id=d".$row['id'].">Delete</button>
                </td>
              </tr>";
              $sno++;
            }
        ?>

      </tbody>
    </table>

  </div>


  <script>
    edits = document.getElementsByClassName("edit");
    Array.from(edits).forEach((element) =>
      element.addEventListener("click", (e) => {

        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        desc = tr.getElementsByTagName("td")[1].innerText
        console.log(title, desc);
        titleEdit.value = title;
        descEdit.value = desc;
        $('#editModal').modal('toggle');
        idEdit.value = e.target.id;
        console.log(e.target.id);
      }));


    deletes = document.getElementsByClassName("delete");
    Array.from(deletes).forEach((element) =>
      element.addEventListener("click", (e) => {
        id = e.target.id.substr(1,); // removes the first character
        if(confirm("Do you want to delete the note ?")){
            console.log("Yes delete");
            window.location = `/php_crud/index.php/?delete=${id}`;
        }else{

        }
      }));
  </script>
</body>

</html>