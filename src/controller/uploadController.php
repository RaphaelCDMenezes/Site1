<?php
require_once('../../lib/config.php');

$action = $_REQUEST['action'];
$action = $_POST['action'] ? $_POST['action'] : $_GET['action'];

switch ($action) {
    case 'enviar' :
        switch ($_FILES['foto']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $arrMsgErro[] = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $arrMsgErro[] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $arrMsgErro[] = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $arrMsgErro[] = "Nenhum arquivo enviado";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $arrMsgErro[] = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $arrMsgErro[] = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $arrMsgErro[] = "File upload stopped by extension";
                break;
                
            default:
                $arquivo_tmp = $_FILES['foto']['tmp_name'];
                $arquivo = $_FILES['foto']['name'];
                $tamanho = $_FILES['foto']['size'] / 1024;
                if (move_uploaded_file($arquivo_tmp, __AGENDAMENTO_DIR_UPLOAD__ . $arquivo)) {
                    $arrMsgSucesso[] = 'Arquivo gravado com sucesso. Tamanho: ' .  number_format($tamanho, 2) . ' kb';
                } else {
                    $arrMsgErro[] = 'Erro ao salvar arquivo';
                }

                break;
        }
        require_once(__AGENDAMENTO_DIR__ . 'src/view/upload/uploadCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/upload/uploadJs.php');

        break;
    case 'pesquisar' :
        require_once(__AGENDAMENTO_DIR__ . 'src/view/upload/uploadCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/upload/uploadJs.php');
        break;
}