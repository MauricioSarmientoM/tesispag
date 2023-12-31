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
    elseif (isset($_POST['update'])) {
        UpdateUser($con, $_POST['rut'], $_POST['name'], $_POST['surname'], $_POST['description'], $_POST['email'], $_POST['phone'], $_POST['password'], $_FILES["imageURL"], $_POST['direction'], $_POST['img']);
        if (isset($_POST['grade'])) UpdateTutor($con, $_POST['rut'], $_POST['grade']);
    }
    elseif (isset($_POST['delete'])) DeleteUser($con, $_POST['rut']);
    elseif (isset($_POST['insertS'])) InsertSuper($con, $_POST['rut']);
    elseif (isset($_POST['deleteS'])) DeleteSuper($con, $_POST['rut']);
    elseif (isset($_POST['insertT'])) InsertTutor($con, $_POST['rut']);
    elseif (isset($_POST['deleteT'])) DeleteTutor($con, $_POST['rut']);

    $showUsers = 10;
    if (isset($_GET['search'])) {
        switch ($_GET['selector']) {
            case 'rut':
                $res = SelectUsersWhereRut($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']);
                break;
            case 'name':
                $res = SelectUsersWhereName($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']);
                break;
            case 'surname':
                $res = SelectUsersWhereSurname($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']);
                break;
            case 'email':
                $res = SelectUsersWhereEmail($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']);
                break;
            case 'direction':
                $res = SelectUsersWhereDirection($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']);
                break;
            default:
                $res = SelectUsers($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers);
        }
    }
    else $res = SelectUsers($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers); // Si no es una busqueda
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
                                <td>
                                    <form action = "users.php" method = "post">
                                        <input type = "hidden" name = "rut" value = "<?php echo $row['rut']; ?>"/>
                                        <?php
                                        $tutor = SelectTutorsWhereRut($con, 1, 1, $row['rut']);
                                        if ($tutor->num_rows > 0) {
                                            echo '<input type = "submit" name = "deleteT" class="btn btn-warning" value = "Deshabilitar como Tutor"/>';
                                        }
                                        else {
                                            echo '<input type = "submit" name = "insertT" class="btn btn-success" value = "Habilitar como Tutor"/>';
                                        }
                                        ?>
                                    </form>
                                </td>

                                <!-- Show Info -->

                                <div class="modal fade" id="InfoUserModal<?php echo $counter;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Informacion</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class = "container perfil">
                                                    <div class ="row">
                                                        <div class="col text-center">
                                                            <div class ="row-md-1 my-1">
                                                                <?php
                                                                if ($row['imageURL'] != NULL) {
                                                                    echo '<img class = "profileIMG" src = "' . $row['imageURL'] . '"/>';
                                                                }
                                                                else{
                                                                    echo '<img class = "profileIMG" src = "src/icons/iconPlaceholder.png"/>';
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class ="row-md-1 my-4">
                                                                <h2><?php echo $row['name']; ?>  <?php echo $row['surname']; ?></h2>
                                                            </div>
                                                            <div class ="row-md-1 my-1">
                                                                <?php
                                                                if (isset($_SESSION['rut']))
                                                                ?>
                                                            </div>
                                                        </div>
                                                                    <div class="row my-1">
                                                                        <h4> Rut </h4>
                                                                        <p><?php echo $row['rut']; ?></p>
                                                                    </div>
                                                                    <div class="row my-1">
                                                                        <h4> Nombres: </h4>
                                                                        <p><?php echo $row['name']; ?></p>
                                                                    </div>
                                                        <div class="row my-1">
                                                            <h4> Apellidos: </h4>
                                                            <p><?php echo $row['surname']; ?></p>
                                                        </div>
                                                        <div class ="row my-1">
                                                            <h4> Email: </h4>
                                                            <p><?php echo $row['email']; ?></p>
                                                        </div>
                                                        <div class ="row my-1">
                                                            <h4> Número de teléfono: </h4>
                                                            <p>+56 9 <?php echo $row['phone']; ?></p>
                                                        </div>
                                                        <div class ="row my-1">
                                                            <h4> Dirección: </h4>
                                                            <p><?php echo $row['direction']; ?></p>
                                                        </div>
                                                        <div class="row my-1">
                                                            <h4> Descripción: </h4>
                                                            <p><?php echo $row['description']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                        <input type="hidden" name="img" value = "<?php echo $row['imageURL']?>"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputDirection">Dirección</label>
                                                        <input type="text" id = "inputDirection" class="form-control mb-3" name="direction" value = "<?php echo $row['direction']?>"/>
                                                        <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                                    </div>
                                                    <?php
                                                    if ($tutor->num_rows > 0) {
                                                        $data = $tutor->fetch_assoc();
                                                        echo '<div class="form-group">';
                                                        echo '<label for="inputGrade">Grado</label>';
                                                        echo '<input type = "text" id = "inputGrade" name = "grade" class="form-control mb-3" value = "' . $data['grade'] . '"/>';
                                                        echo '<div class="invalid-feedback">Por favor ingrese un dato válido.</div></div>';
                                                    }
                                                    ?>
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
            if (isset($_GET['search'])) {
                switch ($_GET['selector']) {
                    case 'rut':
                        $usersAmount = SelectUsersCountWhereRut($con, $_GET['search']);
                        break;
                    case 'name':
                        $usersAmount = SelectUsersCountWhereName($con, $_GET['search']);
                    case 'surname':
                        SelectUsersCountWhereSurname($con, $_GET['search']);
                    case 'email':
                        $usersAmount = SelectUsersCountWhereEmail($con, $_GET['search']);
                        break;
                    case 'direction':
                        SelectUsersCountWhereDirection($con, $_GET['search']);
                        break;
                    default: SelectUsersCount($con);
                }
            }
            else $usersAmount = SelectUsersCount($con);
            
            if (isset($_GET['selector'])) $searchData = '&selector=' . $_GET['selector'] . '&search=' . $_GET['search'];
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

