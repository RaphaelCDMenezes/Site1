<?php
if (!defined('__AGENDAMENTO_DIR__')) {
    require_once('../../../lib/config.php');
}
?><main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Nossos Serviços</h1>
    <ol class="breadcrumb mb-4"><li class="breadcrumb-item active">Serviços</li></ol>

    <!-- Hero -->
    <div class="card mb-4" style="background:linear-gradient(135deg,#0a1628,#0f6fff);border:none;overflow:hidden">
        <div class="card-body p-4" style="color:#fff">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 style="font-weight:700;color:#fff">Cuidamos da sua saúde com excelência</h2>
                    <p style="color:rgba(255,255,255,.7);margin:0">Conheça todos os serviços que o <?= __AGENDAMENTO_TITULO__ ?> oferece para você e sua família.</p>
                </div>
                <div class="col-md-4 text-end d-none d-md-block">
                    <i class="fas fa-hospital" style="font-size:5rem;color:rgba(255,255,255,.15)"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de serviço -->
    <div class="row g-3">
        <?php
        $servicos = [
            ['icon'=>'fa-calendar-check','cor'=>'#dbeafe','ctxt'=>'#1e40af','titulo'=>'Agendamento Online','desc'=>'Marque consultas com facilidade em qualquer horário, sem filas ou ligações telefônicas.'],
            ['icon'=>'fa-user-md','cor'=>'#d1fae5','ctxt'=>'#065f46','titulo'=>'Especialistas Qualificados','desc'=>'Nosso corpo clínico conta com médicos especialistas em diversas áreas da medicina.'],
            ['icon'=>'fa-heartbeat','cor'=>'#fce7f3','ctxt'=>'#9d174d','titulo'=>'Acompanhamento Contínuo','desc'=>'Histórico completo de consultas e atendimentos para um acompanhamento personalizado.'],
            ['icon'=>'fa-flask','cor'=>'#ede9fe','ctxt'=>'#6d28d9','titulo'=>'Exames Laboratoriais','desc'=>'Exames com resultados rápidos e acesso digital, disponíveis em nossa plataforma.'],
            ['icon'=>'fa-ambulance','cor'=>'#fff7ed','ctxt'=>'#c2410c','titulo'=>'Atendimento de Urgência','desc'=>'Equipe disponível para atendimentos emergenciais com agilidade e segurança.'],
            ['icon'=>'fa-pills','cor'=>'#fef3c7','ctxt'=>'#92400e','titulo'=>'Orientação Farmacêutica','desc'=>'Suporte com receitas médicas e orientação sobre medicamentos e tratamentos.'],
            ['icon'=>'fa-comments','cor'=>'#e0f2fe','ctxt'=>'#0369a1','titulo'=>'Telemedicina','desc'=>'Consultas online com médicos especializados sem precisar sair de casa.'],
            ['icon'=>'fa-shield-alt','cor'=>'#f0fdf4','ctxt'=>'#15803d','titulo'=>'Planos Personalizados','desc'=>'Planos de saúde com coberturas flexíveis para você e toda a sua família.'],
        ];
        foreach ($servicos as $s):
        ?>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100" style="transition:all .2s"
                 onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,.1)'"
                 onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div class="card-body">
                    <div style="width:46px;height:46px;border-radius:12px;background:<?= $s['cor'] ?>;display:flex;align-items:center;justify-content:center;margin-bottom:.9rem">
                        <i class="fas <?= $s['icon'] ?>" style="color:<?= $s['ctxt'] ?>;font-size:1.1rem"></i>
                    </div>
                    <h6 style="font-weight:700;margin-bottom:.4rem"><?= $s['titulo'] ?></h6>
                    <p style="font-size:.82rem;color:var(--gray-400);margin:0"><?= $s['desc'] ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-4 p-4 text-center" style="background:var(--primary-light);border-radius:12px">
        <p style="font-size:1rem;font-weight:600;color:var(--primary);margin-bottom:.75rem">Pronto para cuidar da sua saúde?</p>
        <button class="btn btn-primary" onclick="agendamentoJs.fCarregarMenu('consulta')">
            <i class="fas fa-calendar-plus me-2"></i>Agendar Consulta Agora
        </button>
    </div>
</div>
</main>
