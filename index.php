<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel = "stylesheet" href = "./css/mainPage.css"/>
        <link rel = "stylesheet" href = "./css/general.css"/>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <title>UDA</title>
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
    </head>
    <body>
        <main>
            <!-- navbar -->
            <?php include './comp/navbar.php'; ?>
            <!-- end of navbar -->
            
            <!-- Alerts -->
            <?php include './comp/alerts.php' ?>
            <!-- end alerts -->

            <!-- banner -->
            <?php include './comp/banner.php'; ?>
            <!-- end of banner -->

            <!-- Zona de tesis -->
            <div class="container-fluid pt-4"style="background-color: #364c59; color: white"><h1 class="container">Tesis</h1></div>
            <div class="container my-4">
                <div class="row">
                    <div class="col-md-7 p-4" style="border: 2px solid #364c59;">
                        <img src="..." alt="...">
                        <div class="my-2" style="border-bottom: 2px solid #364c59"></div>
                        <h2>Título - Área</h2>
                    </div>
                    <div class="col-md-4 ms-auto">
                        <div class="row mb-4" style="border: 2px solid #364c59">
                        <img src="..." alt="...">
                        <div class="my-2" style="border-bottom: 2px solid #364c59"></div>
                        <h2>Título - Área</h2>
                        </div>
                        <div class="row mb-4" style="border: 2px solid #364c59">
                        <img src="..." alt="...">
                        <div class="my-2" style="border-bottom: 2px solid #364c59"></div>
                        <h2>Título - Área</h2>
                        </div>
                        <div class="row text-center" style="border: 2px solid #364c59">
                            <a href="https://about:blank" target="_blank">
                                <button class="btn"><h1>Más</h1></button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of Zona de tesis -->
            
            <!-- Zona de Calendario -->
            <div class="container-fluid pt-4"style="background-color: #364c59; color: white"><h1 class="container">Calendario</h1></div>
                <div class="container my-4">
                    <div class="row my-4">
                        <div class="col-md-4 my-2" style="border: 2px solid #364c59">
                            <img src="..." alt="Evento_1">
                        </div>
                        <div class="col">
                            <h2>Título</h2>
                            <h3>Fecha del evento</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio impedit optio libero, delectus, voluptatum quibusdam ipsa sapiente maxime sed sint vitae at officiis natus nihil fugit ea cupiditate ex! Provident?</p>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-4 my-2" style="border: 2px solid #364c59">
                            <img src="..." alt="Evento_1">
                        </div>
                        <div class="col">
                            <h2>Título</h2>
                            <h3>Fecha del evento</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio impedit optio libero, delectus, voluptatum quibusdam ipsa sapiente maxime sed sint vitae at officiis natus nihil fugit ea cupiditate ex! Provident?</p>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-4 my-2" style="border: 2px solid #364c59">
                            <img src="..." alt="Evento_1">
                        </div>
                        <div class="col">
                            <h2>Título</h2>
                            <h3>Fecha del evento</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio impedit optio libero, delectus, voluptatum quibusdam ipsa sapiente maxime sed sint vitae at officiis natus nihil fugit ea cupiditate ex! Provident?</p>
                        </div>
                    </div>
                        <div class="row text-center" style="border: 2px solid #364c59">
                            <a href="https://about:blank" target="_blank">
                                <button class="btn"><h1>Más</h1></button>
                            </a>
                        </div>
                </div>
            </div>
            <!-- end of Zona de Calendario -->

            <?php include './comp/footer.php' ?>
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
