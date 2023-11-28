<?php
function conectar(){
    $host="127.0.0.0";
    $user="root";
    $pass="";
    $bd="tesis";

    $con=mysqli_connect($host,$user,$pass);

    mysqli_select_db($con,$bd);

    return $con;
}
?>
