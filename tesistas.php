<?php
    session_start();
    include("./backend/connection.php");
    include("./backend/select.php");
    $con = conectar();

    $showUsers = 10;
    if (isset($_GET['search'])) $res = SelectUsersWhereRut($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers, $_GET['search']);
    else $res = SelectUsers($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showUsers); // Si no es una busqueda
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel = "stylesheet" href = "./css/tesistas.css"/>
        <link rel = "stylesheet" href = "./css/general.css"/>
        <title>UDA</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php include './comp/navbar.php'; ?>

        <!-- Alerts -->
        <?php include './comp/alerts.php'; ?>
        <main>
            <!-- Zona de tesistas -->
            <div class="container-fluid zonasTitulo"><h1 class="container">Tesistas</h1></div>

            <div class="container my-4 ">
                <form action="users.php" method="get">
                    <div class="row text-center">
                        <div class="col-md-5 my-auto">
                            <input class="w-100 py-1 text-center" id = "buscar" type = "search" name = "search" placeholder ="Inserte su búsqueda"/>
                        </div>
                        <div class="col-md-5">
                            <select id="selector" class="form-select">
                                <option value="" disabled selected hidden>Buscar por:</option>
                                <option value="rut"><p>RUT</p></option>
                                <option value="name"><p>Nombre</p></option>
                                <option value="surname"><p>Apellido</p></option>
                                <option value="email"><p>Email</p></option>
                                <option value="direction"><p>Dirección</p></option>
                            </select>
                        </div>
                        <div class="col row">
                            <button type="submit" class="boton"><h4>&#128269;</h4></button>
                        </div>
                    </div>
                </form>
            </div>

            <?php
                while ($row = $res->fetch_assoc()) {
            ?>
            <div class="container my-4 tesistas">
                <a href="profile.php?rut=<?php echo $row['rut']; ?>"> <!-- Diego: Aquí se vincula con su perfil -->
                    <div class="row my-4">
                        <div class="col-md-2 text-center my-auto">
                            <?php
                            if ($row['imageURL'] != NULL) {
                                echo '<img class = "usuario" src = "' . $row['imageURL'] . '"/>';
                            }
                            else{
                                echo '<img class = "usuario" src = "src/icons/iconPlaceholder.png"/>';
                            }
                            ?>
                        </div>
                        <div class="col my-auto">
                            <div class="row">
                                <h2><?php echo $row['name'] . ' ' . $row['surname'] ?></h2>
                            </div>
                            <div class="row">
                                <h4><?php echo $row['rut']; ?></h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
            <!-- Fin de zona de tesistas -->
            
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <?php
                    $usersAmount = SelectUsersCount($con);
                    $usersAmount = $usersAmount->fetch_assoc();
                    $pagesAmount = ceil($usersAmount['count'] / $showUsers);
                    for ($counter = 1; $counter <= $pagesAmount; $counter++) { ?>
                        <li class="page-item"><a href="/users.php?page=<?php echo $counter; ?>" class="page-link"><?php echo $counter; ?></a></li>
                    <?php } $con->close();?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </main>
        <!-- footer -->
        <?php include './comp/footer.php' ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>