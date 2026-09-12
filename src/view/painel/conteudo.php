<?php
// conteudo.php pode ser carregado direto (pelo painel) ou via AJAX
// Garante que config e conexão estejam disponíveis nos dois casos
if (!defined('__AGENDAMENTO_DIR__')) {
    require_once('../../../lib/config.php');
}
global $conexao;

$perfil = $_SESSION['perfil'] ?? '';
$idUser = $_SESSION['id_user'] ?? 0;

// Paciente tem dashboard próprio e acolhedor
if ($perfil === 'user') {
    require_once(__AGENDAMENTO_DIR__ . 'src/view/painel/dashboardPaciente.php');
    return;
}

$totalMedicos       = mysqli_query($conexao, "SELECT COUNT(*) FROM medico")->fetch_row()[0]    ?? 0;
$totalPacientes     = mysqli_query($conexao, "SELECT COUNT(*) FROM usuario")->fetch_row()[0]   ?? 0;
$totalEspecialidades= mysqli_query($conexao, "SELECT COUNT(*) FROM especialidade")->fetch_row()[0] ?? 0;

if ($perfil === 'medic') {
    $totalConsultas = mysqli_query($conexao, "SELECT COUNT(*) FROM consulta WHERE id_medico=$idUser AND status='agendada'")->fetch_row()[0] ?? 0;
} else {
    $totalConsultas = mysqli_query($conexao, "SELECT COUNT(*) FROM consulta WHERE status='agendada'")->fetch_row()[0] ?? 0;
}

