<?php /* session_start() */?>
<?php 
    include("conexion.php");
    $con=conectar();

    /* datos de users */

    $sql0="SELECT *  FROM users";
    $query0=mysqli_query($con,$sql0);

    $row0=mysqli_fetch_array($query0);

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
        <a href="delete.php?rut=<?php echo $row0['rut'] ?>"><button type="button" class="btn btn-primary">Eliminar</button></a>
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
            <!-- gestorbarra -->
            <a href="../../gestor.php"><button type="button" class="btn btn-danger">Volver </button></a>
        </div>
<?php ?>
             <div class="container mt-5">
                    <div class="row"> 
                    <div class="col-md-4">
                        <form action="search.php" method="post">
                            <label for="searchinput"><h2>Buscar</h2></label>
                            <input id = "searchinput" type = "text" name = "search" placeholder ="Inserte busqueda" />
                            <button type="submit" class="btn">Enviar</button>
                        </form>
                    </div>


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
                                                <th><?php  echo $row0['rut']?></th>
                                                <th><?php  echo $row0['name']?></th>
                                                <th><?php  echo $row0['surname']?></th>
                                                <th><?php  echo $row0['description']?></th>
                                                <th><?php  echo $row0['email']?></th>
                                                <th><?php  echo $row0['phone']?></th>
                                                <th><?php  echo $row0['password']?></th>
                                                <th><?php  echo $row0['imageurl']?></th>
                                                <th><?php  echo $row0['direction']?></th>
                                                
                                                <th><a href="actualizar.php?rut=<?php echo $row0['rut'] ?>" class="btn btn-info">Editar</a></th>
                                                <th><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</th>                                       
                                            </tr>
                                        <?php 
                                            }while($row0=mysqli_fetch_array($query0));
                                            }
                                            else{ /* si es una busqueda */

                                                $sql0search="SELECT *  FROM users WHERE rut = '$search'";
                                                $query0search=mysqli_query($con,$sql);

                                                $row0search=mysqli_fetch_array($query);

                                            do{
                                        ?>
                                            <tr>
                                                <?php $identificador= 'rut' ?>
                                                <th><?php  echo $row0search['rut']?></th>
                                                <th><?php  echo $row0search['name']?></th>
                                                <th><?php  echo $row0search['surname']?></th>
                                                <th><?php  echo $row0search['description']?></th>
                                                <th><?php  echo $row0search['email']?></th>
                                                <th><?php  echo $row0search['phone']?></th>
                                                <th><?php  echo $row0search['password']?></th>
                                                <th><?php  echo $row0search['imageurl']?></th>
                                                <th><?php  echo $row0search['direction']?></th>
                                                
                                                
                                                <th><a href="actualizar.php?rut=<?php echo $row0search['rut'] ?>" class="btn btn-info">Editar</a></th>
                                                <th><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</th>                                        
                                            </tr>
                                        <?php 
                                            }while($row0search=mysqli_fetch_array($query0search));

                                            };

                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                    
    </body>
</html>
