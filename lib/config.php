<?php

// ============================================================
// Configurações gerais do sistema Masara
// ============================================================

// Inicia a sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ---- Constantes do sistema ----
// __DIR__ aponta para lib/, então a raiz do projeto é um nível acima
$_raiz = str_replace('\\', '/', dirname(__DIR__)) . '/';

define('__AGENDAMENTO_TITULO__',      'Masara');
define('__AGENDAMENTO_DIR__',         $_raiz);
define('__AGENDAMENTO_HTTP__',        'http://localhost/Site1-main/');
define('__AGENDAMENTO_DIR_UPLOAD__',  $_raiz . 'assets/upload/');
define('__EMAIL__',                   'seu_email@outlook.com'); // altere para o e-mail real

unset($_raiz);

// ---- Autoload de classes (models) ----
spl_autoload_register(function ($classe) {
    $mapa = [
        'agendamento\\medico\\Medico'               => __AGENDAMENTO_DIR__ . 'src/model/medicoModel.php',
        'agendamento\\especialidade\\Especialidade' => __AGENDAMENTO_DIR__ . 'src/model/especialidadeModel.php',
        'agendamento\\usuario\\Usuario'             => __AGENDAMENTO_DIR__ . 'src/model/usuarioModel.php',
        'agendamento\\login\\Login'                 => __AGENDAMENTO_DIR__ . 'src/model/loginModel.php',
        'agendamento\\register\\register'           => __AGENDAMENTO_DIR__ . 'src/model/registerModel.php',
    ];

    if (isset($mapa[$classe])) {
        require_once $mapa[$classe];
    }
});

// ---- Carrega a conexão com o banco ----
require_once __AGENDAMENTO_DIR__ . 'src/controller/database.php';

// ---- Verificação de sessão ----
// Arquivos que definem $ignoraSessao = true pulam a verificação
if (empty($ignoraSessao)) {
    sessaoVerificar();
}

// ---- Funções de sessão ----

/**
 * Verifica se o usuário está logado.
 * Redireciona para o login se não estiver.
 */
function sessaoVerificar()
{
    if (empty($_SESSION['email'])) {
        header('Location: ' . __AGENDAMENTO_HTTP__ . 'src/view/login/login.php');
        exit;
    }
}

/**
 * Encerra a sessão e redireciona para o login.
 */
function sessaoLogout()
{
    $_SESSION = [];
    session_destroy();
    header('Location: ' . __AGENDAMENTO_HTTP__ . 'src/view/login/login.php');
    exit;
}
