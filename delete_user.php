<?php
require_once('conn.php');

$conn   =   DBConnect();
$id     =   $_GET['id'];

$sql    =   "DELETE from tbl_users WHERE id='$id' ";

$results = mysqli_query($conn,$sql);

if($results == true){
    header("Location: index.php?msg=Record Deleted Successfully");
    exit();
}else{
    echo  "Error: " . mysqli_error();
}
?>