<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Especialidades</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Cadastro / Especialidades</li>
    </ol>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fas fa-stethoscope"></i> Lista de Especialidades</span>
            <button class="btn btn-primary btn-sm" onclick="especialidadeJs.fNovo()">
                <i class="fas fa-plus"></i> Nova Especialidade
            </button>
        </div>
        <div class="card-body">
            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Especialidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($arrEspecialidades)): ?>
                            <tr><td colspan="3" class="text-center py-4 text-muted">
                                <i class="fas fa-stethoscope fa-2x mb-2 d-block"></i>
                                Nenhuma especialidade cadastrada
                            </td></tr>
                        <?php else: foreach ($arrEspecialidades as $arr): ?>
                            <tr>
                                <td><span style="color:var(--gray-400);font-size:.78rem"><?= $arr['id_especialidade'] ?></span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:.65rem">
                                        <div style="width:32px;height:32px;border-radius:8px;background:#e0f2fe;display:flex;align-items:center;justify-content:center;color:#0284c7;font-size:.8rem;flex-shrink:0">
                                            <i class="fas fa-stethoscope"></i>
                                        </div>
                                        <span style="font-weight:500"><?= htmlspecialchars($arr['descricao']) ?></span>
                                    </div>
                                </td>
                                <td class="actions">
                                    <a href="javascript:void(0)" onclick="especialidadeJs.fEditar(<?= $arr['id_especialidade'] ?>)">
                                        <i class="fas fa-pencil-alt"></i> Editar
                                    </a>
                                    <a href="javascript:void(0)" class="del" onclick="especialidadeJs.fExcluir(<?= $arr['id_especialidade'] ?>)">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
