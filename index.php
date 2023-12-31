<?php
include './backend/connection.php';
include './backend/select.php';
include './backend/insert.php';
$con = conectar();
session_start();
if (!file_exists("uploads/")) {
    mkdir("uploads/", 0777, true); // The third parameter (true) creates nested directories if they don't exist
}
if (!file_exists("uploads/thesis/")) {
    mkdir("uploads/thesis/", 0777, true);
}
if (!file_exists("uploads/users/")) {
    mkdir("uploads/users/", 0777, true);
}
if (!file_exists("uploads/events/")) {
    mkdir("uploads/events/", 0777, true);
}
if (isset($_POST['subject'])) {
    InsertContact($con, $_POST['rut'], $_POST['subject'], $_POST['body']);
}
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
        <title>UDA</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include './comp/navbar.php'; ?>
        <!-- Alerts -->
        <?php include './comp/alerts.php'; ?>
        <main>
            <!-- Banner -->
            <?php include './comp/banner.php'; ?>
            <!-- Zona de tesis -->
            <?php
            $amountWorks = 3;
            $works = SelectWorksOrderByDesc($con, $amountWorks);
            ?>
            <div class="container-fluid zonasTitulo"><h1 class="container">Tesis</h1></div>
            <div class="container my-4">
                <div class="row">
                    <?php $row = $works->fetch_assoc();?>
                    <a href = "detalle.php?id=<?php echo $row['id'] ?>" class="col-md-7 mb-auto fotosCol GalTesisL">
                        <?php
                        if ($row['image'] === '' or $row['image'] == NULL) {
                        ?>
                        <img class = "fotoCal fotoTesisL" src="./src/FotosDIICC/_ALX9336.JPG" alt="Evento_<?php echo $row['name'] ?>">
                        <?php
                        }
                        else {
                        ?>
                        <img class = "fotoCal fotoTesisL" src="<?php echo $row['image'] ?>" alt="Evento_<?php echo $row['name'] ?>">
                        <?php } ?>
                        <h5 class = "px-2 py-1 shorterLine"><?php echo $row['name'] ?></h5>
                    </a>
                    <div class="col-md-4 ms-auto">
                        <?php $row = $works->fetch_assoc();?>
                        <a href = "detalle.php?id=<?php echo $row['id'] ?>" class="row mb-4 fotosCol GalTesisS">
                            <?php
                            if ($row['image'] === '' or $row['image'] == NULL) {
                            ?>
                            <img class = "fotoCal fotoTesisS" src="./src/FotosDIICC/_ALX9336.JPG" alt="Evento_<?php echo $row['name'] ?>">
                            <?php
                            }
                            else {
                            ?>
                            <img class = "fotoCal fotoTesisS" src="<?php echo $row['image'] ?>" alt="Evento_<?php echo $row['name'] ?>">
                            <?php } ?>
                            <h5 class = "px-2 py-1 shorterLine"><?php echo '' . $row['name'] . ' - ' . $row['area'] ?></h5>
                        </a>
                        <?php $row = $works->fetch_assoc();?>
                        <a href = "detalle.php?id=<?php echo $row['id'] ?>" class="row mb-4 fotosCol GalTesisS">
                            <?php
                            if ($row['image'] === '' or $row['image'] == NULL) {
                            ?>
                            <img class = "fotoCal fotoTesisS" src="./src/FotosDIICC/_ALX9336.JPG" alt="Evento_<?php echo $row['name'] ?>">
                            <?php
                            }
                            else {
                            ?>
                            <img class = "fotoCal fotoTesisS" src="<?php echo $row['image'] ?>" alt="Evento_<?php echo $row['name'] ?>">
                            <?php } ?>
                            <h5 class = "px-2 py-1 shorterLine"><?php echo '' . $row['name'] . ' - ' . $row['area'] ?></h5>
                        </a>
                    </div>
                </div>
                <div class="row text-center">
                    <button class="boton">
                        <a href="trabajos.php"><h1 class="mb-1">Más</h1></a>
                    </button>
                </div>
            </div>
            <!-- end of Zona de tesis -->
            
            <!-- Zona de Calendario -->
            <?php
            $amountNews = 3;
            $news = SelectEventsWhereRealizationDateExist($con, 1, $amountNews); //to search news only of the first page
            ?>
            <div class="container-fluid zonasTitulo"><h1 class="container">Calendario</h1></div>
                <div class="container my-4">
                    <?php 
                    while ($row = $news->fetch_assoc()) {
                    ?>
                    <a href = "calendar.php?id=<?php echo $row['id'] ?>">
                        <div class="row my-4">
                            <div class="col-md-4 my-2 fotosCol">
                                <?php
                                if ($row['image'] === '' or $row['image'] == NULL) {
                                ?>
                                <img class = "fotoCal" src="./src/FotosDIICC/_ALX9336.JPG" alt="Evento_<?php echo $row['title'] ?>">
                                <?php
                                }
                                else {
                                ?>
                                <img class = "fotoCal" src="<?php echo $row['image'] ?>" alt="Evento_<?php echo $row['title'] ?>">
                                <?php } ?>
                            </div>
                            <div class="col p-3">
                                <h2 class = "shorterLine"><?php echo $row['title'] ?></h2>
                                <h5>Fecha de Realización: <?php echo date("d/m/Y", strtotime($row['realizationDate'])); ?></h5>
                                <p><?php echo $row['description'] ?></p>
                            </div>
                        </div>
                    </a>
                    <?php
                    }
                    ?>
                    <div class="row text-center">
                        <button class="boton">
                            <a href="calendar.php"><h1 class="mb-1">Más</h1></a>
                        </button>
                    </div>
                </div>
            </div>
            <!-- end of Zona de Calendario -->
            
        </main>
        <!-- footer -->
        <?php include './comp/footer.php' ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
