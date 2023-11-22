<?php session_start()?>
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
        <!-- HACER NAVBAR -->
	    <main>
            <!-- HACER BANNER (NOTICIAS) -->
            <div>
                Zaza
            </div>
            <!-- HACER FOOTER -->
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

            </main>
    </body>
</html>
