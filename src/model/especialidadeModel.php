<?php

namespace agendamento\especialidade;

/**
 * Modelo de Especialidade
 */
class Especialidade
{
    private $id_especialidade;
    private $descricao;

    public function getId_especialidade() { return $this->id_especialidade; }
    public function getDescricao()        { return $this->descricao; }

    public function setId_especialidade($v) { $this->id_especialidade = $v; return $this; }
    public function setDescricao($v)        { $this->descricao = $v;        return $this; }

    public function listar()
    {
        global $conexao;
        try {
            if ($this->id_especialidade) {
                $stmt = $conexao->prepare("SELECT * FROM especialidade WHERE id_especialidade = ?");
                $stmt->bind_param('i', $this->id_especialidade);
                $stmt->execute();
                $recordset = $stmt->get_result();
            } else {
                $recordset = mysqli_query($conexao, "SELECT * FROM especialidade");
            }
            $dados = [];
            while ($row = $recordset->fetch_assoc()) {
                $dados[] = $row;
            }
            return $dados;
        } catch (\Throwable $th) {
            return [];
        }
    }

    function validar()
    {
        $arrMsg = [];
        if ($this->descricao == '') {
            $arrMsg[] = 'Informe a especialidade';
        }
        return $arrMsg;
    }

    public function inserir()
    {
        global $conexao;
        try {
            $stmt = $conexao->prepare("INSERT INTO especialidade (descricao) VALUES (?)");
            $stmt->bind_param('s', $this->descricao);
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
                "UPDATE especialidade SET descricao = ? WHERE id_especialidade = ?"
            );
            $stmt->bind_param('si', $this->descricao, $this->id_especialidade);
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
            $stmt = $conexao->prepare("DELETE FROM especialidade WHERE id_especialidade = ?");
            $stmt->bind_param('i', $this->id_especialidade);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
