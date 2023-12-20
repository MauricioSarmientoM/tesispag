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

    if (isset($_POST['insert'])) InsertContact($con, $_POST['rut'], $_POST['subject'], $_POST['body']);
    elseif (isset($_POST['update'])) UpdateContact($con, $_POST['id'], $_POST['readedVal']);
    elseif (isset($_POST['delete'])) DeleteContact($con, $_POST['id']);

    $showContacts = 10;
    
    if (isset($_GET['search'])) {
        if ((isset($_GET['readed']) ? intval($_GET['readed']) : -1) != -1) {
            switch ($_GET['selector']) {
                case 'rut':
                    $res = SelectContactsWhereReadedAndRut($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showContacts, $_GET['readed'], $_GET['search']);
                    break;
                case 'subject':
                    $res = SelectContactsWhereReadedAndSubject($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showContacts, $_GET['readed'], $_GET['search']);
                    break;
                case 'abstract':
                    $res = SelectContactsWhereReadedAndBody($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showContacts, $_GET['readed'], $_GET['search']);
                    break;
                default:
                    $res = SelectContactsWhereReaded($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showContacts, $_GET['readed']);
            }
        }
        else {
            switch ($_GET['selector']) {
                case 'rut':
                    $res = SelectContactsWhereRut($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showContacts, $_GET['search']);
                    break;
                case 'subject':
                    $res = SelectContactsWhereSubject($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showContacts, $_GET['search']);
                    break;
                case 'abstract':
                    $res = SelectContactsWhereBody($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showContacts, $_GET['search']);
                    break;
                default:
                    $res = SelectContacts($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showContacts);
            }
        }
    }
    else $res = SelectContacts($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showContacts); // Si no es una busqueda
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "Gestor de mensajes de contacto que envían los usuarios."/>
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
                        <h1 class="text-center">Gestor de Mensajes de Contacto</h1>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- FIN DE BOTON VOLVER Y TITULO -->

            
            <div class="container my-4">
                <form action="contacts.php" method="get">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col">
                            <select id="readed" name = "readed" class="form-select">
                                <?php
                                $values = array('-1', '0', '1');
                                $name = array('Todos', 'No leídos', 'Leídos');
                                for ($counter = 0; $counter < count($values); $counter++) {
                                    echo '<option value = "' . $values[$counter] . '"';
                                    if ($values[$counter] == $_GET['readed']) echo ' selected';
                                    echo '>' . $name[$counter] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <select id="selector" name = "selector" class="form-select">
                                <?php
                                $values = array('', 'rut', 'subject', 'body');
                                $name = array('Buscar por:', 'RUT', 'Asunto', 'Mensaje');
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
                                <input class="text-center" id = "buscar" type = "search" name = "search" placeholder ="Inserte su búsqueda"  value = "<?php echo $_GET['search']?>"/>
                                <button type="submit" class="btn"><h4>&#128269;</h4></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- CONTENEDOR DE TABLA DE GESTION -->
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
                                <td><?php echo $row['name'] . ' ' . $row['surname'] . ' ' . $row['rut']; ?></td>
                                <td><?php echo $row['subject']; ?></td>
                                <td><?php echo $row['body']; ?></td>
                                <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $counter;?>">Eliminar</button></td>
                                <td>
                                    <form action="contacts.php" method="post"  enctype="multipart/form-data">
                                        <div class="container d-flex justify-content-end">
                                            <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                            <?php if ($row['readed'] == 0) { ?>
                                                <input type = "hidden" name = "readedVal" value = "1"/>
                                                <input type = "submit" name = "update" class="btn btn-primary btn-block" value = "Marcar como Leído"/>
                                            <?php } else { ?>
                                                <input type = "hidden" name = "readedVal" value = "0"/>
                                                <input type = "submit" name = "update" class="btn btn-secondary btn-block" value = "Marcar como No Leído"/>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </td>

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
                                                ¿Está seguro de que desea borrar "<?php echo '' . $row['subject']; ?>" de <?php echo $row['name'] . ' ' . $row['surname']?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <form action = "contacts.php" method = "post">
                                                    <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
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
                            
            <!-- End Create User -->
            <?php

            if (isset($_GET['search'])) {
                if ((isset($_GET['readed']) ? intval($_GET['readed']) : -1) != -1) {
                    switch ($_GET['selector']) {
                        case 'rut':
                            $contactsAmount = SelectContactsCountWhereReadedAndRut($con, $_GET['readed'], $_GET['search']);
                            break;
                        case 'subject':
                            $contactsAmount = SelectContactsCountWhereReadedAndSubject($con, $_GET['readed'], $_GET['search']);
                            break;
                        case 'abstract':
                            $contactsAmount = SelectContactsCountWhereReadedAndBody($con, $_GET['readed'], $_GET['search']);
                            break;
                        default:
                            $contactsAmount = SelectContactsCountWhereReaded($con, $_GET['readed']);
                    }
                }
                else {
                    switch ($_GET['selector']) {
                        case 'rut':
                            $contactsAmount = SelectContactsCountWhereRut($con, $_GET['search']);
                            break;
                        case 'subject':
                            $contactsAmount = SelectContactsCountWhereSubject($con, $_GET['search']);
                            break;
                        case 'abstract':
                            $contactsAmount = SelectContactsCountWhereBody($con, $_GET['search']);
                            break;
                        default:
                            $contactsAmount = SelectContactsCount($con);
                    }
                }
            }
            else $contactsAmount = SelectContactsCount($con, $showContacts);
            
            if (isset($_GET['selector'])) $searchData = '&selector=' . $_GET['selector'] . '&search=' . $_GET['search'];
            else $searchData = '';
            
            if (isset($_GET['readed'])) $searchData = $searchData . '&readed=' . $readed;
            
            $contactsAmount = $contactsAmount->fetch_assoc();
            $pagesAmount = ceil($contactsAmount['count'] / $showContacts);
            if ($pagesAmount > 1) {
            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
                    if ((isset($_GET['page']) ? intval($_GET['page']) : 1) == 1) echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
                    else echo '<li class="page-item"><a class="page-link" href="/contacts.php?page=' . (isset($_GET['page']) ? intval($_GET['page']) : 1) - 1 . $searchData . '">Previous</a></li>';
                    
                    for ($counter = 1; $counter <= $pagesAmount; $counter++) {
                        echo '<li class="page-item"><a href="/contacts.php?page=' . $counter . $searchData . '" class="page-link">' . $counter . '</a></li>';
                    }
                    if ($_GET['page'] == $pagesAmount) echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
                    else echo '<li class="page-item"><a class="page-link" href="/contacts.php?page=' . (isset($_GET['page']) ? intval($_GET['page']) : 1) + 1 . $searchData . '">Next</a></li>';
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