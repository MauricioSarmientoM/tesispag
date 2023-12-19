<?php session_start(); /*Diego: Veo que el id de la tesis se envia por el url. Celeste, usala con los llamados php */ ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel = "stylesheet" href = "./css/detalle.css"/>
        <link rel = "stylesheet" href = "./css/general.css"/>
        <title>UDA</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include './comp/navbar.php'; ?>
        <!-- Alerts -->
        <?php include './comp/alerts.php'; ?>
        <main class="fondo"> <!-- Diego: La clase fondo pertenece a detalle.css, ahí define la foto de fondo. Celeste,
                                  debes modificar detalle.css para que la imagen de fondo se la correspondiente -->
            <div class="container py-4 text-center">
                <div class="row my-4 py-4 zona"> <!-- Diego: Celeste, En Título, Área, Objetivo, Abstract, Colaboradores, van
                                                      los correspondientes echo session[''] del php-->
                    <h1>Título</h1>
                </div>
                <div class="row my-4 py-4 zona">
                    <h5>Área</h5>
                </div>
                <div class="row my-4 py-4 zona">
                    <h3>Objetivo</h3>
                </div>
                <div class="row my-4 py-4 zona">
                    <p>Abstract</p>
                </div>
                <div class="row my-4 py-4 zona">
                    <h4>Colaboradores</h4>
                </div>
            </div>
        </main>
        <!-- footer -->
        <?php include './comp/footer.php' ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>