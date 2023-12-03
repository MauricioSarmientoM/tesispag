<?php
    include("connection.php");
    $con = conectar();
/*     if (isset($_POST['name']) && isset($_POST['obj']) && isset($_POST['area']) && isset($_POST['abstract']) && isset($_POST['image'])) { */
        $name = $_POST['name'];
        $obj = $_POST['obj'];
        $area = $_POST['area'];
        $abstract = $_POST['abstract'];
        $image = $_POST['image'];

/*         $query = $connection->prepare("INSERT INTO works (name, obj, area, abstract, image) VALUES (?, ?, ?, ?, ?)");
		if (!$query) {
			die("Preparation failed: " . $connection->error);
		}
		$query->bind_param("sssss", $name, $obj, $area, $abstract, $image);
		if (!$query) {
			die("Binding parameters failed: " . $query->error);
        }
        $query->execute();
		if ($query->affected_rows > 0) {
			$_SESSION["success"] = "Work was created successfully!";
		}
		else {
			$_SESSION["warning"] = $connection->error;
		}
    } */
	$sql="INSERT INTO works VALUES('$name','$obj','$area','$abstract','$image')";
$query= mysqli_query($con,$sql);

if($query){
    Header("Location: ../works.php");
}
else{
	Header("Location: ../works.php");
}
?>