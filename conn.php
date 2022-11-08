<?php

function DBConnect(){

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "phpcrud";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die( "Error Connection: " . mysqli_connect_error());
}else{
    //echo "Successfull Connection";
}

return $conn;

}

?>
