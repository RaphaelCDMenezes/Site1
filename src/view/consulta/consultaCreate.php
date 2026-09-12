<?php $perfil = $_SESSION['perfil'] ?? ''; ?>
<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Agendar Consulta</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="consultaJs.fVoltar()">Consultas</a></li>
        <li class="breadcrumb-item active">Nova consulta</li>
    </ol>
    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header"><i class="fas fa-calendar-plus"></i> Dados da Consulta</div>
                <form id="formConsultaCreate" onsubmit="return false">
                    <div class="card-body">
                        <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                        <input type="hidden" name="action" value="inserir">

                        <?php if ($perfil === 'user' && isset($rowUser)): ?>
                            <input type="hidden" name="id_usuario" value="<?= $rowUser['id_usuario'] ?>">
                            <div class="mb-3">
                                <label class="form-label">Paciente</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($rowUser['nome']) ?>" readonly>
                            </div>
                        <?php else: ?>
                            <div class="mb-3">
                                <label class="form-label">Paciente <span class="text-danger">*</span></label>
                                <select class="form-select" name="id_usuario" required>
                                    <option value="">Selecione o paciente...</option>
                                    <?php foreach ($arrUsuarios ?? [] as $u): ?>
                                        <option value="<?= $u['id_usuario'] ?>"><?= htmlspecialchars($u['nome']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label">Médico <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_medico" required>
                                <option value="">Selecione o médico...</option>
                                <?php foreach ($arrMedicos ?? [] as $m): ?>
                                    <option value="<?= $m['id_medico'] ?>">
                                        Dr(a). <?= htmlspecialchars($m['nome']) ?>
                                        <?= $m['especialidade'] ? ' — ' . $m['especialidade'] : '' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Data e Hora <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="dt_consulta"
                                   min="<?= date('Y-m-d\TH:i') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Motivo / Sintomas</label>
                            <textarea class="form-control" name="motivo" rows="3"
                                      placeholder="Descreva brevemente o motivo da consulta..."></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex gap-2 justify-content-end">
                            <button class="btn btn-secondary" onclick="consultaJs.fVoltar()">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </button>
                            <button class="btn btn-primary" onclick="consultaJs.fSalvar()">
                                <i class="fas fa-calendar-check"></i> Confirmar Agendamento
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card" style="border:none;background:var(--primary-light)">
                <div class="card-body">
                    <div style="font-weight:600;color:var(--primary);margin-bottom:.75rem">
                        <i class="fas fa-info-circle me-1"></i> Como funciona?
                    </div>
                    <ul style="font-size:.83rem;color:var(--primary-dark);padding-left:1.1rem;line-height:2.2">
                        <li>Escolha o médico e a especialidade desejada</li>
                        <li>Selecione data e horário disponível</li>
                        <li>Confirme o agendamento</li>
                        <li>Você poderá cancelar com justificativa</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
