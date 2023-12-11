
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel = "stylesheet" href = "./css/calendar.css"/>
        <link rel = "stylesheet" href = "./css/general.css"/>
        <title>UDA</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include './comp/navbar.php'; ?>
        <main>
            <!-- Alerts -->
            <?php include './comp/alerts.php'; ?>

            <!-- Zona de tesistas -->
            <div class="container-fluid zonasTitulo"><h1 class="container">Eventos</h1></div>
            <div class="container my-4">
                <form action="" method="get"> <!-- cambiar action="" -->
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col">
                            <select id="selector" class="form-select">
                                <option value="" disabled selected hidden>Buscar por:</option>
                                <option value="title"><p>Titulo</p></option>
                                <option value="description"><p>Descripción</p></option>
                                <option value="publicationDate"><p>Fecha de Publicación</p></option>
                                <option value="realizationDate"><p>Fecha de Realización</p></option>
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="btn-group" role="group">
                                <input class="text-center" id = "buscar" type = "search" name = "search" placeholder ="Inserte su búsqueda"/>
                                <button type="submit" class="btn"><h4>&#128269;</h4></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container my-4 eventos">
            <!-- Diego: Celeste, de aquí en adelante añades el backend,
                Tipo, su while piola con php que hace la consulta con arrays and stuff :)
                (Al final elimina mis comentarios)-->
                <a href="https://about:blank"> <!-- Diego: Aquí se vincula con su perfil -->
                    <div class="row my-4">
                        <div class="col-md-2 text-center my-auto">
                            <img class="evento" src="src\icons\userLogo.png" alt="foto-user"> <!-- Diego: No tengo el placeholder del user, en el brach perfil existe. -->
                            <!-- usuario es una clase del tesistas.css, un archivo css nuevo especifico para las imagenes de esta página-->
                        </div>
                        <div class="col my-auto">
                            <div class="row">
                                <h2>Título</h2> <!-- Diego: Aquí va una consulta php del nombre y el apellido -->
                            </div>
                            <div class="row">
                                <h4>Descripción</h4> <!-- Diego: Aquí va una consulta php del rut -->
                            </div>
                        </div>
                    </div>
                </a>
            </div> 
            <!-- Fin de zona de eventos -->

        </main>
        <!-- footer -->
        <?php include './comp/footer.php' ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>