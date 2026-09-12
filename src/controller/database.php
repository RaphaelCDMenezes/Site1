<?php

// ============================================================
// Conexão com o banco de dados via MySQLi
// ============================================================

$dbHost     = '127.0.0.1';
$dbUsuario  = 'root';       // usuário padrão do XAMPP
$dbSenha    = '';           // senha padrão do XAMPP (vazia)
$dbNome     = 'masara';     // nome do banco de dados

$conexao = new mysqli($dbHost, $dbUsuario, $dbSenha, $dbNome);

if ($conexao->connect_error) {
    die('Erro ao conectar com o banco de dados: ' . $conexao->connect_error);
}

// Define o charset para UTF-8 (evita problemas com acentuação)
$conexao->set_charset('utf8mb4');
