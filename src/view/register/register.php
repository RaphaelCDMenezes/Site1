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
                                <h3 class="text-center font-weight-light my-4"><img src="/Img/Capa-hospital.fw.png" alt="CapaHospital" height="50px" width="50px" align="middle">Criar conta</h3>
                            </div>
                            <div class="card-body">
                                <main>
                                    <form action="<?= __AGENDAMENTO_HTTP__ ?>src/controller/registerController.php" method="post">
                                        <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                                        <input type="hidden" name="action" value="register">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="nome" id="nome" type="text" placeholder="Nome" />
                                            <label for="nome">Nome</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="cpf" id="cpf" type="text" placeholder="CPF" />
                                            <label for="cpf">CPF</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="email" type="email" placeholder="nome@exemplo.com" />
                                            <label for="email">E-mail</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="telefone" id="telefone" type="text" placeholder="Telefone" />
                                            <label for="telefone">Telefone</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="senha" id="senha" type="password" placeholder="Senha" />
                                            <label for="senha">Senha</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Criar Conta</button>
                                        </div>
                                    </form>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; <?= __AGENDAMENTO_TITULO__ . ' ' . date('Y') ?> </div>
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