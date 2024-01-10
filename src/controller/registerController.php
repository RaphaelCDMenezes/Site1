<?php
$ignoraSessao = true;
   use agendamento\register\register;

   require_once('../../lib/config.php');

   include_once('database.php');
    //echo "instanciar objeto Login <br />";
    $objregister = new register();
    
    //echo "capturar os campos do formulário <br />";
    $objregister->setId_Usuario($_REQUEST['id_Usuario']);
    $objregister->setNome($_REQUEST['nome']);
    $objregister->setCpf($_REQUEST['cpf']);
    $objregister->setEmail($_REQUEST['email']);
    $objregister->setTelefone($_REQUEST['telefone']);
    $objregister->setSenha($_REQUEST['senha']);
    
    //echo "capturar a ACTION da view <br />";
    $action = $_REQUEST['action'];
    $action = $_POST['action'] ? $_POST['action'] : $_GET['action'];
    
    switch ($action) {
        case 'register':
            $arrMsgErro = $objregister->validar();
            if (count($arrMsgErro) == 0) {
                if ($objregister->inserir() === true) {
                    $arrMsgSucesso[] = 'Inserido com sucesso';
                    $objregister = new register();
                    $objregister = $objregister->listar();
                    header('Location: /src/view/login/login.php');
                } else {
                    $arrMsgErro[] = 'Erro ao inserir';
                }
                require_once(__AGENDAMENTO_DIR__ . 'src/view/register/registerJs.php');
                require_once(__AGENDAMENTO_DIR__ . 'src/view/register/register.php');
            } else {
                require_once(__AGENDAMENTO_DIR__ . 'src/view/register/registerJs.php');
                require_once(__AGENDAMENTO_DIR__ . 'src/view/register/register.php');
            }
    
            break;
        default:
            echo 'Erro: Action "' . $action . '" não existe';
            break;
    }