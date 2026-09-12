<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Paciente</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Cadastro / Paciente</li>
        </ol>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-user me-1"></i> Filtros
                    </div>
                    <div class="card-body">
                        <form action="">
                            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                            <button class="btn btn-secondary" type="button" onclick="usuarioJs.fPesquisar()">Pesquisar</button>
                            <button class="btn btn-secondary" type="button" onclick="usuarioJs.fPesquisar()">Limpar</button>
                            <button class="btn btn-primary"  type="button" onclick="usuarioJs.fNovo()">Novo</button>
                        </form>
                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>E-mail</th>
                                        <th>Telefone</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($arrUsuario)) foreach ($arrUsuario as $arr) { ?>
                                        <tr>
                                            <td><?= htmlspecialchars($arr['id_usuario']) ?></td>
                                            <td><?= htmlspecialchars($arr['nome']) ?></td>
                                            <td><?= htmlspecialchars($arr['cpf']) ?></td>
                                            <td><?= htmlspecialchars($arr['email']) ?></td>
                                            <td><?= htmlspecialchars($arr['telefone']) ?></td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="usuarioJs.fEditar(<?= $arr['id_usuario'] ?>)">Editar</a>&nbsp;
                                                <a href="javascript:void(0)" onclick="usuarioJs.fExcluir(<?= $arr['id_usuario'] ?>)">Excluir</a>
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
