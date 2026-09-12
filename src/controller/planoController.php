<?php
use agendamento\plano\Plano;

require_once('../../lib/config.php');

if (empty($_SESSION['perfil'])) { http_response_code(403); echo 'Acesso negado'; exit; }

$perfil = $_SESSION['perfil'];
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'pesquisar');

$obj = new Plano();
$obj->setId_plano(  isset($_REQUEST['id_plano'])  ? (int)$_REQUEST['id_plano'] : 0);
$obj->setNome(      isset($_REQUEST['nome'])       ? $_REQUEST['nome']          : '');
$obj->setDescricao( isset($_REQUEST['descricao'])  ? $_REQUEST['descricao']     : '');
$obj->setPreco(     isset($_REQUEST['preco'])      ? (float)$_REQUEST['preco']  : 0);
$obj->setBeneficios(isset($_REQUEST['beneficios']) ? $_REQUEST['beneficios']    : '');
$obj->setAtivo(     isset($_REQUEST['ativo'])      ? (int)$_REQUEST['ativo']    : 1);

switch ($action) {
    case 'pesquisar':
        $arrPlanos = $obj->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoJs.php');
        break;
    case 'novo':
        if ($perfil !== 'adm') { echo 'Acesso negado'; break; }
        $obj = new Plano();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoJs.php');
        break;
    case 'inserir':
        if ($perfil !== 'adm') { echo 'Acesso negado'; break; }
        if ($obj->inserir()) { $arrMsgSucesso[] = 'Plano criado!'; $arrPlanos = (new Plano())->listar(); require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoRead.php'); }
        else { $arrMsgErro[] = 'Erro ao inserir'; require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoCreate.php'); }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoJs.php');
        break;
    case 'editar':
        if ($perfil !== 'adm') { echo 'Acesso negado'; break; }
        $dados = $obj->listar();
        if (!empty($dados)) { $r = $dados[0]; $obj->setNome($r['nome']); $obj->setDescricao($r['descricao']); $obj->setPreco($r['preco']); $obj->setBeneficios($r['beneficios']); $obj->setAtivo($r['ativo']); }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoJs.php');
        break;
    case 'alterar':
        if ($perfil !== 'adm') { echo 'Acesso negado'; break; }
        if ($obj->alterar()) { $arrMsgSucesso[] = 'Plano atualizado!'; $arrPlanos = (new Plano())->listar(); require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoRead.php'); }
        else { $arrMsgErro[] = 'Erro ao alterar'; require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoCreate.php'); }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoJs.php');
        break;
    case 'excluir':
        if ($perfil !== 'adm') { echo 'Acesso negado'; break; }
        if ($obj->excluir()) $arrMsgSucesso[] = 'Plano excluído';
        else $arrMsgErro[] = 'Erro ao excluir';
        $arrPlanos = (new Plano())->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoJs.php');
        break;
    default:
        $arrPlanos = $obj->listar();
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoRead.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/plano/planoJs.php');
}
