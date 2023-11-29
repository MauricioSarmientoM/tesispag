<?php
    include("connection.php");
    $con = conectar();
	if (isset($_POST['rut']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['description']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['imageURL']) && isset($_POST['direction'])) {
        $rut = $_POST['rut'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$description = $_POST['description'];
		$email = $_POST['email'];
        $phone = $_POST['phone'];
		$password = $_POST['password'];
		$imageURL = $_POST['imageurl'];
		$direction = $_POST['direction'];

 		$query = $con->prepare("INSERT INTO users (name, surname, username, password, email, birthdate, sex, interests) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		if (!$query) {
			die("Preparation failed: " . $con->error);
		}
		$query->bind_param("ssssssss", $name, $surname, $username, password_hash($password, PASSWORD_BCRYPT), $email, $birthdate, $sex, $interests);
		if (!$query) {
			die("Binding parameters failed: " . $query->error);
        }
		$query->execute();
		if ($query->affected_rows > 0) {
			$_SESSION["success"] = "User was created successfully!";
		}
		else {
			$_SESSION["warning"] = $con->error;
		}
	}
    else {
        $_SESSION["warning"] = 'Fields missing.';
    }
    $con->close();
    Header("Location: ../users.php");
}
?>