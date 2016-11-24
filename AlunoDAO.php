<?php
require "./conexao.php";

class AlunoDAO {

    public static function testeConexao() {
        $conexao = conectar();
        mysqli_close($conexao);
    }
    
    public static function buscar($args) {
        $conexao = conectar();
        $query = "SELECT * FROM aluno WHERE nome LIKE('%" . $args . "%') OR endereco LIKE('%" . $args . "%');";
        $resultado = $conexao->query($query);
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
        $conexao = conectar();
        $query = "SELECT * FROM aluno WHERE id = $id;";
        $resultado = $conexao->query($query);
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
        $conexao = conectar();
        $sql = "INSERT INTO aluno (nome, endereco, turma) "
                . "VALUES ('" . $aluno->getNome() . "', '" . $aluno->getEndereco() . "', '" . $aluno->getTurma() . "');";
        $conexao->query($sql);
        mysqli_close($conexao);
        HistoricoDAO::cadastrar("Novo aluno foi cadastrado");
    }
    
    public static function alterar(Aluno $aluno) {
        $sql = "UPDATE aluno SET ";
        $sql = $sql . "nome='" . $aluno->getNome() . "',";
        $sql = $sql . "endereco='" . $aluno->getEndereco() . "',";
        $sql = $sql . "turma='" . $aluno->getTurma() . "'";
        $sql = $sql . " WHERE id = " . $aluno->getId();
        $conexao = conectar();
        $conexao->query($sql);
        HistoricoDAO::cadastrar("Alterar aluno com id " . $aluno->getId());
    }

    public static function excluir(Aluno $aluno) {
        $conexao = conectar();
        $sql = "DELETE FROM aluno WHERE id=" . $aluno->getId();
        mysqli_query($conexao, $sql);
        $conexao->query($sql);
        HistoricoDAO::cadastrar("Excluir aluno com id " . $aluno->getId());
    }
    
}