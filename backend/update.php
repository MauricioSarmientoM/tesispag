<?php
    function UpdateUser($con, $rut, $name, $surname, $description, $email, $phone, $password, $imageURL, $direction, $img) {
        // Encrypting password, this substring needs to be checked if the password haven't being changed.
        $stringToCheck = '$2y$10$';
        if (!(substr($password, 0, strlen($stringToCheck)) === $stringToCheck)) {
            $password = password_hash($password, PASSWORD_BCRYPT);
        }
        //  Checking if file of image exist to be saved
        if (isset($imageURL) && $imageURL["error"] == UPLOAD_ERR_OK) {
            $targetDirectory = "uploads/users/";  // Set your target directory
            $uploadedFileName = basename($imageURL["name"]);
            $targetFilePath = $targetDirectory . uniqid() . '_' . $uploadedFileName;
            // Move the uploaded file to the target directory
            if (move_uploaded_file($imageURL["tmp_name"], $targetFilePath)) {
                // Now, you can use $targetFilePath to store in the database
                $imageURL = $targetFilePath;

                // Delete previous image
                $sql = "SELECT imageURL FROM users WHERE rut = $rut";
                $resultImg = $con->query($sql);
    
                $imgurl = $resultImg->fetch_assoc();
                // Check if the file exists
                if (file_exists($imgurl['imageURL'])) unlink($imgurl['imageURL']);
                $resultImg->free();
    
            }
            else $imageURL = ''; // File upload failed
        }
        else {
            if ($img === '') $imageURL = '';
            else $imageURL = $img;
        }
        
        $query = $con->prepare("UPDATE users SET name = ?, surname = ?, description = ?, email = ?, phone = ?, password = ?, imageURL = ?, direction = ? WHERE rut = ?");
        
        if (!$query) die("Preparation failed: " . $con->error);
        $query->bind_param("ssssisssi", $name, $surname, $description, $email, $phone, $password, $imageURL, $direction, $rut);
        if ($query->error) die("Binding parameters failed: " . $query->error);
        if ($query->execute()) return 1;
        return 0;
    }
    function UpdateWork($con, $id, $name, $obj, $area, $abstract, $image, $img) {
        if (isset($image) && $image["error"] == UPLOAD_ERR_OK) {
            $targetDirectory = "uploads/thesis/";
            $uploadedFileName = basename($image["name"]);
            $targetFilePath = $targetDirectory . uniqid() . '_' . $uploadedFileName;
            if (move_uploaded_file($image["tmp_name"], $targetFilePath)) {
                $image = $targetFilePath;
                $sql = "SELECT image FROM works WHERE id = $id";
                $resultImg = $con->query($sql);
                $imgurl = $resultImg->fetch_assoc();
                if (file_exists($imgurl['image'])) unlink($imgurl['image']);
                $resultImg->free();
    
            }
            else $image = '';
        }
        else {
            if ($img === '') $image = '';
            else $image = $img;
        }
        $query = $con->prepare("UPDATE works SET name = ?, obj = ?, area = ?, abstract = ?, image = ? WHERE id = ?");
        if (!$query) die("Preparation failed: " . $con->error);
        $query->bind_param("sssssi", $name, $obj, $area, $abstract, $image, $id);
        if ($query->error) die("Binding parameters failed: " . $query->error);
        if ($query->execute()) return 1;
        return 0;
    }
    function UpdateEvent($con, $id, $title, $description, $image, $publicationDate, $realizationDate) {
        
        if (isset($image) && $image["error"] == UPLOAD_ERR_OK) {
            $targetDirectory = "uploads/events/";
            $uploadedFileName = basename($image["name"]);
            $targetFilePath = $targetDirectory . uniqid() . '_' . $uploadedFileName;
            if (move_uploaded_file($image["tmp_name"], $targetFilePath)) {
                $image = $targetFilePath;
                $sql = "SELECT image FROM works WHERE id = $id";
                $resultImg = $con->query($sql);
                $imgurl = $resultImg->fetch_assoc();
                if (file_exists($imgurl['image'])) unlink($imgurl['image']);
                $resultImg->free();
    
            }
            else $image = '';
        }
        else {
            if ($img === '') $image = '';
            else $image = $img;
        }
        $query = $con->prepare("UPDATE events SET title = ?, description = ?, image = ?, publicationDate = ?, realizationDate = ? WHERE id = ?");
        if (!$query) die("Preparation failed: " . $con->error);
        $query->bind_param("sssssi", $title, $description, $image, $publicationDate, $realizationDate, $id);
        if ($query->error) die("Binding parameters failed: " . $query->error);
        if ($query->execute()) return 1;
        return 0;
    }
?>