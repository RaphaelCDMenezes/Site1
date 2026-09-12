<?php
namespace agendamento\adm;

class Adm
{
    private $id_adm;
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $ativo;

    public function getId_adm()  { return $this->id_adm; }
    public function getNome()    { return $this->nome; }
    public function getEmail()   { return $this->email; }
    public function getSenha()   { return $this->senha; }
    public function getTelefone(){ return $this->telefone; }
    public function getAtivo()   { return $this->ativo; }

    public function setId_adm($v)  { $this->id_adm = $v;  return $this; }
    public function setNome($v)    { $this->nome = $v;    return $this; }
    public function setEmail($v)   { $this->email = $v;   return $this; }
    public function setSenha($v)   { $this->senha = $v;   return $this; }
    public function setTelefone($v){ $this->telefone = $v;return $this; }
    public function setAtivo($v)   { $this->ativo = $v;   return $this; }

    public function listar()
    {
        global $conexao;
        try {
            if ($this->id_adm) {
                $stmt = $conexao->prepare("SELECT * FROM adm WHERE id_adm = ?");
                $stmt->bind_param('i', $this->id_adm);
                $stmt->execute();
                return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            }
            return mysqli_query($conexao, "SELECT * FROM adm ORDER BY nome")->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) { return []; }
    }
}
