<?php
    session_start();
    if(!isset($_SESSION['super'])) {
        header("Location: ../index.php");
    }
    include("./backend/connection.php");
    $con=conectar();

    /* datos de admins */
    $sql1="SELECT users.* FROM users INNER JOIN super ON users.rut = super.rut;";
    $query1=mysqli_query($con,$sql1);

    $row1=mysqli_fetch_array($query1);
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
        <!--
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
        -->
    </head>
    <body>
        <!-- navbar -->
        <?php include './comp/navbar.php'; ?>
        <main>
            <!-- Alerts -->
            <?php include './comp/alerts.php' ?>
            
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro de que desea borrar los datos seleccionado?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="/backend/deleteSuper.php?id=<?php echo $row1['id'] ?>"><button type="button" class="btn btn-primary">Eliminar</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
            /* pagina de la paginación por defecto*/
            if(isset($gestorpage) == false ){   /*Diego: por qué preguntas por algo que es 0 (false) para hacerlo 0? Acaso tu intencion era hacerlo 0 si era NULL?*/
                $gestorpage = 0;
            };
            ?>
            
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
                <div class="row text-end">
                    <form action="search.php" method="post">
                        <label for="searchinput"><h5>Buscar:</h5></label>
                        <input id = "searchinput" type = "text" name = "search" placeholder ="Inserte busqueda">
                        <button type="submit" class="btn">Enviar</button>
                    </form>
                </div>
                <div class="row mt-2">
                    <table class="table">
                        <thead class="table-success table-striped" >
                            <tr>
                                <th>Imagen</th>
                                <th>Rut</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Descripción</th>
                                <th>Email</th>
                                <th>Telefóno</th>
                                <th>Dirección</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($search) == false){  /* si no es una busqueda */
                                do{
                            ?>
                            <tr>
                                <?php $identificador= 'rut' ?>
                                <th><?php  echo $row1['imageurl']?></th>
                                <th><?php  echo $row1['rut']?></th>
                                <th><?php  echo $row1['name']?></th>
                                <th><?php  echo $row1['surname']?></th>
                                <th><?php  echo $row1['description']?></th>
                                <th><?php  echo $row1['email']?></th>
                                <th><?php  echo $row1['phone']?></th>
                                <th><?php  echo $row1['direction']?></th>
                                
                                <th><a href="/backend/updateSuper.php?rut=<?php echo $row1['rut'] ?>" class="btn btn-info">Editar</a></th>
                                <th><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</th>                                        
                            </tr>
                            <?php 
                                }while($row1=mysqli_fetch_array($query1));
                                }
                                else{ /* si es una busqueda */

                                    $sql1search="SELECT users.* FROM users INNER JOIN super ON users.rut = super.rut WHERE users.rut = '$search';";
                                    $query1search=mysqli_query($con,$sql1search);

                                    $row1search=mysqli_fetch_array($query1search);

                                do{
                            ?>
                                <tr>
                                    <?php $identificador= 'rut' ?>
                                    <th><?php  echo $row1search['imageurl']?></th>
                                    <th><?php  echo $row1search['rut']?></th>
                                    <th><?php  echo $row1search['name']?></th>
                                    <th><?php  echo $row1search['surname']?></th>
                                    <th><?php  echo $row1search['description']?></th>
                                    <th><?php  echo $row1search['email']?></th>
                                    <th><?php  echo $row1search['phone']?></th>
                                    <th><?php  echo $row1search['direction']?></th>
                                    
                                    <th><a href="/backend/updateSuper.php?rut=<?php echo $row1search['rut'] ?>" class="btn btn-info">Editar</a></th>
                                    <th><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</th>                                        
                                </tr>
                            <?php 
                                }while($row1search=mysqli_fetch_array($query1search));
                                };
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- FIN DE CONTENEDOR DE TABLA DE GESTION -->
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>