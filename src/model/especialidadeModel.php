<?php
namespace agendamento\especialidade;
/**
 * [Description Especialidade]
 */
class Especialidade {
    private $id_especialidade;
    private $descricao;


    /**
     * Get the value of id_especialidade
     */ 
    public function getId_especialidade()
    {
        return $this->id_especialidade;
    }

    /**
     * Set the value of id_especialidade
     *
     * @return  self
     */ 
    public function setId_especialidade($id_especialidade)
    {
        $this->id_especialidade = $id_especialidade;

        return $this;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @return  self
     */ 
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function listar()
    {
        global $conexao;
        try {
            $sql = "select * from especialidade where true";
            if ($this->id_especialidade) {
                $sql .= ' and id_especialidade = ' . $this->id_especialidade;
            }

            $recordset = mysqli_query($conexao, $sql);
            while($row = $recordset->fetch_assoc()) {
                $dados[] = $row;
            }

            return $dados;
        } catch (\Throwable $th) {
            //throw $th;
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
    public function alterar()
    {
        global $conexao;
        try {
            $sql = "UPDATE especialidade 
                    SET 
                        id_especialidade = {$this->id_especialidade}
                    WHERE id_especialidade = " . $this->id_especialidade;
            mysqli_query($conexao, $sql);
            return true;
        } catch (\Throwable $th) {
            print_pre($th);
        }
    }
    public function inserir()
    {
        global $conexao;
        try {
            $sql = "INSERT INTO especialidade (
                descricao
            )   
            VALUES (
                '{$this->descricao}'
            )";
            mysqli_query($conexao, $sql);
            return true;
        } catch (\Throwable $th) {
        }
    }
    public function excluir()
    {
        global $conexao;
        try {
            $sql = "DELETE FROM especialidade 
                    WHERE id_especialidade = " . $this->id_especialidade;
            mysqli_query($conexao, $sql);
            return true;
        } catch (\Throwable $th) {
            print_pre($th);
        }
    }
}