<?php
	session_start();
	include 'connection.php';
	if (isset($_POST['rut']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['description']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['imageURL']) && isset($_POST['direction'])) { 
        $rut = $_POST['rut'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$description = $_POST['description'];
		$email = $_POST['email'];
        $phone = $_POST['phone'];
		$password = $_POST['password'];
		$imageURL = $_POST['imageURL'];
		$direction = $_POST['direction'];

		$query = $connection->prepare("INSERT INTO users (name, surname, username, password, email, birthdate, sex, interests) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		if (!$query) {
			die("Preparation failed: " . $connection->error);
		}
		$query->bind_param("ssssssss", $name, $surname, $username, password_hash($password, PASSWORD_BCRYPT), $email, $birthdate, $sex, $interests);
		if (!$query) {
			die("Binding parameters failed: " . $query->error);
		}
		if ($query->execute()) {
			$_SESSION["name"] = $name;
			$_SESSION["surname"] = $surname;
			$_SESSION["username"] = $username;
			$_SESSION["email"] = $email;
			$_SESSION["birthdate"] = $birthdate;
			$_SESSION["sex"] = $sex;
			$_SESSION["interests"] = $interests;
			$_SESSION["success"] = "Your account was created successfully!";
			header("Location: ../index.php");
			exit();
		}
		else {
			$_SESSION["warning"] = $connection->error;
			header("Location: ../signin.php");
			exit();
		}
	}
	$connection->close();
?>