$labels = ['adm'=>'Administrador','medic'=>'Médico','user'=>'Paciente'];
$hora   = date('H');
$sauda  = $hora < 12 ? 'Bom dia' : ($hora < 18 ? 'Boa tarde' : 'Boa noite');
?>
<main>
<div class="container-fluid px-4">

    <div class="d-flex align-items-center justify-content-between mt-3 mb-4">
        <div>
            <h1 class="mt-4"><?= $sauda ?>! 👋</h1>
            <p style="color:var(--gray-400);font-size:.875rem;margin:.2rem 0 0">
                Você está logado como <strong><?= $labels[$perfil] ?? $perfil ?></strong> — <?= htmlspecialchars($_SESSION['email'] ?? '') ?>
            </p>
        </div>
        <span style="font-size:.8rem;color:var(--gray-400)"><?= date('d/m/Y') ?></span>
    </div>

    <div class="row g-3 mb-4">
        <?php if ($perfil !== 'user'): ?>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card stat-blue">
                <div class="stat-icon"><i class="fas fa-user-md"></i></div>
                <div><div class="stat-label">Médicos</div><div class="stat-value"><?= $totalMedicos ?></div></div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card stat-green">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div><div class="stat-label">Pacientes</div><div class="stat-value"><?= $totalPacientes ?></div></div>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card stat-teal">
                <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                <div><div class="stat-label">Consultas Agendadas</div><div class="stat-value"><?= $totalConsultas ?></div></div>
            </div>
        </div>
        <?php if ($perfil !== 'user'): ?>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card stat-orange">
                <div class="stat-icon"><i class="fas fa-stethoscope"></i></div>
                <div><div class="stat-label">Especialidades</div><div class="stat-value"><?= $totalEspecialidades ?></div></div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Atalhos rápidos por perfil -->
    <div class="row g-3 mb-4">
        <?php if ($perfil === 'adm'): ?>
            <div class="col-12"><p style="font-weight:600;font-size:.85rem;color:var(--gray-400);text-transform:uppercase;letter-spacing:.05em">Acesso rápido</p></div>
            <div class="col-sm-6 col-xl-3">
                <div class="card" style="cursor:pointer" onclick="agendamentoJs.fCarregarMenu('consulta')">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div style="width:40px;height:40px;border-radius:10px;background:#fce7f3;display:flex;align-items:center;justify-content:center"><i class="fas fa-calendar-plus" style="color:#9d174d"></i></div>
                        <div><div style="font-weight:600;font-size:.875rem">Agendar Consulta</div><div style="font-size:.75rem;color:var(--gray-400)">Nova consulta</div></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card" style="cursor:pointer" onclick="admJs.fListar('medico')">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div style="width:40px;height:40px;border-radius:10px;background:#dbeafe;display:flex;align-items:center;justify-content:center"><i class="fas fa-user-md" style="color:#1e40af"></i></div>
                        <div><div style="font-weight:600;font-size:.875rem">Gerenciar Médicos</div><div style="font-size:.75rem;color:var(--gray-400)">Editar dados e senhas</div></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card" style="cursor:pointer" onclick="admJs.fListar('usuario')">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div style="width:40px;height:40px;border-radius:10px;background:#d1fae5;display:flex;align-items:center;justify-content:center"><i class="fas fa-users" style="color:#065f46"></i></div>
                        <div><div style="font-weight:600;font-size:.875rem">Gerenciar Pacientes</div><div style="font-size:.75rem;color:var(--gray-400)">Editar dados e senhas</div></div>
                    </div>
                </div>
            </div>

        <?php elseif ($perfil === 'user'): ?>
            <div class="col-12"><p style="font-weight:600;font-size:.85rem;color:var(--gray-400);text-transform:uppercase;letter-spacing:.05em">O que deseja fazer?</p></div>
            <div class="col-sm-6 col-md-4">
                <div class="card" style="cursor:pointer" onclick="agendamentoJs.fCarregarMenu('consulta')">
                    <div class="card-body text-center py-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:#dbeafe;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem"><i class="fas fa-calendar-plus" style="color:#1e40af;font-size:1.1rem"></i></div>
                        <div style="font-weight:600">Agendar Consulta</div>
                        <div style="font-size:.78rem;color:var(--gray-400)">Marque uma consulta</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card" style="cursor:pointer" onclick="agendamentoJs.fCarregarMenu('plano')">
                    <div class="card-body text-center py-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:#ede9fe;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem"><i class="fas fa-file-medical" style="color:#6d28d9;font-size:1.1rem"></i></div>
                        <div style="font-weight:600">Ver Planos</div>
                        <div style="font-size:.78rem;color:var(--gray-400)">Planos disponíveis</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="card" style="cursor:pointer" onclick="agendamentoJs.fCarregarMenu('servicos')">
                    <div class="card-body text-center py-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:#d1fae5;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem"><i class="fas fa-hospital" style="color:#065f46;font-size:1.1rem"></i></div>
                        <div style="font-weight:600">Nossos Serviços</div>
                        <div style="font-size:.78rem;color:var(--gray-400)">Veja o que oferecemos</div>
                    </div>
                </div>
            </div>

        <?php elseif ($perfil === 'medic'): ?>
            <div class="col-12"><p style="font-weight:600;font-size:.85rem;color:var(--gray-400);text-transform:uppercase;letter-spacing:.05em">Acesso rápido</p></div>
            <div class="col-sm-6 col-md-4">
                <div class="card" style="cursor:pointer" onclick="agendamentoJs.fCarregarMenu('consulta')">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div style="width:40px;height:40px;border-radius:10px;background:#dbeafe;display:flex;align-items:center;justify-content:center"><i class="fas fa-calendar-check" style="color:#1e40af"></i></div>
                        <div><div style="font-weight:600;font-size:.875rem">Ver Consultas</div><div style="font-size:.75rem;color:var(--gray-400)">Agenda do dia</div></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Calendário -->
    <div class="card">
        <div class="card-header"><i class="fas fa-calendar-alt"></i> Calendário</div>
        <div class="card-body p-3"><div id="calendario"></div></div>
    </div>
</div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var el = document.getElementById('calendario');
    if (el && typeof FullCalendar !== 'undefined') {
        new FullCalendar.Calendar(el, {
            initialView: 'dayGridMonth', locale: 'pt-br', height: 480,
            headerToolbar: { left:'prev,next today', center:'title', right:'dayGridMonth,timeGridWeek' },
            selectable: true
        }).render();
    }
});
</script>
