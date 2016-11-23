<?php

class HistoricoDAO {
    
    private static $URL = "localhost";
    private static $USUARIO = "andersonbhbr";
    private static $SENHA = "12345";
    private static $DATABASE = "escola";
    
    public static function testeConexao() {
        $conexao = mysqli_connect(HistoricoDAO::$URL,HistoricoDAO::$USUARIO,HistoricoDAO::$SENHA,HistoricoDAO::$DATABASE);
        mysqli_close($conexao);
    }
    
    public static function buscar() {
        $conexao = mysqli_connect(HistoricoDAO::$URL,HistoricoDAO::$USUARIO,HistoricoDAO::$SENHA,HistoricoDAO::$DATABASE);
        $query = "SELECT * FROM historico;";
        $resultado = mysqli_query($query,$conexao);
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
        $conexao = new mysqli_connect(HistoricoDAO::$URL,HistoricoDAO::$USUARIO,HistoricoDAO::$SENHA,HistoricoDAO::$DATABASE);
        $sql = "INSERT INTO historico (descricao) "
                . "VALUES ('" . $descricao . "');";
        mysqli_query( $sql, $conexao );
        return mysqli_insert_id($conexao) && mysqli_close($conexao);
    }
    
}