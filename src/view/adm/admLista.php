<?php
$tituloTabela = ['medico'=>'Médicos','usuario'=>'Pacientes','adm'=>'Administradores'];
$titulo = $tituloTabela[$tabela] ?? $tabela;
?>
<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Gerenciar <?= $titulo ?></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="admJs.fListar('<?= $tabela ?>')">Painel ADM</a></li>
        <li class="breadcrumb-item active"><?= $titulo ?></li>
    </ol>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fas fa-users me-1"></i> <?= $titulo ?></span>
            <?php if ($tabela === 'medico'): ?>
                <button class="btn btn-primary btn-sm" onclick="agendamentoJs.fCarregarMenu('medico')">
                    <i class="fas fa-plus"></i> Novo Médico
                </button>
            <?php elseif ($tabela === 'usuario'): ?>
                <button class="btn btn-primary btn-sm" onclick="agendamentoJs.fCarregarMenu('usuario')">
                    <i class="fas fa-plus"></i> Novo Paciente
                </button>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
            <div class="table-responsive">
                <table class="table">
                    <thead><tr>
                        <th>#</th><th>Nome</th><th>E-mail</th>
                        <?php if ($tabela==='medico'): ?><th>Especialidade</th>
                        <?php elseif ($tabela==='usuario'): ?><th>CPF</th>
                        <?php elseif ($tabela==='adm'): ?><th>Status</th>
                        <?php endif; ?>
                        <th>Telefone</th><th>Ações</th>
                    </tr></thead>
                    <tbody>
                    <?php if (empty($dados)): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">Nenhum registro encontrado</td></tr>
                    <?php else: foreach ($dados as $row): ?>
                        <tr>
                            <td style="color:var(--gray-400);font-size:.75rem"><?= $row['id'] ?></td>
                            <td>
                                <div style="display:flex;align-items:center;gap:.6rem">
                                    <div style="width:32px;height:32px;border-radius:50%;background:var(--primary-light);display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:700;color:var(--primary);flex-shrink:0">
                                        <?= strtoupper(substr($row['nome'],0,2)) ?>
                                    </div>
                                    <span style="font-weight:500"><?= htmlspecialchars($row['nome']) ?></span>
                                </div>
                            </td>
                            <td style="font-size:.85rem;color:var(--gray-600)"><?= htmlspecialchars($row['email']) ?></td>
                            <?php if ($tabela==='medico'): ?>
                                <td style="font-size:.83rem"><?= htmlspecialchars($row['especialidade'] ?? '—') ?></td>
                            <?php elseif ($tabela==='usuario'): ?>
                                <td style="font-family:monospace;font-size:.82rem"><?= htmlspecialchars($row['cpf'] ?? '—') ?></td>
                            <?php elseif ($tabela==='adm'): ?>
                                <td><span class="badge-consulta <?= $row['ativo'] ? 'badge-realizada' : 'badge-cancelada' ?>"><?= $row['ativo'] ? 'Ativo' : 'Inativo' ?></span></td>
                            <?php endif; ?>
                            <td style="font-size:.85rem;color:var(--gray-600)"><?= htmlspecialchars($row['telefone'] ?? '—') ?></td>
                            <td class="actions">
                                <a href="javascript:void(0)" onclick="admJs.fEditar(<?= $row['id'] ?>,'<?= $tabela ?>')">
                                    <i class="fas fa-user-edit"></i> Editar
                                </a>
                                <a href="javascript:void(0)" class="del" onclick="admJs.fExcluir(<?= $row['id'] ?>,'<?= $tabela ?>','<?= addslashes($row['nome']) ?>')">
                                    <i class="fas fa-trash-alt"></i>
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
