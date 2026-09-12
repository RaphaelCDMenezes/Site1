<?php $perfil = $_SESSION['perfil'] ?? ''; ?>
<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Planos de Saúde</h1>
    <ol class="breadcrumb mb-4"><li class="breadcrumb-item active">Planos disponíveis</li></ol>

    <?php if ($perfil === 'adm'): ?>
    <!-- ADM: tabela gerenciável -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="fas fa-file-medical me-1"></i> Gerenciar Planos</span>
            <button class="btn btn-primary btn-sm" onclick="planoJs.fNovo()">
                <i class="fas fa-plus"></i> Novo Plano
            </button>
        </div>
        <div class="card-body">
            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
            <div class="table-responsive">
                <table class="table">
                    <thead><tr><th>Plano</th><th>Descrição</th><th>Preço/mês</th><th>Status</th><th>Ações</th></tr></thead>
                    <tbody>
                    <?php if (empty($arrPlanos)): ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">Nenhum plano cadastrado</td></tr>
                    <?php else: foreach ($arrPlanos as $p): ?>
                        <tr>
                            <td style="font-weight:600"><?= htmlspecialchars($p['nome']) ?></td>
                            <td style="font-size:.85rem;color:var(--gray-600)"><?= htmlspecialchars(mb_substr($p['descricao'],0,60)) ?>...</td>
                            <td style="font-weight:700;color:var(--primary)">R$ <?= number_format($p['preco'],2,',','.') ?></td>
                            <td>
                                <span class="badge-consulta <?= $p['ativo'] ? 'badge-realizada' : 'badge-cancelada' ?>">
                                    <?= $p['ativo'] ? 'Ativo' : 'Inativo' ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="javascript:void(0)" onclick="planoJs.fEditar(<?= $p['id_plano'] ?>)"><i class="fas fa-pencil-alt"></i> Editar</a>
                                <a href="javascript:void(0)" class="del" onclick="planoJs.fExcluir(<?= $p['id_plano'] ?>)"><i class="fas fa-trash-alt"></i> Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php else: ?>
    <!-- Paciente / Médico: cards visuais -->
    <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
    <div class="row g-3 mb-4">
        <?php foreach ($arrPlanos ?? [] as $p):
            $bens = array_filter(explode(';', $p['beneficios']));
            $cores = ['#dbeafe','#d1fae5','#ede9fe'];
            $icores = ['fas fa-star','fas fa-heart','fas fa-crown'];
            static $ci = 0;
            $cor  = $cores[$ci % 3];
            $ico  = $icores[$ci % 3];
            $ci++;
        ?>
        <div class="col-md-4">
            <div class="card h-100" style="border:2px solid transparent;transition:all .2s"
                 onmouseover="this.style.borderColor='var(--primary)'"
                 onmouseout="this.style.borderColor='transparent'">
                <div class="card-body">
                    <div style="width:48px;height:48px;border-radius:12px;background:<?= $cor ?>;display:flex;align-items:center;justify-content:center;margin-bottom:1rem">
                        <i class="<?= $ico ?>" style="font-size:1.2rem;color:var(--primary)"></i>
                    </div>
                    <h5 style="font-weight:700;margin-bottom:.3rem"><?= htmlspecialchars($p['nome']) ?></h5>
                    <p style="font-size:.83rem;color:var(--gray-400);margin-bottom:1rem"><?= htmlspecialchars($p['descricao']) ?></p>
                    <div style="font-size:1.6rem;font-weight:800;color:var(--primary);margin-bottom:1rem">
                        R$ <?= number_format($p['preco'],2,',','.') ?>
                        <span style="font-size:.8rem;font-weight:400;color:var(--gray-400)">/mês</span>
                    </div>
                    <ul style="list-style:none;padding:0;margin:0;font-size:.83rem;line-height:2">
                        <?php foreach ($bens as $b): ?>
                            <li><i class="fas fa-check-circle text-success me-2"></i><?= htmlspecialchars(trim($b)) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php if ($perfil === 'user'): ?>
                <div class="card-footer" style="background:transparent;border-top:1px solid var(--gray-200)">
                    <button class="btn btn-outline-primary w-100" style="border-radius:9px">
                        <i class="fas fa-handshake me-1"></i> Contratar Plano
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
</main>
