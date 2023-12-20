<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel = "stylesheet" href = "./css/tutores.css"/>
        <link rel = "stylesheet" href = "./css/general.css"/>
        <title>UDA</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include './comp/navbar.php'; ?>
        <!-- Alerts -->
        <?php include './comp/alerts.php'; ?>
        <main>
            <div class="container-fluid zonasTitulo"><h1 class="container">Tutores</h1></div>
            <!--Diego: Celeste, en este container va todo el php -->
            <div class="container py-4">
                <div class="row">
                    <!-- Diego: Celeste, el col-3 hace que un col tome el tamaño de 3 cols.
                        Como solo puede haber un máximo de 12 col desplazados en un row,
                        en este caso, solo puede haber 4 cols, es decir, 4 cards de tutores,
                        por lo que cuando haya un quinto, este se desplaza para abajo como se desea.-->
                    <div class="col-3 my-4">
                        <a href="about:blank"> <!-- aquí va el link para el perfil con el id respectivo -->
                            <div class="card carta">
                                <!-- para que la magia sea resposive, la foto tiene que ser un cuadrado perfecto :( -->
                                <img src="src\icons\iconPlaceholder.png" alt="Un fondo de la universidad" class="card-img-top linea">
                                <div class="card-body text-center">
                                    <h3 class="card-title">Nombre - Apellido</h3> <!-- Diego: Celeste, aquí van los dos echo session -->
                                    <h4 class="card-text">Rut</h4>
                                </div>
                            </div>
                        </a>
                    </div>
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