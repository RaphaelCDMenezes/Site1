<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Médico</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Cadastro / Médico</li>
        </ol>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        <?= $objEspecialidade->getId_especialidade() ? 'Alterar' : 'Novo' ?> Especialidade
                    </div>
                    <form id="formespecialidadeCreate" action="" onsubmit="return false" >
                        <div class="card-body">
                            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                            <input type="hidden" name="action" value="<?= $objEspecialidade->getId_especialidade() ? 'alterar' : 'inserir' ?>">
                            <input type="hidden" name="id_especialidade" value="<?= $objEspecialidade->getId_especialidade() ?>">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Tipo de Especialidade:</label>
                                <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Especialidade" value="<?= $objEspecialidade->getDescricao() ?>" <?= $objEspecialidade->getId_especialidade() ? 'readonly' : '' ?>>
                            </div>
                        </div>
                        </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-end">
                                <button class="btn btn-secondary" onclick="especialidadeJs.fVoltar()">Voltar</button>
                                <button id="especialidade-btn-limpar" class="btn btn-secondary" >Limpar</button>
                                <button class="btn btn-primary" onclick="especialidadeJs.fSalvar()">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>