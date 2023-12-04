<?php
    session_start();
    if(!isset($_SESSION['super'])) {
        header("Location: ../index.php");
    }

    include("./backend/connection.php");
    include("./backend/select.php");
    $con = conectar();

    if (isset($_POST['name'])) {
    	$name = $_POST['name'];
    	$obj = $_POST['obj'];
		$area = $_POST['area'];
    	$abstract = $_POST['abstract'];
        $image = $_POST['image'];
    	if (isset($_POST['insert'])) {
     		$query = $con->prepare("INSERT INTO works (name, obj, area, abstract, image) VALUES (?, ?, ?, ?, ?)");
    		if (!$query) {
    			die("Preparation failed: " . $con->error);
    		}
    		$query->bind_param("sssss", $name, $obj, $area, $abstract, $image);
    		if ($query->error) {
                die("Binding parameters failed: " . $query->error);
            }
    		if ($query->execute()) {
    			$_SESSION["success"] = "$name was created successfully!";
    		}
    		else {
    			$_SESSION["warning"] = $query->error;
    		}
    	}
        elseif (isset($_POST['update'])) {
            $id = $_POST['id'];
            $query = $con->prepare("UPDATE works SET name = ?, obj = ?, area = ?, abstract = ?, image = ? WHERE id = ?");
    		if (!$query) {
    			die("Preparation failed: " . $con->error);
    		}
    		$query->bind_param("sssssi", $name, $obj, $area, $abstract, $image, $id);
    		if ($query->error) {
                die("Binding parameters failed: " . $query->error);
            }
    		if ($query->execute()) {
    			$_SESSION["success"] = "$name was updated successfully!";
    		}
    		else {
    			$_SESSION["warning"] = $query->error;
    		}
        }
    }
    elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $query = $con->prepare("DELETE FROM works WHERE id = ?");
        if (!$query) {
            die("Preparation failed: " . $con->error);
        }
        $query->bind_param("i", $id);
        if ($query->error) {
            die("Binding parameters failed: " . $query->error);
        }
        if ($query->execute()) {
            $_SESSION["success"] = "$name was deleted successfully!";
        }
        else {
            $_SESSION["warning"] = $query->error;
        }
    }

    $showWorks = 10;
    $worksAmount = SelectWorksCount($con);
    if (isset($_GET['search']) == false){  /* si no es una busqueda */
        $res = SelectWorks($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showWorks);
    }
    else {
        $res = SelectWorksWhereId($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showWorks, $_GET['search']);
    }
?>
<!DOCTYPE html>
<html lang="en-US">
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
                        <h1 class="text-center">Gestor de Trabajadores</h1>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- FIN DE BOTON VOLVER Y TITULO -->

            <!-- CONTENEDOR DE TABLA DE GESTION -->
            <div class="container w-100 mt-5">
                <form action="works.php" method="get">
                    <label for="searchinput"><h2>Buscar</h2></label>
                    <div class="row"> 
                        <div class="col-md-2">
                            <a href="gestor.php"><button type="button" class="btn btn-danger">Volver</button></a>
                        </div>
                        <div class="col-md-2">
                            <input id = "searchinput" type = "search" name = "search" placeholder ="Inserte busqueda"/>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
             <div class="mt-5">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table" >
                            <thead class="table-success table-striped" >
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Objetivos</th>
                                    <th>Area</th>
                                    <th>Abstract</th>
                                    <th>Imagen</th>
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
                                    <th><?php  echo $row['id']?></th>
                                    <th><?php  echo $row['name']?></th>
                                    <th><?php  echo $row['obj']?></th>
                                    <th><?php  echo $row['area']?></th>
                                    <th><?php  echo $row['abstract']?></th>
                                    <th><?php  echo $row['image']?></th>

                                    <th><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateWorksModal<?php echo $counter;?>">Editar</th>
                                    <th><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $counter;?>">Eliminar</th>                                   
                                </tr>
                                <div class="modal fade" id="updateWorksModal<?php echo $counter;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Usuario</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="works.php" method="post">
                                                        <div class="form-group">
                                                            <label for="inputName">Nombre</label>
                                                            <input type="text" id = "inputName" class="form-control mb-3" name="name" value = "<?php echo $row['name']?>" required>
                                                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputObj">Objetivos</label>
                                                            <input type="text" id = "inputObj" class="form-control mb-3" name="obj" value = "<?php echo $row['obj']?>">
                                                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputArea">Área</label>
                                                            <input type="text" id = "inputArea" class="form-control mb-3" name="area" value = "<?php echo $row['area']?>">
                                                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAbstract">Abstract</label>
                                                            <input type="text" id = "inputAbstract" class="form-control mb-3" name="abstract" value = "<?php echo $row['abstract']?>">
                                                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputImage">Imagen</label>
                                                            <input type="text" id = "inputImage" class="form-control mb-3" name="image" value = "<?php echo $row['image']?>">
                                                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                        </div>
                                                        <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
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
                                                    <form action = "works.php" method = "post">
                                                        <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                                        <input type = "hidden" name = "name" value = "<?php echo $row['name']; ?>"/>
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
            </div>
        <!-- Create User -->

            <div class="container w-100 mt-5 p-5">
                <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#createWorkModal">Añadir Usuario</button>
            </div>
            <div class="modal fade" id="createWorkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="works.php" method="post">
                                <div class="form-group">
                                    <label for="inputName">Nombre</label>
                                    <input type="text" id = "inputName" class="form-control mb-3" name="name" required/>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputObj">Objetivos</label>
                                    <input type="text" id = "inputObj" class="form-control mb-3" name="obj"/>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputArea">Área</label>
                                    <input type="text" id = "inputArea" class="form-control mb-3" name="area"/>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAbstract">Abstract</label>
                                    <input type="text" id = "inputAbstract" class="form-control mb-3" name="abstract""/>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage">Imagen</label>
                                    <input type="text" id = "inputImage" class="form-control mb-3" name = "image"/>
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

            <div class="container p-5">
                <?php
                    $worksAmount = $worksAmount->fetch_assoc();
                    $pagesAmount = ceil($worksAmount['count'] / $showWorks);
                    for ($counter = 1; $counter <= $pagesAmount; $counter++) { ?>
                        <a href="/users.php?page=<?php echo $counter . "\n"; ?>" class="btn btn-info"><?php echo $counter . "\n"; ?></a>
                <?php
                    }
                    $con->close();
                ?>
            </div>
        </main>
        <?php include './comp/footer.php'; ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var dropdownUser = new bootstrap.Dropdown(document.getElementById('dropdownUser'));
            });
        </script>
    </body>
</html>