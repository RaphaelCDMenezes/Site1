<main>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= $objMedico->getId_medico() ? 'Editar' : 'Novo' ?> Médico</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="medicoJs.fVoltar()">Médicos</a></li>
        <li class="breadcrumb-item active"><?= $objMedico->getId_medico() ? 'Editar' : 'Cadastrar' ?></li>
    </ol>
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-md"></i>
                    Dados do Médico
                </div>
                <form id="formMedicoCreate" action="" onsubmit="return false">
                    <div class="card-body">
                        <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                        <input type="hidden" name="action" value="<?= $objMedico->getId_medico() ? 'alterar' : 'inserir' ?>">
                        <input type="hidden" name="id_medico" value="<?= $objMedico->getId_medico() ?>">

                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Nome completo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nome" placeholder="Nome do médico"
                                    value="<?= htmlspecialchars($objMedico->getNome()) ?>"
                                    <?= $objMedico->getId_medico() ? 'readonly' : '' ?>>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">CRM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="crm" placeholder="CRM-SP 000000"
                                    value="<?= htmlspecialchars($objMedico->getCrm()) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" placeholder="medico@email.com"
                                    value="<?= htmlspecialchars($objMedico->getEmail()) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telefone</label>
                                <input type="text" class="form-control" name="telefone" placeholder="(11) 99999-9999"
                                    value="<?= htmlspecialchars($objMedico->getTelefone()) ?>">
                            </div>
                            <?php if (!$objMedico->getId_medico()): ?>
                            <div class="col-md-6">
                                <label class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" placeholder="Senha de acesso">
                            </div>
                            <?php endif; ?>
                            <div class="col-md-6">
                                <label class="form-label">Especialidade <span class="text-danger">*</span></label>
                                <select class="form-select" name="id_especialidade">
                                    <option value="">Selecione...</option>
                                    <?php if (!empty($arrEspecialidade)) foreach ($arrEspecialidade as $esp): ?>
                                        <option value="<?= $esp['id_especialidade'] ?>"
                                            <?= $objMedico->getId_especialidade() == $esp['id_especialidade'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($esp['descricao']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" name="dt_nascimento"
                                    value="<?= htmlspecialchars($objMedico->getDt_nascimento()) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Empresa / Hospital</label>
                                <input type="text" class="form-control" name="id_empresa" placeholder="Código da empresa"
                                    value="<?= htmlspecialchars($objMedico->getId_empresa()) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex gap-2 justify-content-end">
                            <button class="btn btn-secondary" onclick="medicoJs.fVoltar()">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </button>
                            <button id="medico-btn-limpar" class="btn btn-secondary">
                                <i class="fas fa-eraser"></i> Limpar
                            </button>
                            <button class="btn btn-primary" onclick="medicoJs.fSalvar()">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
