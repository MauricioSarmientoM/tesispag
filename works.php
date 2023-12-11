<?php
    session_start();
    if(!isset($_SESSION['super'])) {
        header("Location: ../index.php");
    }

    include("./backend/connection.php");
    include("./backend/select.php");
    include("./backend/insert.php");
    include("./backend/update.php");
    include("./backend/delete.php");
    $con = conectar();

    if (isset($_POST['insert'])) InsertWork($con, $_POST['name'], $_POST['obj'], $_POST['area'], $_POST['abstract'], $_FILES["image"]);
    elseif (isset($_POST['update'])) UpdateWork($con, $_POST['id'], $_POST['name'], $_POST['obj'], $_POST['area'], $_POST['abstract'], $_FILES["image"], $_POST['img']);
    elseif (isset($_POST['delete'])) DeleteWork($con, $_POST['id']);
    elseif (isset($_POST['insertC'])) InsertCollab($con, $_POST['collabRut'], $_POST['id']);
    elseif (isset($_POST['deleteC'])) DeleteCollab($con, $_POST['collabRut'], $_POST['id']);


    $showWorks = 10;
    if (isset($_GET['search'])) $res = SelectWorksWhereId($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showWorks, $_GET['search']);
    else $res = SelectWorks($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showWorks);
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
        <?php
        include './comp/navbar.php'; 
        if (isset($_POST['addCollab'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $collab = SelectUsersNotInIdWork($con, 1, 10, $id, $rut);
            ?>
            <main>
                <div class="container-fluid p-4 thesisSpace"><h1 class="container">Tesis</h1></div>
                <?php include './comp/alerts.php'; ?>
                <div class = "thesisMenu py-4">
                    <div class="container">
                    <form action = "profile.php" method = "post">
                        <input type = "hidden" name = "rut" value = "<?php echo $rut; ?>"/>
                        <input type = "submit" class="btn btn-danger" value = "Volver"/>
                    </form>
            <?php
            while ($data = $collab->fetch_assoc()) {
                ?>
                <div class="container row my-4">
                    <div class="col my-2">
                        <?php
                        if ($data['imageURL'] != NULL) {
                            echo '<img class = "collabPhoto" src = "' . $data['imageURL'] . '"/>';
                        }
                        else{
                            echo '<img class = "collabPhoto" src = "src/icons/iconPlaceholder.png"/>';
                        }
                        ?>
                    </div>
                    <div class="col p-3">
                        <h4>RUT</h4>
                        <p><?php echo $data['rut']; ?></p>
                    </div>
                    <div class="col p-3">
                        <h4>Nombre</h4>
                        <p><?php echo $data['name'] . ' ' . $data['surname']; ?></p>
                    </div>
                    <div class="col p-3">
                        <form action = "works.php" method = "post">
                            <input type = "hidden" name = "rut" value = "<?php echo $rut; ?>"/>
                            <input type = "hidden" name = "id" value = "<?php echo $id; ?>"/>
                            <input type = "hidden" name = "collabRut" value = "<?php echo $data['rut']; ?>"/>
                            <input type = "submit" name = "insertC" class="btn btn-success" value = "Añadir"/>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
                    </div>
                </div>
        <?php
        }
        else {
        ?>
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
                        <h1 class="text-center">Gestor de Trabajos</h1>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- FIN DE BOTON VOLVER Y TITULO -->

            <!-- CONTENEDOR DE TABLA DE GESTION -->
            <div class="container">
                <div class="row text-end">
                    <form action="works.php" method="get">
                        <label for="searchinput"><h5>Buscar:</h5></label>
                        <input id = "searchinput" type = "search" name = "search" placeholder ="Inserte busqueda">
                        <button type="submit" class="btn">Enviar</button>
                    </form>
                </div>
                <div class="row mt-2">
                    <table class="table">
                        <tbody>
                            <?php
                                $counter = 0;
                                while($row = $res->fetch_assoc()){
                            ?>
                            <tr>
                                <td>
                                <?php
                                if ($row['image'] != NULL) {
                                    echo '<img class = "thesisPhoto" src = "' . $row['image'] . '"/>';
                                }
                                else{
                                    echo '<img class = "thesisPhoto" src = "src/FotosDIICC/_ALX9336.JPG"/>';
                                }
                                ?>
                                </td>
                                <td><?php  echo $row['name']?></td>
                                <td><?php  echo $row['obj']?></td>
                                <td><?php  echo $row['area']?></td>
                                <td><?php  echo $row['abstract']?></td>

                                <td>
                                    <div class = "btn-group-vertical">
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateWorksModal<?php echo $counter;?>">Editar</button>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#collabModal<?php echo $counter;?>">Colaborar</button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $counter;?>">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="updateWorksModal<?php echo $counter;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Información</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="works.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="img" value = "<?php echo $row['image']; ?>" readonly/>
                                                <input type="hidden" name="id" value = "<?php echo $row['id']; ?>" readonly/>
                                                <div class="form-group">
                                                    <label for="inputName">Nombre</label>
                                                    <input type="text" id = "inputName" class="form-control mb-3" name="name" value = "<?php echo $row['name'] ?>" required/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputObj">Objetivos</label>
                                                    <input type="textarea" id = "inputObj" class="form-control mb-3" name="obj" value = "<?php echo $row['obj'] ?>"/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputArea">Área</label>
                                                    <input type="text" id = "inputArea" class="form-control mb-3" name="area" value = "<?php echo $row['area'] ?>"/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAbstract">Abstract</label>
                                                    <input type="textarea" id = "inputAbstract" class="form-control mb-3" name="abstract" value = "<?php echo $row['abstract'] ?>"/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputImage">Imagen</label>
                                                    <input type="file" id = "inputImage" class="form-control mb-3" name = "image" accept=".jpg, .jpeg, .png"/>
                                                </div>
                                                <div class="container d-flex justify-content-end">
                                                    <button type="submit" name = "update" class="btn btn-primary btn-block ">Confirmar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="collabModal<?php echo $counter;?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Colaborar</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $collab = SelectUsersWhereIdWork($con, 1, 10, $row['id']);

                                        while ($data = $collab->fetch_assoc()) {
                                        ?>
                                        <div class="row my-4">
                                            <div class="col my-2">
                                            <?php
                                                if ($data['imageURL'] != NULL) {
                                                    echo '<img class = "collabPhoto" src = "' . $data['imageURL'] . '"/>';
                                                }
                                                else{
                                                    echo '<img class = "collabPhoto" src = "src/icons/iconPlaceholder.png"/>';
                                                }
                                            ?>
                                            </div>
                                            <div class="col p-3">
                                                <h4>RUT</h4>
                                                <p><?php echo $data['rut']; ?></p>
                                            </div>
                                            <div class="col p-3">
                                                <h4>Nombre</h4>
                                                <p><?php echo $data['name'] . ' ' . $data['surname']; ?></p>
                                            </div>
                                            <div class="col p-3">
                                                <form action = "works.php" method = "post">
                                                    <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                                    <input type = "hidden" name = "collabRut" value = "<?php echo $data['rut']; ?>"/>
                                                    <input type = "hidden" name = "name" value = "<?php echo $row['name']; ?>"/>
                                                    <input type = "submit" name = "deleteC" class="btn btn-danger" value = "Quitar"/>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <form action = "works.php" method = "post">
                                            <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                            <input type = "hidden" name = "name" value = "<?php echo $row['name']; ?>"/>
                                            <input type = "submit" name = "addCollab" class="btn btn-success" value = "Añadir Colaborador"/>
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
                                            ¿Está seguro de que desea borrar a <?php echo $row['name']; ?>?
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
                    <div class="row text-center m-4">
                        <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#createModal">Añadir Tesis</button>
                    </div>
                </div>  
            </div>

            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createThesisModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Tesis</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="works.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputName">Nombre</label>
                                    <input type="text" id = "inputName" class="form-control mb-3" name="name" required/>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputObj">Objetivos</label>
                                    <input type="textarea" id = "inputObj" class="form-control mb-3" name="obj"/>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputArea">Área</label>
                                    <input type="text" id = "inputArea" class="form-control mb-3" name="area"/>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAbstract">Abstract</label>
                                    <input type="textarea" id = "inputAbstract" class="form-control mb-3" name="abstract"/>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage">Imagen</label>
                                    <input type="file" id = "inputImage" class="form-control mb-3" name = "image" accept=".jpg, .jpeg, .png"/>
                                </div>
                                <div class="container d-flex justify-content-end">
                                    <button type="submit" name = "insert" class="btn btn-primary btn-block ">Confirmar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                    
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <?php
                        $worksAmount = SelectWorksCount($con);
                        $worksAmount = $worksAmount->fetch_assoc();
                        $pagesAmount = ceil($worksAmount['count'] / $showWorks);
                        for ($counter = 1; $counter <= $pagesAmount; $counter++) { ?>
                            <li class="page-item"><a href="/works.php?page=<?php echo $counter; ?>" class="page-link"><?php echo $counter; ?></a></li>
                    <?php } $con->close();?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
            <?php
            }
            ?>
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>