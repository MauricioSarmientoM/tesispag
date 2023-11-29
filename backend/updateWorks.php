<?php

include("connection.php");
$con=conectar();
        $id = $_POST['name'];
        $name = $_POST['name'];
        $obj = $_POST['obj'];
        $area = $_POST['area'];
        $abstract = $_POST['abstract'];
        $image = $_POST['image'];


$sql="UPDATE works SET name='$name', obj='$obj', area='$area', abstract='$abstract',image='$image' WHERE id='$id'";

                                                
$query=mysqli_query($con,$sql);

if($query){
    Header("Location: ../works.php");
}
else{
	Header("Location: ../works.php");
}
?>