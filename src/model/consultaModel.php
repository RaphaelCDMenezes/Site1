<?php
namespace agendamento\consulta;

class Consulta
{
    private $id_consulta;
    private $id_medico;
    private $id_usuario;
    private $dt_consulta;
    private $motivo;
    private $status;
    private $motivo_cancelamento;

    public function getId_consulta()          { return $this->id_consulta; }
    public function getId_medico()            { return $this->id_medico; }
    public function getId_usuario()           { return $this->id_usuario; }
    public function getDt_consulta()          { return $this->dt_consulta; }
    public function getMotivo()               { return $this->motivo; }
    public function getStatus()               { return $this->status; }
    public function getMotivo_cancelamento()  { return $this->motivo_cancelamento; }

    public function setId_consulta($v)         { $this->id_consulta = $v;         return $this; }
    public function setId_medico($v)           { $this->id_medico = $v;           return $this; }
    public function setId_usuario($v)          { $this->id_usuario = $v;          return $this; }
    public function setDt_consulta($v)         { $this->dt_consulta = $v;         return $this; }
    public function setMotivo($v)              { $this->motivo = $v;              return $this; }
    public function setStatus($v)              { $this->status = $v;              return $this; }
    public function setMotivo_cancelamento($v) { $this->motivo_cancelamento = $v; return $this; }

    /** Lista consultas com dados de médico e paciente */
    public function listar($filtroMedico = null, $filtroUsuario = null)
    {
        global $conexao;
        try {
            $where = 'WHERE 1=1';
            $params = [];
            $types  = '';

            if ($this->id_consulta) {
                $where .= ' AND c.id_consulta = ?';
                $params[] = $this->id_consulta;
                $types   .= 'i';
            }
            if ($filtroMedico) {
                $where .= ' AND c.id_medico = ?';
                $params[] = $filtroMedico;
                $types   .= 'i';
            }
            if ($filtroUsuario) {
                $where .= ' AND c.id_usuario = ?';
                $params[] = $filtroUsuario;
                $types   .= 'i';
            }

            $sql = "SELECT c.*, m.nome AS nome_medico, m.crm,
                           u.nome AS nome_paciente, u.cpf,
                           e.descricao AS especialidade
                    FROM consulta c
                    JOIN medico m  ON m.id_medico  = c.id_medico
                    JOIN usuario u ON u.id_usuario = c.id_usuario
                    LEFT JOIN especialidade e ON e.id_especialidade = m.id_especialidade
                    $where
                    ORDER BY c.dt_consulta DESC";

            if ($params) {
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param($types, ...$params);
                $stmt->execute();
                return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            }
            return mysqli_query($conexao, $sql)->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) { return []; }
    }

    public function inserir()
    {
        global $conexao;
        try {
            $stmt = $conexao->prepare(
                "INSERT INTO consulta (id_medico, id_usuario, dt_consulta, motivo, status)
                 VALUES (?, ?, ?, ?, 'agendada')"
            );
            $stmt->bind_param('iiss', $this->id_medico, $this->id_usuario, $this->dt_consulta, $this->motivo);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) { return false; }
    }

    public function cancelar($novoStatus)
    {
        global $conexao;
        try {
            $stmt = $conexao->prepare(
                "UPDATE consulta SET status = ?, motivo_cancelamento = ? WHERE id_consulta = ?"
            );
            $stmt->bind_param('ssi', $novoStatus, $this->motivo_cancelamento, $this->id_consulta);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) { return false; }
    }

    public function marcarRealizada()
    {
        global $conexao;
        try {
            $stmt = $conexao->prepare("UPDATE consulta SET status = 'realizada' WHERE id_consulta = ?");
            $stmt->bind_param('i', $this->id_consulta);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) { return false; }
    }

    public function excluir()
    {
        global $conexao;
        try {
            $stmt = $conexao->prepare("DELETE FROM consulta WHERE id_consulta = ?");
            $stmt->bind_param('i', $this->id_consulta);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) { return false; }
    }

    public function validar()
    {
        $erros = [];
        if (!$this->id_medico)   $erros[] = 'Selecione um médico';
        if (!$this->id_usuario)  $erros[] = 'Paciente inválido';
        if (!$this->dt_consulta) $erros[] = 'Informe a data e hora';
        return $erros;
    }
}
