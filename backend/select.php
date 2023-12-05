<?php
    function SelectUsers ($con, $pageNumber, $itemsPerPage) {
        // Calculate the offset
        $offset = ($pageNumber - 1) * $itemsPerPage;
        // Query to retrieve data by pages
        $sql = "SELECT * FROM users LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
        //if ($result->num_rows > 0) {}  With this I can verify if the query got data
    }
    function SelectUsersWhereRut ($con, $pageNumber, $itemsPerPage, $rut) {
        // Calculate the offset
        $offset = ($pageNumber - 1) * $itemsPerPage;
        // Query to retrieve data by pages
        $sql = "SELECT * FROM users WHERE rut = $rut LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
        //if ($result->num_rows > 0) {}  With this I can verify if the query got data
    }
    function SelectUsersCount($con) {
        $sql = "SELECT COUNT(rut) as count FROM users";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorks ($con, $pageNumber, $itemsPerPage) {
        // Calculate the offset
        $offset = ($pageNumber - 1) * $itemsPerPage;
        // Query to retrieve data by pages
        $sql = "SELECT * FROM works LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
        //if ($result->num_rows > 0) {}  With this I can verify if the query got data
    }
    function SelectWorksOrderByDesc ($con, $itemsPerPage) {
        // Query to retrieve data by pages
        $sql = "SELECT * FROM works ORDER BY id DESC LIMIT $itemsPerPage";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksWhereId ($con, $pageNumber, $itemsPerPage, $id) {
        // Calculate the offset
        $offset = ($pageNumber - 1) * $itemsPerPage;
        // Query to retrieve data by pages
        $sql = "SELECT * FROM works WHERE id = $id LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
        //if ($result->num_rows > 0) {}  With this I can verify if the query got data
    }
    function SelectWorksCount($con) {
        $sql = "SELECT COUNT(id) as count FROM works";
        $result = $con->query($sql);
        return $result;
    }
    function selectEvents($con, $limit) {
        $sql = "SELECT * FROM events LIMIT $limit";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsWhereRealizationDateExist($con, $limit) {
        $sql = "SELECT * FROM events WHERE realizationDate <> '' ORDER BY realizationDate DESC LIMIT $limit";
        $result = $con->query($sql);
        return $result;
    }
?>