<?php
	session_start();
	include 'connection.php';
	if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['birthday']) && isset($_POST['sex']) && isset($_POST['interest'])) { 
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$birthdate = $_POST['birthday'];
		$sex = $_POST['sex'];
		$interests = $_POST['interest'];

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
