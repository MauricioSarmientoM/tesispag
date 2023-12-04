<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel = "stylesheet" href = "./css/mainPage.css"/>
        <link rel = "stylesheet" href = "./css/general.css"/>
        <title>UDA</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include './comp/navbar.php'; ?>
        <main>
            <!-- Alerts -->
            <?php include './comp/alerts.php'; ?>

            <!-- Banner -->
            <?php include './comp/banner.php'; ?>

            <!-- Zona de tesis -->
            <div class="container-fluid pt-4 zonasTitulo"><h1 class="container">Tesis</h1></div>
            <div class="container my-4">
                <div class="row">
                    <div class="col-md-7 p-4 fotosCol">
                        <img src="./src/FotosDIICC/_ALX9336.JPG" alt="...">
                        <div class="my-4 fotos"></div>
                        <h2>Título - Área</h2>
                    </div>
                    <div class="col-md-4 ms-auto">
                        <div class="row mb-4 pt-2 fotosCol ">
                        <img src="./src/FotosDIICC/_ALX9336.JPG" alt="...">
                        <div class="my-2 fotos"></div>
                        <h2>Título - Área</h2>
                        </div>
                        <div class="row mb-4 pt-2 fotosCol">
                        <img src="./src/FotosDIICC/_ALX9336.JPG" alt="...">
                        <div class="my-2 fotos"></div>
                        <h2>Título - Área</h2>
                        </div>
                        <div class="row text-center">
                            <button class="boton">
                                <a class="link" href="https://about:blank" target="_blank">
                                    <h1 class="mb-1">Más</h1>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of Zona de tesis -->
            
            <!-- Zona de Calendario -->
            <div class="container-fluid pt-4 zonasTitulo"><h1 class="container">Calendario</h1></div>
                <div class="container my-4">
                    <div class="row my-4">
                        <div class="col-md-4 my-2 py-2 fotosCol">
                            <img src="./src/FotosDIICC/_ALX9336.JPG" alt="Evento_1">
                        </div>
                        <div class="col">
                            <h2>Título</h2>
                            <h3>Fecha del evento</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio impedit optio libero, delectus, voluptatum quibusdam ipsa sapiente maxime sed sint vitae at officiis natus nihil fugit ea cupiditate ex! Provident?</p>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-4 my-2 py-2 fotosCol">
                            <img src="./src/FotosDIICC/_ALX9336.JPG" alt="Evento_2">
                        </div>
                        <div class="col">
                            <h2>Título</h2>
                            <h3>Fecha del evento</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio impedit optio libero, delectus, voluptatum quibusdam ipsa sapiente maxime sed sint vitae at officiis natus nihil fugit ea cupiditate ex! Provident?</p>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-4 my-2 py-2 fotosCol">
                            <img src="./src/FotosDIICC/_ALX9336.JPG" alt="Evento_3">
                        </div>
                        <div class="col">
                            <h2>Título</h2>
                            <h3>Fecha del evento</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio impedit optio libero, delectus, voluptatum quibusdam ipsa sapiente maxime sed sint vitae at officiis natus nihil fugit ea cupiditate ex! Provident?</p>
                        </div>
                    </div>
                        <div class="row text-center">
                            <button class="boton">
                                <a class="link" href="https://about:blank" target="_blank">
                                    <h1 class="mb-1">Más</h1>
                                </a>
                            </button>
                        </div>
                </div>
            </div>
            <!-- end of Zona de Calendario -->
            
            <!-- footer -->
            <?php include './comp/footer.php' ?>
            <!-- end of footer -->
        </main>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
