<?php /* session_start() */?>
<?php 
    include("./backend/connection.php");
    $con=conectar();

    /* datos de works */

    $sql2="SELECT *  FROM works";
    $query2=mysqli_query($con,$sql2);

    $row2=mysqli_fetch_array($query2);
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
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
    </head>
    <body>
        <main>
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
        <a href="/backend/deleteWork.php?id=<?php echo $row2['id']?>"><button type="button" class="btn btn-primary">Eliminar</button></a>
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


            <!-- /* tabla de Trabajo */ -->
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
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Titulo</th>
                                        <th>Area</th>
                                        <th>Abstract</th>
                                        <th>Imagen</th>
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
                                                <th><?php  echo $row2['id']?></th>
                                                <th><?php  echo $row2['name']?></th>
                                                <th><?php  echo $row2['obj']?></th>
                                                <th><?php  echo $row2['area']?></th>
                                                <th><?php  echo $row2['abstract']?></th>
                                                <th><?php  echo $row2['image']?></th>
                                                
                                                <th><a href="/backend/updateformworks.php?rut=<?php echo $row2['rut'] ?>" class="btn btn-info">Editar</a></th>
                                                <th><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</th>                                       
                                            </tr>
                                        <?php 
                                            }while($row2=mysqli_fetch_array($query2));
                                            }
                                            else{ /* si es una busqueda */

                                                $sql2search="SELECT *  FROM works WHERE id = '$search'";
                                                $query2search=mysqli_query($con,$sql2search);

                                                $row2search=mysqli_fetch_array($query2search);

                                            do{
                                        ?>
                                            <tr>
                                                <?php $identificador= 'id' ?>
                                                <th><?php  echo $row2search['id']?></th>
                                                <th><?php  echo $row2search['name']?></th>
                                                <th><?php  echo $row2search['obj']?></th>
                                                <th><?php  echo $row2search['area']?></th>
                                                <th><?php  echo $row2search['abstract']?></th>
                                                <th><?php  echo $row2search['image']?></th>

                                                
                                                <th><a href="/backend/updateformworks.php?rut=<?php echo $row2search['rut'] ?>" class="btn btn-info">Editar</a></th>
                                                <th><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Eliminar</th>                                        
                                            </tr>
                                        <?php 
                                            }while($row2search=mysqli_fetch_array($query2search));

                                            };

                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>  
            </div>


        
        <div>
            
        </div>
        </main>
    </body>
</html>