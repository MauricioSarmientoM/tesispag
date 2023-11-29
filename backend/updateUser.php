<?php

include("connection.php");
$con=conectar();

        $rut = $_POST['rut'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$description = $_POST['description'];
		$email = $_POST['email'];
        $phone = $_POST['phone'];
		$password = $_POST['password'];
		$imageURL = $_POST['imageurl'];
		$direction = $_POST['direction'];


$sql="UPDATE users SET rut='$rut' , name='$name', , surname='$surname', description='$description', email='$email',phone='$phone',password='$password' ,imageurl='$imageurl',direction='$direction' WHERE rut='$rut'";

                                                
$query=mysqli_query($con,$sql);

if($query){
    Header("Location: ../users.php");
}
else{
	Header("Location: ../users.php");
}
?>
