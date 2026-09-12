<?php

use agendamento\usuario\Usuario;

require_once('../../lib/config.php');

$objUsuario = new Usuario();

$objUsuario->setId_usuario(isset($_REQUEST['id_usuario']) ? $_REQUEST['id_usuario'] : '');
$objUsuario->setNome(isset($_REQUEST['nome'])             ? $_REQUEST['nome']         : '');
$objUsuario->setCpf(isset($_REQUEST['cpf'])               ? $_REQUEST['cpf']          : '');
$objUsuario->setEmail(isset($_REQUEST['email'])           ? $_REQUEST['email']        : '');
$objUsuario->setTelefone(isset($_REQUEST['telefone'])     ? $_REQUEST['telefone']     : '');
$objUsuario->setSenha(isset($_REQUEST['senha'])           ? $_REQUEST['senha']        : '');

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

switch ($action) {
    case 'inserir':
        $arrMsgErro = $objUsuario->validar();
        if (count($arrMsgErro) == 0) {
            if ($objUsuario->inserir() === true) {
                $arrMsgSucesso[] = 'Inserido com sucesso';
                $objUsuario  = new Usuario();
                $arrUsuario  = $objUsuario->listar();
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioRead.php');
            } else {
                $arrMsgErro[] = 'Erro ao inserir';
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioCreate.php');
            }
        } else {
            require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioCreate.php');
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
        break;

    case 'alterar':
        $arrMsgErro = $objUsuario->validar();
        if (count($arrMsgErro) == 0) {
            if ($objUsuario->alterar() === true) {
                $arrMsgSucesso[] = 'Alterado com sucesso';
                $objUsuario  = new Usuario();
                $arrUsuario  = $objUsuario->listar();
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioRead.php');
            } else {
                $arrMsgErro[] = 'Erro ao alterar';
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioCreate.php');
            }
        } else {
            require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioCreate.php');
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
        break;

    case 'excluir':
        if ($objUsuario->excluir() === true) {
            $arrMsgSucesso[] = 'Excluído com sucesso';
        } else {
            $arrMsgErro[] = 'Erro ao excluir';
        }
        $objUsuario = new Usuario();
        $arrUsuario = $objUsuario->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
        break;

    case 'pesquisar':
        $arrUsuario = $objUsuario->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
        break;

    case 'novo':
        $objUsuario = new Usuario();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
        break;

    case 'editar':
        $dados = $objUsuario->listar();
        if (!empty($dados)) {
            $arr = $dados[0];
            $objUsuario->setId_usuario($arr['id_usuario']);
            $objUsuario->setNome(      $arr['nome']);
            $objUsuario->setCpf(       $arr['cpf']);
            $objUsuario->setEmail(     $arr['email']);
            $objUsuario->setTelefone(  $arr['telefone']);
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
        break;

    default:
        echo 'Erro: Action "' . htmlspecialchars($action) . '" não existe';
        break;
}
