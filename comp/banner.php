<div id="carouselCaptions" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-indicators">
        <?php
            $amountNews = 3;
            $news = SelectEvents($con, 1, $amountNews); //Only select the first page of news
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
				<div class="row">
					<div class="col text-start">
					<p class = "white transBG"><?php echo $row['description']; ?></p>
					</div>
					<div class="col text-end">
                        <h5>Fecha de Publicación</h5>
						<h2><?php echo date("d/m/Y", strtotime($row['publicationDate'])); ?></h2>
					</div>
				</div>
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
