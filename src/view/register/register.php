<?php
$ignoraSessao = true;
include_once('../../../lib/config.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Criar Conta — <?= __AGENDAMENTO_TITULO__ ?></title>
    <?php include_once(__AGENDAMENTO_DIR__ . 'src/view/painel/css.php') ?>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <div class="auth-card" style="max-width:480px">
            <div class="auth-header">
                <div class="auth-logo-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2>Criar Conta</h2>
                <p>Cadastre-se como paciente</p>
            </div>
            <div class="auth-body">
                <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                <form action="<?= __AGENDAMENTO_HTTP__ ?>src/controller/registerController.php" method="post">
                    <input type="hidden" name="action" value="register">
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label for="nome" class="form-label">Nome completo</label>
                            <input class="form-control" name="nome" id="nome" type="text" placeholder="Seu nome completo" required />
                        </div>
                        <div class="col-md-6">
                            <label for="cpf" class="form-label">CPF</label>
                            <input class="form-control" name="cpf" id="cpf" type="text" placeholder="000.000.000-00" required />
                        </div>
                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input class="form-control" name="telefone" id="telefone" type="text" placeholder="(11) 99999-9999" />
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" name="email" id="email" type="email" placeholder="nome@exemplo.com" required />
                        </div>
                        <div class="col-12">
                            <label for="senha" class="form-label">Senha</label>
                            <input class="form-control" name="senha" id="senha" type="password" placeholder="Mínimo 6 caracteres" required />
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-user-check me-1"></i> Criar Conta
                    </button>
                </form>
            </div>
            <div class="auth-footer">
                Já tem conta? <a href="/Site1-main/src/view/login/login.php">Fazer login</a>
            </div>
        </div>
    </div>
    <footer class="py-4">
        <div class="text-center">
            <span>Copyright &copy; <?= __AGENDAMENTO_TITULO__ . ' ' . date('Y') ?></span>
        </div>
    </footer>
</div>
</body>
</html>
