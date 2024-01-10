<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../../lib/config.php');

$action = $_REQUEST['action'];
$action = $_POST['action'] ? $_POST['action'] : $_GET['action'];

switch ($action) {
    case 'pesquisar':
        require_once(__AGENDAMENTO_DIR__ . 'src/view/email/emailCreate.php');
        require_once(__AGENDAMENTO_DIR__ . 'src/view/email/emailJs.php');
        break;
    case 'enviar':
        $email_para = $_POST['para'];
        $email_assunto = $_POST['assunto'];
        $email_corpo = $_POST['corpo'];
        $arrMsgErro = [];
        if ($email_para == '') {
            $arrMsgErro[] = 'Informe o destinatário';
        }
        if ($email_assunto == '') {
            $arrMsgErro[] = 'Informe o assunto';
        }
        if ($email_corpo == '') {
            $arrMsgErro[] = 'Informe o conteúdo';
        }
        if (count($arrMsgErro) == 0) {
            $objEmail = new PHPMailer(true);
            try {
                //configuracao
                //$objEmail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $objEmail->isSMTP();                                            //Send using SMTP
                $objEmail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
                $objEmail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $objEmail->Username   = __EMAIL__;                     //SMTP username
                $objEmail->Password   = 'ag#2022QQ';                               //SMTP password
                $objEmail->SMTPSecure = PHPmailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $objEmail->Port       = 587;
                $objEmail->SMTPSecure = 'tls';

                //envio
                $objEmail->setFrom(__EMAIL__, 'masara_hospital');
                $objEmail->addAddress($email_para, '');
                $objEmail->isHTML(true);                                  //Set email format to HTML
                $objEmail->Subject = $email_assunto;
                $objEmail->Body    = $email_corpo;
                $objEmail->AltBody = strip_tags($email_corpo);
                $objEmail->send();
                $arrMsgSucesso[] = 'E-mail enviado com sucesso';
                $email_para = '';
                $email_assunto = '';
                $email_corpo = '';
                require_once(__AGENDAMENTO_DIR__ . 'src/view/email/emailCreate.php');
                require_once(__AGENDAMENTO_DIR__ . 'src/view/email/emailJs.php');
            } catch (Exception $e) {
                $arrMsgErro[] = 'Erro E-mail: ' . $objEmail->ErrorInfo;
            }
        } else {
            require_once(__AGENDAMENTO_DIR__ . 'src/view/email/emailCreate.php');
            require_once(__AGENDAMENTO_DIR__ . 'src/view/email/emailJs.php');
        }


        break;
}
