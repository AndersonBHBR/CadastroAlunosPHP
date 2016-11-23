<?php

class AlunoDAO {
    
    private static $URL = "localhost";
    private static $USUARIO = "andersonbhbr";
    private static $SENHA = "12345";
    private static $DATABASE = "escola";
    
    public static function testeConexao() {
        $conexao = new mysqli_connect(AlunoDAO::$URL,AlunoDAO::$USUARIO,AlunoDAO::$SENHA,AlunoDAO::$DATABASE);
        mysqli_close($conexao);
    }
    
    public static function buscar($args) {
        $conexao = new mysqli_connect(AlunoDAO::$URL,AlunoDAO::$USUARIO,AlunoDAO::$SENHA,AlunoDAO::$DATABASE);
        $query = "SELECT * FROM aluno WHERE nome LIKE('%" . $args . "%') OR endereco LIKE('%" . $args . "%');";
        $resultado = mysqli_query($query,$conexao);
        $tudo = "";
        $separador = "";
        while ($linha = mysqli_fetch_array($resultado)) {
            $tudo = $tudo . $separador;
            $tudo = $tudo . $linha['id'];
            $tudo = $tudo . "&&";
            $tudo = $tudo . $linha['nome'];
            $tudo = $tudo . "&&";
            $tudo = $tudo . $linha['endereco'];
            $tudo = $tudo . "&&";
            $tudo = $tudo . $linha['turma'];
            $separador = "##";
        }
        mysqli_close($conexao);
        return $alunos = split("##",$tudo);
    }
    
    public static function find($id) {
        $conexao = new mysqli_connect(AlunoDAO::$URL,AlunoDAO::$USUARIO,AlunoDAO::$SENHA,AlunoDAO::$DATABASE);
        $query = "SELECT * FROM aluno WHERE id = $id;";
        $resultado = mysqli_query($query,$conexao);
        mysqli_close($conexao);
        $aluno = new Aluno();
        while ($linha = mysqli_fetch_array($resultado)) {
            $aluno = new Aluno();
            $aluno->setId($id);
            $aluno->setNome($linha['nome']);
            $aluno->setEndereco($linha['endereco']);
            $aluno->setTurma($linha['turma']);
        }
        return $aluno;
    }
    
    public static function cadastrar(Aluno $aluno) {
        $conexao = new mysqli_connect(AlunoDAO::$URL,AlunoDAO::$USUARIO,AlunoDAO::$SENHA,AlunoDAO::$DATABASE);
        $sql = "INSERT INTO aluno (nome, endereco, turma) "
                . "VALUES ('" . $aluno->getNome() . "', '" . $aluno->getEndereco() . "', '" . $aluno->getTurma() . "');";
        mysqli_query( $sql, $conexao );
        mysqli_close($conexao);
        HistoricoDAO::cadastrar("Novo aluno foi cadastrado");
    }
    
    public static function alterar(Aluno $aluno) {
        $sql = "UPDATE aluno SET ";
        $sql = $sql . "nome='" . $aluno->getNome() . "',";
        $sql = $sql . "endereco='" . $aluno->getEndereco() . "',";
        $sql = $sql . "turma='" . $aluno->getTurma() . "'";
        $sql = $sql . " WHERE id = " . $aluno->getId();
        $conexao = mysqli_connect(AlunoDAO::$URL,AlunoDAO::$USUARIO,AlunoDAO::$SENHA,AlunoDAO::$DATABASE);
        mysqli_query( $sql, $conexao );
        HistoricoDAO::cadastrar("Alterar aluno com id " . $aluno->getId());
    }

    public static function excluir(Aluno $aluno) {
        $conexao = mysqli_connect(AlunoDAO::$URL,AlunoDAO::$USUARIO,AlunoDAO::$SENHA,AlunoDAO::$DATABASE);
        $sql = "DELETE FROM aluno WHERE id=" . $aluno->getId();
        mysqli_query($conexao, $sql);
        mysqli_close($conexao);
        HistoricoDAO::cadastrar("Excluir aluno com id " . $aluno->getId());
    }
    
}