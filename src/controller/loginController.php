<?php
$ignoraSessao = true;
require_once('../../lib/config.php');

include_once('database.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$email  = isset($_POST['email'])  ? trim($_POST['email'])  : '';
$senha  = isset($_POST['senha'])  ? $_POST['senha']        : '';

switch ($action) {
    case 'login':
        $arrMsgErro = [];
        if ($email === '') {
            $arrMsgErro[] = 'Informe o usuário';
        }
        if ($senha === '') {
            $arrMsgErro[] = 'Informe a senha';
        }

        if (count($arrMsgErro) > 0) {
            require_once(__AGENDAMENTO_DIR__ . 'src/view/login/login.php');
            break;
        }

        // Verifica médico via prepared statement
        $stmtMedico = $conexao->prepare("SELECT id_medico, email, senha FROM medico WHERE email = ?");
        $stmtMedico->bind_param('s', $email);
        $stmtMedico->execute();
        $resMedico = $stmtMedico->get_result();

        // Verifica usuário/paciente via prepared statement
        $stmtUsuario = $conexao->prepare("SELECT id_usuario, email, senha FROM usuario WHERE email = ?");
        $stmtUsuario->bind_param('s', $email);
        $stmtUsuario->execute();
        $resUsuario = $stmtUsuario->get_result();

        if ($resMedico->num_rows === 1) {
            $rowMedico = $resMedico->fetch_assoc();
            if (password_verify($senha, $rowMedico['senha'])) {
                session_regenerate_id(true);
                $_SESSION['email']  = $email;
                $_SESSION['perfil'] = 'medic';
                header('Location: ' . __AGENDAMENTO_HTTP__ . 'src/view/painel');
                exit;
            } else {
                $arrMsgErro[] = 'Login inválido';
            }
        } elseif ($resUsuario->num_rows === 1) {
            $rowUsuario = $resUsuario->fetch_assoc();
            if (password_verify($senha, $rowUsuario['senha'])) {
                session_regenerate_id(true);
                $_SESSION['email']  = $email;
                $_SESSION['perfil'] = 'user';
                header('Location: ' . __AGENDAMENTO_HTTP__ . 'src/view/painel');
                exit;
            } else {
                $arrMsgErro[] = 'Login inválido';
            }
        } else {
            $arrMsgErro[] = 'Login inválido';
        }

        require_once(__AGENDAMENTO_DIR__ . 'src/view/login/login.php');
        break;

    case 'logout':
        sessaoLogout();
        break;

    default:
        break;
}
