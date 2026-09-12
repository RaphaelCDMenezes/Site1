<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Upload de Arquivos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Envio de arquivos</li>
    </ol>
    <div class="row g-3">

        <!-- Envio -->
        <div class="col-xl-5">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-upload"></i> Enviar arquivo
                </div>
                <form id="formUploadCreate" enctype="multipart/form-data" onsubmit="return false">
                    <div class="card-body">
                        <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                        <input type="hidden" name="action" value="enviar">

                        <!-- Drop zone visual -->
                        <div style="border:2px dashed var(--gray-200);border-radius:10px;padding:2rem;text-align:center;cursor:pointer;transition:border-color .2s;margin-bottom:1rem"
                             onclick="document.getElementById('foto').click()"
                             id="dropzone">
                            <i class="fas fa-cloud-upload-alt fa-2x mb-2" style="color:var(--primary)"></i>
                            <div style="font-weight:500;color:var(--gray-600)">Clique para selecionar</div>
                            <div style="font-size:.78rem;color:var(--gray-400);margin-top:.3rem">ou arraste um arquivo aqui</div>
                        </div>
                        <input type="file" class="form-control" name="foto" id="foto" style="display:none">
                        <div id="file-name-display" style="font-size:.82rem;color:var(--gray-600);min-height:1.4rem"></div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex gap-2 justify-content-end">
                            <button id="upload-btn-limpar" class="btn btn-secondary">
                                <i class="fas fa-eraser"></i> Limpar
                            </button>
                            <button class="btn btn-primary" onclick="uploadJs.fEnviar()">
                                <i class="fas fa-upload"></i> Enviar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de arquivos -->
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-folder-open"></i> Arquivos enviados
                </div>
                <div class="card-body p-0">
                    <?php
                    $arrLista = is_dir(__AGENDAMENTO_DIR_UPLOAD__) ? scandir(__AGENDAMENTO_DIR_UPLOAD__) : [];
                    $arrLista = array_values(array_filter($arrLista, fn($f) => !in_array($f, ['.', '..'])));
                    ?>
                    <?php if (empty($arrLista)): ?>
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                            Nenhum arquivo enviado
                        </div>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                        <?php foreach ($arrLista as $arquivo):
                            $ext  = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
                            $icon = match($ext) {
                                'pdf'  => 'fa-file-pdf text-danger',
                                'doc','docx' => 'fa-file-word text-primary',
                                'xls','xlsx' => 'fa-file-excel text-success',
                                'jpg','jpeg','png','gif','webp' => 'fa-file-image text-warning',
                                default => 'fa-file text-muted'
                            };
                        ?>
                            <li class="list-group-item d-flex align-items-center gap-3 px-4 py-3">
                                <i class="fas <?= $icon ?> fa-lg" style="width:24px;text-align:center"></i>
                                <a href="<?= __AGENDAMENTO_HTTP__ . 'assets/upload/' . rawurlencode($arquivo) ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   style="font-size:.86rem;font-weight:500;flex:1">
                                    <?= htmlspecialchars($arquivo) ?>
                                </a>
                                <span style="font-size:.75rem;color:var(--gray-400)"><?= strtoupper($ext) ?></span>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>
</main>

<script>
document.getElementById('foto').addEventListener('change', function () {
    var dz = document.getElementById('dropzone');
    var nm = document.getElementById('file-name-display');
    if (this.files.length > 0) {
        nm.textContent = '📎 ' + this.files[0].name;
        dz.style.borderColor = 'var(--primary)';
        dz.style.background  = 'var(--primary-light)';
    }
});
document.getElementById('upload-btn-limpar').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('formUploadCreate').reset();
    document.getElementById('file-name-display').textContent = '';
    var dz = document.getElementById('dropzone');
    dz.style.borderColor = '';
    dz.style.background  = '';
});
</script>
