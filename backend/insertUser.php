<?php
    include("./connection.php");
    $con = conectar();
	if (isset($_POST['rut']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['password'])) {
        $rut = $_POST['rut'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$description = $_POST['description'];
		$email = $_POST['email'];
        $phone = $_POST['phone'];
		$password = $_POST['password'];
		$imageURL = $_POST['imageURL'];
		$direction = $_POST['direction'];

 		$query = $con->prepare("INSERT INTO users (rut, name, surname, description, email, phone, password, imageURL, direction) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		if (!$query) {
			die("Preparation failed: " . $con->error);
		}
		$query->bind_param("issssssss", $rut, $name, $surname, $description, $email, $phone, password_hash($password, PASSWORD_BCRYPT), $imageURL, $direction);
		if ($query->error) {
            die("Binding parameters failed: " . $query->error);
        }
		if ($query->execute()) {
			$_SESSION["success"] = "User was created successfully!";
		}
		else {
			$_SESSION["warning"] = $query->error;
		}
	}
    else {
        $_SESSION["warning"] = 'Fields missing.';
    }
    $con->close();
    Header("Location: ../users.php");
?>