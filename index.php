<?php

$insert=false;
$update=false;
$delete=false;

$conn= mysqli_connect("localhost","root","","registerduser");

if(mysqli_connect_error()){
    echo"<script>window.alert('cannot connect to the database');</script>";
    exit();

}
if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
  $delete=true;
  $sql=  "DELETE FROM `note` WHERE `sno` = $sno";
  $result=mysqli_query($conn,$sql);
}

if($_SERVER['REQUEST_METHOD']=='POST'){

  if(isset($_POST['snoedit'])){
    $sno=$_POST['snoedit'];

    $title=$_POST['titleedit'];
    $description=$_POST['descriptionedit'];

    $sql="UPDATE `note` SET `title` = '$title' , `description` = '$description'  WHERE `note`.`sno` = $sno";
    $result=mysqli_query($conn,$sql);

    $update=true;
   
   
  }
  else{
    $title=$_POST['title'];
    $description=$_POST['description'];

    $sql="INSERT INTO `note` (`title`,`description`) VALUES ('$title','$description')";
    $result=mysqli_query($conn,$sql);

    if($result){
      echo"<script>
      alert('notes inseerted');
      </script>";
    }
    else{
      echo"notes not inserted" .mysqli_error($conn);
    }
}
  
    
}


?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $ (document).ready(function () {
          $('#myTable') .DataTable();
          } );
</script>
    
  </head>
  <body>

  <!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit
</button>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModal">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/crud/index.php" method="POST">
        <input type="hidden" name="snoedit" id="snoedit">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Note Title</label>
              <input type="text"  class="form-control" id="titleedit" name="titleedit" aria-describedby="emailHelp">
             </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Note Description</label>
                <textarea class="form-control" id="descriptionedit" name="descriptionedit" rows="3"></textarea>
              </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary" name="update">update</button>
          </form>
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Menu</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">contact us</a>
              </li>
             
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <div class="container my-5">

        <h1>Add a Note</h1>
        <form action="/crud/index.php?update=true" method="POST">
          
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Note Title</label>
              <input type="text"  class="form-control" id="title" name="title" aria-describedby="emailHelp">
             </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Note Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary" name="add">ADD</button>
          </form>

          <div class="container">
         
<table class="table" id="myTable">
   <thead>
    <tr>
      <th scope="col">s.no</th>
      <th scope="col">title</th>
      <th scope="col">description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   
    <?php


          $sql="SELECT * FROM `note`";
          $result = mysqli_query($conn,$sql);
          $sno=0;
          
          while($row=mysqli_fetch_assoc($result)){
            $sno=$sno+1;
            echo"<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['title'] . "</td>
            <td>". $row['description'] . "</td>
            <td> <button type='button' class='edit btn btn-sm btn-primary'data-bs-toggle='#editModal' data-bs-target=#editModal' id=".$row['sno'].">Edit</button>
              <button type='button' class='delete' id=d".$row['sno'].">Delete</button></td>
          </tr>";
           
          }
         
          ?>
         
    
  </tbody>
</table>




          </div>
      </div>
      <hr> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script >
      edit = document.getElementsByClassName("edit");
      Array.from(edit).forEach((element)=>{
       element.addEventListener("click",(e)=>{
        console.log("edit",);
        tr=e.target.parentNode.parentNode;
        title=tr.getElementsByTagName("td")[0].innerText;
        description=tr.getElementsByTagName("td")[1].innerText;
        console.log(title,description);
        titleedit.value=title;
        descriptionedit.value=description;
        snoedit.value=e.target.id;
        console.log(e.target.id)
       $('#editModal').modal('toggle');
     

      
       } )
      
      })
      deletes= document.getElementsByClassName("delete");
      Array.from(deletes).forEach((element)=>{
       element.addEventListener("click",(e)=>{
        console.log("edit",);
       sno = e.target.id.substr(1,)
        
        if(confirm("Are you sure you want to delete a record!")){
          console.log("yes");
          window.location=`/crud/index.php?delete=${sno}`;
        }
        else{
          console.log("no")
        }
     

      
       } )
      
      })
    </script>
  </body>
</html>