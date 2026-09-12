<?php

namespace agendamento\register;

/**
 * Modelo de Registro (auto-cadastro de paciente)
 */
class register
{
    private $id_usuario;
    private $nome;
    private $cpf;
    private $email;
    private $telefone;
    private $senha;

    public function getId_usuario() { return $this->id_usuario; }
    public function getNome()       { return $this->nome; }
    public function getCpf()        { return $this->cpf; }
    public function getEmail()      { return $this->email; }
    public function getTelefone()   { return $this->telefone; }
    public function getSenha()      { return $this->senha; }

    public function setId_usuario($v) { $this->id_usuario = $v; return $this; }
    public function setNome($v)       { $this->nome = $v;       return $this; }
    public function setCpf($v)        { $this->cpf = $v;        return $this; }
    public function setEmail($v)      { $this->email = $v;      return $this; }
    public function setTelefone($v)   { $this->telefone = $v;   return $this; }
    public function setSenha($v)      { $this->senha = $v;      return $this; }

    public function inserir()
    {
        global $conexao;
        try {
            $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);
            $stmt = $conexao->prepare(
                "INSERT INTO usuario (nome, cpf, email, telefone, senha) VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->bind_param('sssss', $this->nome, $this->cpf, $this->email, $this->telefone, $senhaHash);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function listar()
    {
        global $conexao;
        try {
            if ($this->id_usuario) {
                $stmt = $conexao->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
                $stmt->bind_param('i', $this->id_usuario);
                $stmt->execute();
                $recordset = $stmt->get_result();
            } else {
                $recordset = mysqli_query($conexao, "SELECT * FROM usuario");
            }
            return mysqli_fetch_all($recordset, MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            return [];
        }
    }

    function validar()
    {
        $arrMsg = [];
        if ($this->nome == '') {
            $arrMsg[] = 'Informe o nome';
        }
        if ($this->cpf == '') {
            $arrMsg[] = 'Informe o CPF';
        }
        if ($this->email == '') {
            $arrMsg[] = 'Informe o e-mail';
        }
        if ($this->senha == '') {
            $arrMsg[] = 'Informe a senha';
        }
        return $arrMsg;
    }
}
