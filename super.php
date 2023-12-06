<?php
    session_start();
    if(!isset($_SESSION['super'])) {
        header("Location: ../index.php");
    }

    include("./backend/connection.php");
    include("./backend/select.php");
    $con = conectar();
    if (isset($_POST['rut'])) {
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
     		$query = $con->prepare("INSERT INTO super (rut) VALUES (?) ");
    		if (!$query) {
    			die("Preparation failed: " . $con->error);
    		}
    		$query->bind_param("i", $rut);
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
        }
    elseif (isset($_POST['delete'])) {
        $rut = $_POST['rut'];
/*     	$name = $_POST['name'];
    	$surname = $_POST['surname']; */

        $query = $con->prepare("DELETE * FROM super  WHERE rut = ?");
    	if (!$query) {
    		die("Preparation failed: " . $con->error);
		}
    	$query->bind_param("i", $rut);
    	if ($query->error) {
            die("Binding parameters failed: " . $query->error);
        }
    	if ($query->execute()) {
			$_SESSION["success"] = "$rut was deleted successfully!";
    	}
    	else {
			$_SESSION["warning"] = $query->error;
    	}
    }


    $showSupers = 10;
    $usersAmount = SelectSupersCount($con);
    /* datos de Supers */
    if (isset($_GET['search']) == false){  /* si no es una busqueda */
        $res = SelectSupers($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showSupers);
    }
    else {
        $res = SelectSupersWhereRut($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showSupers, $_GET['search']);
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css" />
        <link rel = "stylesheet" href = "./css/general.css" />
        <link rel = "stylesheet" href = "./css/gestor.css" />
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <title>UDA</title>
    </head>
    <body>
        <!-- navbar -->
        <?php include './comp/navbar.php'; ?>
        <main>
            <!-- Alerts -->
            <?php include './comp/alerts.php' ?>
            
            <div class="container w-100 mt-5 se">
                <div class="row text-end">
                    <form action="search.php" method="post">
                        <label for="searchinput"><h5>Buscar:</h5></label>
                        <input id = "searchinput" type = "text" name = "search" placeholder ="Inserte busqueda">
                        <button type="submit" class="btn">Enviar</button>
                    </form>
                </div>
	        </div>
            <div class="w-100 mt-5">
             <!-- crud de usuario -->
                <div class="w-100">
                    <table class="table" >
                        <thead class="table-success table-striped tableh" >
                            <tr>
                                <th>Rut</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
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
                                        <td><?php  echo $row['rut']?></td>
                                        <td><?php  echo $row['name']?></td>
                                        <td><?php  echo $row['surname']?></td>
                                        <td><button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#InfoUserModal">Inf</button></td>
                                    </tr>


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
                        <h1 class="text-center">Gestor de Administradores</h1>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- FIN DE BOTON VOLVER Y TITULO -->

            <!-- CONTENEDOR DE TABLA DE GESTION -->
            <div class="container">
                                         <th><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php //echo $counter;?>">Eliminar</th>
                                    </tr>
                                    <div class="modal fade" id="deleteModal<?php echo $counter;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Está seguro de que desea borrar a <?php echo '' . $row['name'] . ' ' . $row['surname']; ?> como administrador?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <form action = "super.php" method = "post">
                                                        <input type = "hidden" name = "rut" value = "<?php echo $row['rut']; ?>"/>
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
                                <tr><td colspan="5" class="container w-100">            
                                    
                                <div class="container w-100">
                <button type="button" class="buttonadd" data-bs-toggle="modal" data-bs-target="#createSuperModal"><h1>+</h1></button>
            </div>
            <div class="modal fade" id="createSuperModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="super.php" method="post">
                                <div class="form-group">
                                    <label for="inputRut">Rut</label>
                                    <input type="text" id = "inputRut" class="form-control mb-3" name="rut" placeholder="123456789-0" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                
                                <div class="container d-flex justify-content-end">
                                    <button type="submit" name = "insert" class="btn btn-primary btn-block ">Confirmar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- FIN DE CONTENEDOR DE TABLA DE GESTION -->
        </main>
        <?php include './comp/footer.php'; ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
