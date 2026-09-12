<?php
$ignoraSessao = true;
require_once('../../lib/config.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$perfil = isset($_POST['perfil'])    ? $_POST['perfil']    : '';
$email  = isset($_POST['email'])     ? trim($_POST['email']) : '';
$senha  = isset($_POST['senha'])     ? $_POST['senha']       : '';

switch ($action) {

    /* ── Exibe formulário de login filtrado por perfil ── */
    case 'form':
        $arrMsgErro = [];
        require_once(__AGENDAMENTO_DIR__ . 'src/view/login/loginForm.php');
        break;

    /* ── Processa autenticação ── */
    case 'login':
        $arrMsgErro = [];

        if ($email === '') $arrMsgErro[] = 'Informe o e-mail';
        if ($senha === '') $arrMsgErro[] = 'Informe a senha';

        if (count($arrMsgErro) > 0) {
            require_once(__AGENDAMENTO_DIR__ . 'src/view/login/loginForm.php');
            break;
        }

        $logado = false;

        if ($perfil === 'adm') {
            $stmt = $conexao->prepare("SELECT id_adm, email, senha FROM adm WHERE email = ? AND ativo = 1");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            if ($row && password_verify($senha, $row['senha'])) {
                session_regenerate_id(true);
                $_SESSION['email']   = $email;
                $_SESSION['perfil']  = 'adm';
                $_SESSION['id_user'] = $row['id_adm'];
                $logado = true;
            }

        } elseif ($perfil === 'medic') {
            $stmt = $conexao->prepare("SELECT id_medico, email, senha FROM medico WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            if ($row && password_verify($senha, $row['senha'])) {
                session_regenerate_id(true);
                $_SESSION['email']   = $email;
                $_SESSION['perfil']  = 'medic';
                $_SESSION['id_user'] = $row['id_medico'];
                $logado = true;
            }

        } elseif ($perfil === 'user') {
            $stmt = $conexao->prepare("SELECT id_usuario, email, senha FROM usuario WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            if ($row && password_verify($senha, $row['senha'])) {
                session_regenerate_id(true);
                $_SESSION['email']   = $email;
                $_SESSION['perfil']  = 'user';
                $_SESSION['id_user'] = $row['id_usuario'];
                $logado = true;
            }
        } else {
            $arrMsgErro[] = 'Perfil inválido';
        }

        if ($logado) {
            header('Location: ' . __AGENDAMENTO_HTTP__ . 'src/view/painel/');
            exit;
        }

        $arrMsgErro[] = 'E-mail ou senha incorretos';
        require_once(__AGENDAMENTO_DIR__ . 'src/view/login/loginForm.php');
        break;

    /* ── Logout ── */
    case 'logout':
        sessaoLogout();
        break;

    /* ── Tela inicial: seleção de perfil ── */
    default:
        require_once(__AGENDAMENTO_DIR__ . 'src/view/login/login.php');
        break;
}
