<?php
if (!defined('__AGENDAMENTO_DIR__')) {
    require_once('../../../lib/config.php');
}
global $conexao;

$idUser  = $_SESSION['id_user'] ?? 0;
$email   = $_SESSION['email']   ?? '';

// Dados do paciente
$paciente = null;
if ($idUser) {
    $r = $conexao->prepare("SELECT nome FROM usuario WHERE id_usuario = ?");
    $r->bind_param('i', $idUser);
    $r->execute();
    $paciente = $r->get_result()->fetch_assoc();
}
$nomeFirst = $paciente ? explode(' ', $paciente['nome'])[0] : 'Paciente';

// Consultas agendadas do paciente
$consultas = [];
if ($idUser) {
    $q = $conexao->prepare(
        "SELECT c.dt_consulta, c.motivo, c.status, m.nome AS nome_medico, e.descricao AS especialidade
         FROM consulta c
         JOIN medico m ON m.id_medico = c.id_medico
         LEFT JOIN especialidade e ON e.id_especialidade = m.id_especialidade
         WHERE c.id_usuario = ? AND c.status = 'agendada'
         ORDER BY c.dt_consulta ASC LIMIT 3"
    );
    $q->bind_param('i', $idUser);
    $q->execute();
    $consultas = $q->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Planos
$planos = mysqli_query($conexao, "SELECT * FROM plano WHERE ativo=1 ORDER BY preco ASC LIMIT 3")->fetch_all(MYSQLI_ASSOC);

// Hora do dia
$hora  = (int)date('H');
$sauda = $hora < 12 ? 'Bom dia' : ($hora < 18 ? 'Boa tarde' : 'Boa noite');
?>

<style>
/* ── Hero ── */
.hero-paciente {
    background: linear-gradient(135deg, #0a1628 0%, #0f3460 50%, #0f6fff 100%);
    border-radius: 16px;
    padding: 2.5rem 2rem;
    color: #fff;
    position: relative;
    overflow: hidden;
    margin-bottom: 1.5rem;
}
.hero-paciente::after {
    content: '';
    position: absolute;
    right: -60px; top: -60px;
    width: 300px; height: 300px;
    background: rgba(255,255,255,.04);
    border-radius: 50%;
}
.hero-paciente::before {
    content: '';
    position: absolute;
    right: 60px; bottom: -80px;
    width: 200px; height: 200px;
    background: rgba(255,255,255,.04);
    border-radius: 50%;
}
.hero-btn {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .65rem 1.4rem; border-radius: 50px; font-weight: 600;
    font-size: .875rem; cursor: pointer; border: none; transition: all .2s;
    text-decoration: none;
}
.hero-btn-primary { background: #fff; color: #0f6fff; }
.hero-btn-primary:hover { background: #e8f0fe; color: #0050cc; box-shadow: 0 4px 16px rgba(0,0,0,.15); }
.hero-btn-outline { background: rgba(255,255,255,.12); color: #fff; border: 1.5px solid rgba(255,255,255,.3); }
.hero-btn-outline:hover { background: rgba(255,255,255,.22); }

/* ── Cards stat paciente ── */
.pstat-card {
    border-radius: 14px; padding: 1.2rem 1.4rem;
    display: flex; align-items: center; gap: 1rem;
    background: #fff; border: 1px solid var(--gray-200);
    box-shadow: 0 1px 6px rgba(0,0,0,.06);
    transition: all .2s; cursor: pointer;
}
.pstat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(15,111,255,.12); }
.pstat-icon {
    width: 48px; height: 48px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; flex-shrink: 0;
}

/* ── Serviços ── */
.servico-card {
    background: #fff; border: 1px solid var(--gray-200);
    border-radius: 14px; padding: 1.5rem;
    transition: all .22s; text-align: center; height: 100%;
}
.servico-card:hover {
    border-color: var(--primary, #0f6fff);
    box-shadow: 0 8px 28px rgba(15,111,255,.12);
    transform: translateY(-4px);
}
.servico-icon {
    width: 60px; height: 60px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1rem; font-size: 1.4rem;
}

/* ── Próximas consultas ── */
.consulta-item {
    display: flex; align-items: center; gap: 1rem;
    padding: .9rem 0; border-bottom: 1px solid var(--gray-100);
}
.consulta-item:last-child { border-bottom: none; }
.consulta-data-box {
    width: 52px; height: 52px; border-radius: 12px;
    background: var(--primary-light, #e8f0fe);
    display: flex; flex-direction: column; align-items: center;
    justify-content: center; flex-shrink: 0; text-align: center;
}
.consulta-data-box .dia  { font-size: 1.2rem; font-weight: 800; color: #0f6fff; line-height: 1; }
.consulta-data-box .mes  { font-size: .65rem; font-weight: 600; color: #6b7280; text-transform: uppercase; }

/* ── Planos ── */
.plano-card {
    border-radius: 16px; overflow: hidden;
    border: 2px solid var(--gray-200); transition: all .22s;
    background: #fff; height: 100%;
}
.plano-card:hover { border-color: #0f6fff; box-shadow: 0 10px 32px rgba(15,111,255,.14); transform: translateY(-4px); }
.plano-card.destaque { border-color: #0f6fff; }
.plano-header { padding: 1.5rem; text-align: center; }
.plano-preco { font-size: 2rem; font-weight: 800; color: #0f6fff; }
.plano-preco span { font-size: .85rem; font-weight: 400; color: #9ca3af; }
.plano-body { padding: 0 1.5rem 1.5rem; }
.plano-item { display: flex; align-items: center; gap: .5rem; padding: .3rem 0; font-size: .83rem; color: #4b5563; }
.plano-item i { color: #10b981; font-size: .75rem; }

/* ── Médicos em destaque ── */
.medico-chip {
    display: flex; align-items: center; gap: .75rem;
    padding: .75rem 1rem; background: #fff;
    border: 1px solid var(--gray-200); border-radius: 12px;
    transition: all .2s; cursor: pointer;
}
.medico-chip:hover { border-color: #0f6fff; background: #f0f4ff; }
.medico-avatar {
    width: 40px; height: 40px; border-radius: 50%;
    background: var(--primary-light, #e8f0fe);
    display: flex; align-items: center; justify-content: center;
    font-size: .78rem; font-weight: 700; color: #0f6fff; flex-shrink: 0;
}

/* ── Dicas de saúde ── */
.dica-card {
    border-radius: 14px; padding: 1.25rem 1.5rem;
    border: none; color: #fff; position: relative; overflow: hidden;
}
.dica-card::after {
    content: ''; position: absolute; right: -20px; top: -20px;
    width: 80px; height: 80px; border-radius: 50%;
    background: rgba(255,255,255,.1);
}

/* ── Section label ── */
.section-label {
    font-size: .75rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .08em; color: #9ca3af; margin-bottom: .75rem;
}
</style>

<main>
<div class="container-fluid px-4 pb-4">

    <!-- ╔══════════════════════════════╗ -->
    <!-- ║          HERO                ║ -->
    <!-- ╚══════════════════════════════╝ -->
    <div class="hero-paciente mt-3">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.75rem">
                    <div style="width:8px;height:8px;border-radius:50%;background:#4ade80;box-shadow:0 0 0 3px rgba(74,222,128,.3)"></div>
                    <span style="font-size:.78rem;color:rgba(255,255,255,.6);font-weight:500">Sistema ativo</span>
                </div>
                <h1 style="font-size:2rem;font-weight:800;color:#fff;margin-bottom:.5rem;line-height:1.2">
                    <?= $sauda ?>, <?= htmlspecialchars($nomeFirst) ?>! 👋
                </h1>
                <p style="color:rgba(255,255,255,.7);font-size:.95rem;margin-bottom:1.5rem;max-width:480px">
                    Cuide da sua saúde com facilidade. Agende consultas, acesse seus históricos e conheça nossos especialistas.
                </p>
                <div style="display:flex;gap:.75rem;flex-wrap:wrap">
                    <button class="hero-btn hero-btn-primary" onclick="agendamentoJs.fCarregarMenu('consulta')">
                        <i class="fas fa-calendar-plus"></i> Agendar Consulta
                    </button>
                    <button class="hero-btn hero-btn-outline" onclick="agendamentoJs.fCarregarMenu('plano')">
                        <i class="fas fa-file-medical"></i> Ver Planos
                    </button>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-end align-items-center" style="position:relative;z-index:1">
                <!-- Ilustração SVG médica -->
                <svg viewBox="0 0 320 260" width="280" height="228" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Fundo card -->
                    <rect x="20" y="30" width="280" height="200" rx="20" fill="rgba(255,255,255,0.08)"/>
                    <!-- Pulso/heartbeat line -->
                    <path d="M40 130 L80 130 L95 100 L110 160 L125 115 L140 145 L155 130 L280 130"
                          stroke="rgba(255,255,255,0.6)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    <!-- Ícone coração -->
                    <path d="M155 75 C155 70, 148 62, 140 65 C132 68, 130 76, 130 80 C130 88, 140 95, 155 105 C170 95, 180 88, 180 80 C180 76, 178 68, 170 65 C162 62, 155 70, 155 75Z"
                          fill="rgba(255,255,255,0.25)"/>
                    <!-- Cruz médica -->
                    <rect x="225" y="55" width="40" height="40" rx="10" fill="rgba(255,255,255,0.15)"/>
                    <rect x="242" y="63" width="6" height="24" rx="3" fill="white"/>
                    <rect x="233" y="72" width="24" height="6" rx="3" fill="white"/>
                    <!-- Chip de consulta -->
                    <rect x="35" y="165" width="150" height="42" rx="10" fill="rgba(255,255,255,0.12)"/>
                    <circle cx="56" cy="186" r="12" fill="rgba(255,255,255,0.2)"/>
                    <text x="56" y="190" text-anchor="middle" fill="white" font-size="9" font-weight="700">Dr</text>
                    <rect x="74" y="178" width="80" height="7" rx="3" fill="rgba(255,255,255,0.4)"/>
                    <rect x="74" y="190" width="55" height="5" rx="2" fill="rgba(255,255,255,0.2)"/>
                    <!-- Estrelinhas decorativas -->
                    <circle cx="270" cy="180" r="3" fill="rgba(255,255,255,0.3)"/>
                    <circle cx="285" cy="165" r="2" fill="rgba(255,255,255,0.2)"/>
                    <circle cx="260" cy="200" r="2" fill="rgba(255,255,255,0.25)"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- ╔══════════════════════════════╗ -->
    <!-- ║       CARDS RÁPIDOS          ║ -->
    <!-- ╚══════════════════════════════╝ -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="pstat-card" onclick="agendamentoJs.fCarregarMenu('consulta')">
                <div class="pstat-icon" style="background:#dbeafe;color:#1e40af"><i class="fas fa-calendar-check"></i></div>
                <div>
                    <div style="font-size:.75rem;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:.04em">Minhas Consultas</div>
                    <div style="font-size:1.4rem;font-weight:800;color:#1f2937"><?= count($consultas) ?></div>
                    <div style="font-size:.75rem;color:#6b7280">agendadas</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="pstat-card" onclick="agendamentoJs.fCarregarMenu('plano')">
                <div class="pstat-icon" style="background:#ede9fe;color:#6d28d9"><i class="fas fa-file-medical"></i></div>
                <div>
                    <div style="font-size:.75rem;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:.04em">Planos</div>
                    <div style="font-size:1.4rem;font-weight:800;color:#1f2937"><?= count($planos) ?></div>
                    <div style="font-size:.75rem;color:#6b7280">disponíveis</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="pstat-card" onclick="agendamentoJs.fCarregarMenu('servicos')">
                <div class="pstat-icon" style="background:#d1fae5;color:#065f46"><i class="fas fa-hospital"></i></div>
                <div>
                    <div style="font-size:.75rem;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:.04em">Serviços</div>
                    <div style="font-size:1.4rem;font-weight:800;color:#1f2937">8</div>
                    <div style="font-size:.75rem;color:#6b7280">especialidades</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="pstat-card" onclick="agendamentoJs.fCarregarMenu('consulta')">
                <div class="pstat-icon" style="background:#fce7f3;color:#9d174d"><i class="fas fa-clock"></i></div>
                <div>
                    <div style="font-size:.75rem;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:.04em">Atendimento</div>
                    <div style="font-size:1.4rem;font-weight:800;color:#1f2937">24h</div>
                    <div style="font-size:.75rem;color:#6b7280">urgência</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <!-- ╔═══════════════════════╗ -->
        <!-- ║  PRÓXIMAS CONSULTAS   ║ -->
        <!-- ╚═══════════════════════╝ -->
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="fas fa-calendar-check me-2" style="color:#0f6fff"></i>Próximas Consultas</span>
                    <button class="btn btn-primary btn-sm" onclick="agendamentoJs.fCarregarMenu('consulta')" style="border-radius:20px;font-size:.75rem;padding:.3rem .85rem">
                        <i class="fas fa-plus me-1"></i>Nova
                    </button>
                </div>
                <div class="card-body">
                    <?php if (empty($consultas)): ?>
                        <div style="text-align:center;padding:2rem 0;color:#9ca3af">
                            <!-- Ilustração vazia -->
                            <svg viewBox="0 0 120 100" width="100" height="84" style="margin-bottom:1rem;opacity:.4">
                                <rect x="20" y="10" width="80" height="70" rx="8" fill="#e5e7eb"/>
                                <rect x="30" y="5" width="10" height="15" rx="3" fill="#d1d5db"/>
                                <rect x="80" y="5" width="10" height="15" rx="3" fill="#d1d5db"/>
                                <rect x="30" y="35" width="60" height="6" rx="3" fill="#d1d5db"/>
                                <rect x="30" y="48" width="40" height="6" rx="3" fill="#d1d5db"/>
                                <circle cx="60" cy="72" r="8" fill="#d1d5db"/>
                                <path d="M56 72 L59 75 L65 68" stroke="white" stroke-width="2" fill="none" stroke-linecap="round"/>
                            </svg>
                            <p style="font-weight:600;color:#6b7280;margin-bottom:.3rem">Sem consultas agendadas</p>
                            <p style="font-size:.82rem;margin-bottom:1rem">Agende sua primeira consulta agora</p>
                            <button class="hero-btn hero-btn-primary" style="margin:0 auto" onclick="agendamentoJs.fCarregarMenu('consulta')">
                                <i class="fas fa-calendar-plus"></i> Agendar Agora
                            </button>
                        </div>
                    <?php else: ?>
                        <?php foreach ($consultas as $c):
                            $dt  = new DateTime($c['dt_consulta']);
                            $mes = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'][(int)$dt->format('m')-1];
                        ?>
                        <div class="consulta-item">
                            <div class="consulta-data-box">
                                <div class="dia"><?= $dt->format('d') ?></div>
                                <div class="mes"><?= $mes ?></div>
                            </div>
                            <div style="flex:1;min-width:0">
                                <div style="font-weight:600;font-size:.875rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                    Dr(a). <?= htmlspecialchars($c['nome_medico']) ?>
                                </div>
                                <div style="font-size:.78rem;color:#9ca3af"><?= htmlspecialchars($c['especialidade'] ?? 'Clínica Geral') ?></div>
                            </div>
                            <div style="text-align:right;flex-shrink:0">
                                <div style="font-size:.75rem;font-weight:600;color:#0f6fff"><?= $dt->format('H:i') ?></div>
                                <span style="font-size:.7rem;background:#dbeafe;color:#1e40af;padding:.15rem .5rem;border-radius:20px;font-weight:600">Agendada</span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div style="margin-top:1rem;text-align:center">
                            <a href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('consulta')"
                               style="font-size:.82rem;color:#0f6fff;font-weight:600">
                                Ver todas as consultas →
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- ╔═══════════════════════╗ -->
        <!-- ║   NOSSOS SERVIÇOS     ║ -->
        <!-- ╚═══════════════════════╝ -->
        <div class="col-lg-7">
            <p class="section-label">Nossos Serviços</p>
            <div class="row g-2">
                <?php
                $servicos = [
                    ['i'=>'fa-user-md',       'cor'=>'#dbeafe','ct'=>'#1e40af','t'=>'Consultas',       'd'=>'Com especialistas qualificados'],
                    ['i'=>'fa-flask',          'cor'=>'#d1fae5','ct'=>'#065f46','t'=>'Exames',          'd'=>'Resultados rápidos e online'],
                    ['i'=>'fa-laptop-medical', 'cor'=>'#fce7f3','ct'=>'#9d174d','t'=>'Telemedicina',    'd'=>'Atendimento de qualquer lugar'],
                    ['i'=>'fa-ambulance',      'cor'=>'#fff7ed','ct'=>'#c2410c','t'=>'Urgência',        'd'=>'Equipe disponível 24 horas'],
                    ['i'=>'fa-heartbeat',      'cor'=>'#ede9fe','ct'=>'#6d28d9','t'=>'Cardiologia',     'd'=>'Cuide do seu coração'],
                    ['i'=>'fa-child',          'cor'=>'#e0f2fe','ct'=>'#0369a1','t'=>'Pediatria',       'd'=>'Cuidado especial para crianças'],
                ];
                foreach ($servicos as $s):
                ?>
                <div class="col-6 col-md-4">
                    <div class="servico-card" onclick="agendamentoJs.fCarregarMenu('servicos')" style="cursor:pointer">
                        <div class="servico-icon" style="background:<?= $s['cor'] ?>">
                            <i class="fas <?= $s['i'] ?>" style="color:<?= $s['ct'] ?>"></i>
                        </div>
                        <div style="font-weight:700;font-size:.875rem;margin-bottom:.2rem"><?= $s['t'] ?></div>
                        <div style="font-size:.77rem;color:#9ca3af"><?= $s['d'] ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div><!-- row -->

    <!-- ╔══════════════════════════════╗ -->
    <!-- ║         PLANOS               ║ -->
    <!-- ╚══════════════════════════════╝ -->
    <div class="mt-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="section-label mb-0">Planos Disponíveis</p>
            <a href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('plano')"
               style="font-size:.82rem;color:#0f6fff;font-weight:600">Ver todos →</a>
        </div>
        <div class="row g-3">
            <?php
            $cores_plano = [
                ['bg'=>'#0a1628','badge'=>'Popular',   'badgebg'=>'#0f6fff','badgetxt'=>'#fff'],
                ['bg'=>'#065f46','badge'=>'Família',   'badgebg'=>'#10b981','badgetxt'=>'#fff'],
                ['bg'=>'#4c1d95','badge'=>'Premium',   'badgebg'=>'#8b5cf6','badgetxt'=>'#fff'],
            ];
            foreach ($planos as $i => $p):
                $cor   = $cores_plano[$i % 3];
                $bens  = array_filter(explode(';', $p['beneficios']));
            ?>
            <div class="col-md-4">
                <div class="plano-card <?= $i===0?'destaque':'' ?>">
                    <!-- Header colorido -->
                    <div class="plano-header" style="background:<?= $cor['bg'] ?>;color:#fff;position:relative">
                        <?php if ($i === 0): ?>
                        <div style="position:absolute;top:12px;right:12px;background:<?= $cor['badgebg'] ?>;color:<?= $cor['badgetxt'] ?>;font-size:.68rem;font-weight:700;padding:.2rem .6rem;border-radius:20px">
                            <?= $cor['badge'] ?>
                        </div>
                        <?php endif; ?>
                        <!-- Ícone SVG decorativo -->
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;margin:0 auto .75rem">
                            <i class="fas fa-shield-alt" style="font-size:1.3rem;color:#fff"></i>
                        </div>
                        <div style="font-weight:700;font-size:1rem;margin-bottom:.5rem"><?= htmlspecialchars($p['nome']) ?></div>
                        <div class="plano-preco">
                            R$ <?= number_format($p['preco'],2,',','.') ?>
                            <span>/mês</span>
                        </div>
                    </div>
                    <!-- Benefícios -->
                    <div class="plano-body">
                        <div style="font-size:.78rem;color:#9ca3af;margin-bottom:.75rem;padding-top:.75rem">
                            <?= htmlspecialchars($p['descricao']) ?>
                        </div>
                        <?php foreach (array_slice($bens, 0, 4) as $b): ?>
                        <div class="plano-item">
                            <i class="fas fa-check-circle"></i>
                            <?= htmlspecialchars(trim($b)) ?>
                        </div>
                        <?php endforeach; ?>
                        <button onclick="agendamentoJs.fCarregarMenu('plano')"
                                style="width:100%;margin-top:1rem;padding:.6rem;border-radius:50px;border:2px solid #0f6fff;background:<?= $i===0?'#0f6fff':'transparent' ?>;color:<?= $i===0?'#fff':'#0f6fff' ?>;font-weight:600;font-size:.83rem;cursor:pointer;transition:all .2s"
                                onmouseover="this.style.background='#0f6fff';this.style.color='#fff'"
                                onmouseout="this.style.background='<?= $i===0?'#0f6fff':'transparent' ?>';this.style.color='<?= $i===0?'#fff':'#0f6fff' ?>'">
                            Contratar Plano
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ╔══════════════════════════════╗ -->
    <!-- ║      DICAS DE SAÚDE          ║ -->
    <!-- ╚══════════════════════════════╝ -->
    <div class="mt-4">
        <p class="section-label">Dicas de Saúde</p>
        <div class="row g-3">
            <?php
            $dicas = [
                ['bg'=>'linear-gradient(135deg,#0f6fff,#0ea5e9)',  'i'=>'fa-tint',        't'=>'Hidratação',     'd'=>'Beba pelo menos 2 litros de água por dia para manter o bom funcionamento do organismo.'],
                ['bg'=>'linear-gradient(135deg,#10b981,#059669)',   'i'=>'fa-running',     't'=>'Exercícios',     'd'=>'30 minutos de atividade física diária reduzem em até 35% o risco de doenças cardíacas.'],
                ['bg'=>'linear-gradient(135deg,#f59e0b,#d97706)',   'i'=>'fa-moon',        't'=>'Sono',           'd'=>'Adultos precisam de 7 a 9 horas de sono por noite para saúde física e mental.'],
                ['bg'=>'linear-gradient(135deg,#8b5cf6,#6d28d9)',   'i'=>'fa-smile',       't'=>'Saúde Mental',   'd'=>'Pratique meditação e mindfulness. Cuidar da mente é tão importante quanto cuidar do corpo.'],
            ];
            foreach ($dicas as $d):
            ?>
            <div class="col-sm-6 col-xl-3">
                <div class="dica-card" style="background:<?= $d['bg'] ?>">
                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;margin-bottom:.9rem">
                        <i class="fas <?= $d['i'] ?>" style="color:#fff;font-size:.9rem"></i>
                    </div>
                    <div style="font-weight:700;font-size:.9rem;color:#fff;margin-bottom:.4rem"><?= $d['t'] ?></div>
                    <div style="font-size:.78rem;color:rgba(255,255,255,.8);line-height:1.5"><?= $d['d'] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ╔══════════════════════════════╗ -->
    <!-- ║    MÉDICOS EM DESTAQUE       ║ -->
    <!-- ╚══════════════════════════════╝ -->
    <?php
    $medicos = mysqli_query($conexao,
        "SELECT m.nome, e.descricao AS especialidade
         FROM medico m LEFT JOIN especialidade e ON e.id_especialidade = m.id_especialidade
         ORDER BY m.id_medico ASC LIMIT 6"
    )->fetch_all(MYSQLI_ASSOC);
    ?>
    <?php if (!empty($medicos)): ?>
    <div class="mt-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="section-label mb-0">Nossos Médicos</p>
            <a href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('consulta')"
               style="font-size:.82rem;color:#0f6fff;font-weight:600">Agendar consulta →</a>
        </div>
        <div class="row g-2">
            <?php foreach ($medicos as $m): ?>
            <div class="col-sm-6 col-xl-4">
                <div class="medico-chip" onclick="agendamentoJs.fCarregarMenu('consulta')">
                    <div class="medico-avatar"><?= strtoupper(substr($m['nome'],0,2)) ?></div>
                    <div style="min-width:0">
                        <div style="font-weight:600;font-size:.86rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                            Dr(a). <?= htmlspecialchars($m['nome']) ?>
                        </div>
                        <div style="font-size:.76rem;color:#9ca3af"><?= htmlspecialchars($m['especialidade'] ?? 'Clínica Geral') ?></div>
                    </div>
                    <i class="fas fa-chevron-right" style="color:#d1d5db;font-size:.7rem;margin-left:auto;flex-shrink:0"></i>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- ╔══════════════════════════════╗ -->
    <!-- ║      CTA FINAL               ║ -->
    <!-- ╚══════════════════════════════╝ -->
    <div class="mt-4 p-4" style="background:linear-gradient(135deg,#0a1628,#0f6fff);border-radius:16px;text-align:center">
        <div style="font-size:1.35rem;font-weight:800;color:#fff;margin-bottom:.5rem">
            Pronto para cuidar da sua saúde?
        </div>
        <p style="color:rgba(255,255,255,.7);font-size:.9rem;margin-bottom:1.25rem">
            Agende uma consulta agora e tenha acesso aos melhores especialistas
        </p>
        <div style="display:flex;gap:.75rem;justify-content:center;flex-wrap:wrap">
            <button class="hero-btn hero-btn-primary" onclick="agendamentoJs.fCarregarMenu('consulta')">
                <i class="fas fa-calendar-plus"></i> Agendar Consulta
            </button>
            <button class="hero-btn hero-btn-outline" onclick="agendamentoJs.fCarregarMenu('servicos')">
                <i class="fas fa-hospital"></i> Ver Serviços
            </button>
        </div>
    </div>

</div>
</main>
