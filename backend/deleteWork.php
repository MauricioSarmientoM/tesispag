<?php

include("connection.php");
$con=conectar();

$id=$_GET['id'];

$sql="DELETE FROM works  WHERE id='$id'";
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: ../works.php");
    }
    else{
        Header("Location: ../works.php");
    };
?>
