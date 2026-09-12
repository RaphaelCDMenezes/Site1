<?php
require_once('../../lib/config.php');

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'pesquisar');

switch ($action) {
    case 'enviar':
        if (!isset($_FILES['foto'])) {
            $arrMsgErro[] = 'Nenhum arquivo recebido';
            break;
        }
        switch ($_FILES['foto']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $arrMsgErro[] = 'Arquivo muito grande';
                break;
            case UPLOAD_ERR_PARTIAL:
                $arrMsgErro[] = 'Upload incompleto';
                break;
            case UPLOAD_ERR_NO_FILE:
                $arrMsgErro[] = 'Nenhum arquivo enviado';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
            case UPLOAD_ERR_CANT_WRITE:
                $arrMsgErro[] = 'Erro ao salvar o arquivo no servidor';
                break;
            default:
                $arquivo_tmp = $_FILES['foto']['tmp_name'];
                $arquivo     = basename($_FILES['foto']['name']);
                $tamanho     = $_FILES['foto']['size'] / 1024;
                if (move_uploaded_file($arquivo_tmp, __AGENDAMENTO_DIR_UPLOAD__ . $arquivo)) {
                    $arrMsgSucesso[] = 'Arquivo enviado com sucesso. Tamanho: ' . number_format($tamanho, 2) . ' KB';
                } else {
                    $arrMsgErro[] = 'Erro ao salvar arquivo';
                }
                break;
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/upload/uploadCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/upload/uploadJs.php');
        break;

    case 'pesquisar':
    default:
        require_once(__AGENDAMENTO_DIR__ . 'src/view/upload/uploadCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/upload/uploadJs.php');
        break;
}
