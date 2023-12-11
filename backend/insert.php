<?php
    function InsertUser($con, $rut, $name, $surname, $description, $email, $phone, $password, $imageURL, $direction) {
        $sql = "SELECT rut FROM users WHERE rut = $rut";
        $resultRut = $con->query($sql);
        if ($resultRut->num_rows == 0) { // Verifing that user doesn't exist first
            // Encrypting password
            $password = password_hash($password, PASSWORD_BCRYPT);
            //  Checking if file of image exist to be saved
            if (isset($imageURL) && $imageURL["error"] == UPLOAD_ERR_OK) {
                $targetDirectory = "uploads/users/";  // Set your target directory
                $uploadedFileName = basename($imageURL["name"]);
                $targetFilePath = $targetDirectory . uniqid() . '_' . $uploadedFileName;
                // Move the uploaded file to the target directory
                if (move_uploaded_file($imageURL["tmp_name"], $targetFilePath)) $imageURL = $targetFilePath; // Now, you can use $targetFilePath to store in the database
                else $imageURL = ''; // File upload failed
            }
        
            $query = $con->prepare("INSERT INTO users (rut, name, surname, description, email, phone, password, imageURL, direction) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
            if (!$query) die("Preparation failed: " . $con->error);
    
            $query->bind_param("issssisss", $rut, $name, $surname, $description, $email, $phone, $password, $imageURL, $direction);
    
            if ($query->error) die("Binding parameters failed: " . $query->error);
            if ($query->execute()) return 1;
        }
        return 0;
    }
    function InsertSuper($con, $rut) {
        $query = $con->prepare("INSERT INTO super (rut) VALUES (?)");
        if (!$query) {
            die("Preparation failed: " . $con->error);
        }
        $query->bind_param("i", $rut);
        if ($query->error) {
            die("Binding parameters failed: " . $query->error);
        }
        if ($query->execute()) return 1;
        return 0;
    }
?>