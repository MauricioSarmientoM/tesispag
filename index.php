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
                    <a href = "thesis.php?id=<?php echo $row['id'] ?>" class="col-md-7 mb-4 fotosCol">
                        <?php
                        if ($row['image'] === '' or $row['image'] == NULL) {
                        ?>
                        <img class = "fotoCal" src="./src/FotosDIICC/_ALX9336.JPG" alt="Evento_<?php echo $row['name'] ?>">
                        <?php
                        }
                        else {
                        ?>
                        <img class = "fotoCal" src="<?php echo $row['image'] ?>" alt="Evento_<?php echo $row['name'] ?>">
                        <?php } ?>
                        <h3 class = "px-2 py-1 shorterLine"><?php echo $row['name'] ?></h3>
                        <h5 class = "px-2 py-1 shorterLine"><?php echo $row['area'] ?></h5>
                        <p class = "px-4"><?php echo $row['abstract']?></p>
                    </a>
                    <div class="col-md-4 ms-auto">
                        <?php $row = $works->fetch_assoc();?>
                        <a href = "thesis.php?id=<?php echo $row['id'] ?>" class="row mb-4 fotosCol">
                            <?php
                            if ($row['image'] === '' or $row['image'] == NULL) {
                            ?>
                            <img class = "fotoCal" src="./src/FotosDIICC/_ALX9336.JPG" alt="Evento_<?php echo $row['name'] ?>">
                            <?php
                            }
                            else {
                            ?>
                            <img class = "fotoCal" src="<?php echo $row['image'] ?>" alt="Evento_<?php echo $row['name'] ?>">
                            <?php } ?>
                            <h3 class = "px-2 py-1 shorterLine"><?php echo '' . $row['name'] . ' - ' . $row['area'] ?></h3>
                        </a>
                        <?php $row = $works->fetch_assoc();?>
                        <a href = "thesis.php?id=<?php echo $row['id'] ?>" class="row mb-4 fotosCol">
                            <?php
                            if ($row['image'] === '' or $row['image'] == NULL) {
                            ?>
                            <img class = "fotoCal" src="./src/FotosDIICC/_ALX9336.JPG" alt="Evento_<?php echo $row['name'] ?>">
                            <?php
                            }
                            else {
                            ?>
                            <img class = "fotoCal" src="<?php echo $row['image'] ?>" alt="Evento_<?php echo $row['name'] ?>">
                            <?php } ?>
                            <h3 class = "px-2 py-1 shorterLine"><?php echo '' . $row['name'] . ' - ' . $row['area'] ?></h3>
                        </a>
                        <div class="row text-center">
                            <button class="boton">
                                <a class="link" href="thesis.php">
                                    <h1 class="mb-1">Más</h1>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of Zona de tesis -->
            
            <!-- Zona de Calendario -->
            <?php
            $amountNews = 3;
            $news = SelectEventsWhereRealizationDateExist($con, $amountNews);
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
                            <a class="link" href="calendar.php">
                                <h1 class="mb-1">Más</h1>
                            </a>
                        </button>
                    </div>
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
