<?php
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['image']) && isset($_POST['publicationDate']) && isset($_POST['realizationDate'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $publicationDate = $_POST['publicationDate'];
        $realizationDate = $_POST['realizationDate'];

        $query = $connection->prepare("INSERT INTO events (title, description, image, publicationDate, realizationDate) VALUES (?, ?, ?, ?, ?)");
		if (!$query) {
			die("Preparation failed: " . $connection->error);
		}
		$query->bind_param("sssss", $title, $description, $image, $publicationDate, $realizationDate);
		if (!$query) {
			die("Binding parameters failed: " . $query->error);
        }
        $query->execute();
		if ($query->affected_rows > 0) {
			$_SESSION["success"] = "Event was created successfully!";
		}
		else {
			$_SESSION["warning"] = $connection->error;
		}
    }
?>