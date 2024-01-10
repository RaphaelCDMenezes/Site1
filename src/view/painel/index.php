<?php include_once('../../../lib/config.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= __AGENDAMENTO_TITULO__ ?></title>
    <?php include_once('css.php') ?>
</head>

<body class="sb-nav-fixed">
    <?php include_once('nav.php') ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include_once('menu.php') ?>
        </div>
        <div id="layoutSidenav_content">
            <?php include_once('conteudo.php') ?>
            <?php include_once('rodape.php') ?>
        </div>
    </div>
    <?php include_once('js.php') ?>
</body>

</html>