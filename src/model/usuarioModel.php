<?php

namespace agendamento\usuario;

/**
 * [Description Usuario]
 */
class Usuario
{
    private $id_usuario;
    private $nome;
    private $cpf;
    private $email;
    private $telefone;
    private $senha;
    //private $id_especialidade;

    /**
     * Get the value of id_usuario
     */ 
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */ 
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

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
     * Get the value of cpf
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set the value of cpf
     */
    public function setCpf($cpf): self
    {
        $this->cpf = $cpf;

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

    /**
     * Get the value of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }
    public function inserir()
    {
        global $conexao;
        try {
            $sql = "INSERT INTO usuario (
                nome,
                cpf,
                email,
                telefone,
                senha
            )   
            VALUES (
                '{$this->nome}',
                '{$this->cpf}',
                '{$this->email}',
                '{$this->telefone}',
                '{$this->senha}'
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
            $sql = "UPDATE usuario 
                    SET 
                        cpf = '{$this->cpf}',
                        email = '{$this->email}',
                        telefone = '{$this->telefone}'
                    WHERE id_usuario = " . $this->id_usuario;
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
            $sql = "DELETE FROM usuario 
                    WHERE id_usuario = " . $this->id_usuario;
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
            $sql = "select * from usuario where true";
            if ($this->id_usuario) {
                $sql .= ' and id_usuario = ' . $this->id_usuario;
            }

            $recordset = mysqli_query($conexao, $sql);
            return mysqli_fetch_all($recordset);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    function validar()
    {
        $arrMsg = [];
        if ($this->nome == '') {
            $arrMsg[] = 'Informe o nome';
        }
        if ($this->cpf == '') {
            $arrMsg[] = 'Informe o cpf';
        }

        return $arrMsg;
    }

}