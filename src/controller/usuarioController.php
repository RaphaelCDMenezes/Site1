<?php
    // echo "carregar o config <br />";
    use agendamento\usuario\Usuario;

    require_once('../../lib/config.php');
    
    //echo "instanciar objeto usuario <br />";
    $objUsuario = new Usuario();
    
    //echo "capturar os campos do formulário <br />";
    $objUsuario->setId_usuario($_REQUEST['id_usuario']);
    $objUsuario->setNome($_REQUEST['nome']);
    $objUsuario->setCpf($_REQUEST['cpf']);
    $objUsuario->setEmail($_REQUEST['email']);
    $objUsuario->setTelefone($_REQUEST['telefone']);
    $objUsuario->setSenha($_REQUEST['senha']);
    
    //echo "capturar a ACTION da view <br />";
    $action = $_REQUEST['action'];
    $action = $_POST['action'] ? $_POST['action'] : $_GET['action'];
    
    switch ($action) {
        case 'inserir':
            $arrMsgErro = $objUsuario->validar();
            if (count($arrMsgErro) == 0) {
                if ($objUsuario->inserir() === true) {
                    $arrMsgSucesso[] = 'Inserido com sucesso';
                    $objUsuario = new Usuario();
                    $objUsuario = $objUsuario->listar();
                } else {
                    $arrMsgErro[] = 'Erro ao inserir';
                }
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioRead.php');
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
            } else {
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioCreate.php');
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
            }
    
            break;
        case 'alterar':
            $arrMsgErro = $objUsuario->validar();
            if (count($arrMsgErro) == 0) {
                if ($objUsuario->alterar() === true) {
                    $arrMsgSucesso[] = 'Alterado com sucesso';
                    $objUsuario = new Usuario();
                    $objUsuario = $objUsuario->listar();
                } else {
                    $arrMsgErro[] = 'Erro ao alterar';
                }
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioRead.php');
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
            } else {
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioCreate.php');
                require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
            }
            break;
        case 'excluir':
            if ($objUsuario->excluir() === true) {
                $arrMsgSucesso[] = 'Excluído com sucesso';
                $objUsuario = new Usuario();
                $objUsuario = $objUsuario->listar();
            } else {
                $arrMsgErro[] = 'Erro ao excluir';
            }
            require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioRead.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
            break;
        case 'pesquisar':
            $arrUsuario = $objUsuario->listar();
            require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioRead.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
            break;
        case 'novo':
            require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioCreate.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
            break;
        case 'editar':
            $arrUsuario = $objUsuario->listar()[0];
            $objUsuario->setId_usuario($arrUsuario[0]);
            $objUsuario->setNome($arrUsuario[1]);
            $objUsuario->setCpf($arrUsuario[2]);
            $objUsuario->setEmail($arrUsuario[3]);
            $objUsuario->setTelefone($arrUsuario[4]);
            $objUsuario->setSenha($arrUsuario[5]);
    
            require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioCreate.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/usuario/usuarioJs.php');
            break;
        default:
            echo 'Erro: Action "' . $action . '" não existe';
            break;
    }
    