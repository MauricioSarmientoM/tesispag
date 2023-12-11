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

    if (isset($_POST['insert'])) InsertEvent($con, $_POST['title'], $_POST['description'], $_FILES['image'], $_POST['publicationDate'], $_POST['realizationDate']);

    $showEvents = 10;
    /* datos de users */
    if (isset($_GET['search'])) $res = SelectUsersWhereRut($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']);
    else $res = SelectUsers($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css" />
        <link rel = "stylesheet" href = "./css/general.css"/>
        <link rel = "stylesheet" href = "./css/gestor.css"/>
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

            <!-- CONTENEDOR DE TABLA DE GESTION -->
            <div class="container">
                <div class="row text-end">
                    <form action="users.php" method="get">
                        <label for="searchinput"><h5>Buscar:</h5></label>
                        <input id = "searchinput" type = "search" name = "search" placeholder ="Inserte busqueda">
                        <button type="submit" class="btn">Enviar</button>
                    </form>
                </div>
                <div class="row mt-2">
                    <!-- crud de usuario -->
                    <table class="table" >
                        <tbody>
                            <?php
                            $counter = 0;
                            while($row = $res->fetch_assoc()){
                            ?>
                            <tr>
                                <td>
                                <?php
                                if ($row['image'] != NULL) echo '<img class = "thesisPhoto" src = "' . $row['image'] . '"/>';
                                else echo '<img class = "thesisPhoto" src = "src/FotosDIICC/_ALX9336.JPG"/>';
                                ?>
                                </td>
                                <td><?php echo $row['title']; ?></td>
                                <td>
                                    <h3>Fecha de Publicación</h3>
                                    <?php echo date("d/m/Y", strtotime($row['publicationDate'])); ?>
                                </td>
                                <td>
                                    <h3>Fecha de Realización</h3>
                                    <?php echo date("d/m/Y", strtotime($row['realizationDate'])); ?>
                                </td>
                                <td>
                                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal<?php echo $counter;?>">Información</button>
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateUserModal<?php echo $counter;?>">Editar</button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $counter;?>">Eliminar</button>
                                    </div>
                                </td>

                                <!-- Show Info -->

                                <div class="modal fade" id="infoModal<?php echo $counter;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Informacion</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>Id: <?php echo $row['id'];?></div>
                                                <div>Título: <?php echo $row['title'];  ?></div>
                                                <div>Descripción: <?php echo $row['description'];  ?></div>
                                                <div>Fecha de Publicación: <?php echo date("d/m/Y", strtotime($row['publicationDate']));  ?></div>
                                                <div>Fecha de Realización: <?php echo date("d/m/Y", strtotime($row['realizationDate']));  ?></div>
                                                <div>Imagen: <?php echo $row['image'];  ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Update -->

                                <div class="modal fade" id="updateUserModal<?php echo $counter;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Usuario</h1>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="events.php" method="post"  enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="inputTitle">Título</label>
                                                        <input type="text" id = "inputTitle" class="form-control mb-3" name="title" value = "<?php echo $row['title']?>" required/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputDesc">Descripción</label>
                                                        <input type="text" id = "inputDesc" class="form-control mb-3" name="description" value = "<?php echo $row['description']?>"/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPublicationDate">Fecha de Publicación</label>
                                                        <input type="date" id = "inputPublicationDate" class="form-control mb-3" name="publicationDate" value = "<?php echo $row['publicationDate']?>"/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputRealizationDate">Fecha de Realización</label>
                                                        <input type="date" id = "inputRealizationDate" class="form-control mb-3" name="realizationDate" value = "<?php echo $row['realizationDate']?>"/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputImage">Imagen Referencial</label>
                                                        <input type="file" id = "inputImage" class="form-control mb-3" name="image" accept=".jpg, .jpeg, .png"/>
                                                    </div>
                                                    <div class="container d-flex justify-content-end">
                                                        <button type="submit" name = "update" class="btn btn-primary btn-block ">Confirmar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- DELETE -->

                                <div class="modal fade" id="deleteModal<?php echo $counter;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de que desea borrar a <?php echo '' . $row['name'] . ' ' . $row['surname']; ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <form action = "events.php" method = "post">
                                                    <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                                    <input type = "hidden" name = "title" value = "<?php echo $row['title']; ?>"/>
                                                    <input type = "submit" name = "delete" class="btn btn-danger" value = "Eliminar"/>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            <?php
                                $counter++;
                            }
                            ?>
                            
                            <!-- Create user -->
                            
                            <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Evento</h1>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="events.php" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="inputTitle">Title</label>
                                                    <input type="text" id = "inputTitle" class="form-control mb-3" name="title" placeholder="Se invita a toda la comunidad..." required/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDesc">Descripción</label>
                                                    <input type="text" id = "inputDesc" class="form-control mb-3" name="description" placeholder="Descripción del Evento"/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPublicationDate">Fecha de Publicación*</label>
                                                    <input type="date" id = "inputPublicationDate" class="form-control mb-3" name="publicationDate"/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputRealizationDate">Fecha de Realización</label>
                                                    <input type="text" id = "inputRealizationDate" class="form-control mb-3" name="realizationDate"/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputImage">Imagen Referencial</label>
                                                    <input type="file" id = "inputImage" class="form-control mb-3" name="image" accept=".jpg, .jpeg, .png"/>
                                                </div>
                                                <div class="container d-flex justify-content-end">
                                                    <button type="submit" name = "insert" class="btn btn-primary btn-block ">Confirmar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table>
                    <div class="row text-center m-4">
                        <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#createUserModal">Añadir Evento</button>
                    </div>
                </div>
            </div>

            <!-- End Create User -->
            
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <?php
                    $eventsAmount = SelectEventsCount($con);
                    $eventsAmount = $eventsAmount->fetch_assoc();
                    for ($counter = 1; $counter <= $pagesAmount; $counter++) { ?>
                        <li class="page-item"><a href="/users.php?page=<?php echo $counter; ?>" class="page-link"><?php echo $counter; ?></a></li>
                    <?php } $con->close();?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>