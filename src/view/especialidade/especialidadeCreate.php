<main>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= $objEspecialidade->getId_especialidade() ? 'Editar' : 'Nova' ?> Especialidade</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="especialidadeJs.fVoltar()">Especialidades</a></li>
        <li class="breadcrumb-item active"><?= $objEspecialidade->getId_especialidade() ? 'Editar' : 'Cadastrar' ?></li>
    </ol>
    <div class="row">
        <div class="col-xl-5">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-stethoscope"></i>
                    Dados da Especialidade
                </div>
                <form id="formespecialidadeCreate" action="" onsubmit="return false">
                    <div class="card-body">
                        <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                        <input type="hidden" name="action" value="<?= $objEspecialidade->getId_especialidade() ? 'alterar' : 'inserir' ?>">
                        <input type="hidden" name="id_especialidade" value="<?= $objEspecialidade->getId_especialidade() ?>">
                        <div class="mb-3">
                            <label class="form-label">Tipo de Especialidade <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="descricao" placeholder="Ex: Cardiologia"
                                value="<?= htmlspecialchars($objEspecialidade->getDescricao()) ?>">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex gap-2 justify-content-end">
                            <button class="btn btn-secondary" onclick="especialidadeJs.fVoltar()">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </button>
                            <button id="especialidade-btn-limpar" class="btn btn-secondary">
                                <i class="fas fa-eraser"></i> Limpar
                            </button>
                            <button class="btn btn-primary" onclick="especialidadeJs.fSalvar()">
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
