<?php

namespace agendamento\medico;

/**
 * [Description Medico]
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
    //private $id_especialidade;

    function __construct()
    {
    }

    /**
     * Get the value of id_medico
     */
    public function getId_medico()
    {
        return $this->id_medico;
    }

    /**
     * Set the value of id_medico
     *
     * @return  self
     */
    public function setId_medico($id_medico)
    {
        $this->id_medico = $id_medico;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of crm
     */
    public function getCrm()
    {
        return $this->crm;
    }

    /**
     * Set the value of crm
     *
     * @return  self
     */
    public function setCrm($crm)
    {
        $this->crm = $crm;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telefone
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function inserir()
    {
        global $conexao;
        try {
            $sql = "INSERT INTO medico (
                nome,
                crm,
                email,
                telefone,
                senha,
                id_especialidade,
                dt_nascimento,
                id_empresa
            )   
            VALUES (
                '{$this->nome}',
                '{$this->crm}',
                '{$this->email}',
                '{$this->telefone}',
                '{$this->senha}',
                {$this->id_especialidade},
                {$this->dt_nascimento},
                {$this->id_empresa}
            )";
            mysqli_query($conexao, $sql);
            return true;
        } catch (\Throwable $th) {
        }
    }
    public function alterar()
    {
        global $conexao;
        try {
            $sql = "UPDATE medico 
                    SET 
                        crm = '{$this->crm}',
                        email = '{$this->email}',
                        telefone = '{$this->telefone}',
                        id_especialidade = {$this->id_especialidade}
                        dt_nascimento = {$this->dt_nascimento}
                        id_empresa = {$this->id_empresa}
                    WHERE id_medico = " . $this->id_medico;
            mysqli_query($conexao, $sql);
            return true;
        } catch (\Throwable $th) {
            print_pre($th);
        }
    }
    public function excluir()
    {
        global $conexao;
        try {
            $sql = "DELETE FROM medico 
                    WHERE id_medico = " . $this->id_medico;
            mysqli_query($conexao, $sql);
            return true;
        } catch (\Throwable $th) {
            print_pre($th);
        }
    }
    public function listar()
    {
        global $conexao;
        try {
            $sql = "select * from medico where true";
            if ($this->id_medico) {
                $sql .= ' and id_medico = ' . $this->id_medico;
            }

            $recordset = mysqli_query($conexao, $sql);
            return mysqli_fetch_all($recordset);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

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

    function validar()
    {
        $arrMsg = [];
        if ($this->nome == '') {
            $arrMsg[] = 'Informe o nome';
        }
        if ($this->crm == '') {
            $arrMsg[] = 'Informe o crm';
        }
        if ($this->id_especialidade == '') {
            $arrMsg[] = 'Informe a especialidade';
        }

        return $arrMsg;
    }

    /**
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     */
    public function setSenha($senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of dt_nascimento
     */ 
    public function getDt_nascimento()
    {
        return $this->dt_nascimento;
    }

    /**
     * Set the value of dt_nascimento
     *
     * @return  self
     */ 
    public function setDt_nascimento($dt_nascimento)
    {
        $this->dt_nascimento = $dt_nascimento;

        return $this;
    }

    /**
     * Get the value of id_empresa
     */ 
    public function getId_empresa()
    {
        return $this->id_empresa;
    }

    /**
     * Set the value of id_empresa
     *
     * @return  self
     */ 
    public function setId_empresa($id_empresa)
    {
        $this->id_empresa = $id_empresa;

        return $this;
    }
}
