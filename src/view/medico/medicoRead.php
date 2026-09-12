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
                        <i class="fas fa-user-md me-1"></i> Filtros
                    </div>
                    <div class="card-body">
                        <form action="">
                            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                            <button class="btn btn-secondary" type="button" onclick="medicoJs.fPesquisar()">Pesquisar</button>
                            <button class="btn btn-secondary" type="button" onclick="medicoJs.fPesquisar()">Limpar</button>
                            <button class="btn btn-primary"  type="button" onclick="medicoJs.fNovo()">Novo</button>
                        </form>
                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>CRM</th>
                                        <th>E-mail</th>
                                        <th>Telefone</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($arrMedicos)) foreach ($arrMedicos as $arr) { ?>
                                        <tr>
                                            <td><?= htmlspecialchars($arr['id_medico']) ?></td>
                                            <td><?= htmlspecialchars($arr['nome']) ?></td>
                                            <td><?= htmlspecialchars($arr['crm']) ?></td>
                                            <td><?= htmlspecialchars($arr['email']) ?></td>
                                            <td><?= htmlspecialchars($arr['telefone']) ?></td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="medicoJs.fEditar(<?= $arr['id_medico'] ?>)">Editar</a>&nbsp;
                                                <a href="javascript:void(0)" onclick="medicoJs.fExcluir(<?= $arr['id_medico'] ?>)">Excluir</a>
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
