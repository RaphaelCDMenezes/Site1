<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">E-mail</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Enviar e-mail</li>
        </ol>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <ion-icon name="mail-outline"></ion-icon>
                    </div>
                    <form id="formEmailCreate" enctype="multipart/form-data" action="" onsubmit="return false">
                        <div class="card-body">
                            <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                            <input type="hidden" name="action" value="enviar">
                            <div class="mb-3">
                                <label for="de" class="form-label">De</label>
                                <input type="text" class="form-control" name="de" id="de" placeholder="" value="<?= __EMAIL__ ?>" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="para" class="form-label">Para</label>
                                <input type="email" class="form-control" name="para" id="para" placeholder="Destinatário" value="<?= $email_para ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="assunto" class="form-label">Assunto</label>
                                <input type="text" class="form-control" name="assunto" id="assunto" placeholder="Título" value="<?= $email_assunto ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="corpo" class="form-label">Conteúdo</label>
                                <textarea class="form-control" name="corpo" id="corpo" cols="80" rows="5"><?= $email_corpo ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-end">
                                <button id="email-btn-limpar" class="btn btn-secondary">Limpar</button>
                                <button class="btn btn-primary" onclick="emailJs.fEnviar()">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>