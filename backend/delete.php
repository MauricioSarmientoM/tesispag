<?php
    function DeleteUser($con, $rut) {
        $query = $con->prepare("DELETE FROM contact WHERE rut = ?");
        if (!$query) die("Preparation failed: " . $con->error);
        $query->bind_param("i", $rut);
        if ($query->error) die("Binding parameters failed: " . $query->error);
        $query->execute();
        
        $query = $con->prepare("DELETE FROM super WHERE rut = ?");
    	if (!$query) die("Preparation failed: " . $con->error);
    	$query->bind_param("i", $rut);
    	if ($query->error) die("Binding parameters failed: " . $query->error);
    	$query->execute();
        
        $query = $con->prepare("DELETE FROM workuser WHERE rut = ?");
        if (!$query) die("Preparation failed: " . $con->error);
        $query->bind_param("i", $rut);
        if ($query->error) die("Binding parameters failed: " . $query->error);
        $query->execute();
        
        $query = $con->prepare("DELETE FROM usertutor WHERE rut = ?");
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
    function DeleteTutor($con, $rut) {
        $query = $con->prepare("DELETE FROM usertutor WHERE rut = ?");
    	if (!$query) die("Preparation failed: " . $con->error);
    	$query->bind_param("i", $rut);
    	if ($query->error) die("Binding parameters failed: " . $query->error);
    	if ($query->execute()) return 1;
    	return 0;
    }
    function DeleteCollab($con, $collabRut, $id) {
        $query = $con->prepare("DELETE FROM workuser WHERE idWork = ? AND rut = ?");
        if (!$query) die("Preparation failed: " . $con->error);
        $query->bind_param("ii", $id, $collabRut);
        if ($query->error) die("Binding parameters failed: " . $query->error);
        if ($query->execute()) return 1;
        return 0;
    }
    function DeleteWork($con, $id) {
        $query = $con->prepare("DELETE FROM workuser WHERE idWork = ?");
        if (!$query) die("Preparation failed: " . $con->error);
        $query->bind_param("i", $id);
        if ($query->error) die("Binding parameters failed: " . $query->error);
        $query->execute();

        $sql = "SELECT image FROM works WHERE id = $id";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        if (file_exists($row['image'])) unlink($row['image']);
        $result->free();

        $query = $con->prepare("DELETE FROM works WHERE id = ?");
        if (!$query) die("Preparation failed: " . $con->error);
        $query->bind_param("i", $id);
        if ($query->error) die("Binding parameters failed: " . $query->error);
        if ($query->execute()) return 1;
        return 0;
    }
    function DeleteEvent($con, $id) {
        $sql = "SELECT image FROM events WHERE id = $id";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        if (file_exists($row['image'])) unlink($row['image']);
        $result->free();
        
        $query = $con->prepare("DELETE FROM events WHERE id = ?");
        if (!$query) die("Preparation failed: " . $con->error);
        $query->bind_param("i", $id);
        if ($query->error) die("Binding parameters failed: " . $query->error);
        if ($query->execute()) return 1;
        return 0;
    }
    function DeleteContact($con, $id) {
        $query = $con->prepare("DELETE FROM contact WHERE id = ?");
        if (!$query) die("Preparation failed: " . $con->error);
        $query->bind_param("i", $id);
        if ($query->error) die("Binding parameters failed: " . $query->error);
        if ($query->execute()) return 1;
        return 0;
    }
?>