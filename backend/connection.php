<?php
    function conectar(){
        $server = "127.0.0.1";
        $user = "root";
        $pass = "12345678";
        $db = "tesis";
        $con = new mysqli($server, $user, $pass, $db);
        if ($con->connect_error) {
            die("Error: " . $con->connect_error);
        }
        return $con;
    }
?>