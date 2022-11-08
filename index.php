<?php require_once('conn.php');
$conn = DBConnect(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CRUD</title>
</head>
<body>
    <div class="container mt-5 mb-5">
        <a href="add_user.php" class="btn btn-success">Add New Record</a>
        <div class="mt-3"><?php if(isset($_GET['msg'])){
            echo $_GET['msg'];
        }?>

        </div>
    
    <table class="table mt-3">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Gender</th>
      <th scope="col">Skills</th>
      <th scope="col">Address</th>
      <th rowspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
        <?php
        $sql = "SELECT * FROM tbl_users ";
        if($results = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($results)){
        ?>
        
    <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['firstname']; ?></td>
      <td><?php echo $row['lastname']; ?></td>
      <td><?php echo $row['user_email']; ?></td>
      <td><?php echo $row['user_gender']; ?></td>
      <td><?php echo $row['user_skills']; ?></td>
      <td><?php echo $row['user_address']; ?></td>
      <td><a class="btn btn-success" href="update_user.php?id=<?php echo $row['id']; ?>">Edit</a> <a class="btn btn-danger" onclick="deleteConfirmation(<?php echo $row['id']; ?>)" href="javascript:void(0);">Delete</a></td>
      <td></td>
    </tr>
    <?php
    }
}else { ?>

  <tr>
    <td colspan="9">No Record Found</td>
  </tr>
<?php }
?>    

  </tbody>
</table>
</div>

<script>
function deleteConfirmation(id) {
  var x = confirm("Please confirm you want to delete the record.!");
  if(x){
    location.href = 'delete_user.php?id='+id;
    alert("Record is deleted.");
    //location.reload();
  }
  else{
    alert("Record not deleted..");
  }
}
</script>

</body>
</html>

