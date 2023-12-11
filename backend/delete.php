<?php
    function DeleteUser($con, $rut) {
        $query = $con->prepare("DELETE FROM workuser WHERE rut = ?");
        
        if (!$query) die("Preparation failed: " . $con->error);
        
        $query->bind_param("i", $rut);
        
        if ($query->error) die("Binding parameters failed: " . $query->error);
        
        $query->execute();

        $sql = "SELECT imageURL FROM users WHERE rut = $rut";
        $result = $con->query($sql);

        $row = $result->fetch_assoc();
        
        // Check if the file exists
        if (file_exists($row['imageURL'])) unlink($row['imageURL']);
        
        $result->free();

        $query = $con->prepare("DELETE FROM users WHERE rut = ?");
        
    	if (!$query) die("Preparation failed: " . $con->error);
        
    	$query->bind_param("i", $rut);
        
    	if ($query->error) die("Binding parameters failed: " . $query->error);
    	if ($query->execute()) return 1;
        return 0;
    }
    function DeleteSuper($con, $rut) {
        $query = $con->prepare("DELETE FROM super WHERE rut = ?");
        
    	if (!$query) die("Preparation failed: " . $con->error);
        
    	$query->bind_param("i", $rut);
        
    	if ($query->error) die("Binding parameters failed: " . $query->error);
        
    	if ($query->execute()) return 1;
    	return 0;
    }
?>