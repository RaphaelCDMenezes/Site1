<?php
$ignoraSessao = true;

use agendamento\register\register;

require_once('../../lib/config.php');

include_once('database.php');

$objregister = new register();

$objregister->setId_usuario(isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : '');
$objregister->setNome(isset($_REQUEST['nome'])         ? $_REQUEST['nome']         : '');
$objregister->setCpf(isset($_REQUEST['cpf'])           ? $_REQUEST['cpf']          : '');
$objregister->setEmail(isset($_REQUEST['email'])       ? $_REQUEST['email']        : '');
$objregister->setTelefone(isset($_REQUEST['telefone']) ? $_REQUEST['telefone']     : '');
$objregister->setSenha(isset($_REQUEST['senha'])       ? $_REQUEST['senha']        : '');

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

switch ($action) {
    case 'register':
        $arrMsgErro = $objregister->validar();
        if (count($arrMsgErro) == 0) {
            if ($objregister->inserir() === true) {
                // Registro bem-sucedido: redireciona para o login
                header('Location: ' . __AGENDAMENTO_HTTP__ . 'src/view/login/login.php');
                exit;
            } else {
                $arrMsgErro[] = 'Erro ao criar conta. Tente novamente.';
            }
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/register/register.php');
        break;

    default:
        echo 'Erro: Action "' . htmlspecialchars($action) . '" não existe';
        break;
}
