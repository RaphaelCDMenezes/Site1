<main>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= $obj->getId_plano() ? 'Editar' : 'Novo' ?> Plano</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="planoJs.fVoltar()">Planos</a></li>
        <li class="breadcrumb-item active"><?= $obj->getId_plano() ? 'Editar' : 'Criar' ?></li>
    </ol>
    <div class="row"><div class="col-xl-7">
        <div class="card">
            <div class="card-header"><i class="fas fa-file-medical"></i> Dados do Plano</div>
            <form id="formPlanoCreate" onsubmit="return false">
                <div class="card-body">
                    <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                    <input type="hidden" name="action"   value="<?= $obj->getId_plano() ? 'alterar' : 'inserir' ?>">
                    <input type="hidden" name="id_plano" value="<?= $obj->getId_plano() ?>">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Nome do Plano <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nome" placeholder="Ex: Plano Premium"
                                   value="<?= htmlspecialchars($obj->getNome()) ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Preço/mês (R$) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" name="preco" placeholder="0,00"
                                   value="<?= $obj->getPreco() ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descrição</label>
                            <input type="text" class="form-control" name="descricao" placeholder="Breve descrição"
                                   value="<?= htmlspecialchars($obj->getDescricao()) ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Benefícios <small class="text-muted">(separe por ponto-e-vírgula)</small></label>
                            <textarea class="form-control" name="beneficios" rows="4"
                                      placeholder="Ex: Consultas ilimitadas;Exames cobertos;Internações"><?= htmlspecialchars($obj->getBeneficios()) ?></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="ativo">
                                <option value="1" <?= $obj->getAtivo() ? 'selected' : '' ?>>Ativo</option>
                                <option value="0" <?= !$obj->getAtivo() ? 'selected' : '' ?>>Inativo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2 justify-content-end">
                        <button class="btn btn-secondary" onclick="planoJs.fVoltar()"><i class="fas fa-arrow-left"></i> Voltar</button>
                        <button class="btn btn-primary" onclick="planoJs.fSalvar()"><i class="fas fa-save"></i> Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div></div>
</div>
</main>
