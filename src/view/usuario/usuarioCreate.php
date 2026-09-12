<main>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= $objUsuario->getId_usuario() ? 'Editar' : 'Novo' ?> Paciente</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="usuarioJs.fVoltar()">Pacientes</a></li>
        <li class="breadcrumb-item active"><?= $objUsuario->getId_usuario() ? 'Editar' : 'Cadastrar' ?></li>
    </ol>
    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user"></i>
                    Dados do Paciente
                </div>
                <form id="formUsuarioCreate" action="" onsubmit="return false">
                    <div class="card-body">
                        <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                        <input type="hidden" name="action" value="<?= $objUsuario->getId_usuario() ? 'alterar' : 'inserir' ?>">
                        <input type="hidden" name="id_usuario" value="<?= $objUsuario->getId_usuario() ?>">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nome completo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nome" placeholder="Nome do paciente"
                                    value="<?= htmlspecialchars($objUsuario->getNome()) ?>"
                                    <?= $objUsuario->getId_usuario() ? 'readonly' : '' ?>>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">CPF <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="cpf" placeholder="000.000.000-00"
                                    value="<?= htmlspecialchars($objUsuario->getCpf()) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telefone</label>
                                <input type="text" class="form-control" name="telefone" placeholder="(11) 99999-9999"
                                    value="<?= htmlspecialchars($objUsuario->getTelefone()) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" placeholder="paciente@email.com"
                                    value="<?= htmlspecialchars($objUsuario->getEmail()) ?>">
                            </div>
                            <?php if (!$objUsuario->getId_usuario()): ?>
                            <div class="col-md-6">
                                <label class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" placeholder="Senha de acesso">
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex gap-2 justify-content-end">
                            <button class="btn btn-secondary" onclick="usuarioJs.fVoltar()">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </button>
                            <button id="usuario-btn-limpar" class="btn btn-secondary">
                                <i class="fas fa-eraser"></i> Limpar
                            </button>
                            <button class="btn btn-primary" onclick="usuarioJs.fSalvar()">
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
