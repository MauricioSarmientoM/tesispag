<?php
   /*  session_start();
    if(!isset($_SESSION['super'])) {
        header("Location: ../index.php");
    } */
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
        <!-- navbar -->
        <?php include './comp/navbar.php'; ?>
        <main>
            <!-- Alerts -->
            <?php include './comp/alerts.php' ?>
            <!-- CONTENEDOR DE BARRA DE GESTORES -->
            <div class="container py-4">
                <!-- BOTON VOLVER Y TITULO -->
                <div class="row">
                    <div class="col-md-3">    
                        <button class="boton">
                            <a href="index.php">
                                <h3 class="mt-2 mx-2">&#9664; Volver</h3>
                            </a>
                        </button>
                    </div>
                    <div class="col">
                        <h1 class="text-center">Gestor</h1>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <!-- FIN DE BOTON VOLVER Y TITULO -->

                <!-- BARRA DE GESTORES -->
                <div class="row my-4 d-flex zona">
                    <div class="col-md-1 zona-imagen">
                        <img class="d-flex mx-auto my-4" src="src\icons\userLogo.png" alt="">
                    </div>
                    <div class="col my-auto">
                        <a href="users.php"><h2>Gestionar Usuarios</h2></a>
                    </div>
                </div>
                <div class="row mt-4 d-flex zona">
                    <div class="col-md-1 zona-imagen">
                        <img class="d-flex mx-auto my-4" src="src\icons\adminLogo.png" alt="">
                    </div>
                    <div class="col my-auto">
                        <a href="super.php"><h2>Gestionar Administración</h2></a>
                    </div>
                </div>
                <div class="row mt-4 d-flex zona">
                    <div class="col-md-1 zona-imagen">
                        <img class="d-flex mx-auto my-4" src="src\icons\workLogo.png" alt="">
                    </div>
                    <div class="col my-auto">
                        <a href="works.php"><h2>Gestionar Trabajos</h2></a>
                    </div>
                </div>
                <!-- FIN BARRA DE GESTORES -->
            </div>
            <!-- FIN DE CONTENEDOR DE BARRA DE GESTORES -->

            <!-- DIEGO: EL FOOTER NO ES NECESARIO EN gestor.php
            <div class="fixed-bottom">
                <?php /* include './comp/footer.php'; */?>
            </div>
            -->
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>