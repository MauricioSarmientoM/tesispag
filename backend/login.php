<?php
	session_start();
	$server = "127.0.0.1";
	$user = "root";
	$pass = "12345678";
	$db = "tesis";
	$connection = new mysqli($server, $user, $pass, $db);
	if ($connection->connect_error) {
		die("Error: " . $connection->connect_error);
	}
	if (isset($_POST['rut']) && isset($_POST['password'])) { 
		$rut = $_POST['rut'];
		$password = $_POST['password'];
		// Use a prepared statement to prevent SQL injection
        $query = $connection->prepare("SELECT password FROM users WHERE rut = ?");
        $query->bind_param("s", $rut);
        $query->execute();

        $result = $query->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $query = $connection->prepare("SELECT * FROM users WHERE rut = ?");
                $query->bind_param("s", $rut);
                $query->execute();

                $result = $query->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION["rut"] = $row['rut'];
                    $_SESSION["name"] = $row['name'];
                    $_SESSION["surname"] = $row['surname'];
                    $_SESSION["description"] = $row['description'];
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["phone"] = $row['phone'];
                    $_SESSION["password"] = $row['password'];
                    $_SESSION["imageURL"] = $row['imageURL'];
                    $_SESSION["direction"] = $row['direction'];
                }
                else {
                    $_SESSION['error'] = "Couldn't enter to your session, try again.";
                }
            }
            else {
                $_SESSION['warning'] = "Invalid password.";
            }
        }
        else {
            $_SESSION['error'] = "$rut is not an user.";
        }
    }
	else {
		$_SESSION['warning'] = "Must provide a RUT and a password.";
	}
    $connection->close();
    header("Location: ../index.php");
?>
