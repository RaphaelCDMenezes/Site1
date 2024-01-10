<?php
// echo "carregar o config <br />";

use agendamento\especialidade\Especialidade;

require_once('../../lib/config.php');

//echo "instanciar objeto especialidade <br />";
$objEspecialidade = new Especialidade();

//echo "capturar os campos do formulário <br />";
$objEspecialidade->setId_especialidade($_REQUEST['id_especialidade']);
$objEspecialidade->setDescricao($_REQUEST['descricao']);


//echo "capturar a ACTION da view <br />";
$action = $_REQUEST['action'];
$action = $_POST['action'] ? $_POST['action'] : $_GET['action'];

switch ($action) {
    case 'inserir':
        $arrMsgErro = $objEspecialidade->validar();
        if (count($arrMsgErro) == 0) {
            if ($objEspecialidade->inserir() === true) {
                $arrMsgSucesso[] = 'Inserido com sucesso';
                $objEspecialidade = new especialidade();
                $arrEspecialidades = $objEspecialidade->listar();
            } else {
                $arrMsgErro[] = 'Erro ao inserir';
                $arrEspecialidade = $objEspecialidade->listar();
            }
            require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeRead.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        } else {
            $arrEspecialidade = $objEspecialidade->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeCreate.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        }

        break;
    case 'alterar':
        $arrMsgErro = $objEspecialidade->validar();
        if (count($arrMsgErro) == 0) {
            if ($objEspecialidade->alterar() === true) {
                $arrMsgSucesso[] = 'Alterado com sucesso';
                $objEspecialidade = new especialidade();
                $arrEspecialidades = $objEspecialidade->listar();
            } else {
                $arrMsgErro[] = 'Erro ao alterar';
            }
            $arrEspecialidade = $objEspecialidade->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeRead.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        } else {
            $arrEspecialidade = $objEspecialidade->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeCreate.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        }
        break;
    case 'excluir':
        if ($objEspecialidade->excluir() === true) {
            $arrMsgSucesso[] = 'Excluído com sucesso';
            $objEspecialidade = new especialidade();
            $arrEspecialidades = $objEspecialidade->listar();
        } else {
            $arrMsgErro[] = 'Erro ao excluir';
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        break;
    case 'pesquisar':
        $arrEspecialidades = $objEspecialidade->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        break;
    case 'novo':
        $arrEspecialidade = $objEspecialidade->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        break;
    case 'editar':
        $arrEspecialidades = $objEspecialidade->listar()[0];
        $objEspecialidade->setId_especialidade($arrEspecialidades[0]);
        $objEspecialidade ->setDescricao($arrEspecialidades[1]);
        $arrEspecialidade = $objEspecialidade->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        break;
    default:
        echo 'Erro: Action "' . $action . '" não existe';
        break;
}
