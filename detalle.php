<?php
    session_start();
    if(!isset($_GET['id'])) {
        header("Location: ../index.php");
    }
    include("./backend/connection.php");
    include("./backend/select.php");
    $con = conectar();

    $res = SelectWorksWhereId($con, 1, 1, $_GET['id']);
    $row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel = "stylesheet" href = "./css/detalle.css"/>
        <link rel = "stylesheet" href = "./css/general.css"/>
        <title>UDA</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include './comp/navbar.php'; ?>
        <!-- Alerts -->
        <?php include './comp/alerts.php'; ?>
        <main>
            <?php if ($row['image'] == '') { ?>
                <div style = 'background-image: url("../src/FotosDIICC/_ALX9325.JPG")' class = "fondo"></div>
            <?php } else {?>
                <div style = 'background-image: url("<?php echo $row['image']; ?>")' class = "fondo"></div>
            <?php } ?>
            <div class="container py-4 text-center">
                <div class="row my-4 py-4 zona">
                    <h1><?php echo $row['name']; ?></h1>
                    <?php if ($row['area'] == '') { ?>
                        <h5>Área: N/D</h5>
                    <?php } else {?>
                        <h5>Área: <?php echo $row['area']; ?></h5>
                    <?php } if ($row['obj'] == '') { ?>
                        <h3>Objetivo: N/D</h3>
                    <?php } else {?>
                        <h3>Objetivo: <?php echo $row['obj']; ?></h3>
                    <?php } if ($row['abstract'] == '') { ?>
                        <p>Abstact: N/D</p>
                    <?php } else {?>
                        <p>Abstract: <?php echo $row['abstract']; ?></p>
                    <?php } ?>
                    </div>
                <div class="row my-4 py-4 zona">
                    <h4>Colaboradores</h4>
                    <div class="row my-4">
                    <?php
                    $collab = SelectUsersWhereIdWork($con, 1, 10, $_GET['id']);
                    while ($data = $collab->fetch_assoc()) {
                        ?>
                        <a href = "profile.php?rut=<?php echo $data['rut']; ?>" class="col my-2 prof">
                            <?php
                            if ($data['imageURL'] != NULL) {
                                echo '<img class = "collabPhoto" src = "' . $data['imageURL'] . '"/>';
                            }
                            else{
                                echo '<img class = "collabPhoto" src = "src/icons/iconPlaceholder.png"/>';
                            }
                            ?>
                            <h2><?php echo $data['name'] . ' ' . $data['surname']; ?></h2>
                            <h4><?php echo $data['email']; ?></h4>
                        </a>
                        <?php
                        }
                        ?>
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