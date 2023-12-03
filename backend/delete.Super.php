<?php

include("connection.php");
$con=conectar();

$Rut=$_GET['Rut'];

$sql="DELETE FROM super  WHERE Rut='$Rut'";
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: ../super.php");
    }
    else{
        Header("Location: ../super.php");
    };
?>
