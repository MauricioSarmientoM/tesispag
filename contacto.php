<?php
/*     session_start();
    if(!isset($_SESSION['rut'])) {
        header("Location: ../index.php");
    }
    else{
        ;
    }
     */

    include("./backend/connection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css" />
        <link rel = "stylesheet" href = "./css/general.css"/>
        <link rel = "stylesheet" href = "./css/gestor.css"/>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Contacto</title>
</head>
<body>




                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">Contáctanos
                </button>

<!-- Modal -->

<!--                 <?php 
/* if (isset($_SESSION['rut']))  {*/
                    ?> -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
            <form action="./backend/insertContact.php" method="post">
      <div class="modal-header ">
        <h1 class="modal-title fs-5 " id="exampleModalLabel">Contacto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <div class="container mt-5 col-10">
            <div class="mb-3">
                <input type="hidden" id="inputrut" class="form-control mb-3" value="1" name="rut"/>

                <input type="hidden" id="inputreaded" class="form-control mb-3" value="0" name="readed" />

                <input type="text" class="form-control" id="inputsubject" name="subject" placeholder="Asunto" />
            </div>
            <div class="mb-3">
            <label for="inputObj" class="form-label"></label>
            <textarea class="form-control" id="inputObj" name="body" placeholder="Escriba su mensaje aquí." rows="3"></textarea>
            </div>
       <div>
</div>

</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="boton" name="contacto">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>




