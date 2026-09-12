<?php
use agendamento\consulta\Consulta;

require_once('../../lib/config.php');

// Verifica permissão — bloqueia se não tiver sessão válida
if (empty($_SESSION['perfil'])) {
    http_response_code(403); echo 'Acesso negado'; exit;
}

$perfil  = $_SESSION['perfil'];
$idUser  = $_SESSION['id_user'];
$action  = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'pesquisar');

$obj = new Consulta();
$obj->setId_consulta(        isset($_REQUEST['id_consulta'])         ? (int)$_REQUEST['id_consulta']         : 0);
$obj->setId_medico(          isset($_REQUEST['id_medico'])           ? (int)$_REQUEST['id_medico']           : 0);
$obj->setId_usuario(         isset($_REQUEST['id_usuario'])          ? (int)$_REQUEST['id_usuario']          : 0);
$obj->setDt_consulta(        isset($_REQUEST['dt_consulta'])         ? $_REQUEST['dt_consulta']              : '');
$obj->setMotivo(             isset($_REQUEST['motivo'])              ? $_REQUEST['motivo']                   : '');
$obj->setMotivo_cancelamento(isset($_REQUEST['motivo_cancelamento']) ? $_REQUEST['motivo_cancelamento']      : '');

switch ($action) {

    /* ─── Listar ─── */
    case 'pesquisar':
        if ($perfil === 'medic') {
            $arrConsultas = $obj->listar($idUser, null);
        } elseif ($perfil === 'user') {
            $arrConsultas = $obj->listar(null, $idUser);
        } else {
            $arrConsultas = $obj->listar();
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaJs.php');
        break;

    /* ─── Formulário novo (paciente e adm) ─── */
    case 'novo':
        if ($perfil === 'medic') { echo 'Acesso negado'; break; }
        // Lista médicos para o select
        $arrMedicos = mysqli_query($conexao,
            "SELECT m.id_medico, m.nome, e.descricao AS especialidade
             FROM medico m LEFT JOIN especialidade e ON e.id_especialidade = m.id_especialidade
             ORDER BY m.nome"
        )->fetch_all(MYSQLI_ASSOC);

        // Paciente fixado para perfil user
        if ($perfil === 'user') {
            $rowUser = mysqli_query($conexao,
                "SELECT id_usuario, nome FROM usuario WHERE id_usuario = $idUser"
            )->fetch_assoc();
        } else {
            $arrUsuarios = mysqli_query($conexao, "SELECT id_usuario, nome FROM usuario ORDER BY nome")->fetch_all(MYSQLI_ASSOC);
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaJs.php');
        break;

    /* ─── Inserir ─── */
    case 'inserir':
        if ($perfil === 'medic') { echo 'Acesso negado'; break; }
        // Paciente = quem está logado (se for user)
        if ($perfil === 'user') $obj->setId_usuario($idUser);

        $arrMsgErro = $obj->validar();
        if (count($arrMsgErro) === 0) {
            if ($obj->inserir()) {
                $arrMsgSucesso[] = 'Consulta agendada com sucesso!';
            } else {
                $arrMsgErro[] = 'Erro ao agendar consulta';
            }
        }
        if (count($arrMsgErro) === 0) {
            if ($perfil === 'user')  $arrConsultas = $obj->listar(null, $idUser);
            else                     $arrConsultas = $obj->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaRead.php');
        } else {
            $arrMedicos = mysqli_query($conexao,
                "SELECT m.id_medico, m.nome, e.descricao AS especialidade
                 FROM medico m LEFT JOIN especialidade e ON e.id_especialidade = m.id_especialidade
                 ORDER BY m.nome"
            )->fetch_all(MYSQLI_ASSOC);
            if ($perfil === 'user') {
                $rowUser = mysqli_query($conexao, "SELECT id_usuario, nome FROM usuario WHERE id_usuario = $idUser")->fetch_assoc();
            } else {
                $arrUsuarios = mysqli_query($conexao, "SELECT id_usuario, nome FROM usuario ORDER BY nome")->fetch_all(MYSQLI_ASSOC);
            }
            require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaCreate.php');
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaJs.php');
        break;

    /* ─── Cancelar (médico = cancelada_medico, paciente = cancelada_paciente) ─── */
    case 'cancelar':
        if ($perfil === 'user' && !$obj->getMotivo_cancelamento()) {
            $arrMsgErro[] = 'Informe o motivo do cancelamento';
            if ($perfil === 'user') $arrConsultas = $obj->listar(null, $idUser);
            else $arrConsultas = $obj->listar($idUser, null);
            require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaRead.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaJs.php');
            break;
        }
        $novoStatus = ($perfil === 'medic') ? 'cancelada_medico' : 'cancelada_paciente';
        if ($obj->cancelar($novoStatus)) {
            $arrMsgSucesso[] = 'Consulta cancelada';
        } else {
            $arrMsgErro[] = 'Erro ao cancelar';
        }
        if ($perfil === 'medic')     $arrConsultas = $obj->listar($idUser, null);
        elseif ($perfil === 'user')  $arrConsultas = $obj->listar(null, $idUser);
        else                         $arrConsultas = $obj->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaJs.php');
        break;

    /* ─── Marcar como realizada (adm e médico) ─── */
    case 'realizada':
        if ($perfil === 'user') { echo 'Acesso negado'; break; }
        if ($obj->marcarRealizada()) $arrMsgSucesso[] = 'Consulta marcada como realizada';
        else $arrMsgErro[] = 'Erro ao atualizar';
        $arrConsultas = ($perfil === 'medic') ? $obj->listar($idUser, null) : $obj->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaJs.php');
        break;

    /* ─── Excluir (apenas adm) ─── */
    case 'excluir':
        if ($perfil !== 'adm') { echo 'Acesso negado'; break; }
        if ($obj->excluir()) $arrMsgSucesso[] = 'Consulta excluída';
        else $arrMsgErro[] = 'Erro ao excluir';
        $arrConsultas = $obj->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/consulta/consultaJs.php');
        break;

    default:
        echo 'Action inválida';
}
