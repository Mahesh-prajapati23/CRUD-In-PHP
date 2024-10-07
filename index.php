<?php

$insert = false;
// connecting to database
$servername = "localhost";
$username = "root";
$password = "Mysql@123,";
$database = "notes";


// Create a connection object

$conn = mySqli_connect($servername,$username,$password,$database);

//Die if connection was not successful!
if(!$conn){
    echo ("Sorry we failed to connect database(mySql) :". mysqli_connect_error());
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $title = $_POST["title"];
  $description = $_POST["description"];

  // sql query to be execute
  $sql = "INSERT INTO `note` (`title`, `description`) VALUES ('$title','$description')";
  $result = mySqli_query($conn,$sql);

  // Add a new data in tha datanase
  if($result){
    // echo "Record has been inserted successfully!<br>";
    $insert = true;
  }
  else{
    echo "Record was not inserted successsfully! bcz for this error -->".mysqli_error($conn);
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css">
    
    <script 
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous">></script>
  <script src="//cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
  
  
  </head>
  <body>

  <!-- edit  modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this note!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/CRUD/index.php" method="POST">
            <div class="mb-3">
              <label for="exampleInputEmail1Edit" class="form-label">Note title</label>
              <input type="text" class="form-control" name="titleEdit" id="exampleInputEmail1Edit" placeholder="Enter your note title here!" aria-describedby="emailHelp">
              
            </div>
            <div class="mb-3">
                    <label for="floatingTextareaEdit" class="form-label">Note description</label>
                    <textarea class="form-control" name="descriptionEdit" placeholder="Enter some description about your note here!" id="floatingTextareaEdit"></textarea>   
            </div>
            
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">iNotes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact us</a>
              </li>
              
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <?php
      if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been inserted successfully!. 
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
      }
      ?>

      <div class="container mt-4">
        <h2>Add a Note!</h2>
        <form action="/CRUD/index.php" method="POST">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Note title</label>
              <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter your note title here!" aria-describedby="emailHelp">
              
            </div>
            <div class="mb-3">
                    <label for="floatingTextarea" class="form-label">Note description</label>
                    <textarea class="form-control" name="description" placeholder="Enter some description about your note here!" id="floatingTextarea"></textarea>   
            </div>
            
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>

      <div class="container my-4">
        

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">Title</th>
      <th scope="col">Descrption</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
        $sql = "SELECT * FROM `note`";
        $result = mySqli_query($conn,$sql);

        $sno =0;
        while($row = mysqli_fetch_assoc($result)){
            $sno = $sno +1;
          echo "<tr>
                 <th >".$sno."</th>
                 <td>".$row['title']."</td>
                 <td>".$row['description']."</td>
                 <td>  <button class='edit btn btn-sm btn-primary'>Edit</button> <a href='/delete'>Delete</a>
          </td>
                </tr>";
                
        }
         ?>

        
    
   
  </tbody>
</table>
      </div>
      <hr>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      let table = new DataTable('#myTable');
    </script>
    <script>
    edits = document.getElementsByClassName('edit')
    Array.from(edits).forEach((element)=>{
      element.addEventListener("click",(e)=>{
        console.log("edit",);
        tr=e.target.parentNode.parentNode
        title = tr.getElementsByTagName("td")[0].innerText
        description = tr.getElementsByTagName("td")[1].innerText
        console.log(title,description)
        titleEdit.value = title
        descriptionEdit.value = description
        $('#editModal').modal('toggle')
      })
    })
    // const myModalAlternative = new bootstrap.Modal('#editModal', options)
    
  </script>
  </body>
</html>