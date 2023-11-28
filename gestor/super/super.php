<?php /* session_start() */?>
<?php 
    include("conexion.php");
    $con=conectar();

    /* datos de admins */

    $sql1="SELECT users.* FROM users INNER JOIN super ON users.rut = super.rut;";
    $query1=mysqli_query($con,$sql1);

    $row1=mysqli_fetch_array($query1);


?>

<!DOCTYPE html>
<html lang="en-US" data-bs-theme="dark">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css" />
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <title>UDA</title>
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
    </head>
    <body>
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
        <a href="delete.php?id=<?php echo $row1['id'] ?>"><button type="button" class="btn btn-primary">Eliminar</button></a>
      </div>
    </div>
  </div>
</div>
<!-- 	<main>
        <?php
/*         if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['warning'])) {
            echo '<div class="alert alert-warning" role="alert">'.$_SESSION['warning'].'</div>';
            unset($_SESSION['warning']);
        } */
        ?> 
        </main> -->

        <?php  ?>


        <?php 
        /* pagina de la paginación por defecto*/
        if(isset($gestorpage) == false ){
            $gestorpage = 0;
        };
        ?>

        <div>
            navbar
        </div>
        <div>
            <!-- gestorbarra -->

<a href="../../gestor.php"><button type="button" class="btn btn-danger">Volver </button></a>

        </div>


        <!-- tablas de gestion -->

            <!-- /* tabla de Administradores */ -->

        
             <div class="container mt-5">
                    <div class="row"> 
                    <div class="col-md-4">
                        <form action="search.php" method="post">
                            <label for="searchinput"><h2>Buscar</h2></label>
                            <input id = "searchinput" type = "text" name = "search" placeholder ="Inserte busqueda" />
                            <button type="submit" class="btn">Enviar</button>
                        </form>
                    </div>
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
                                        <th>Password</th>
                                        <th>Imagen</th>
                                        <th>Direccion</th>
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
                                                <th><?php  echo $row1['rut']?></th>
                                                <th><?php  echo $row1['name']?></th>
                                                <th><?php  echo $row1['surname']?></th>
                                                <th><?php  echo $row1['description']?></th>
                                                <th><?php  echo $row1['email']?></th>
                                                <th><?php  echo $row1['phone']?></th>
                                                <th><?php  echo $row1['password']?></th>
                                                <th><?php  echo $row1['imageurl']?></th>
                                                <th><?php  echo $row1['direction']?></th>
                                                
                                                <th><a href="actualizar.php?rut=<?php echo $row1['rut'] ?>" class="btn btn-info">Editar</a></th>
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
                                                <th><?php  echo $row1search['rut']?></th>
                                                <th><?php  echo $row1search['name']?></th>
                                                <th><?php  echo $row1search['surname']?></th>
                                                <th><?php  echo $row1search['description']?></th>
                                                <th><?php  echo $row1search['email']?></th>
                                                <th><?php  echo $row1search['phone']?></th>
                                                <th><?php  echo $row1search['password']?></th>
                                                <th><?php  echo $row1search['imageurl']?></th>
                                                <th><?php  echo $row1search['direction']?></th>
                                                
                                                <th><a href="actualizar.php?rut=<?php echo $row1search['rut'] ?>" class="btn btn-info">Editar</a></th>
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
            </div>



        
        <div>
            
        </div>
    </body>
</html>