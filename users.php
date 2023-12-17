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

    if (isset($_POST['insert'])) InsertUser($con, $_POST['rut'], $_POST['name'], $_POST['surname'], $_POST['description'], $_POST['email'], $_POST['phone'], $_POST['password'], $_FILES["imageURL"], $_POST['direction']);
    elseif (isset($_POST['update'])) UpdateUser($con, $_POST['rut'], $_POST['name'], $_POST['surname'], $_POST['description'], $_POST['email'], $_POST['phone'], $_POST['password'], $_FILES["imageURL"], $_POST['direction'], $_POST['img']);
    elseif (isset($_POST['delete'])) DeleteUser($con, $_POST['rut']);
    elseif (isset($_POST['insertS'])) InsertSuper($con, $_POST['rut']);
    elseif (isset($_POST['deleteS'])) DeleteSuper($con, $_POST['rut']);

    $showUsers = 10;
    $res = match ($_GET['selector']) {
        'rut' => SelectUsersWhereRut($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']),
        'name' => SelectUsersWhereName($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']),
        'surname' => SelectUsersWhereSurname($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']),
        'email' => SelectUsersWhereEmail($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']),
        'direction' => SelectUsersWhereDirection($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']),
        default => SelectUsers($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers),
    };
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

            <div class="container my-4">
                <form action="users.php" method="get">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col">
                            <select id="selector" name = "selector" class="form-select">
                                <?php
                                // Assume you have retrieved options from the database in an array
                                $values = array('', 'rut', 'name', 'surname', 'email', 'direction');
                                $name = array('Buscar por:', 'RUT', 'Nombre', 'Apellido', 'Email', 'Dirección');
                                for ($counter = 0; $counter < count($values); $counter++) {
                                    echo '<option value = "' . $values[$counter] . '"';
                                    if ($values[$counter] == $_GET['selector']) echo ' selected';
                                    if ($counter == 0) echo ' disabled hidden';
                                    echo '>' . $name[$counter] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="btn-group" role="group">
                                <input class="text-center" id = "buscar" type = "search" name = "search" placeholder ="Inserte su búsqueda" value = "<?php echo $_GET['search']?>"/>
                                <button type="submit" class="btn"><h4>&#128269;</h4></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container">
                <div class="row mt-2">
                    <!-- crud de usuario -->
                    <table class="table" >
                        <tbody>
                            <?php
                            $counter = 0;
                            while($row = $res->fetch_assoc()){
                            ?>
                            <tr>
                                <?php
                                if ($row['imageURL'] != NULL) {
                                    echo '<td><image class = "img" src = "' . $row['imageURL'] . '"/></td>';
                                }
                                else{
                                    echo '<td><image class = "img" src = "src/icons/iconPlaceholder.png"/></td>';
                                }
                                ?>
                                <td><?php  echo $row['rut']?></td>
                                <td><?php  echo $row['name'] . " " . $row['surname']?>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Vertical button group">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#InfoUserModal<?php echo $counter;?>">Información</button>
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateUserModal<?php echo $counter;?>">Editar</button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $counter;?>">Eliminar</button>
                                    </div>
                                </td>
                                <td>
                                    <form action = "users.php" method = "post">
                                        <input type = "hidden" name = "rut" value = "<?php echo $row['rut']; ?>"/>
                                        <?php
                                        $super = SelectSupersWhereRut($con, 1, 1, $row['rut']);
                                        if ($super->num_rows > 0) {
                                            echo '<input type = "submit" name = "deleteS" class="btn btn-warning" value = "Quitar Privilegios"/>';
                                        }
                                        else {
                                            echo '<input type = "submit" name = "insertS" class="btn btn-success" value = "Dar Privilegios"/>';
                                        }
                                        ?>
                                    </form>
                                </td>

                                <!-- Show Info -->

                                <div class="modal fade" id="InfoUserModal<?php echo $counter;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Informacion</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>Rut: <?php echo $row['rut'];?></div>
                                                <div>Nombre: <?php echo $row['name'];  ?></div>
                                                <div>Apellidos: <?php echo $row['surname'];  ?></div>
                                                <div>Descripción: <?php echo $row['description'];  ?></div>
                                                <div>Email: <?php echo $row['email'];  ?></div>
                                                <div>Telefono: <?php echo $row['phone'];  ?></div>
                                                <div>Contraseña: <?php echo $row['password'];  ?></div>
                                                <div>Imagen: <?php echo $row['imageURL'];  ?></div>
                                                <div>Direccion: <?php echo $row['direction'];  ?></div>
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
                                                <form action="users.php" method="post"  enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="inputRut">Rut</label>
                                                        <input type="text" id = "inputRut" class="form-control mb-3" name="rut" value = "<?php echo $row['rut']?>" readonly/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputName">Nombre</label>
                                                        <input type="text" id = "inputName" class="form-control mb-3" name="name" value = "<?php echo $row['name']?>" required/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSurname">Apellidos</label>
                                                        <input type="text" id = "inputSurname" class="form-control mb-3" name="surname" value = "<?php echo $row['surname']?>" required/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputDesc">Descripción</label>
                                                        <input type="text" id = "inputDesc" class="form-control mb-3" name="description" value = "<?php echo $row['description']?>"/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail">Correo</label>
                                                        <input type="email" id = "inputEmail" class="form-control mb-3" name="email" value = "<?php echo $row['email']?>"/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPhone">Teléfono</label>
                                                        <input type="text" id = "inputPhone" class="form-control mb-3" name="phone" value = "<?php echo $row['phone']?>"/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPassword">Contraseña</label>
                                                        <input type="password" id = "inputPassword" class="form-control mb-3" name="password" value = "<?php echo $row['password']?>" required/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputImage">Imagen</label>
                                                        <input type="file" id = "inputImage" class="form-control mb-3" name="imageURL" accept=".jpg, .jpeg, .png"/>
                                                        <input type="text" name="img" value = "<?php echo $row['imageURL']?>"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputDirection">Dirección</label>
                                                        <input type="text" id = "inputDirection" class="form-control mb-3" name="direction" value = "<?php echo $row['direction']?>"/>
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
                                                <form action = "users.php" method = "post">
                                                    <input type = "hidden" name = "rut" value = "<?php echo $row['rut']; ?>"/>
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
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Usuario</h1>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="users.php" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="inputRut">Rut</label>
                                                    <input type="text" id = "inputRut" class="form-control mb-3" name="rut" placeholder="123456789-0" required/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputName">Nombre</label>
                                                    <input type="text" id = "inputName" class="form-control mb-3" name="name" placeholder="Nombre" required/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputSurname">Apellidos</label>
                                                    <input type="text" id = "inputSurname" class="form-control mb-3" name="surname" placeholder="Apellido" required/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDesc">Descripción</label>
                                                    <input type="text" id = "inputDesc" class="form-control mb-3" name="description" placeholder="Descripción"/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputEmail">Correo</label>
                                                    <input type="email" id = "inputEmail" class="form-control mb-3" name="email" placeholder="alumno.universidad.20@alumnos.uda.cl"/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPhone">Teléfono</label>
                                                    <input type="text" id = "inputPhone" class="form-control mb-3" name="phone" placeholder = "12345678"/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword">Contraseña</label>
                                                    <input type="password" id = "inputPassword" class="form-control mb-3" name="password" placeholder="Contraseña" required/>
                                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputImage">Imagen</label>
                                                    <input type="file" id = "inputImage" class="form-control mb-3" name="imageURL" accept=".jpg, .jpeg, .png"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDirection">Dirección</label>
                                                    <input type="text" id = "inputDirection" class="form-control mb-3" name="direction" placeholder="Dirección"/>
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
                        </tbody>
                    </table>
                    <div class="row text-center m-4">
                        <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#createUserModal">Añadir Usuario</button>
                    </div>
                </div>
            </div>

            <!-- End Create User -->
            
            <?php
            $usersAmount = match ($_GET['selector']) {
                'rut' => SelectUsersCountWhereRut($con, $_GET['search']),
                'name' => SelectUsersCountWhereName($con, $_GET['search']),
                'surname' => SelectUsersCountWhereSurname($con, $_GET['search']),
                'email' => SelectUsersCountWhereEmail($con, $_GET['search']),
                'direction' => SelectUsersCountWhereDirection($con, $_GET['search']),
                default => SelectUsersCount($con),// Si no es una busqueda
            };
            if (isset($_GET['selector'])) $searchData = '&selector=' . $_GET['selector'] . '&search=aaa' . $_GET['search'];
            else $searchData = '';

            $usersAmount = $usersAmount->fetch_assoc();
            $pagesAmount = ceil($usersAmount['count'] / $showUsers);
            if ($pagesAmount > 1) {
            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
                    if ((isset($_GET['page']) ? intval($_GET['page']) : 1) == 1) echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
                    else echo '<li class="page-item"><a class="page-link" href="/users.php?page=' . (isset($_GET['page']) ? intval($_GET['page']) : 1) - 1 . $searchData . '">Previous</a></li>';
                    
                    for ($counter = 1; $counter <= $pagesAmount; $counter++) {
                        echo '<li class="page-item"><a href="/users.php?page=' . $counter . $searchData . '" class="page-link">' . $counter . '</a></li>';
                    }
                    if ($_GET['page'] == $pagesAmount) echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
                    else echo '<li class="page-item"><a class="page-link" href="/users.php?page=' . (isset($_GET['page']) ? intval($_GET['page']) : 1) + 1 . $searchData . '">Next</a></li>';
                    ?>
                </ul>
            </nav>
            <?php } $con->close(); ?>
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>

