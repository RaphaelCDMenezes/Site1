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
                        Filtros
                    </div>
                    <div class="card-body">
                        <form action="">
                            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                            <button class="btn btn-secondary" type="button" onclick="medicoJs.fPesquisar()">Pesquisar</button>
                            <button class="btn btn-secondary">Limpar</button>
                            <button class="btn btn-primary" type="button" onclick="medicoJs.fNovo()">Novo</button>
                        </form>
                        <div id="divMedicoLista">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Médico</th>
                                        <th scope="col">CRM</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Especialidade</th>
                                        <th scope="col">Dt. Nasc</th>
                                        <th scope="col">Empresa</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($arrMedicos as $arr) { ?>
                                        <tr>
                                            <td><?= $arr[1] ?></td>
                                            <td><?= $arr[2] ?></td>
                                            <td><?= $arr[3] ?></td>
                                            <td><?= $arr[4] ?></td>
                                            <td><?= $arr[7] ?></td>
                                            <td><?= $arr[8] ?></td>
                                            <td><?= $arr[9] ?></td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="medicoJs.fEditar(<?= $arr[0] ?>)" >Editar</a>&nbsp;
                                                <a href="javascript:void(0)" onclick="medicoJs.fExcluir(<?= $arr[0] ?>)" >Excluir</a>&nbsp;
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