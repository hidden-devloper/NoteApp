
<?php
$insert = false;
$update = false;
$delete = false;

$conn = mysqli_connect("localhost", "root", "", "YOUR_DATABASE_NAME");

if(!$conn){
    echo "not ". mysqli_connect_error();
}
else{
  //echo "successfully connected <br>"; 
}

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `tabledata` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

$sql = "UPDATE `tabledata` SET `title` = '$title' , `description` = '$description' WHERE `tabledata`.`sno` = $sno";

// $sql = "UPDATE `tabledata` SET `title` = 'titleee1', `description` = 'it is the part of description and it is our first Note2999uuuuu' WHERE `tabledata`.`sno` = 1;

$result = mysqli_query($conn, $sql);
if($result){
    $update = true;
}
else{
    echo "We could not update ";
}
}
else{
    $title = $_POST["title"];
    $description = $_POST['description'];

  // Sql query to be executed
  $sql = "INSERT INTO `tabledata` (`title`, `description`) VALUES ('$title', '$description')";

  //INSERT INTO `tabledata` (`sno`, `title`, `description`, `timestamp`) VALUES (NULL, 'MY FIrst Note is here', 'mmmmmmmmmmm', current_timestamp());

  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error". mysqli_error($conn);
  } 
}
}
?>

<!--HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoteApp</title>
  <!--  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.">--->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <!--- <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script>
      $(document).ready( function (){
         $('#myTable').DataTable();
      });:rgb(245	,245	,220)
      </script>-->


<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <style>
     body{
      background-color:#E1F8DC;
      
     }
     form  #title{
      width:50%;
     }


    </style>
</head>
<body>


<!--modall--->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
         <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"> </span>
          </button>---->
        </div>
        <form action="/noteapp/main.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!--nav--->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)">iNoTes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
       
      
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="text" placeholder="your note">
        <button class="btn btn-primary" type="button">Search</button>
      </form>
    </div>
  </div>
</nav>


  <?php
if($insert){
   echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>success!</strong> Your Note has been inserted 
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
if($delete){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
 <strong>success!</strong> Your Note has been deleted successfulyy 
 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
if($update){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
 <strong>success!</strong> Your Note has been successfulyy updated
 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

?>
<!--alert-->
  <div class="container my-2">
    <h2 style="text-align : center ;">Add a Note</h2><br><br>
    <form action= "main.php" method ="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Note title</label>
        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" width="50px" >
       
      </div>
     
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>

  <div class="container">
<table class="table" id="mytable">
  <thead>
    <tr>
      <th scope="col">sno</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
$sql = "SELECT * FROM `tabledata`";
$resultn  = mysqli_query($conn, $sql);

if(!$resultn){
  echo "query failes ". mysqli_error($conn);
}
$sno = 0;
while($row = mysqli_fetch_assoc($resultn)){
  $sno = $sno +1;
  echo " <tr>
       <th scope='row'>". $sno . "</th>
      <td>". $row['title'] ."</td>
      <td>". $row['description'] ."</td>
      <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">edit</button>  <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> </td>
    </tr>";

}
?>
  </tbody>
</table>
</div>

<!--JS-->
<!--<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="crossorigin="anonymous"></script>---
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>-->
<script src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="crossorigin="anonymous"></script>
<!--<link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.">

<script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>-->



<link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
<script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
<script>
 let table = new DataTable('#myTable');
  $(document).ready( function (){
     $('#mytable').DataTable();
  });
  
</script>
<script>

let edits = document.getElementsByClassName('edit');
Array.from(edits).forEach((element)=>{
  element.addEventListener("click", (e) =>{
//   console.log("edit ");
        tr = e.target.parentNode.parentNode ; 
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(e.target.id)
        console.log(title + "\n" + description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
     //   console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

 deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/noteapp/main.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>


