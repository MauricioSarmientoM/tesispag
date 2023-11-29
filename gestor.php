<?php
    session_start();
    if(!isset($_SESSION['super'])) {
        header("Location: ../index.php");
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
            <?php 
                include './comp/navbar.php';
                include './comp/alerts.php';
            ?>
            <!-- gestorbarra -->
            <div class="container p-5" style="background-color: white;">
                <h1>Gestor de base de datos</h1>
                <div class="foption">
                    <span>
                        <img class="icon" src="src/u.png" alt="">
                    </span>
                    <a href="users.php?page=1"><span>Usuarios</span> </a>
                </div>
                <div class="foption">
                    <span>
                        <img class="icon" src="src/s.png" alt="">
                    </span>
                    <a href="super.php"><span>Administracion</span></a>
                </div>
                <div class="foption">
                    <span>
                        <img class="icon" src="src/w.png" alt="">
                    </span><a href="works.php"><span>Trabajos</span></a>
                </div>
            </div>
            <?php include './comp/footer.php'; ?>
        </main>
    </body>
</html>