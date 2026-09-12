<?php
$totalMedicos  = mysqli_query($conexao,"SELECT COUNT(*) FROM medico")->fetch_row()[0] ?? 0;
$totalPacientes= mysqli_query($conexao,"SELECT COUNT(*) FROM usuario")->fetch_row()[0] ?? 0;
$totalConsultas= mysqli_query($conexao,"SELECT COUNT(*) FROM consulta")->fetch_row()[0] ?? 0;
$totalAdms     = mysqli_query($conexao,"SELECT COUNT(*) FROM adm")->fetch_row()[0] ?? 0;
?>
<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Painel Administrativo</h1>
    <ol class="breadcrumb mb-4"><li class="breadcrumb-item active">Gestão Geral</li></ol>

    <!-- Stats -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card stat-blue" style="cursor:pointer" onclick="admJs.fListar('medico')">
                <div class="stat-icon"><i class="fas fa-user-md"></i></div>
                <div><div class="stat-label">Médicos</div><div class="stat-value"><?= $totalMedicos ?></div></div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card stat-green" style="cursor:pointer" onclick="admJs.fListar('usuario')">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div><div class="stat-label">Pacientes</div><div class="stat-value"><?= $totalPacientes ?></div></div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card stat-teal" style="cursor:pointer" onclick="agendamentoJs.fCarregarMenu('consulta')">
                <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                <div><div class="stat-label">Consultas</div><div class="stat-value"><?= $totalConsultas ?></div></div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card stat-orange" style="cursor:pointer" onclick="admJs.fListar('adm')">
                <div class="stat-icon"><i class="fas fa-user-shield"></i></div>
                <div><div class="stat-label">Administradores</div><div class="stat-value"><?= $totalAdms ?></div></div>
            </div>
        </div>
    </div>

    <!-- Ações rápidas -->
    <div class="row g-3">
        <?php
        $acoes = [
            ['icon'=>'fa-user-md','cor'=>'#dbeafe','cortxt'=>'#1e40af','titulo'=>'Médicos','desc'=>'Cadastrar, editar, alterar senha','fn'=>"admJs.fListar('medico')"],
            ['icon'=>'fa-users','cor'=>'#d1fae5','cortxt'=>'#065f46','titulo'=>'Pacientes','desc'=>'Cadastrar, editar, alterar senha','fn'=>"admJs.fListar('usuario')"],
            ['icon'=>'fa-calendar-plus','cor'=>'#fce7f3','cortxt'=>'#9d174d','titulo'=>'Consultas','desc'=>'Agendar, cancelar, gerenciar','fn'=>"agendamentoJs.fCarregarMenu('consulta')"],
            ['icon'=>'fa-stethoscope','cor'=>'#e0f2fe','cortxt'=>'#0369a1','titulo'=>'Especialidades','desc'=>'Tipos de especialidade','fn'=>"agendamentoJs.fCarregarMenu('especialidade')"],
            ['icon'=>'fa-file-medical','cor'=>'#ede9fe','cortxt'=>'#6d28d9','titulo'=>'Planos','desc'=>'Criar e gerenciar planos','fn'=>"agendamentoJs.fCarregarMenu('plano')"],
            ['icon'=>'fa-user-shield','cor'=>'#fef3c7','cortxt'=>'#92400e','titulo'=>'Administradores','desc'=>'Gerenciar logins de ADM','fn'=>"admJs.fListar('adm')"],
            ['icon'=>'fa-envelope','cor'=>'#f0fdf4','cortxt'=>'#15803d','titulo'=>'E-mail','desc'=>'Enviar mensagens','fn'=>"agendamentoJs.fCarregarMenu('email')"],
            ['icon'=>'fa-upload','cor'=>'#fff7ed','cortxt'=>'#c2410c','titulo'=>'Upload','desc'=>'Gerenciar arquivos','fn'=>"agendamentoJs.fCarregarMenu('upload')"],
        ];
        foreach ($acoes as $a): ?>
        <div class="col-sm-6 col-xl-3">
            <div class="card" style="cursor:pointer;transition:all .2s" onclick="<?= $a['fn'] ?>"
                 onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,.1)'"
                 onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div class="card-body d-flex align-items-center gap-3">
                    <div style="width:44px;height:44px;border-radius:11px;background:<?= $a['cor'] ?>;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="fas <?= $a['icon'] ?>" style="color:<?= $a['cortxt'] ?>;font-size:1rem"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:.9rem"><?= $a['titulo'] ?></div>
                        <div style="font-size:.75rem;color:var(--gray-400)"><?= $a['desc'] ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</main>
