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
                        <?= $objMedico->getId_medico() ? 'Alterar' : 'Novo' ?> médico
                    </div>
                    <form id="formMedicoCreate" action="" onsubmit="return false" >
                        <div class="card-body">
                            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                            <input type="hidden" name="action" value="<?= $objMedico->getId_medico() ? 'alterar' : 'inserir' ?>">
                            <input type="hidden" name="id_medico" value="<?= $objMedico->getId_medico() ?>">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= $objMedico->getNome() ?>" <?= $objMedico->getId_medico() ? 'readonly' : '' ?>>
                            </div>
                            <div class="mb-3">
                                <label for="crm" class="form-label">CRM:</label>
                                <input type="text" class="form-control" name="crm" id="crm" placeholder="CRM" value="<?= $objMedico->getCrm() ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" value="<?= $objMedico->getEmail() ?>">
                            </div>
                            <div class="mb-3">
                                <label for="Telefone" class="form-label">Telefone:</label>
                                <input type="text" class="form-control" name="telefone" id="telefone" placeholder="telefone" value="<?= $objMedico->getTelefone() ?>">
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha:</label>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" value="<?= $objMedico->getSenha() ?>">
                            </div>
                            <div class="mb-3">
                            <label for="especialidade" class="form-label">Especialidades:</label>
                                <select class="list-group-item form-control" name="id_especialidade" id="id_especialidade" name="dados">
                                    <option value="">Selecione</option>
                                    <?php foreach ($arrEspecialidade as $itemEspecialidade) {?>
                                        <option value="<?= $itemEspecialidade['id_especialidade'] ?>" <?= $objMedico->getId_especialidade() == $itemEspecialidade['id_especialidade']  ? 'selected' : '' ?> ><?= $itemEspecialidade['descricao'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-end">
                                <button class="btn btn-secondary" onclick="medicoJs.fVoltar()">Voltar</button>
                                <button id="medico-btn-limpar" class="btn btn-secondary" >Limpar</button>
                                <button class="btn btn-primary" onclick="medicoJs.fSalvar()">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>