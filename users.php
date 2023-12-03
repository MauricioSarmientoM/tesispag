<?php
    session_start();
    if(!isset($_SESSION['super'])) {
        header("Location: ../index.php");
    }

    include("./backend/connection.php");
    include("./backend/select.php");
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
    	if (isset($_POST['insert'])) {
     		$query = $con->prepare("INSERT INTO users (rut, name, surname, description, email, phone, password, imageURL, direction) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    		if (!$query) {
    			die("Preparation failed: " . $con->error);
    		}
    		$query->bind_param("issssisss", $rut, $name, $surname, $description, $email, $phone, password_hash($password, PASSWORD_BCRYPT), $imageURL, $direction);
    		if ($query->error) {
                die("Binding parameters failed: " . $query->error);
            }
    		if ($query->execute()) {
    			$_SESSION["success"] = "$name $surname was created successfully!";
    		}
    		else {
    			$_SESSION["warning"] = $query->error;
    		}
    	}
        elseif (isset($_POST['update'])) {
            $query = $con->prepare("UPDATE users SET name = ?, surname = ?, description = ?, email = ?, phone = ?, password = ?, imageURL = ?, direction = ? WHERE rut = ?");
    		if (!$query) {
    			die("Preparation failed: " . $con->error);
    		}
    		$query->bind_param("ssssisssi", $name, $surname, $description, $email, $phone, password_hash($password, PASSWORD_BCRYPT), $imageURL, $direction, $rut);
    		if ($query->error) {
                die("Binding parameters failed: " . $query->error);
            }
    		if ($query->execute()) {
    			$_SESSION["success"] = "$name $surname was updated successfully!";
    		}
    		else {
    			$_SESSION["warning"] = $query->error;
    		}
        }
    }
    elseif (isset($_POST['delete'])) {
        $rut = $_POST['rut'];
    	$name = $_POST['name'];
    	$surname = $_POST['surname'];

        $query = $con->prepare("DELETE FROM users WHERE rut = ?");
    	if (!$query) {
    		die("Preparation failed: " . $con->error);
		}
    	$query->bind_param("i", $rut);
    	if ($query->error) {
            die("Binding parameters failed: " . $query->error);
        }
    	if ($query->execute()) {
			$_SESSION["success"] = "$name $surname was deleted successfully!";
    	}
    	else {
			$_SESSION["warning"] = $query->error;
    	}
    }

    $showUsers = 10;
    $usersAmount = SelectUsersCount($con);
    /* datos de users */
    if (isset($_GET['search']) == false){  /* si no es una busqueda */
        $res = SelectUsers($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers);
    }
    else {
        $res = SelectUsersWhereRut($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']);
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css" />
        <link rel = "stylesheet" href = "./css/general.css"/>
        <link rel = "stylesheet" href = "./css/gestor.css" />
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <title>UDA</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include './comp/navbar.php'; ?>
        <main>
            <!-- Alerts -->
            <?php include './comp/alerts.php'; ?>

            <!-- BOTON VOLVER Y TITULO -->
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-3">    
                        <button class="boton">
                            <a href="gestor.php">
                                <h3 class="mt-2 mx-2">&#9664; Volver</h3>
                            </a>
                        </button>
                    </div>
                    <div class="col">
                        <h1 class="text-center">Gestor de Usuarios</h1>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- FIN DE BOTON VOLVER Y TITULO -->

            <!-- tablas de gestion -->
            <div class="container">
                <div class="row text-end">
                    <form action="users.php" method="get">
                        <label for="searchinput"><h5>Buscar:</h5></label>
                        <input id = "searchinput" type = "search" name = "search" placeholder ="Inserte busqueda"/>
                        <button type="submit" class="btn">Enviar</button>
                    </form>
                </div>
                <div class="row mt-2">
                    <!-- crud de usuario -->
                    <table class="table" >
                        <thead class="table-success table-striped" >
                            <tr>
                                <th>Rut</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Descripción</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <!--th>Contraseña</th-->
                                <th>Imagen</th>
                                <th>Direccion</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                $counter = 0;
                                while($row = $res->fetch_assoc()){
                                ?>
                                    <tr>
                                        <th><?php  echo $row['rut']?></th>
                                        <th><?php  echo $row['name']?></th>
                                        <th><?php  echo $row['surname']?></th>
                                        <th><?php  echo $row['description']?></th>
                                        <th><?php  echo $row['email']?></th>
                                        <th><?php  echo $row['phone']?></th>
                                        <!--th><?php //  echo $row['password']?> </th> -->
                                        <th><?php  echo $row['imageURL']?></th>
                                        <th><?php  echo $row['direction']?></th>
                                        
                                        <th><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateUserModal<?php echo $counter;?>">Editar</th>
                                        <th><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $counter;?>">Eliminar</th>
                                    </tr>
                                    <div class="modal fade" id="updateUserModal<?php echo $counter;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Usuario</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="users.php" method="post">
                                                        <div class="form-group">
                                                            <label for="inputRut">Rut</label>
                                                            <input type="text" id = "inputRut" class="form-control mb-3" name="rut" value = "<?php echo $row['rut']?>" readonly>
                                                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName">Nombre</label>
                                                            <input type="text" id = "inputName" class="form-control mb-3" name="name" value = "<?php echo $row['name']?>" required>
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
                                                            <input type="text" id = "inputPhone" class="form-control mb-3" name="phone" value = "<?php echo $row['phone']?>">
                                                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword">Contraseña</label>
                                                            <input type="password" id = "inputPassword" class="form-control mb-3" name="password" value = "<?php echo $row['password']?>" required>
                                                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputImage">Imagen URL</label>
                                                            <input type="text" id = "inputImage" class="form-control mb-3" name="imageURL" value = "<?php echo $row['imageURL']?>">
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
                                    <div class="modal fade" id="deleteModal<?php echo $counter;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Está seguro de que desea borrar a <?php echo '' . $row['name'] . ' ' . $row['surname']; ?>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <form action = "users.php" method = "post">
                                                        <input type = "hidden" name = "rut" value = "<?php echo $row['rut']; ?>"/>
                                                        <input type = "hidden" name = "name" value = "<?php echo $row['name']; ?>"/>
                                                        <input type = "hidden" name = "surname" value = "<?php echo $row['surname']; ?>"/>
                                                        <input type = "submit" name = "delete" class="btn btn-danger" value = "Eliminar"/>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $counter++;
                                }
                                ?>        
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Create User -->

            <div class="container text-center my-4">
                <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#createUserModal">Añadir Usuario</button>
            </div>
            <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="users.php" method="post">
                                <div class="form-group">
                                    <label for="inputRut">Rut</label>
                                    <input type="text" id = "inputRut" class="form-control mb-3" name="rut" placeholder="123456789-0" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nombre</label>
                                    <input type="text" id = "inputName" class="form-control mb-3" name="name" placeholder="Nombre" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSurname">Apellidos</label>
                                    <input type="text" id = "inputSurname" class="form-control mb-3" name="surname" placeholder="Apellido" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDesc">Descripción</label>
                                    <input type="text" id = "inputDesc" class="form-control mb-3" name="description" placeholder="Descripción">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Correo</label>
                                    <input type="email" id = "inputEmail" class="form-control mb-3" name="email" placeholder="alumno.universidad.20@alumnos.uda.cl">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPhone">Teléfono</label>
                                    <input type="text" id = "inputPhone" class="form-control mb-3" name="phone" placeholder = "12345678">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Contraseña</label>
                                    <input type="password" id = "inputPassword" class="form-control mb-3" name="password" placeholder="Contraseña" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage">Imagen URL</label>
                                    <input type="text" id = "inputImage" class="form-control mb-3" name="imageURL" placeholder="URL?">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDirection">Dirección</label>
                                    <input type="text" id = "inputDirection" class="form-control mb-3" name="direction" placeholder="Dirección">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="container d-flex justify-content-end">
                                    <button type="submit" name = "insert" class="btn btn-primary btn-block ">Confirmar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Create User -->

            <div class="container text-center pb-4">
                <?php
                    $usersAmount = $usersAmount->fetch_assoc();
                    $pagesAmount = ceil($usersAmount['count'] / $showUsers);
                    for ($counter = 1; $counter <= $pagesAmount; $counter++) { ?>
                        <a href="/users.php?page=<?php echo $counter . "\n"; ?>" class="btn btn-info"><?php echo $counter . "\n"; ?></a>
                <?php
                    }
                    $con->close();
                ?>
            </div>
            <!--
            <? /* include './comp/footer.php'; */?>
            -->
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
