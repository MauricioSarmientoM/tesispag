<?php
	session_start();
	include './connection.php';
    include './insert.php';
    $con = conectar();
	if ($con->connect_error) {
		die("Error: " . $con->connect_error);
	}
	if (isset($_POST['rut'])) { 
		$rut = $_POST['rut'];
        $query = $con->prepare("SELECT * FROM users WHERE rut = ?");
        $query->bind_param("s", $rut);
        $query->execute();

        $result = $query->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $subject = 'RECUPERAR CONTRASEÑA';
            $body = $row['name'] . ' ' . $row['surname'] . ', con el RUT ' . $row['rut'] . ' y email ' . $row['email'] . ' solicita recuperar su contraseña';

            InsertContact($con, $rut, $subject, $body);
        }
        else {
            $_SESSION['error'] = "El rut $rut no está registrado en nuestro sistema.";
        }
    }
	else {
		$_SESSION['warning'] = "Debes ingresar un RUT.";
	}
    $con->close();
    header("Location: ../index.php");
?>
