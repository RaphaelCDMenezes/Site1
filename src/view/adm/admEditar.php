<?php
$tituloTabela = ['medico'=>'Médico','usuario'=>'Paciente','adm'=>'Administrador'];
$titulo = $tituloTabela[$tabela] ?? $tabela;
?>
<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar <?= $titulo ?></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="admJs.fListar('<?= $tabela ?>')">← Voltar para lista</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <div class="row"><div class="col-xl-7">
        <div class="card">
            <div class="card-header"><i class="fas fa-user-edit"></i> Alterar dados do <?= $titulo ?></div>
            <form id="formAdmEditar" onsubmit="return false">
                <div class="card-body">
                    <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                    <input type="hidden" name="action" value="salvar">
                    <input type="hidden" name="tabela" value="<?= htmlspecialchars($tabela) ?>">
                    <input type="hidden" name="id"     value="<?= (int)($row['id_medico'] ?? $row['id_usuario'] ?? $row['id_adm'] ?? 0) ?>">

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Nome <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nome"
                                   value="<?= htmlspecialchars($row['nome'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">E-mail <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email"
                                   value="<?= htmlspecialchars($row['email'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="telefone"
                                   value="<?= htmlspecialchars($row['telefone'] ?? '') ?>">
                        </div>
                        <?php if ($tabela === 'medico'): ?>
                        <div class="col-md-4">
                            <label class="form-label">CRM</label>
                            <input type="text" class="form-control" name="crm"
                                   value="<?= htmlspecialchars($row['crm'] ?? '') ?>">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Especialidade</label>
                            <select class="form-select" name="id_especialidade">
                                <option value="">Selecione...</option>
                                <?php foreach ($especialidades ?? [] as $e): ?>
                                    <option value="<?= $e['id_especialidade'] ?>"
                                        <?= ($row['id_especialidade'] ?? 0) == $e['id_especialidade'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($e['descricao']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        <?php if ($tabela === 'usuario'): ?>
                        <div class="col-md-6">
                            <label class="form-label">CPF</label>
                            <input type="text" class="form-control" name="cpf"
                                   value="<?= htmlspecialchars($row['cpf'] ?? '') ?>">
                        </div>
                        <?php endif; ?>

                        <!-- Seção de senha -->
                        <div class="col-12">
                            <hr style="border-color:var(--gray-200)">
                            <div style="font-weight:600;font-size:.85rem;color:var(--gray-600);margin-bottom:.75rem">
                                <i class="fas fa-lock me-1"></i> Alterar Senha
                                <span style="font-weight:400;color:var(--gray-400)">(deixe em branco para manter a atual)</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" name="nova_senha" placeholder="Mínimo 6 caracteres">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2 justify-content-end">
                        <button class="btn btn-secondary" onclick="admJs.fListar('<?= $tabela ?>')">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </button>
                        <button class="btn btn-primary" onclick="admJs.fSalvar()">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div></div>
</div>
</main>
