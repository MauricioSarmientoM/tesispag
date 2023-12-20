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
    function SelectUsersCount($con) {
        $sql = "SELECT COUNT(rut) as count FROM users";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersNoTutor ($con, $pageNumber, $itemsPerPage) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.* FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE usertutor.rut IS NULL";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountNoTutor ($con) {
        $sql = "SELECT COUNT(users.rut) as count FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE usertutor.rut IS NULL";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereRut ($con, $pageNumber, $itemsPerPage, $rut) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM users WHERE CAST(rut AS CHAR) LIKE '%$rut%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountWhereRut ($con, $rut) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT COUNT(rut) as count FROM users WHERE CAST(rut AS CHAR) LIKE '%$rut%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereRutAndNoTutor ($con, $pageNumber, $itemsPerPage, $rut) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.* FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE d AND usertutor.rut IS NULL LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountWhereRutAndNoTutor ($con, $rut) {
        $sql = "SELECT COUNT(users.rut) as count FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE CAST(users.rut AS CHAR) LIKE '%$rut%' AND usertutor.rut IS NULL";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereName ($con, $pageNumber, $itemsPerPage, $name) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM users WHERE name LIKE '%$name%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountWhereName ($con, $name) {
        $sql = "SELECT COUNT(rut) as count FROM users WHERE name LIKE '%$name%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereNameAndNoTutor ($con, $pageNumber, $itemsPerPage, $name) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.* FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE users.name LIKE '%$name%' AND usertutor.rut IS NULL LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountWhereNameAndNoTutor ($con, $rut) {
        $sql = "SELECT COUNT(users.rut) as count FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE users.name LIKE '%$name%' AND usertutor.rut IS NULL";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereSurname ($con, $pageNumber, $itemsPerPage, $surname) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM users WHERE surname LIKE '%$surname%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountWhereSurname ($con, $surname) {
        $sql = "SELECT COUNT(rut) as count FROM users WHERE surname LIKE '%$surname%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereSurnameAndNoTutor ($con, $pageNumber, $itemsPerPage, $surname) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.* FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE users.surname LIKE '%$surname%' AND usertutor.rut IS NULL LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountWhereSurnameAndNoTutor ($con, $surname) {
        $sql = "SELECT COuNT(users.rut) as count FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE users.surname LIKE '%$surname%' AND usertutor.rut IS NULL";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereEmail ($con, $pageNumber, $itemsPerPage, $email) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM users WHERE email LIKE '%$email%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountWhereEmail ($con, $email) {
        $sql = "SELECT COUNT(rut) as count FROM users WHERE email LIKE '%$email%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereEmailAndNoTutor ($con, $pageNumber, $itemsPerPage, $email) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.* FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE users.email LIKE '%$email%' AND usertutor.rut IS NULL LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountWhereEmailAndNoTutor ($con, $email) {
        $sql = "SELECT COuNT(users.rut) as count FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE users.email LIKE '%$email%' AND usertutor.rut IS NULL";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereDirection ($con, $pageNumber, $itemsPerPage, $direction) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM users WHERE surname LIKE '%$direction%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountWhereDirection ($con, $direction) {
        $sql = "SELECT COUNT(rut) as count FROM users WHERE surname LIKE '%$direction%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersWhereDirectionAndNoTutor ($con, $pageNumber, $itemsPerPage, $direction) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.* FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE users.direction LIKE '%$direction%' AND usertutor.rut IS NULL LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectUsersCountWhereDirectionAndNoTutor ($con, $direction) {
        $sql = "SELECT COuNT(users.rut) as count FROM users LEFT JOIN usertutor ON users.rut = usertutor.rut WHERE users.direction LIKE '%$direction%' AND usertutor.rut IS NULL";
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
    function SelectUsersCountWhereIdWorkButNoRut($con, $idWork, $rut) {
        $sql = "SELECT COUNT(users.rut) as count FROM users JOIN workuser ON users.rut = workuser.rut WHERE workuser.idWork = $idWork AND users.rut != $rut LIMIT $itemsPerPage OFFSET $offset";
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
    function SelectUsersCountNotInIdWork($con, $idWork) {
        $sql = "SELECT * FROM users WHERE rut NOT IN (SELECT rut FROM workuser WHERE idWork = $idWork)";
        $result = $con->query($sql);
        return $result;
    }

    //Tutores

    function SelectTutors ($con, $pageNumber, $itemsPerPage) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.*, usertutor.grade FROM users INNER JOIN usertutor ON users.rut = usertutor.rut LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectTutorsWhereRut($con, $pageNumber, $itemsPerPage, $rut) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.*, usertutor.grade FROM users INNER JOIN usertutor ON users.rut = usertutor.rut WHERE CAST(users.rut AS CHAR) LIKE '%$rut%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectTutorsCount($con) {
        $sql = "SELECT COUNT(users.rut) as count FROM users INNER JOIN usertutor ON users.rut = usertutor.rut";
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
    function SelectWorksWhereName ($con, $pageNumber, $itemsPerPage, $name) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM works WHERE name LIKE '%$name%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksCountWhereName ($con, $name) {
        $sql = "SELECT COUNT(id) as count FROM works WHERE name LIKE '%$name%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksWhereObj ($con, $pageNumber, $itemsPerPage, $obj) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM works WHERE obj LIKE '%$obj%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksCountWhereObj ($con, $obj) {
        $sql = "SELECT COUNT(id) as count FROM works WHERE obj LIKE '%$obj%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksWhereArea ($con, $pageNumber, $itemsPerPage, $area) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM works WHERE area LIKE '%$area%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksCountWhereArea ($con, $area) {
        $sql = "SELECT COUNT(id) as count FROM works WHERE area LIKE '%$area%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksWhereAbstract ($con, $pageNumber, $itemsPerPage, $abstract) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM works WHERE abstract LIKE '%$abstract%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksCountWhereAbstract ($con, $abstract) {
        $sql = "SELECT COUNT(id) as count FROM works WHERE abstract LIKE '%$abstract%'";
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
    function SelectWorksWhereRutCount($con, $rut) {
        $sql = "SELECT COUNT(works.id) as count FROM works JOIN workuser ON works.id = workuser.idWork WHERE workuser.rut = $rut";
        $result = $con->query($sql);
        return $result;
    }
    function SelectWorksCount($con) {
        $sql = "SELECT COUNT(id) as count FROM works";
        $result = $con->query($sql);
        return $result;
    }

    //Events

    function SelectEvents($con, $pageNumber, $itemsPerPage) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM events ORDER BY publicationDate DESC LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsWhereRealizationDateExist($con, $pageNumber, $itemsPerPage) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM events WHERE realizationDate IS NOT NULL ORDER BY realizationDate DESC LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsWhereTitle($con, $pageNumber, $itemsPerPage, $title) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM events WHERE title LIKE '%$title%' ORDER BY publicationDate DESC LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsCountWhereTitle($con, $title) {
        $sql = "SELECT COUNT(id) as count FROM events WHERE title LIKE '%$title%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsWhereDescription($con, $pageNumber, $itemsPerPage, $description) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM events WHERE description LIKE '%$description%' ORDER BY publicationDate DESC LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsCountWhereDescription($con, $description) {
        $sql = "SELECT COUNT(id) as count FROM events WHERE description LIKE '%$description%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsWherePublicationDate($con, $pageNumber, $itemsPerPage, $publicationDate) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM events WHERE publicationDate LIKE '%$publicationDate%' ORDER BY publicationDate DESC LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsCountWherePublicationDate($con, $publicationDate) {
        $sql = "SELECT COUNT(id) as count FROM events WHERE publicationDate LIKE '%$publicationDate%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsRealizationDate($con, $pageNumber, $itemsPerPage, $realizationDate) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT * FROM events WHERE realizationDate LIKE '%$realizationDate%' ORDER BY publicationDate DESC LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsCountRealizationDate($con, $realizationDate) {
        $sql = "SELECT COUNT(id) as count FROM events WHERE realizationDate LIKE '%$realizationDate%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectEventsCount($con) {
        $sql = "SELECT COUNT(id) as count FROM events";
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

    //Contact Messages

    function SelectContacts($con, $pageNumber, $itemsPerPage) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.name as name, users.surname as surname, contact.* FROM contact JOIN users ON users.rut = contact.rut LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsCount($con) {
        $sql = "SELECT COUNT(id) as count FROM contact";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsWhereReaded($con, $pageNumber, $itemsPerPage, $readed) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.name as name, users.surname as surname, contact.* FROM contact JOIN users ON users.rut = contact.rut WHERE readed = $readed LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsCountWhereReaded($con, $readed) {
        $sql = "SELECT COUNT(id) as count FROM contact WHERE readed = $readed";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsWhereRut($con, $pageNumber, $itemsPerPage, $rut) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.name as name, users.surname as surname, contact.* FROM contact JOIN users ON users.rut = contact.rut WHERE CAST(rut AS CHAR) LIKE '%$rut%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsCountWhereRut($con, $rut) {
        $sql = "SELECT COUNT(id) as count FROM contact WHERE CAST(rut AS CHAR) LIKE '%$rut%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsWhereReadedAndRut($con, $pageNumber, $itemsPerPage, $readed, $rut) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.name as name, users.surname as surname, contact.* FROM contact JOIN users ON users.rut = contact.rut WHERE readed = $readed AND CAST(rut AS CHAR) LIKE '%$rut%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsCountWhereReadedAndRut($con, $readed, $rut) {
        $sql = "SELECT COUNT(id) as count FROM contact WHERE readed = $readed AND CAST(rut AS CHAR) LIKE '%$rut%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsWhereSubject($con, $pageNumber, $itemsPerPage, $subject) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.name as name, users.surname as surname, contact.* FROM contact JOIN users ON users.rut = contact.rut WHERE subject LIKE '%$subject%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsCountWhereSubject($con, $subject) {
        $sql = "SELECT COUNT(id) as count FROM contact WHERE subject LIKE '%$subject%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsWhereReadedAndSubject($con, $pageNumber, $itemsPerPage, $readed, $subject) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.name as name, users.surname as surname, contact.* FROM contact JOIN users ON users.rut = contact.rut WHERE readed = $readed AND subject LIKE '%$subject%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsCountWhereReadedAndSubject($con, $readed, $subject) {
        $sql = "SELECT COUNT(id) as count FROM contact WHERE readed = $readed AND subject LIKE '%$subject%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsWhereBody($con, $pageNumber, $itemsPerPage, $body) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.name as name, users.surname as surname, contact.* FROM contact JOIN users ON users.rut = contact.rut WHERE body LIKE '%$body%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsCountWhereBody($con, $body) {
        $sql = "SELECT COUNT(id) as count FROM contact WHERE subject LIKE '%$subject%'";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsWhereReadedAndBody($con, $pageNumber, $itemsPerPage, $readed, $body) {
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $sql = "SELECT users.name as name, users.surname as surname, contact.* FROM contact JOIN users ON users.rut = contact.rut WHERE readed = $readed AND body LIKE '%$body%' LIMIT $itemsPerPage OFFSET $offset";
        $result = $con->query($sql);
        return $result;
    }
    function SelectContactsCountWhereReadedAndBody($con, $readed, $body) {
        $sql = "SELECT COUNT(id) as count FROM contact WHERE readed = $readed AND subject LIKE '%$subject%'";
        $result = $con->query($sql);
        return $result;
    }
?>