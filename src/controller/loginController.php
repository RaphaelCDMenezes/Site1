<?php
$ignoraSessao = true;
require_once('../../lib/config.php');

include_once('database.php');

$action = $_REQUEST['action'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$matricula = $_POST['matricula'];

$query = "select id_medico, email from medico where email = '{$email}' and senha = ('{$senha}')";
$query2 = "select id_usuario, email from usuario where email = '{$email}' and senha = ('{$senha}')";

$result = mysqli_query($conexao, $query);
$result2 = mysqli_query($conexao, $query2);

$row = mysqli_num_rows($result);
$row2 = mysqli_num_rows($result2);

switch ($action) {
    case 'login':

        $arrMsgErro = [];
        if ($email == '') {
            $arrMsgErro[] = 'Informe o usuário';
        }
        if ($senha == '') {
            $arrMsgErro[] = 'Informe a senha';
        }
        if (count($arrMsgErro) > 0) {
            require_once(__AGENDAMENTO_DIR__ . 'src/view/login/login.php');
        }
         else {
            if ($email == 'suporte@adm.com' && $senha == 'masara2022'){
                $_SESSION['email'] = $email;
                $_SESSION['perfil'] = $email == $email ? 'adm' : 'user' && 'medic';
                header('Location: /src/view/painel');
            } else {
                if ($row == 1){
                    $_SESSION['email'] = $email;
                    $_SESSION['perfil'] = $email == $email ? 'medic' : 'adm' && 'user';
    
                    header('Location: /src/view/painel'); 
            } else {
                if ($row2 == 1){
                    $_SESSION['email'] = $email;
                    $_SESSION['perfil'] = $email == $email ? 'user' : 'adm' && 'medic';;
    
                    header('Location: /src/view/painel'); 
            } else {
                $arrMsgErro[] = 'Login inválido';
                require_once(__AGENDAMENTO_DIR__ . 'src/view/login/login.php');
            }
        }
    }}
        break;
    case 'logout':
        sessaoLogout();
        
        break;

    default:
        # code...
        break;
}
