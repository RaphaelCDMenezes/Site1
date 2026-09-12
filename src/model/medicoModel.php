<?php

namespace agendamento\medico;

/**
 * Modelo de Médico
 */
class Medico
{
    private $id_medico;
    private $nome;
    private $crm;
    private $email;
    private $telefone;
    private $senha;
    private $dt_nascimento;
    private $id_empresa;
    private $id_especialidade;

    function __construct()
    {
    }

    public function getId_medico()      { return $this->id_medico; }
    public function getNome()           { return $this->nome; }
    public function getCrm()            { return $this->crm; }
    public function getEmail()          { return $this->email; }
    public function getTelefone()       { return $this->telefone; }
    public function getSenha()          { return $this->senha; }
    public function getDt_nascimento()  { return $this->dt_nascimento; }
    public function getId_empresa()     { return $this->id_empresa; }
    public function getId_especialidade() { return $this->id_especialidade; }

    public function setId_medico($v)        { $this->id_medico = $v;        return $this; }
    public function setNome($v)             { $this->nome = $v;             return $this; }
    public function setCrm($v)              { $this->crm = $v;              return $this; }
    public function setEmail($v)            { $this->email = $v;            return $this; }
    public function setTelefone($v)         { $this->telefone = $v;         return $this; }
    public function setSenha($v)            { $this->senha = $v;            return $this; }
    public function setDt_nascimento($v)    { $this->dt_nascimento = $v;    return $this; }
    public function setId_empresa($v)       { $this->id_empresa = $v;       return $this; }
    public function setId_especialidade($v) { $this->id_especialidade = $v; return $this; }

    public function inserir()
    {
        global $conexao;
        try {
            $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);
            $stmt = $conexao->prepare(
                "INSERT INTO medico (nome, crm, email, telefone, senha, id_especialidade, dt_nascimento, id_empresa)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param(
                'sssssisi',
                $this->nome,
                $this->crm,
                $this->email,
                $this->telefone,
                $senhaHash,
                $this->id_especialidade,
                $this->dt_nascimento,
                $this->id_empresa
            );
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function alterar()
    {
        global $conexao;
        try {
            $stmt = $conexao->prepare(
                "UPDATE medico
                 SET crm = ?,
                     email = ?,
                     telefone = ?,
                     id_especialidade = ?,
                     dt_nascimento = ?,
                     id_empresa = ?
                 WHERE id_medico = ?"
            );
            $stmt->bind_param(
                'sssisii',
                $this->crm,
                $this->email,
                $this->telefone,
                $this->id_especialidade,
                $this->dt_nascimento,
                $this->id_empresa,
                $this->id_medico
            );
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function excluir()
    {
        global $conexao;
        try {
            $stmt = $conexao->prepare("DELETE FROM medico WHERE id_medico = ?");
            $stmt->bind_param('i', $this->id_medico);
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
            if ($this->id_medico) {
                $stmt = $conexao->prepare("SELECT * FROM medico WHERE id_medico = ?");
                $stmt->bind_param('i', $this->id_medico);
                $stmt->execute();
                $recordset = $stmt->get_result();
            } else {
                $recordset = mysqli_query($conexao, "SELECT * FROM medico");
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
        if ($this->crm == '') {
            $arrMsg[] = 'Informe o CRM';
        }
        if ($this->id_especialidade == '') {
            $arrMsg[] = 'Informe a especialidade';
        }
        return $arrMsg;
    }
}
