<?php

use agendamento\especialidade\Especialidade;

require_once('../../lib/config.php');

$objEspecialidade = new Especialidade();

$objEspecialidade->setId_especialidade(isset($_REQUEST['id_especialidade']) ? $_REQUEST['id_especialidade'] : '');
$objEspecialidade->setDescricao(isset($_REQUEST['descricao']) ? $_REQUEST['descricao'] : '');

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

switch ($action) {
    case 'inserir':
        $arrMsgErro = $objEspecialidade->validar();
        if (count($arrMsgErro) == 0) {
            if ($objEspecialidade->inserir() === true) {
                $arrMsgSucesso[] = 'Inserido com sucesso';
                $objEspecialidade  = new Especialidade();
                $arrEspecialidades = $objEspecialidade->listar();
                require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeRead.php');
            } else {
                $arrMsgErro[]     = 'Erro ao inserir';
                $arrEspecialidade = $objEspecialidade->listar();
                require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeCreate.php');
            }
        } else {
            $arrEspecialidade = $objEspecialidade->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeCreate.php');
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        break;

    case 'alterar':
        $arrMsgErro = $objEspecialidade->validar();
        if (count($arrMsgErro) == 0) {
            if ($objEspecialidade->alterar() === true) {
                $arrMsgSucesso[]   = 'Alterado com sucesso';
                $objEspecialidade  = new Especialidade();
                $arrEspecialidades = $objEspecialidade->listar();
                require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeRead.php');
            } else {
                $arrMsgErro[]     = 'Erro ao alterar';
                $arrEspecialidade = $objEspecialidade->listar();
                require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeCreate.php');
            }
        } else {
            $arrEspecialidade = $objEspecialidade->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeCreate.php');
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        break;

    case 'excluir':
        if ($objEspecialidade->excluir() === true) {
            $arrMsgSucesso[]   = 'Excluído com sucesso';
        } else {
            $arrMsgErro[]      = 'Erro ao excluir';
        }
        $objEspecialidade  = new Especialidade();
        $arrEspecialidades = $objEspecialidade->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        break;

    case 'pesquisar':
        $arrEspecialidades = $objEspecialidade->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        break;

    case 'novo':
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        break;

    case 'editar':
        $dados = $objEspecialidade->listar();
        if (!empty($dados)) {
            $row = $dados[0];
            $objEspecialidade->setId_especialidade($row['id_especialidade']);
            $objEspecialidade->setDescricao($row['descricao']);
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/especialidade/especialidadeJs.php');
        break;

    default:
        echo 'Erro: Action "' . htmlspecialchars($action) . '" não existe';
        break;
}
