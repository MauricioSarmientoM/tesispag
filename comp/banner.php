<div id="carouselCaptions" class="carousel slide boxShadow content" data-bs-ride="carousel">
	<div class="carousel-indicators">
        <?php
            include './backend/connection.php';
            include './backend/select.php';
            $con = conectar();
            $amountNews = 2;
            $news = selectEvents($con, $amountNews);
            for ($counter = 0; $counter < $amountNews; $counter++) {
                if ($counter === 0) {
                    echo '<button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
                }
                else {
                    echo '<button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="' . $counter . '" aria-label="Slide ' . ($counter + 1) . '"></button>';
                }
            }
        ?>
	</div>
	<div class="carousel-inner">
        <?php
            $counter = 0;
            while ($row = $news->fetch_assoc()) {
                if ($counter == 0) {
                    echo '<div class="carousel-item active">';
                }
                else {
                    echo '<div class="carousel-item">';
                }
                if ($row['image'] === NULL) {
                    echo '<img src="./src/FotosDIICC/_ALX9334.JPG" class="d-block carousel-img" alt="...">';
                }
                else {
                    echo '<img src="' . $row['image'] . '" class="d-block carousel-img" alt="...">';
                }
        ?>
			<div class="carousel-caption d-md-block">
				<h1 class = "white"><?php echo $row['title']; ?></h1>
				<p class = "white transBG"><?php echo $row['description']; ?></p>
			</div>
		</div>
        <?php
                $counter++;
            }
                ?>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>
<!--
Investigadores de la Universidad de Atacama Descubren Nueva Especie de Mariposa
En un emocionante avance científico, un equipo de investigadores de la Universidad de Atacama ha identificado y catalogado una nueva especie de mariposa en una expedición en la selva amazónica. Este descubrimiento destaca el compromiso de la universidad con la investigación biológica y la conservación de la biodiversidad.
Estudiantes de la Universidad de Atacama son Ganadores del Concurso Nacional de Innovación Tecnológica
¡Éxito estudiantil! Un grupo de estudiantes de la Universidad de Atacama ha triunfado en el Concurso Nacional de Innovación Tecnológica con su proyecto revolucionario de inteligencia artificial para asistencia médica. Este logro subraya el enfoque vanguardista de la universidad en la formación de futuros líderes en el campo de la tecnología.
Conferencia Internacional en la Universidad de Atacama Destaca Avances en Energías Renovables
La Universidad de Atacama fue anfitriona de una destacada conferencia internacional sobre energías renovables, donde expertos de todo el mundo compartieron sus investigaciones más recientes. Este evento reafirma el papel de la universidad como un centro líder en la promoción de soluciones sostenibles y la colaboración global para abordar los desafíos ambientales.
-->
