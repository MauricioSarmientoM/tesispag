<?php
	session_start();
	include './connection.php';
    $con = conectar();
	if ($con->connect_error) {
		die("Error: " . $con->connect_error);
	}
	if (isset($_POST['rut']) && isset($_POST['password'])) { 
		$rut = $_POST['rut'];
		$password = $_POST['password'];
		// Use a prepared statement to prevent SQL injection
        $query = $con->prepare("SELECT password FROM users WHERE rut = ?");
        $query->bind_param("s", $rut);
        $query->execute();

        $result = $query->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $query = $con->prepare("SELECT * FROM users WHERE rut = ?");
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
                    $_SESSION["imageURL"] = $row['imageURL'];
                    $_SESSION["direction"] = $row['direction'];

                    //Extra step to detect admin/super users
                    $query = $con->prepare("SELECT * FROM super WHERE rut = ?");
                    $query->bind_param("s", $rut);
                    $query->execute();
    
                    $result = $query->get_result();
                    if ($result->num_rows > 0) {
                        $_SESSION["super"] = 'Super';
                    }
                }
                else {
                    $_SESSION['error'] = "No se ha podido iniciar sesión, inténtelo otra vez.";
                }
            }
            else {
                $_SESSION['warning'] = "Contraseña inválida.";
            }
        }
        else {
            $_SESSION['error'] = "El rut $rut no está registrado en nuestro sistema.";
        }
    }
	else {
		$_SESSION['warning'] = "Debes ingresar un RUT y contraseña.";
	}
    $con->close();
    header("Location: ../index.php");
?>
