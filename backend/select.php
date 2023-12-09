<?php


    //User

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
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM users WHERE rut = $rut LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereIdWork($con, $pageNumber, $itemsPerPage, $idWork) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.* FROM users JOIN workuser ON users.rut = workuser.rut WHERE workuser.idWork = $idWork LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereIdWorkButNoRut($con, $pageNumber, $itemsPerPage, $idWork, $rut) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.* FROM users JOIN workuser ON users.rut = workuser.rut WHERE workuser.idWork = $idWork AND users.rut != $rut LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersNotInIdWork($con, $pageNumber, $itemsPerPage, $idWork) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM users WHERE rut NOT IN (SELECT rut FROM workuser WHERE idWork = ?) LIMIT ? OFFSET ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iii", $idWork, $itemsPerPage, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    function SelectUsersCount($con) {
        $sql = "SELECT COUNT(rut) as count FROM users";
        $result = $con->query($sql);
        return $result;
    }


    //Works


    function SelectWorks ($con, $pageNumber, $itemsPerPage) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM works LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksOrderByDesc ($con, $itemsPerPage) {
        $sql = "SELECT * FROM works ORDER BY id DESC LIMIT $itemsPerPage";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksWhereId ($con, $pageNumber, $itemsPerPage, $id) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM works WHERE id = $id LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksWhereRut($con, $pageNumber, $itemsPerPage, $rut) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT works.* FROM works JOIN workuser ON works.id = workuser.idWork WHERE workuser.rut = $rut LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksCount($con) {
        $sql = "SELECT COUNT(id) as count FROM works";
        $result = $con->query($sql);
        return $result;
    }

    //Events

    function selectEvents($con, $limit) {
        $sql = "SELECT * FROM events LIMIT $limit";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsWhereRealizationDateExist($con, $limit) {
        $sql = "SELECT * FROM events WHERE realizationDate IS NOT NULL ORDER BY realizationDate DESC LIMIT $limit";
        $result = $con->query($sql);
        return $result;
    }

    //Supers

    function SelectSupers ($con, $pageNumber, $itemsPerPage) {
        // Calculate the offset
        $offset = ($pageNumber - 1) * $itemsPerPage;
        // Query to retrieve data by pages
        $sql = "SELECT users.* FROM users INNER JOIN super ON users.rut = super.rut LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
        //if ($result->num_rows > 0) {}  With this I can verify if the query got data
    }
    function SelectSupersWhereRut ($con, $pageNumber, $itemsPerPage, $rut) {
        // Calculate the offset
        $offset = ($pageNumber - 1) * $itemsPerPage;
        // Query to retrieve data by pages
        $sql = "SELECT users.* FROM users INNER JOIN super ON users.rut = super.rut WHERE super.rut = $rut LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
        //if ($result->num_rows > 0) {}  With this I can verify if the query got data
    }
    function SelectSupersCount($con) {
        $sql = "SELECT COUNT(users.rut) as count FROM users INNER JOIN super ON users.rut = super.rut";
        $result = $con->query($sql);
        return $result;
    }
?>