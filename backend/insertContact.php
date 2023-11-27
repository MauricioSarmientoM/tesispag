<?php
    if (isset($_POST['rut']) && isset($_POST['subject']) && isset($_POST['body']) && isset($_POST['readed'])) {
        $rut = $_POST['rut'];
        $subject = $_POST['subject'];
        $body =  $_POST['body'];
        $readed = $_POST['readed'];

        $query = $connection->prepare("INSERT INTO contact (rut, subject, body, readed) VALUES (?, ?, ?, ?)");
		if (!$query) {
			die("Preparation failed: " . $connection->error);
		}
		$query->bind_param("isss", $rut, $subject, $body, $readed);
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