<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name = "author" content = "Equipo4"/>
        <meta name = "description" content = "*¡Página de Tesistas!"/>
        <link rel = "stylesheet" href = "./node_modules/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel = "stylesheet" href = "./css/aboutUsPage.css"/>
        <link rel = "stylesheet" href = "./css/general.css"/>
        <script type = "text/javascript" src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <title>UDA</title>
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>
    </head>
    <body>
        <!-- navbar -->
        <?php include './comp/navbar.php'; ?>
        <main>
            <!-- Alerts -->
            <?php include './comp/alerts.php' ?>

            <div class="container-fluid zonasTitulo" id="quienes-somos"><h1 class="container">Quienes somos</h1></div>
            <div class="container my-4">
                <div class="row">
                    <div class="col py-4">
                        <div class="card mx-auto text-center" style="width: 18rem;">
                        <img src="src\icons\iconPlaceholder.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4>Diego Astorga</h4>
                                <p class="card-text">Encargado principalmente del área visual de la página (Frontend).</p>
                            </div>
                        </div>
                    </div>
                    <div class="col py-4">
                        <div class="card mx-auto text-center" style="width: 18rem;">
                        <img src="src\icons\iconPlaceholder.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4>Celeste Marambio</h4>
                                <p class="card-text">Encargada principalmente del área funcional de la página (Fullstack).</p>
                            </div>
                        </div>
                    </div>
                    <div class="col py-4">
                        <div class="card mx-auto text-center" style="width: 18rem;">
                        <img src="src\icons\iconPlaceholder.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4>Alejandro</h4>
                                <p class="card-text">Encargado principalmente del área administrativa de la página (Backend).</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h4>Somos un equipo de estudiantes de la carrera de Ingenieria Civil en Computación e Informática. Hemos realizado esta página web con el motivo de que sirva como una plantilla a lo que puede ser una página oficial de la institución, sobre a tesis respecta.</h4>
                </div>
            </div>

            <div class="container-fluid zonasTitulo" id="terminos"><h1 class="container">Términos y Condiciones</h1></div>
            <div class="container my-4">
                <div class="row my-4">
                <h2>Aceptación de Términos y Condiciones</h2>
                <p>Bienvenido a Nuestra página de tesistas de la Universidad de Atacama. Al acceder y utilizar este sitio web, usted acepta cumplir con los siguientes términos y condiciones. Lea atentamente esta información antes de continuar navegando por nuestro sitio.</p>
                </div>
                <div class="row my-4">
                <h2>Derechos de Autor</h2>
                <p>Todo el contenido, diseño y código del sitio web son propiedad exclusiva de [Nombre de la Página Web] y están protegidos por leyes de derechos de autor.</p>
                </div>
                <div class="row my-4">
                <h2>Marcas Registradas</h2>
                <p>Todas las marcas registradas utilizadas en este sitio son propiedad de sus respectivos dueños.</p>
                </div>
                <div class="row my-4">
                <h2>Enlaces a Terceros</h2>
                <p>Este sitio web puede contener enlaces a sitios web de terceros. [Nombre de la Página Web] no tiene control sobre el contenido de estos sitios y no se hace responsable de cualquier contenido o práctica de privacidad de los mismos.</p>
                </div>
            </div>

            <div id="politicas"></div>
            <div class="container-fluid zonasTitulo"><h1 class="container">Políticas de Privacidad</h1></div>
            <div class="container my-4">
                <div class="row my-4">
                <h2>Información que Recopilamos</h2>
                <p>Información Personal: Podemos recopilar información personal que nos proporcionas voluntariamente, como tu nombre, dirección de correo electrónico, número de teléfono, etc. Esta información se recopila cuando te registras en nuestro sitio, participas en encuestas, te suscribes a nuestro boletín, o realizas compras.</p>
                </div>
                <div class="row my-4">
                <h2>Compartir Información</h2>
                <p>No compartimos tu información personal con terceros, excepto cuando sea necesario para cumplir con la ley, proteger nuestros derechos o facilitar servicios que nos has solicitado.</p>
                </div>
                <div class="row my-4">
                <h2>Enlaces a Otros Sitios</h2>
                <p>Nuestro sitio puede contener enlaces a sitios web de terceros. No somos responsables de las prácticas de privacidad de esos sitios. Te recomendamos revisar las políticas de privacidad de esos terceros.</p>
                </div>
                <div class="row my-4">
                <h2>Contacto</h2>
                <p>Si tienes preguntas sobre esta Política de Privacidad o de este sitio web, por favor contáctanos a través del formulario que se encuentra en la pestaña "Contáctanos".</p>
                </div>
            </div>

        </main>
            <!-- footer -->
            <?php include './comp/footer.php' ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>