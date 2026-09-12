<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Especialidade</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Cadastro / Especialidade</li>
        </ol>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-stethoscope me-1"></i> Filtros
                    </div>
                    <div class="card-body">
                        <form action="">
                            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                            <button class="btn btn-secondary" type="button" onclick="especialidadeJs.fPesquisar()">Pesquisar</button>
                            <button class="btn btn-secondary" type="button" onclick="especialidadeJs.fPesquisar()">Limpar</button>
                            <button class="btn btn-primary" type="button" onclick="especialidadeJs.fNovo()">Novo</button>
                        </form>
                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Especialidade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($arrEspecialidades)) foreach ($arrEspecialidades as $arr) { ?>
                                        <tr>
                                            <td><?= htmlspecialchars($arr['id_especialidade']) ?></td>
                                            <td><?= htmlspecialchars($arr['descricao']) ?></td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="especialidadeJs.fEditar(<?= $arr['id_especialidade'] ?>)">Editar</a>&nbsp;
                                                <a href="javascript:void(0)" onclick="especialidadeJs.fExcluir(<?= $arr['id_especialidade'] ?>)">Excluir</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
