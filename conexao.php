<?php
function conectar(){
    $URL = "localhost";
    $USUARIO = "andersonbhbr";
    $SENHA = "loverei169";
    $DATABASE = "escola";

    $con = new mysqli($URL, $USUARIO, $SENHA, $DATABASE);
    if (mysqli_connect_errno()) {
        die(mysqli_connect_error());
    }
    return $con;
}

?>