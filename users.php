<?php
    session_start();
    if(!isset($_SESSION['super'])) {
        header("Location: ../index.php");
    }

    include("./backend/connection.php");
    include("./backend/select.php");
    $con = conectar();
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
<html lang="en-US">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css" />
        <link rel = "stylesheet" href = "./css/general.css" />
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <title>UDA</title>
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
    </head>
    <body>
        <main>
            <?php 
                include './comp/navbar.php';
                include './comp/alerts.php';
            ?>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro de que desea borrar los datos del usuario seleccionado?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="/backend/deleteUser.php?rut=<?php echo $row['rut'] ?>"><button type="button" class="btn btn-primary">Eliminar</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="backend/insertUser.php" method="post">
                                <div class="form-group">
                                    <label for="inputRut">Rut</label>
                                    <input type="text" id = "inputRut" class="form-control mb-3" name="rut" placeholder="" value="<?php echo $row['rut']  ?>" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nombre</label>
                                    <input type="text" id = "inputName" class="form-control mb-3" name="name" placeholder="" value="<?php echo $row['name']  ?>" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSurname">Apellidos</label>
                                    <input type="text" id = "inputSurname" class="form-control mb-3" name="surname" placeholder="" value="<?php echo $row['surname']  ?>" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Descripción</label>
                                    <input type="text" class="form-control mb-3" name="description" placeholder="" value="<?php echo $row['description']  ?>">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Correo</label>
                                    <input type="email" class="form-control mb-3" name="email" placeholder="" value="<?php echo $row['email']  ?>">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Teléfono</label>
                                    <input type="text" class="form-control mb-3" name="phone" placeholder="" value="<?php echo $row['phone']  ?>">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Contraseña</label>
                                    <input type="password" class="form-control mb-3" name="password" placeholder="" value="<?php echo $row['password']  ?>" required>
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputImage">Imagen URL</label>
                                    <input type="text" id = "inputImage" class="form-control mb-3" name="imageurl" placeholder="" value="<?php echo $row['imagenurl']  ?>">
                                    <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDirection">Dirección</label>
                                    <input type="text" id = "inputDirection" class="form-control mb-3" name="direction" placeholder="" value="<?php echo $row['direction']  ?>">
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
            
            <div class="container w-100 mt-5">
                <form action="users.php" method="get">
                    <div class="row"> 
                        <div class="col-md-2">
                            <a href="gestor.php"><button type="button" class="btn btn-danger">Volver</button></a>
                        </div>
                        <div class="col-md-2">
                            <label for="searchinput"><h2>Buscar</h2></label>
                        </div>
                        <div class="col-md-2">
                            <input id = "searchinput" type = "search" name = "search" placeholder ="Inserte busqueda"/>
                        </div>
                        <div class="col-md-2">
                            <input type = "hidden" name = "page" value = "1"/>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="container w-100 mt-5">
             <!-- crud de usuario -->
                <div class="col-md-8">
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
                                while($row = $res->fetch_assoc()){
                                ?>
                                    <tr>
                                        <?php $identificador= 'rut' ?>
                                        <th><?php  echo $row['rut']?></th>
                                        <th><?php  echo $row['name']?></th>
                                        <th><?php  echo $row['surname']?></th>
                                        <th><?php  echo $row['description']?></th>
                                        <th><?php  echo $row['email']?></th>
                                        <th><?php  echo $row['phone']?></th>
                                        <!--th><?php//  echo $row['password']?></th-->
                                        <th><?php  echo $row['imageurl']?></th>
                                        <th><?php  echo $row['direction']?></th>
                                                
                                        <th><a href="updateformusers.php?rut=<?php echo $row['rut'] ?>" class="btn btn-info">Editar</a></th>
                                        <th><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</th>                                       
                                    </tr>
                                <?php 
                                }
                                ?>        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container w-100 mt-5 p-5">
                <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#createUserModal">Añadir Usuario</button>
            </div>
            <div class="container w-100 mt-5 p-5">
                <?php
                    $usersAmount = $usersAmount->fetch_assoc();
                    $pagesAmount = ceil($usersAmount['count'] / $showUsers);
                    for ($counter = 1; $counter <= $pagesAmount; $counter++) { ?>
                        <a href="/users.php?page=<?php echo $counter . "\n"; ?>" class="btn btn-info"><?php echo $counter . "\n"; ?></a>
                <?php
                    }
                ?>
            </div>
        </main>
        <?php include './comp/footer.php'; ?>
    </body>
</html>
