<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Enviar E-mail</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">E-mail</li>
    </ol>
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-envelope"></i> Nova Mensagem
                </div>
                <form id="formEmailCreate" enctype="multipart/form-data" action="" onsubmit="return false">
                    <div class="card-body">
                        <?php include_once(__AGENDAMENTO_DIR__ . 'lib/alert.php') ?>
                        <input type="hidden" name="action" value="enviar">

                        <div class="mb-3">
                            <label class="form-label">De</label>
                            <div class="d-flex align-items-center gap-2 p-2"
                                 style="background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:8px">
                                <div style="width:28px;height:28px;border-radius:50%;background:var(--primary-light);display:flex;align-items:center;justify-content:center;color:var(--primary);flex-shrink:0">
                                    <i class="fas fa-user" style="font-size:.7rem"></i>
                                </div>
                                <span style="font-size:.85rem;color:var(--gray-600)"><?= htmlspecialchars(__EMAIL__) ?></span>
                            </div>
                            <input type="hidden" name="de" value="<?= htmlspecialchars(__EMAIL__) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Para <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="para" id="para"
                                   placeholder="destinatario@email.com"
                                   value="<?= htmlspecialchars(isset($email_para) ? $email_para : '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assunto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="assunto" id="assunto"
                                   placeholder="Assunto da mensagem"
                                   value="<?= htmlspecialchars(isset($email_assunto) ? $email_assunto : '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mensagem <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="corpo" id="corpo" rows="8"
                                      placeholder="Escreva sua mensagem aqui..."
                                      style="resize:vertical"><?= htmlspecialchars(isset($email_corpo) ? $email_corpo : '') ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex gap-2 justify-content-end">
                            <button id="email-btn-limpar" class="btn btn-secondary"
                                    onclick="document.getElementById('formEmailCreate').reset();return false;">
                                <i class="fas fa-eraser"></i> Limpar
                            </button>
                            <button class="btn btn-primary" onclick="emailJs.fEnviar()">
                                <i class="fas fa-paper-plane"></i> Enviar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Dica lateral -->
        <div class="col-xl-4">
            <div class="card" style="border:none;background:var(--primary-light)">
                <div class="card-body">
                    <div style="font-weight:600;color:var(--primary);margin-bottom:.75rem">
                        <i class="fas fa-info-circle me-1"></i> Informações
                    </div>
                    <ul style="font-size:.83rem;color:var(--primary-dark);padding-left:1.1rem;line-height:2">
                        <li>Use e-mails válidos no campo "Para"</li>
                        <li>O campo assunto é obrigatório</li>
                        <li>Configure as credenciais SMTP em <code>config.php</code></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
