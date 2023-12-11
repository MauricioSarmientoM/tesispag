<?php
    session_start();
    if (!isset($_POST['rut'])){
        header("Location: ./index.php");
    }
    $rut = $_POST['rut'];
    include("./backend/connection.php");
    include("./backend/select.php");
    include("./backend/insert.php");
    include("./backend/update.php");
    include("./backend/delete.php");
    $con = conectar();
    if (isset($_POST['update'])) UpdateUser($con, $_POST['rut'], $_POST['name'], $_POST['surname'], $_POST['description'], $_POST['email'], $_POST['phone'], $_POST['password'], $_FILES["imageURL"], $_POST['direction'], $_POST['img']);
    elseif (isset($_POST['insertT'])) {
        InsertWork($con, $_POST['name'], $_POST['obj'], $_POST['area'], $_POST['abstract'], $_FILES["image"]);
        $work = SelectWorksOrderByDesc ($con, 1);
        $work = $work->fetch_assoc();
        InsertCollab($con, $rut, $work['id']);
    }
    elseif (isset($_POST['updateT'])) UpdateWork($con, $_POST['id'], $_POST['name'], $_POST['obj'], $_POST['area'], $_POST['abstract'], $_FILES["image"], $_POST['img']);
    elseif (isset($_POST['deleteT'])) DeleteWork($con, $_POST['id']);
    elseif (isset($_POST['insertC'])) InsertCollab($con, $_POST['collabRut'], $_POST['id']);
    elseif (isset($_POST['deleteC'])) DeleteCollab($con, $_POST['collabRut'], $_POST['id']);
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
        <?php
        include './comp/navbar.php'; 
        if (isset($_POST['addCollab'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $collab = SelectUsersNotInIdWork($con, 1, 10, $id);
            ?>
            <main>
                <div class="container-fluid zonasTitulo"><h1 class="container">Tesis</h1></div>
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
                        <form action = "profile.php" method = "post">
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
            <?php
                $res = SelectUsersWhereRut($con, 1, 1, $rut);
                $row = $res->fetch_assoc();
            ?>
            <div class = "container perfil">
                <div class ="row">
                    <div class="col lateral text-center">
                        <div class ="row-md-1 my-4">
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
                        <div class ="row-md-1 my-4">
                        <?php
                            if (isset($_SESSION['rut']))
                            if ($_SESSION['rut'] == $rut) {
                                echo '<button class="btn boton text-center" data-bs-toggle="modal" data-bs-target="#updateModal">Editar Perfil</button>';
                            }
                        ?>
                        </div>
                    </div>
                    <div class="col py-4">
                        <h4> Descripción </h4>
                        <p><?php echo $row['description']; ?></p>
                    </div>
                    <div class="col">
                        <div class ="row my-4">
                            <h4> Email: </h4>
                            <p><?php echo $row['email']; ?></p>
                        </div>
                        <div class ="row my-4">
                            <h4> Número de teléfono: </h4>
                            <p>+56 9 <?php echo $row['phone']; ?></p>
                        </div>
                        <div class ="row my-4">
                            <h4> Dirección: </h4>
                            <p><?php echo $row['direction']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php include './comp/alerts.php'; ?>

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
                                    <label for="inputImage">Imagen</label>
                                    <input type="file" id = "inputImage" class="form-control mb-3" name="imageURL" accept=".jpg, .jpeg, .png"/>
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
            <?php
            $res = SelectWorksWhereRut($con, 1, 10, $rut);

            if ($res->num_rows > 0 || $_SESSION['rut'] == $rut) {
            ?>
            <div class="container-fluid p-4 thesisSpace"><h1 class="container">Tesis</h1></div>
            <div class = "thesisMenu py-4">
                <div class="container">
                    <?php
                    $counter = 0;
                    while ($row = $res->fetch_assoc()) {
                    ?>
                        <div class="row my-4">
                            <div class="col-md-2 my-2 thesisContainer">
                            <?php
                                if ($row['image'] != NULL) {
                                    echo '<img class = "thesisPhoto" src = "' . $row['image'] . '"/>';
                                }
                                else{
                                    echo '<img class = "thesisPhoto" src = "src/FotosDIICC/_ALX9336.JPG"/>';
                                }
                            ?>
                            </div>
                            <div class="col p-3">
                                <h4><?php echo $row['name']; ?></h4>
                                <p><?php echo $row['abstract']; ?></p>
                            </div>
                            <div class="col-md-2">
                                <h4>Colaboradores</h4>
                                <?php
                                $collab = SelectUsersWhereIdWorkButNoRut($con, 1, 10, $row['id'], $rut);

                                while ($data = $collab->fetch_assoc()) {
                                    echo '<form action="profile.php" method="post"><input type="hidden" name="rut" value = ' . $data["rut"] . ' readonly/>';
                                    echo '<input type = "submit" value = "' . $data['name'] . ' ' . $data['surname'] .'"/></form>';
                                }
                                ?>
                            </div>
                            <?php
                            if (isset($_SESSION['rut']))
                            if ($_SESSION['rut'] == $rut) {
                            ?>
                            <div class="col-md-1">
                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                    <button class="btn boton" data-bs-toggle="modal" data-bs-target="#updateThesisModal<?php echo $counter; ?>">Editar</button>
                                    <button class="btn boton" data-bs-toggle="modal" data-bs-target="#collabModal<?php echo $counter;?>">Colaborar</button>
                                    <button class="btn boton" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $counter;?>">Eliminar</button>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="modal fade" id="updateThesisModal<?php echo $counter; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Información</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="profile.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="rut" value = "<?php echo $rut; ?>" readonly/>
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
                                                <button type="submit" name = "updateT" class="btn btn-primary btn-block ">Confirmar</button>
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
                                        $collab = SelectUsersWhereIdWorkButNoRut($con, 1, 10, $row['id'], $rut);

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
                                                <form action = "profile.php" method = "post">
                                                    <input type = "hidden" name = "rut" value = "<?php echo $rut; ?>"/>
                                                    <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                                    <input type = "hidden" name = "collabRut" value = "<?php echo $data['rut']; ?>"/>
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
                                        <form action = "profile.php" method = "post">
                                            <input type = "hidden" name = "rut" value = "<?php echo $rut; ?>"/>
                                            <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                            <input type = "hidden" name = "collabRut" value = "<?php echo $rut; ?>"/>
                                            <input type = "submit" name = "deleteC" class="btn btn-danger" value = "Dejar de Colaborar"/>
                                        </form>
                                        <form action = "profile.php" method = "post">
                                            <input type = "hidden" name = "rut" value = "<?php echo $rut; ?>"/>
                                            <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                            <input type = "submit" name = "addCollab" class="btn btn-success" value = "Añadir Colaborador"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="deleteModal<?php echo $counter;?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de que desea borrar <?php echo $row['name']; ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <form action = "profile.php" method = "post">
                                            <input type = "hidden" name = "rut" value = "<?php echo $rut; ?>"/>
                                            <input type = "hidden" name = "id" value = "<?php echo $row['id']; ?>"/>
                                            <input type = "submit" name = "deleteT" class="btn btn-danger" value = "Eliminar"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $counter++;
                    }
                    if (isset($_SESSION['rut']))
                    if ($_SESSION['rut'] == $rut) {
                        echo '<div class="row text-center"><button class="bnt boton" data-bs-toggle="modal" data-bs-target="#createThesisModal"><h1 class="mb-1">Crear Proyecto de Tesis</h1></button></div>';
                    }
                    ?>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            
            <div class="modal fade" id="createThesisModal" tabindex="-1" aria-labelledby="createThesisModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Información</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="profile.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="rut" value = "<?php echo $rut; ?>" readonly/>
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
                                    <button type="submit" name = "insertT" class="btn btn-primary btn-block ">Confirmar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        include './comp/footer.php';
        ?>
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
