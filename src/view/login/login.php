<?php
$ignoraSessao = true;
include_once('../../../lib/config.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= __AGENDAMENTO_TITULO__ ?> — Acesso</title>
    <?php include_once(__AGENDAMENTO_DIR__ . 'src/view/painel/css.php') ?>
    <style>
        body.bg-primary { min-height:100vh; display:flex; flex-direction:column;
            background: linear-gradient(135deg, #0a1628 0%, #0f3460 55%, #0f6fff 100%) !important; }
        .select-card {
            background:#fff; border-radius:16px; padding:2rem 1.5rem; text-align:center;
            cursor:pointer; transition:all .22s; border:2px solid transparent;
            box-shadow:0 2px 12px rgba(0,0,0,.08);
        }
        .select-card:hover { transform:translateY(-5px); box-shadow:0 12px 32px rgba(15,111,255,.18); border-color:var(--primary,#0f6fff); }
        .select-card .icon-wrap {
            width:64px; height:64px; border-radius:16px; margin:0 auto 1rem;
            display:flex; align-items:center; justify-content:center; font-size:1.6rem;
        }
        .select-card h5 { font-weight:700; margin-bottom:.3rem; font-size:1rem; }
        .select-card p  { font-size:.8rem; color:#9ca3af; margin:0; }
        .hero-logo { display:flex; align-items:center; justify-content:center; gap:12px; margin-bottom:2.5rem; }
        .hero-logo .icon { width:56px; height:56px; border-radius:14px; background:rgba(255,255,255,.15);
            display:flex; align-items:center; justify-content:center; font-size:1.6rem; color:#fff; }
        .hero-logo span { font-size:2rem; font-weight:800; color:#fff; letter-spacing:-1px; }
        .hero-sub { color:rgba(255,255,255,.6); font-size:.9rem; text-align:center; margin-bottom:2.5rem; }
    </style>
</head>
<body class="bg-primary">
<div style="flex:1;display:flex;align-items:center;justify-content:center;padding:2rem 1rem">
    <div style="width:100%;max-width:680px">

        <div class="hero-logo">
            <div class="icon"><i class="fas fa-heartbeat"></i></div>
            <span><?= __AGENDAMENTO_TITULO__ ?></span>
        </div>
        <p class="hero-sub">Sistema de Agendamento Médico — selecione seu perfil para continuar</p>

        <div class="row g-3">
            <!-- Paciente -->
            <div class="col-md-4">
                <a href="<?= __AGENDAMENTO_HTTP__ ?>src/controller/loginController.php?action=form&perfil=user" style="text-decoration:none">
                    <div class="select-card">
                        <div class="icon-wrap" style="background:#d1fae5;color:#065f46"><i class="fas fa-user"></i></div>
                        <h5>Paciente</h5>
                        <p>Agende e gerencie suas consultas</p>
                    </div>
                </a>
            </div>
            <!-- Médico -->
            <div class="col-md-4">
                <a href="<?= __AGENDAMENTO_HTTP__ ?>src/controller/loginController.php?action=form&perfil=medic" style="text-decoration:none">
                    <div class="select-card">
                        <div class="icon-wrap" style="background:#dbeafe;color:#1e40af"><i class="fas fa-user-md"></i></div>
                        <h5>Médico</h5>
                        <p>Visualize e gerencie consultas</p>
                    </div>
                </a>
            </div>
            <!-- ADM -->
            <div class="col-md-4">
                <a href="<?= __AGENDAMENTO_HTTP__ ?>src/controller/loginController.php?action=form&perfil=adm" style="text-decoration:none">
                    <div class="select-card">
                        <div class="icon-wrap" style="background:#ede9fe;color:#6d28d9"><i class="fas fa-user-shield"></i></div>
                        <h5>Administrador</h5>
                        <p>Acesso completo ao sistema</p>
                    </div>
                </a>
            </div>
        </div>

        <p style="text-align:center;color:rgba(255,255,255,.4);font-size:.78rem;margin-top:2rem">
            Não tem conta? <a href="/Site1-main/src/view/register/register.php" style="color:rgba(255,255,255,.7)">Criar conta de paciente</a>
        </p>
    </div>
</div>
<footer style="padding:1rem;text-align:center;color:rgba(255,255,255,.3);font-size:.75rem">
    Copyright &copy; <?= __AGENDAMENTO_TITULO__ . ' ' . date('Y') ?>
</footer>
<?php include_once(__AGENDAMENTO_DIR__ . 'src/view/painel/js.php') ?>
</body>
</html>
