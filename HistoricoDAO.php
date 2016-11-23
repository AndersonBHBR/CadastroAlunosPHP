<?php
require "conexao.php";

class HistoricoDAO {
    
    public static function testeConexao() {
        $conexao = conectar();
        mysqli_close($conexao);
    }
    
    public static function buscar() {
        $conexao = conectar();
        $query = "SELECT * FROM historico;";
        $resultado = $conexao->query($query);
        $tudo = "";
        $separador = "";
        while ($linha = mysqli_fetch_array($resultado)) {
            $tudo = $tudo . $separador;
            $tudo = $tudo . $linha['id'];
            $tudo = $tudo . "&&";
            $tudo = $tudo . $linha['dataHistorico'];
            $tudo = $tudo . "&&";
            $tudo = $tudo . $linha['descricao'];
            $separador = "##";
        }
        mysqli_close($conexao);
        return $descricao = split("##",$tudo);
    }
    
    public static function cadastrar($descricao) {
        $conexao = conectar();
        $sql = "INSERT INTO historico (descricao) "
                . "VALUES ('" . $descricao . "');";
        $conexao->query($sql);
        return mysqli_insert_id($conexao) && mysqli_close($conexao);
    }
    
}