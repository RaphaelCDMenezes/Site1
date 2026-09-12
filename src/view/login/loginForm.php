<?php
$ignoraSessao = true;
// Pode ser chamado direto ou incluído pelo controller
if (!defined('__AGENDAMENTO_TITULO__')) {
    include_once('../../../lib/config.php');
}

$perfil = isset($_POST['perfil']) ? $_POST['perfil'] : (isset($_GET['perfil']) ? $_GET['perfil'] : 'user');

$perfilInfo = [
    'user'  => ['label' => 'Paciente',       'icon' => 'fa-user',       'cor' => '#065f46', 'bg' => '#d1fae5'],
    'medic' => ['label' => 'Médico',          'icon' => 'fa-user-md',    'cor' => '#1e40af', 'bg' => '#dbeafe'],
    'adm'   => ['label' => 'Administrador',   'icon' => 'fa-user-shield','cor' => '#6d28d9', 'bg' => '#ede9fe'],
];
$info = $perfilInfo[$perfil] ?? $perfilInfo['user'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login <?= $info['label'] ?> — <?= __AGENDAMENTO_TITULO__ ?></title>
    <?php include_once(__AGENDAMENTO_DIR__ . 'src/view/painel/css.php') ?>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo-icon" style="background:<?= $info['bg'] ?>;color:<?= $info['cor'] ?>">
                    <i class="fas <?= $info['icon'] ?>"></i>
                </div>
                <h2>Entrar como <?= $info['label'] ?></h2>
                <p><?= __AGENDAMENTO_TITULO__ ?> — Sistema de Agendamento</p>
            </div>
            <div class="auth-body">
                <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                <form action="<?= __AGENDAMENTO_HTTP__ ?>src/controller/loginController.php" method="post">
                    <input type="hidden" name="action" value="login">
                    <input type="hidden" name="perfil" value="<?= htmlspecialchars($perfil) ?>">
                    <div class="form-floating mb-3">
                        <input class="form-control" name="email" id="email" type="email"
                               placeholder="nome@exemplo.com" autocomplete="email" required />
                        <label for="email"><i class="fas fa-envelope me-1"></i> E-mail</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input class="form-control" name="senha" id="senha" type="password"
                               placeholder="Senha" autocomplete="current-password" required />
                        <label for="senha"><i class="fas fa-lock me-1"></i> Senha</label>
                    </div>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-sign-in-alt me-1"></i> Entrar
                    </button>
                </form>
            </div>
            <div class="auth-footer" style="display:flex;justify-content:space-between;align-items:center">
                <a href="<?= __AGENDAMENTO_HTTP__ ?>src/controller/loginController.php" style="font-size:.82rem">
                    <i class="fas fa-arrow-left me-1"></i> Trocar perfil
                </a>
                <?php if ($perfil === 'user'): ?>
                <a href="/Site1-main/src/view/register/register.php" style="font-size:.82rem">Criar conta</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <footer class="py-4"><div class="text-center">Copyright &copy; <?= __AGENDAMENTO_TITULO__ . ' ' . date('Y') ?></div></footer>
</div>
<?php include_once(__AGENDAMENTO_DIR__ . 'src/view/painel/js.php') ?>
</body>
</html>
