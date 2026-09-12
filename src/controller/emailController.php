<?php

require_once('../../lib/config.php');

$action        = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : 'pesquisar');
$email_para    = '';
$email_assunto = '';
$email_corpo   = '';

switch ($action) {

    case 'pesquisar':
    default:
        require_once(__AGENDAMENTO_DIR__ . 'src/view/email/emailCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/email/emailJs.php');
        break;

    case 'enviar':
        $email_para    = isset($_POST['para'])    ? trim($_POST['para'])    : '';
        $email_assunto = isset($_POST['assunto']) ? trim($_POST['assunto']) : '';
        $email_corpo   = isset($_POST['corpo'])   ? $_POST['corpo']         : '';

        $arrMsgErro = [];
        if ($email_para    === '') $arrMsgErro[] = 'Informe o destinatário';
        if ($email_assunto === '') $arrMsgErro[] = 'Informe o assunto';
        if ($email_corpo   === '') $arrMsgErro[] = 'Informe o conteúdo';

        if (count($arrMsgErro) === 0) {
            // Verifica se PHPMailer está instalado
            $phpmailerPath = __AGENDAMENTO_DIR__ . 'lib/PHPMailer/src/PHPMailer.php';

            if (!file_exists($phpmailerPath)) {
                $arrMsgErro[] = 'PHPMailer não está instalado. Coloque a biblioteca em lib/PHPMailer/src/';
            } else {
                require_once $phpmailerPath;
                require_once __AGENDAMENTO_DIR__ . 'lib/PHPMailer/src/SMTP.php';
                require_once __AGENDAMENTO_DIR__ . 'lib/PHPMailer/src/Exception.php';

                $objEmail = new \PHPMailer\PHPMailer\PHPMailer(true);
                try {
                    $objEmail->isSMTP();
                    $objEmail->Host       = 'smtp-mail.outlook.com';
                    $objEmail->SMTPAuth   = true;
                    $objEmail->Username   = __EMAIL__;
                    $objEmail->Password   = defined('__EMAIL_SENHA__') ? __EMAIL_SENHA__ : '';
                    $objEmail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                    $objEmail->Port       = 587;
                    $objEmail->CharSet    = 'UTF-8';

                    $objEmail->setFrom(__EMAIL__, 'Masara');
                    $objEmail->addAddress($email_para);
                    $objEmail->isHTML(true);
                    $objEmail->Subject = $email_assunto;
                    $objEmail->Body    = $email_corpo;
                    $objEmail->AltBody = strip_tags($email_corpo);
                    $objEmail->send();

                    $arrMsgSucesso[] = 'E-mail enviado com sucesso!';
                    $email_para = $email_assunto = $email_corpo = '';
                } catch (\PHPMailer\PHPMailer\Exception $e) {
                    $arrMsgErro[] = 'Erro ao enviar: ' . $objEmail->ErrorInfo;
                }
            }
        }

        require_once(__AGENDAMENTO_DIR__ . 'src/view/email/emailCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/email/emailJs.php');
        break;
}
