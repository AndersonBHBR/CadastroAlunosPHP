<?php
function conectar(){
    $URL = "localhost";
    $USUARIO = "andersonbhbr";
    $SENHA = "12345";
    $DATABASE = "escola";

    $con = new mysqli($URL, $USUARIO, $SENHA, $DATABASE);
    return $con;
}

$conexao = conectar();
?>