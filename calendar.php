<?php
    session_start();

    include("./backend/connection.php");
    include("./backend/select.php");
    $con = conectar();

    $showEvents = 10;
    if (isset($_GET['search'])) {
         switch ($_GET['selector']) {
            case 'title':
                $res = SelectEventsWhereTitle($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showEvents, $_GET['search']);
                break;
            case 'description':
                $res = SelectEventsWhereDescription($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showEvents, $_GET['search']);
                break;
            case 'publicationDate':
                $res = SelectEventsWherePublicationDate($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showEvents, $_GET['search']);
                break;
            case 'realizationDate':
                $res = SelectEventsRealizationDate($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showEvents, $_GET['search']);
                break;
            default:
                $res = SelectEvents($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showEvents);
        }
    }
    else $res = SelectEvents($con, isset($_GET['page']) ? intval($_GET['page']) : 1, $showEvents); // Si no es una busqueda
?>
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

            <div class="container-fluid zonasTitulo"><h1 class="container">Eventos</h1></div>
            
            <div class="container my-4">
                <form action="calendar.php" method="get">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col">
                            <select id="selector" name = "selector" class="form-select">
                                <?php
                                $values = array('', 'title', 'description', 'publicationDate', 'realizationDate');
                                $name = array('Buscar por:', 'Titulo', 'Descripción', 'Fecha de Publicación', 'Fecha de Realización');
                                for ($counter = 0; $counter < count($values); $counter++) {
                                    echo '<option value = "' . $values[$counter] . '"';
                                    if ($values[$counter] == $_GET['selector']) echo ' selected';
                                    if ($counter == 0) echo ' disabled hidden';
                                    echo '>' . $name[$counter] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <div class="btn-group" role="group">
                                <input class="text-center" id = "buscar" type = "search" name = "search" placeholder ="Inserte su búsqueda" value = "<?php echo $_GET['search']?>"/>
                                <button type="submit" class="btn"><h4>&#128269;</h4></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <?php
                while ($row = $res->fetch_assoc()) {
            ?>
            <div class="container my-4 eventos">
                <a href="https://about:blank">
                    <div class="row my-4">
                        <div class="col-md-2 text-center my-auto">
                            <?php
                            if ($row['image'] != NULL) {
                                echo '<img class = "evento" src = "' . $row['image'] . '"/>';
                            }
                            else{
                                echo '<img class = "evento" src = "src/icons/iconPlaceholder.png"/>';
                            }
                            ?>
                        </div>
                        <div class="col my-auto">
                            <div class="row">
                                <h2><?php echo $row['title'];?></h2>
                            </div>
                            <div class="row">
                                <p><?php echo $row['description'];?></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
            <!-- Fin de zona de eventos -->

            <?php
            if (isset($_GET['search'])) {
                 switch ($_GET['selector']) {
                    case 'title':
                        $eventsAmount = SelectEventsCountWhereTitle($con, $_GET['search']);
                        break;
                    case 'description':
                        $eventsAmount = SelectEventsCountWhereDescription($con, $_GET['search']);
                        break;
                    case 'publicationDate':
                        $eventsAmount = SelectEventsCountWherePublicationDate($con, $_GET['search']);
                        break;
                    case 'realizationDate':
                        $eventsAmount = SelectEventsCountRealizationDate($con, $_GET['search']);
                        break;
                    default:
                        $eventsAmount = SelectEventsCount($con);
                }
            }
            else $eventsAmount = SelectEventsCount($con);
                
            if (isset($_GET['selector'])) $searchData = '&selector=' . $_GET['selector'] . '&search=' . $_GET['search'];
            else $searchData = '';
            
            $eventsAmount = $eventsAmount->fetch_assoc();
            $pagesAmount = ceil($eventsAmount['count'] / $showEvents);
            if ($pagesAmount > 1) {
            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
                    if ((isset($_GET['page']) ? intval($_GET['page']) : 1) == 1) echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
                    else echo '<li class="page-item"><a class="page-link" href="/calendar.php?page=' . (isset($_GET['page']) ? intval($_GET['page']) : 1) - 1 . $searchData . '">Previous</a></li>';
                    
                    for ($counter = 1; $counter <= $pagesAmount; $counter++) {
                        echo '<li class="page-item"><a href="/calendar.php?page=' . $counter . $searchData .'" class="page-link">' . $counter . '</a></li>';
                    }
                    if ($_GET['page'] == $pagesAmount) echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
                    else echo '<li class="page-item"><a class="page-link" href="/calendar.php?page=' . (isset($_GET['page']) ? intval($_GET['page']) : 1) + 1 . $searchData . '">Next</a></li>';
                    ?>
                </ul>
            </nav>
            <?php } $con->close(); ?>

        </main>
        <!-- footer -->
        <?php include './comp/footer.php' ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>