<?php ?>
<?php 
    include("/backend/connection.php");
    $con=conectar();

$id=$_GET['id'];

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
                <div class="card-header text-center">Actualizar datos de Usuario</div>
                <div class="card-body">

                    <form action="backend/updateWork.php" method="post">

        <div class="form-group">
            <label for="inputUsername">Titulo</label>
            <input type="text" class="form-control mb-3" name="name" placeholder="" value="<?php echo $row['name']  ?>" required>
            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
        </div>
        
        <div class="form-group">
            <label for="inputEmail">Objetivo</label>
            <input type="text" class="form-control mb-3" name="obj" placeholder="" value="<?php echo $row['obj']  ?>" required>
            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
        </div>

        <div class="form-group">
            <label for="inputEmail">Área</label>
            <input type="text" class="form-control mb-3" name="area" placeholder="" value="<?php echo $row['area']  ?>" required>
            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
        </div>

        <div class="form-group">
            <label for="inputEmail">Abstract</label>
            <input type="text" class="form-control mb-3" name="abstract" placeholder="" value="<?php echo $row['abstract']  ?>" required>
            <div class="invalid-feedback">Por favor ingrese un dato válido.</div>
        </div>

        <div class="form-group">
            <label for="inputEmail">Imagen</label>
            <input type="text" class="form-control mb-3" name="image" placeholder="" value="<?php echo $row['image']  ?>" required>
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