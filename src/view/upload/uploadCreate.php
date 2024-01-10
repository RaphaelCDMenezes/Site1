<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Upload de arquivo</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Envio de fotos</li>
        </ol>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-upload me-1"></i>
                    </div>
                    <form id="formUploadCreate" enctype="multipart/form-data" onsubmit="return false">
                        <div class="card-body">
                            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                            <input type="hidden" name="action" value="enviar">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="file" class="form-control" name="foto" id="foto" placeholder="Escolha uma foto" value="" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-end">
                                <button id="upload-btn-limpar" class="btn btn-secondary">Limpar</button>
                                <button class="btn btn-primary" onclick="uploadJs.fEnviar()">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <span>Lista de arquivos</span>
                    </div>
                    <div class="card-body">
                        <?php
                        $arrLista = scandir(__AGENDAMENTO_DIR_UPLOAD__);
                        array_shift($arrLista);
                        array_shift($arrLista);
                        if (count($arrLista) > 0) {
                            foreach ($arrLista as $arquivo) { ?>
                                <div>
                                    <a href="<?= __AGENDAMENTO_HTTP__ . 'assets/upload/' . $arquivo ?>" target="_blank" rel="noopener noreferrer"><?= $arquivo ?>
                                    </a>
                                </div>

                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
</main>