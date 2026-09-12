<?php

use agendamento\especialidade\Especialidade;
use agendamento\medico\Medico;

require_once('../../lib/config.php');

$objMedico       = new Medico();
$objEspecialidade = new Especialidade();

$objMedico->setId_medico(        isset($_REQUEST['id_medico'])        ? $_REQUEST['id_medico']        : '');
$objMedico->setNome(             isset($_REQUEST['nome'])             ? $_REQUEST['nome']             : '');
$objMedico->setCrm(              isset($_REQUEST['crm'])              ? $_REQUEST['crm']              : '');
$objMedico->setEmail(            isset($_REQUEST['email'])            ? $_REQUEST['email']            : '');
$objMedico->setTelefone(         isset($_REQUEST['telefone'])         ? $_REQUEST['telefone']         : '');
$objMedico->setSenha(            isset($_REQUEST['senha'])            ? $_REQUEST['senha']            : '');
$objMedico->setId_especialidade( isset($_REQUEST['id_especialidade']) ? $_REQUEST['id_especialidade'] : '');
$objMedico->setDt_nascimento(    isset($_REQUEST['dt_nascimento'])    ? $_REQUEST['dt_nascimento']    : '');
$objMedico->setId_empresa(       isset($_REQUEST['id_empresa'])       ? $_REQUEST['id_empresa']       : '');

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

switch ($action) {
    case 'inserir':
        $arrMsgErro = $objMedico->validar();
        if (count($arrMsgErro) == 0) {
            if ($objMedico->inserir() === true) {
                $arrMsgSucesso[] = 'Inserido com sucesso';
                $objMedico  = new Medico();
                $arrMedicos = $objMedico->listar();
                require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoRead.php');
            } else {
                $arrMsgErro[]     = 'Erro ao inserir';
                $arrEspecialidade = $objEspecialidade->listar();
                require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoCreate.php');
            }
        } else {
            $arrEspecialidade = $objEspecialidade->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoCreate.php');
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        break;

    case 'alterar':
        $arrMsgErro = $objMedico->validar();
        if (count($arrMsgErro) == 0) {
            if ($objMedico->alterar() === true) {
                $arrMsgSucesso[] = 'Alterado com sucesso';
                $objMedico  = new Medico();
                $arrMedicos = $objMedico->listar();
                require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoRead.php');
            } else {
                $arrMsgErro[]     = 'Erro ao alterar';
                $arrEspecialidade = $objEspecialidade->listar();
                require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoCreate.php');
            }
        } else {
            $arrEspecialidade = $objEspecialidade->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoCreate.php');
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        break;

    case 'excluir':
        if ($objMedico->excluir() === true) {
            $arrMsgSucesso[] = 'Excluído com sucesso';
        } else {
            $arrMsgErro[] = 'Erro ao excluir';
        }
        $objMedico  = new Medico();
        $arrMedicos = $objMedico->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        break;

    case 'pesquisar':
        $arrMedicos = $objMedico->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        break;

    case 'novo':
        $objMedico        = new Medico();
        $arrEspecialidade = $objEspecialidade->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        break;

    case 'editar':
        $dados = $objMedico->listar();
        if (!empty($dados)) {
            $arr = $dados[0];
            $objMedico->setId_medico(        $arr['id_medico']);
            $objMedico->setNome(             $arr['nome']);
            $objMedico->setCrm(              $arr['crm']);
            $objMedico->setEmail(            $arr['email']);
            $objMedico->setTelefone(         $arr['telefone']);
            $objMedico->setSenha(            $arr['senha']);
            $objMedico->setId_especialidade( $arr['id_especialidade']);
            $objMedico->setDt_nascimento(    $arr['dt_nascimento']);
            $objMedico->setId_empresa(       $arr['id_empresa']);
        }
        $arrEspecialidade = $objEspecialidade->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        break;

    default:
        echo 'Erro: Action "' . htmlspecialchars($action) . '" não existe';
        break;
}
