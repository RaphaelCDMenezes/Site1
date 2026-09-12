<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Pacientes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Cadastro / Pacientes</li>
    </ol>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fas fa-users"></i> Lista de Pacientes</span>
            <button class="btn btn-primary btn-sm" onclick="usuarioJs.fNovo()">
                <i class="fas fa-plus"></i> Novo Paciente
            </button>
        </div>
        <div class="card-body">
            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
            <div class="table-responsive">
                <table class="table">
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
                        <?php if (empty($arrUsuario)): ?>
                            <tr><td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-users fa-2x mb-2 d-block"></i>
                                Nenhum paciente cadastrado
                            </td></tr>
                        <?php else: foreach ($arrUsuario as $arr): ?>
                            <tr>
                                <td><span style="color:var(--gray-400);font-size:.78rem"><?= $arr['id_usuario'] ?></span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:.65rem">
                                        <div style="width:34px;height:34px;border-radius:50%;background:#d1fae5;display:flex;align-items:center;justify-content:center;color:#065f46;font-size:.78rem;font-weight:700;flex-shrink:0">
                                            <?= strtoupper(substr($arr['nome'], 0, 2)) ?>
                                        </div>
                                        <span style="font-weight:500"><?= htmlspecialchars($arr['nome']) ?></span>
                                    </div>
                                </td>
                                <td><span style="font-family:monospace;font-size:.82rem;background:var(--gray-100);padding:.15rem .5rem;border-radius:5px"><?= htmlspecialchars($arr['cpf']) ?></span></td>
                                <td style="color:var(--gray-600)"><?= htmlspecialchars($arr['email']) ?></td>
                                <td style="color:var(--gray-600)"><?= htmlspecialchars($arr['telefone']) ?></td>
                                <td class="actions">
                                    <a href="javascript:void(0)" onclick="usuarioJs.fEditar(<?= $arr['id_usuario'] ?>)">
                                        <i class="fas fa-pencil-alt"></i> Editar
                                    </a>
                                    <a href="javascript:void(0)" class="del" onclick="usuarioJs.fExcluir(<?= $arr['id_usuario'] ?>)">
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
