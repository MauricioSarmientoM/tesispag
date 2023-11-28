<?php session_start()?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel = "stylesheet" href = "styles.css"/>
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
            <div class="header-top" style="background-color: #364c59;">
                <div class="container-fluid py-2">
                    <div class="row px-4">
                        <div class="col-md-8 d-flex mx-auto my-auto">
                            <a href="https://uda.cl" target="_blank">
                                <img width="297px" id="udaLogo" src="src\materialessolciitados\logo-udacorp-txtblanco.png">
                            </a>
                        </div>
                        <div class="col d-flex">
                            <div class="dropdown mx-auto my-auto">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Personas
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Tesistas</a>
                                    <a class="dropdown-item" href="#">Tutores</a>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex">
                            <a class="my-auto mx-auto" href="https://about:blank" target="_blank">Trabajos</a>
                        </div>
                        <div class="col d-flex">
                            <a class="my-auto mx-auto" href="https://about:blank" target="_blank">Contactanos</a>
                        </div>
                        <div class="col d-flex my-auto">
                            <button class="btn btn-outline-light mx-auto" data-toggle="modal" data-target="#loginModal">Iniciar Sesión</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of navbar -->
        
            <!-- Modal de Login -->
            <div class="modal" id="loginModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Iniciar Sesión</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group pb-2">
                                    <label for="inputEmail">Correo institucional*</label>
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Ingrese su correo institucional" required>
                                </div>
                                <div class="form-group py-2 mb-3">
                                    <label for="inputPassword">Contraseña*</label>
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Ingrese su contraseña" required>
                                </div>
                                <div class="text-end">
                                    <hr class="my-1">
                                    <button type="submit" class="btn btn-primary mt-3">Iniciar Sesión</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of modal login -->

            <!-- HACER BANNER (NOTICIAS) -->
            <?php include './comp/banner.php'; ?>
            <!-- HACER FOOTER -->

            <footer class="container-fluid">
                <div class="row px-4 py-4" style="border-bottom: 1px solid gray">
                    <div class="col d-flex mx-auto my-auto">
                        <a href="https://uda.cl" target="_blank">
                            <img width="297px" id="footerUdaLogo" src="src\materialessolciitados\logo-udacorp-txtblanco.png">
                        </a>
                    </div>
                    <div class="col">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim velit fugit, exercitationem reiciendis delectus aliquam deserunt vero iure adipisci sint rem dolor error accusamus animi neque nihil architecto nostrum aut!
                    </div>
                    <div class="col text-center">
                        <h2>Acerca De</h2>
                        <a href="https://about:blank" target="_blank">Nosotros</a><br>
                        <a href="https://about:blank" target="_blank">Términos y Condiciones</a><br>
                        <a href="https://about:blank" target="_blank">Políticas de Privacidad</a>
                    </div>
                    <div class="col text-center">
                        <h2>Otros</h2>
                        <a href="http://www.alumnos.uda.cl" target="_blank">Intranet</a><br>
                        <a href="https://www.moodle.uda.cl" target="_blank">Moodle</a><br>
                        <a href="https://www.portal.uda.cl" target="_blank">Portal</a>
                    </div>
                    <div class="col text-center">
                        <h2>Redes</h2>
                        <a href="https://www.facebook.com/UDAinstitucional" target="_blank">
                            <img id="facebookLogo" src="logos\facebookLogo.png">
                        </a>
                        <a href="https://www.instagram.com/u_atacama/" target="_blank">
                            <img id="instagramLogo" src="logos\instagramLogo.png">
                        </a>
                        <a href="https://twitter.com/UAtacama" target="_blank">
                            <img id="xLogo" src="logos\xLogo.png">
                        </a>
                        <a href="https://www.youtube.com/channel/UCTTKoSvDWYwQS8HgG3pf-SA" target="_blank">
                            <img id="youtubeLogo" src="logos\youtubeLogo.png">
                        </a>
                        <a href="https://www.linkedin.com/company/uda-universidad-de-atacama" target="_blank">
                            <img id="linkedInLogo" src="logos\linkedInLogo.png">
                        </a>
                    </div>
                </div>
                <div class="text-center py-4" style="color: lightgray">
                    © Grupo n, Copyleft.
                </div>
            </footer>
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
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
