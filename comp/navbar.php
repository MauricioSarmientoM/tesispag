<div class="header-top navbarData fixed-top">
    <div class="container-fluid py-2">
        <div class="row px-4">
            <div class="col-ms-6 col-md-12 col-lg-5 d-flex mx-auto my-auto">
                <a href="index.php">
                    <img width="297px" id="udaLogo" src="src\materialessolciitados\logo-udacorp-txtblanco.png">
                </a>
            </div>
            <div class="col d-flex">
                <div class="dropdown mx-auto my-auto">
                    <button class="btn dropdown-toggle" type="button" id="dropdownPersonas" data-toggle="dropdown" aria-expanded="false">
                        Personas
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownPersonas">
                        <li><a class="dropdown-item" href="tesistas.php">Tesistas</a></li>
                        <li><a class="dropdown-item" href="tutores.php">Tutores</a></li>
                    </ul>
                </div>
            </div>
            <div class="col d-flex">
                <div class="dropdown mx-auto my-auto">
                    <button class="btn dropdown-toggle" type="button" id="dropdownTrabajos" data-toggle="dropdown" aria-expanded="false">
                        Trabajos
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownTrabajos">
                        <li><a class="dropdown-item" href="trabajos.php">Tesis</a></li>
                        <li><a class="dropdown-item" href="guia.php">Guía de Presentación</a></li>
                        <li><a class="dropdown-item" href="reglamento.php">Reglamento</a></li>
                    </ul>
                </div>
            </div>
            <!-- Nuevo link: Eventos -->
            <div class="col d-flex">
                <a class="my-auto mx-auto" href="calendar.php">Eventos</a>
            </div>
            <div class="col d-flex">
                 <?php if (isset($_SESSION['rut'])) { ?>
                <button type="button" class="btn login-btn mx-auto my-auto" data-bs-toggle="modal" data-bs-target="#contactModal">Contáctanos</button>
                <?php } else { ?>
                <button type="button" class="btn login-btn mx-auto my-auto" data-toggle="modal" data-target="#loginModal">Contáctanos</button>
                <?php } ?>
            </div>
            <div class="col d-flex my-auto">
                <?php 
                if (isset($_SESSION['rut'])) {
                    ?>
                    <div class="dropdown mx-auto">
                        <button class="btn dropdown-toggle" type="button" id="dropdownUser" data-toggle="dropdown" aria-expanded="false">
                            <?php echo '' . $_SESSION['name']; ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownUser">
                            <li>
                                <a class="dropdown-item" href = "/profile.php?rut=<?php echo $_SESSION['rut']; ?>">Perfil</a>
                            </li>
                            <?php
                                if(isset($_SESSION['super'])) {
                                    echo '<li><a class="dropdown-item" href="gestor.php">Gestor</a></li>';
                                }
                                ?>
                              <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./backend/logout.php">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                    <?php
                } else {
                    ?>
                    <button class="btn login-btn mx-auto" data-toggle="modal" data-target="#loginModal">Iniciar Sesión</button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Login -->
<div class="modal" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registre su Información</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="nav barraModal" id="nav-tab">
                <button class="nav-link active col text-center" id="inicioSesion" data-bs-toggle="tab" data-bs-target="#sesionInit" role="tab" aria-selected="true">Iniciar Sesión</button>
                <button class="nav-link col text-center"     id="recuperarContra" data-bs-toggle="tab" data-bs-target="#forgotPass" role="tab" aria-selected="false">Recuperar Contraseña</button>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="sesionInit" role="tabpanel" aria-labelledby="inicioSesion" tabindex="0">
                        <form action="./backend/login.php" method="POST">
                            <div class="form-group pb-2">
                                <label for="inputRut">Rut*</label>
                                <input type="text" class="form-control" name="rut" id="inputRut" placeholder="Ingrese su Rut" required>
                            </div>
                            <div class="form-group py-2 mb-3">
                                <label for="inputPassword">Contraseña*</label>
                                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Ingrese su contraseña" required>
                            </div>
                            <div class="text-end">
                                <hr class="my-1">
                                <button type="submit" class="btn login-btn mt-3">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="forgotPass" role="tabpanel" aria-labelledby="recuperarContra" tabindex="0">
                        <form action="backend/recover.php" method="POST">
                            <div class="form-group pb-2 mb-3">
                                <label for="inputRutRecuperar">Rut*</label>
                                <input type="text" class="form-control" name="rut" id="inputRutRecuperar" placeholder="Ingrese su Rut" required>
                            </div>
                            <div class="text-end">
                                <hr class="my-1">
                                <button type="submit" class="btn login-btn mt-3">Solicitar recuperación a Administrador</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of modal login -->

<!-- Modal Contact -->
<div class="modal" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Contacto</h1>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./backend/insertContact.php" method="post">
                    <div class="form-group mt-2">
                        <input type="hidden" id="inputrut" class="form-control mb-3" value="<?php echo $_SESSION['rut'] ?>" name="rut"/>
                        <input type="text" class="form-control" id="inputsubject" name="subject" placeholder="Asunto" />
                    </div>
                    <div class="form-group pb-3">
                        <label for="inputObj" class="form-label"></label>
                        <textarea class="form-control" id="inputObj" name="body" placeholder="Escriba su mensaje aquí." rows="3"></textarea>
                    </div>
                    <div class="text-end">
                        <hr class="my-1">
                        <button type="submit" class="btn login-btn mt-3">Enviar</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End -->