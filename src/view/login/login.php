<?php
$ignoraSessao = true;
include_once('../../../lib/config.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= __AGENDAMENTO_TITULO__ ?></title>
    <?php include_once(__AGENDAMENTO_DIR__ . 'src/view/painel/css.php') ?>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">
                                    <div class="auth-logo">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
                                            <rect width="64" height="64" rx="12" fill="white" fill-opacity="0.2"/>
                                            <path d="M32 10 L32 54 M14 32 L50 32" stroke="white" stroke-width="7" stroke-linecap="round"/>
                                            <circle cx="32" cy="32" r="20" stroke="white" stroke-width="4" fill="none"/>
                                        </svg>
                                        Login
                                    </div>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="<?= __AGENDAMENTO_HTTP__ ?>src/controller/loginController.php" method="post">
                                    <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                                    <input type="hidden" name="action" value="login">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="email" id="email" type="email" placeholder="nome@exemplo.com" />
                                        <label for="email">E-mail</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="senha" id="senha" type="password" placeholder="Senha" />
                                        <label for="senha">Senha</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="#">Esqueceu sua senha?</a>
                                        <button class="btn btn-primary" type="submit">Entrar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small">
                                    <a href="/Site1-main/src/view/register/register.php">Criar uma conta!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; <?= __AGENDAMENTO_TITULO__ . ' ' . date('Y') ?></div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
