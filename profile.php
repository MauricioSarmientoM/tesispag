<?php
    session_start();
    if (!isset($_POST['rut'])){
        header("Location: ./index.php");
    }
    $rut = $_POST['rut'];
    include("./backend/connection.php");
    include("./backend/select.php");
    $con = conectar();
    if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['password'])) {
    	$name = $_POST['name'];
    	$surname = $_POST['surname'];
		$description = $_POST['description'];
    	$email = $_POST['email'];
        $phone = $_POST['phone'];
		$password = $_POST['password'];
        if (isset($_FILES["imageURL"]) && $_FILES["imageURL"]["error"] == UPLOAD_ERR_OK) {
            $targetDirectory = "uploads/users/";  // Set your target directory
            if (!file_exists($targetDirectory)) {
                mkdir($targetDirectory, 0777, true); // The third parameter (true) creates nested directories if they don't exist
            }
            $uploadedFileName = basename($_FILES["imageURL"]["name"]);
            $targetFilePath = $targetDirectory . uniqid() . '_' . $uploadedFileName;
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["imageURL"]["tmp_name"], $targetFilePath)) {
                // Now, you can use $targetFilePath to store in the database
                $imageURL = $targetFilePath;
            } else {
                // File upload failed
                $_SESSION["error"] = "Error uploading the file.";
            }
        }
        else {
            if ($_POST['img'] === '' || $_POST['img'] == NULL) {
                $imageURL = '';
            }
            else {
                $imageURL = $_POST['img'];
            }
        }
    	$direction = $_POST['direction'];

        $stringToCheck = '$2y$10$';
        if (!(substr($password, 0, strlen($stringToCheck)) === $stringToCheck)) {
            $password = password_hash($password, PASSWORD_BCRYPT);
        }
        
        if (isset($_POST['update'])) {
            $query = $con->prepare("UPDATE users SET name = ?, surname = ?, description = ?, email = ?, phone = ?, password = ?, imageURL = ?, direction = ? WHERE rut = ?");
    		if (!$query) {
    			die("Preparation failed: " . $con->error);
    		}
    		$query->bind_param("ssssisssi", $name, $surname, $description, $email, $phone, $password, $imageURL, $direction, $rut);
    		if ($query->error) {
                die("Binding parameters failed: " . $query->error);
            }
    		if ($query->execute()) {
    			$_SESSION["success"] = "¡Has actualizado correctamente tu perfil!";
    		}
    		else {
    			$_SESSION["warning"] = $query->error;
    		}
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "Perfíl de usuario."/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel = "stylesheet" href = "./css/profile.css"/>
        <link rel = "stylesheet" href = "./css/general.css"/>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <title>UDA</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include './comp/navbar.php'; ?>
        <main>
            <?php
                $res = SelectUsersWhereRut($con, 1, 1, $rut);
                $row = $res->fetch_assoc();
            ?>
            <div class = "container perfil my-4">
                <div class ="row">
                    <div class="col lateral text-center">
                        <div class ="row-md-1 my-4">
                        <?php
                            if ($row['imageURL'] != NULL || $row['imageURL'] !== '') {
                                echo '<img class = "profileIMG" src = "' . $row['imageURL'] . '"/>';
                            }
                            else{
                                echo '<img class = "profileIMG" src = "src\icons\iconPlaceholder.png"/>';
                            }
                        ?>
                        </div>
                        <div class ="row-md-1 my-4">
                            <h2><?php echo $row['name']; ?>  <?php echo $row['surname']; ?></h2>
                        </div>
                        <div class ="row-md-1 my-4">
                        <?php
                            if ($_SESSION['rut'] == $row['rut']) {
                                echo '<button class="btn boton text-center" data-bs-toggle="modal" data-bs-target="#updateModal">Editar Perfil</button>';
                            }
                        ?>
                        </div>
                    </div>
                    <div class="col lateral py-4">
                        <h4> Descripción </h4>
                        <p><?php echo $row['description']; ?></p>
                    </div>
                    <div class="col">
                        <div class ="row vertical my-4">
                            <h4> Email: </h4>
                            <p><?php echo $row['email']; ?></p>
                        </div>
                        <div class ="row vertical my-4">
                            <h4> Número de teléfono: </h4>
                            <p><?php echo $row['phone']; ?></p>
                        </div>
                        <div class ="row my-4">
                            <h4> Dirección: </h4>
                            <p><?php echo $row['direction']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                
            </div>
            <?php
                include './comp/alerts.php';
            ?>

            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Información</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="profile.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="rut" value = "<?php echo $row['rut']?>" readonly/>
                                <input type="hidden" name="img" value = "<?php echo $row['imageURL']?>" readonly/>
                                <div class="form-group">
                                    <label for="inputName">Nombre</label>
                                    <input type="text" id = "inputName" class="form-control mb-3" name="name" value = "<?php echo $row['name']?>" required/>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSurname">Apellidos</label>
                                    <input type="text" id = "inputSurname" class="form-control mb-3" name="surname" value = "<?php echo $row['surname']?>" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDesc">Descripción</label>
                                    <input type="text" id = "inputDesc" class="form-control mb-3" name="description" value = "<?php echo $row['description']?>">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Correo</label>
                                    <input type="email" id = "inputEmail" class="form-control mb-3" name="email" value = "<?php echo $row['email']?>">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPhone">Teléfono</label>
                                    <input type="number" id = "inputPhone" class="form-control mb-3" name="phone" value = "<?php echo $row['phone']?>">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Contraseña</label>
                                    <input type="password" id = "inputPassword" class="form-control mb-3" name="password" value = "<?php echo $row['password']?>" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage">Imagen URL</label>
                                    <input type="file" id = "inputImage" class="form-control mb-3" name="imageURL" accept=".jpg, .jpeg, .png"/>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDirection">Dirección</label>
                                    <input type="text" id = "inputDirection" class="form-control mb-3" name="direction" value = "<?php echo $row['direction']?>">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="container d-flex justify-content-end">
                                    <button type="submit" name = "update" class="btn btn-primary btn-block ">Confirmar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include './comp/footer.php'; ?>
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
