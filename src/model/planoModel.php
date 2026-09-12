<?php
namespace agendamento\plano;

class Plano
{
    private $id_plano;
    private $nome;
    private $descricao;
    private $preco;
    private $beneficios;
    private $ativo;

    public function getId_plano()  { return $this->id_plano; }
    public function getNome()      { return $this->nome; }
    public function getDescricao() { return $this->descricao; }
    public function getPreco()     { return $this->preco; }
    public function getBeneficios(){ return $this->beneficios; }
    public function getAtivo()     { return $this->ativo; }

    public function setId_plano($v)  { $this->id_plano = $v;  return $this; }
    public function setNome($v)      { $this->nome = $v;      return $this; }
    public function setDescricao($v) { $this->descricao = $v; return $this; }
    public function setPreco($v)     { $this->preco = $v;     return $this; }
    public function setBeneficios($v){ $this->beneficios = $v;return $this; }
    public function setAtivo($v)     { $this->ativo = $v;     return $this; }

    public function listar()
    {
        global $conexao;
        try {
            if ($this->id_plano) {
                $stmt = $conexao->prepare("SELECT * FROM plano WHERE id_plano = ?");
                $stmt->bind_param('i', $this->id_plano);
                $stmt->execute();
                return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            }
            return mysqli_query($conexao, "SELECT * FROM plano ORDER BY preco ASC")->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) { return []; }
    }

    public function inserir()
    {
        global $conexao;
        try {
            $stmt = $conexao->prepare(
                "INSERT INTO plano (nome, descricao, preco, beneficios, ativo) VALUES (?,?,?,?,1)"
            );
            $stmt->bind_param('ssds', $this->nome, $this->descricao, $this->preco, $this->beneficios);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) { return false; }
    }

    public function alterar()
    {
        global $conexao;
        try {
            $stmt = $conexao->prepare(
                "UPDATE plano SET nome=?, descricao=?, preco=?, beneficios=?, ativo=? WHERE id_plano=?"
            );
            $stmt->bind_param('ssdsii', $this->nome, $this->descricao, $this->preco, $this->beneficios, $this->ativo, $this->id_plano);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) { return false; }
    }

    public function excluir()
    {
        global $conexao;
        try {
            $stmt = $conexao->prepare("DELETE FROM plano WHERE id_plano = ?");
            $stmt->bind_param('i', $this->id_plano);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) { return false; }
    }
}
