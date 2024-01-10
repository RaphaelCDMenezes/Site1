<?php
// echo "carregar o config <br />";

use agendamento\especialidade\Especialidade;
use agendamento\medico\Medico;

require_once('../../lib/config.php');

//echo "instanciar objeto medico <br />";
$objMedico = new Medico();
$objEspecialidade = new Especialidade();

//echo "capturar os campos do formulário <br />";
$objMedico->setId_medico($_REQUEST['id_medico']);
$objMedico->setNome($_REQUEST['nome']);
$objMedico->setCrm($_REQUEST['crm']);
$objMedico->setEmail($_REQUEST['email']);
$objMedico->setTelefone($_REQUEST['telefone']);
$objMedico->setSenha($_REQUEST['senha']);
$objMedico->setId_especialidade($_REQUEST['id_especialidade']);
$objMedico->setDt_nascimento($_REQUEST['dt_nascimento']);
$objMedico->setId_empresa($_REQUEST['id_empresa']);

//echo "capturar a ACTION da view <br />";
$action = $_REQUEST['action'];
$action = $_POST['action'] ? $_POST['action'] : $_GET['action'];

switch ($action) {
    case 'inserir':
        $arrMsgErro = $objMedico->validar();
        if (count($arrMsgErro) == 0) {
            if ($objMedico->inserir() === true) {
                $arrMsgSucesso[] = 'Inserido com sucesso';
                $objMedico = new Medico();
                $arrMedicos = $objMedico->listar();
            } else {
                $arrMsgErro[] = 'Erro ao inserir';
                $arrEspecialidade = $objEspecialidade->listar();
            }
            require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoRead.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        } else {
            $arrEspecialidade = $objEspecialidade->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoCreate.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        }

        break;
    case 'alterar':
        $arrMsgErro = $objMedico->validar();
        if (count($arrMsgErro) == 0) {
            if ($objMedico->alterar() === true) {
                $arrMsgSucesso[] = 'Alterado com sucesso';
                $objMedico = new Medico();
                $arrMedicos = $objMedico->listar();
            } else {
                $arrMsgErro[] = 'Erro ao alterar';
            }
            $arrEspecialidade = $objEspecialidade->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoRead.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        } else {
            $arrEspecialidade = $objEspecialidade->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoCreate.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        }
        break;
    case 'excluir':
        if ($objMedico->excluir() === true) {
            $arrMsgSucesso[] = 'Excluído com sucesso';
            $objMedico = new Medico();
            $arrMedicos = $objMedico->listar();
        } else {
            $arrMsgErro[] = 'Erro ao excluir';
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        break;
    case 'pesquisar':
        $arrMedicos = $objMedico->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        break;
    case 'novo':
        $arrEspecialidade = $objEspecialidade->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        break;
    case 'editar':
        $arrMedicos = $objMedico->listar()[0];
        $objMedico->setId_medico($arrMedicos[0]);
        $objMedico->setNome($arrMedicos[1]);
        $objMedico->setCrm($arrMedicos[2]);
        $objMedico->setEmail($arrMedicos[3]);
        $objMedico->setTelefone($arrMedicos[4]);
        $objMedico->setSenha($arrMedicos[5]);
        $objMedico->setId_especialidade($arrMedicos[7]);
        $objMedico->setDt_nascimento($arrMedicos[8]);
        $objMedico->setId_empresa($arrMedicos[9]);
        $arrEspecialidade = $objEspecialidade->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/medico/medicoJs.php');
        break;
    default:
        echo 'Erro: Action "' . $action . '" não existe';
        break;
}
