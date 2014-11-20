<?php

class HistoricoDAO {
    
    private static $URL = "mysql9.000webhost.com";
    private static $USUARIO = "a1658207_005";
    private static $SENHA = "thmpv005";
    private static $DATABASE = "a1658207_005";
    
    public static function testeConexao() {
        $conexao = mysql_connect(HistoricoDAO::$URL,HistoricoDAO::$USUARIO,HistoricoDAO::$SENHA);
        mysql_close($conexao);
    }
    
    public static function buscar() {
        $conexao = mysql_connect(HistoricoDAO::$URL,HistoricoDAO::$USUARIO,HistoricoDAO::$SENHA);
        mysql_select_db(HistoricoDAO::$DATABASE,$conexao);
        $query = "SELECT * FROM historico;";
        $resultado = mysql_query($query,$conexao);
        $tudo = "";
        $separador = "";
        while ($linha = mysql_fetch_array($resultado)) {
            $tudo = $tudo . $separador;
            $tudo = $tudo . $linha['id'];
            $tudo = $tudo . "&&";
            $tudo = $tudo . $linha['dataHistorico'];
            $tudo = $tudo . "&&";
            $tudo = $tudo . $linha['descricao'];
            $separador = "##";
        }
        mysql_close($conexao);
        return $descricao = split("##",$tudo);
    }
    
    public static function cadastrar($descricao) {
        $conexao = mysql_connect(HistoricoDAO::$URL,HistoricoDAO::$USUARIO,HistoricoDAO::$SENHA);
        mysql_select_db(HistoricoDAO::$DATABASE,$conexao);
        $sql = "INSERT INTO historico (descricao) "
                . "VALUES ('" . $descricao . "');";
        mysql_query( $sql, $conexao );
        return mysql_insert_id($conexao) && mysql_close($conexao);
    }
    
}