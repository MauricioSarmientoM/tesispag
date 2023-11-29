<?php

include("connection.php");
$con=conectar();

$Rut=$_GET['Rut'];

$sql="DELETE FROM users  WHERE Rut='$Rut'";
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: ../users.php");
    }
    else{
        Header("Location: ../users.php");
    };
?>
