<?php
    session_start();
    if(!isset($_SESSION['super'])) {
        header("Location: ../index.php");
    }

    include("./backend/connection.php");
    $con=conectar();

    $rut=$_GET['rut'];

    $sql="SELECT * FROM users WHERE rut='$rut'";
    $query=mysqli_query($con,$sql);

    $row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset = "utf-8"/>
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css" />
        <link rel = "stylesheet" href = "./css/general.css" />
        <link rel = "stylesheet" href = "./css/gestor.css" />
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <title>UDA</title>
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
    </head>
    <body>
        <main>
            <?php 
                include './comp/navbar.php';
                include './comp/alerts.php';
            ?>
               <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">Actualizar datos de usuario</div>
                <div class="card-body">

                    <form action="backend/updateUser.php" method="post">


        <div class="form-group">
            <label for="inputUsername">Rut</label>
            <input type="text" class="form-control mb-3" name="rut" placeholder="" value="<?php echo $row['rut']  ?>" required>
            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
        </div>

        <div class="form-group">
            <label for="inputUsername">Nombre</label>
            <input type="text" class="form-control mb-3" name="name" placeholder="" value="<?php echo $row['name']  ?>" required>
            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
        </div>
        
        <div class="form-group">
            <label for="inputEmail">Apellidos</label>
            <input type="text" class="form-control mb-3" name="surname" placeholder="" value="<?php echo $row['surname']  ?>" required>
            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
        </div>

        <div class="form-group">
            <label for="inputEmail">Descripción</label>
            <input type="text" class="form-control mb-3" name="description" placeholder="" value="<?php echo $row['description']  ?>" required>
            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
        </div>

                        <div class="form-group">
                            <label for="inputEmail">Correo</label>
                            <input type="email" class="form-control mb-3" name="email" placeholder="" value="<?php echo $row['email']  ?>" required>
                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Teléfono</label>
                            <input type="text" class="form-control mb-3" name="phone" placeholder="" value="<?php echo $row['phone']  ?>" required>
                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Contraseña</label>
                            <input type="password" class="form-control mb-3" name="password" placeholder="" value="<?php echo $row['password']  ?>" required>
                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Imagen URL</label>
                            <input type="text" class="form-control mb-3" name="imageurl" placeholder="" value="<?php echo $row['imagenurl']  ?>" required>
                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Dirección</label>
                            <input type="text" class="form-control mb-3" name="direction" placeholder="" value="<?php echo $row['direction']  ?>" required>
                            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
                        </div>

                        <div class="container d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-block ">Confirmar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
               </div>
            <?php include './comp/footer.php'; ?>
        </main>
    </body>
</html>