<div class="header-top navbarData">
    <div class="container-fluid py-2">
        <div class="row px-4">
            <div class="col-md-8 d-flex mx-auto my-auto">
                <a href="/">
                    <img width="297px" id="udaLogo" src="src\materialessolciitados\logo-udacorp-txtblanco.png">
                </a>
            </div>
            <div class="col d-flex">
                <div class="dropdown mx-auto my-auto">
                    <button class="btn dropdown-toggle" type="button" id="dropdownPersonas" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Personas
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownPersonas">
                        <a style="color: black" class="dropdown-item" href="#">Tesistas</a>
                        <a style="color: black" class="dropdown-item" href="#">Tutores</a>
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
                <?php 
                if (isset($_SESSION['rut'])) {
                    ?>
                    <div class="dropdown mx-auto my-auto">
                        <button class="btn dropdown-toggle" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo '' . $_SESSION['name']; ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownUser">
                            <a style="color: black"  class="dropdown-item" href="/profile.php?rut=<?php echo $_SESSION['rut']; ?>">Perfil</a>
                            <?php
                                if(isset($_SESSION['super'])) {
                                    echo '<a style="color: black" class="dropdown-item" href="/gestor.php">Gestor</a>';
                                }
                                ?>
                            <a style="color: black"  class="dropdown-item" href="/backend/logout.php">Cerrar Session</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <button class="btn btn-outline-light mx-auto" data-toggle="modal" data-target="#loginModal">Iniciar Sesión</button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

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
                <form action="./backend/login.php" method="POST">
                    <div class="form-group pb-2">
                        <label for="inputEmail">Rut*</label>
                        <input type="text" class="form-control" name="rut" id="inputRut" placeholder="Ingrese su Rut" required>
                    </div>
                    <div class="form-group py-2 mb-3">
                        <label for="inputPassword">Contraseña*</label>
                        <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Ingrese su contraseña" required>
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