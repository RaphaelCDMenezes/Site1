<?php
$perfil = $_SESSION['perfil'] ?? '';
$statusLabels = [
    'agendada'          => ['label'=>'Agendada',    'class'=>'badge-agendada'],
    'cancelada_medico'  => ['label'=>'Canc. Médico','class'=>'badge-cancelada'],
    'cancelada_paciente'=> ['label'=>'Canc. Paciente','class'=>'badge-cancelada'],
    'realizada'         => ['label'=>'Realizada',   'class'=>'badge-realizada'],
];
?>
<style>
.badge-agendada  { background:#dbeafe;color:#1e40af; }
.badge-cancelada { background:#fee2e2;color:#991b1b; }
.badge-realizada { background:#d1fae5;color:#065f46; }
.badge-consulta  { padding:.25rem .7rem;border-radius:20px;font-size:.72rem;font-weight:600;display:inline-flex;align-items:center;gap:.3rem; }
</style>
<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">
        <?php if ($perfil==='medic'): ?>Minhas Consultas
        <?php elseif ($perfil==='user'): ?>Minhas Consultas
        <?php else: ?>Consultas — Gestão
        <?php endif; ?>
    </h1>
    <ol class="breadcrumb mb-4"><li class="breadcrumb-item active">Consultas</li></ol>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fas fa-calendar-check me-1"></i>
                <?= $perfil==='medic' ? 'Agenda de Consultas' : ($perfil==='user' ? 'Minhas Consultas' : 'Todas as Consultas') ?>
            </span>
            <?php if ($perfil !== 'medic'): ?>
            <button class="btn btn-primary btn-sm" onclick="consultaJs.fNovo()">
                <i class="fas fa-plus"></i> Nova Consulta
            </button>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
            <div class="table-responsive">
                <table class="table">
                    <thead><tr>
                        <th>#</th>
                        <th>Data / Hora</th>
                        <?php if ($perfil !== 'user'): ?><th>Paciente</th><?php endif; ?>
                        <?php if ($perfil !== 'medic'): ?><th>Médico</th><?php endif; ?>
                        <th>Especialidade</th>
                        <th>Motivo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr></thead>
                    <tbody>
                    <?php if (empty($arrConsultas)): ?>
                        <tr><td colspan="9" class="text-center py-4 text-muted">
                            <i class="fas fa-calendar-times fa-2x mb-2 d-block"></i>
                            Nenhuma consulta encontrada
                        </td></tr>
                    <?php else: foreach ($arrConsultas as $c):
                        $st = $statusLabels[$c['status']] ?? ['label'=>$c['status'],'class'=>'badge-agendada'];
                        $podeAgendar = $c['status'] === 'agendada';
                    ?>
                        <tr>
                            <td style="color:var(--gray-400);font-size:.75rem"><?= $c['id_consulta'] ?></td>
                            <td>
                                <div style="font-weight:600"><?= date('d/m/Y', strtotime($c['dt_consulta'])) ?></div>
                                <div style="font-size:.78rem;color:var(--gray-400)"><?= date('H:i', strtotime($c['dt_consulta'])) ?></div>
                            </td>
                            <?php if ($perfil !== 'user'): ?>
                            <td>
                                <div style="display:flex;align-items:center;gap:.5rem">
                                    <div style="width:30px;height:30px;border-radius:50%;background:#d1fae5;display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:700;color:#065f46">
                                        <?= strtoupper(substr($c['nome_paciente'],0,2)) ?>
                                    </div>
                                    <span style="font-size:.85rem"><?= htmlspecialchars($c['nome_paciente']) ?></span>
                                </div>
                            </td>
                            <?php endif; ?>
                            <?php if ($perfil !== 'medic'): ?>
                            <td style="font-size:.85rem">Dr(a). <?= htmlspecialchars($c['nome_medico']) ?></td>
                            <?php endif; ?>
                            <td style="font-size:.82rem;color:var(--gray-600)"><?= htmlspecialchars($c['especialidade'] ?? '—') ?></td>
                            <td style="font-size:.82rem;color:var(--gray-600);max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"
                                title="<?= htmlspecialchars($c['motivo_cancelamento'] ?: $c['motivo']) ?>">
                                <?= htmlspecialchars($c['motivo_cancelamento'] ?: $c['motivo'] ?: '—') ?>
                            </td>
                            <td><span class="badge-consulta <?= $st['class'] ?>"><?= $st['label'] ?></span></td>
                            <td class="actions">
                                <?php if ($podeAgendar):
                                    if ($perfil === 'user'): ?>
                                        <a href="javascript:void(0)" class="del"
                                           onclick="consultaJs.fCancelarModal(<?= $c['id_consulta'] ?>)">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>
                                    <?php elseif ($perfil === 'medic'): ?>
                                        <a href="javascript:void(0)"
                                           onclick="consultaJs.fRealizada(<?= $c['id_consulta'] ?>)">
                                            <i class="fas fa-check"></i> Realizada
                                        </a>
                                        <a href="javascript:void(0)" class="del"
                                           onclick="consultaJs.fCancelarDireto(<?= $c['id_consulta'] ?>)">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>
                                    <?php else: ?>
                                        <a href="javascript:void(0)"
                                           onclick="consultaJs.fRealizada(<?= $c['id_consulta'] ?>)">
                                            <i class="fas fa-check"></i> Realizada
                                        </a>
                                        <a href="javascript:void(0)" class="del"
                                           onclick="consultaJs.fCancelarDireto(<?= $c['id_consulta'] ?>)">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>
                                        <a href="javascript:void(0)" class="del"
                                           onclick="consultaJs.fExcluir(<?= $c['id_consulta'] ?>)">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal cancelamento paciente -->
<div class="modal fade" id="modalCancelar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:14px;border:none">
            <div class="modal-header" style="border-bottom:1px solid var(--gray-200)">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Cancelar Consulta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="font-size:.9rem;color:var(--gray-600)">Informe o motivo do cancelamento:</p>
                <textarea id="motivoCancelamento" class="form-control" rows="3"
                          placeholder="Ex: Compromisso de trabalho, melhora do quadro..."></textarea>
                <input type="hidden" id="idConsultaCancelar">
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--gray-200)">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                <button type="button" class="btn btn-danger" onclick="consultaJs.fConfirmarCancelamento()">
                    <i class="fas fa-times me-1"></i> Confirmar Cancelamento
                </button>
            </div>
        </div>
    </div>
</div>
</main>
