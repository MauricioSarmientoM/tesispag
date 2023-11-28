<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en-US" data-bs-theme="dark">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css" />
        <link rel = "stylesheet" href = "gestor/css/gestor.css" />
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
            if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['warning'])) {
            echo '<div class="alert alert-warning" role="alert">'.$_SESSION['warning'].'</div>';
            unset($_SESSION['warning']);
        }
        ?>
            <!-- gestorbarra -->
            <div class="container" style="background-color: white;">
                <div class="foption">
                    <span>
                        <img class="icon" src="gestor/img/u.png" alt="">
                    </span>
                    <a href="gestor/users.php?page=1"><span>Usuarios</span> </a>
                </div>
                <div class="foption"><span ><img class="icon" src="gestor/img/s.png" alt=""></span><a href="gestor/super/super.php"><span>Administracion</span></a></div>
                <div  class="foption"><span ><img class="icon" src="gestor/img/w.png" alt=""></span><a href="gestor/works/works.php"><span>Trabajos</span> </a></div>
            </div>
        </main>

        <?php  ?>
    </body>
</html>