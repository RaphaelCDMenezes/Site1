<?php
// Exibe mensagens de erro
if (!empty($arrMsgErro)) {
    foreach ($arrMsgErro as $msg) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-1"></i>
            <?= htmlspecialchars($msg) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php }
}

// Exibe mensagens de sucesso
if (!empty($arrMsgSucesso)) {
    foreach ($arrMsgSucesso as $msg) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i>
            <?= htmlspecialchars($msg) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php }
}
?>
