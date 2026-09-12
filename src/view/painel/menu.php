<?php $perfil = $_SESSION['perfil'] ?? ''; ?>
<nav class="sb-sidenav accordion" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

        <?php if ($perfil === 'adm'): ?>
            <!-- ═══ ADMINISTRADOR ═══ -->
            <div class="sb-sidenav-menu-heading">Painel</div>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('admpainel')">
                <div class="sb-nav-link-icon"><i class="fas fa-th-large"></i></div>Início
            </a>

            <div class="sb-sidenav-menu-heading">Cadastros</div>
            <a class="nav-link" href="javascript:void(0)" onclick="admJs.fListar('medico')">
                <div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>Médicos
            </a>
            <a class="nav-link" href="javascript:void(0)" onclick="admJs.fListar('usuario')">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Pacientes
            </a>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('especialidade')">
                <div class="sb-nav-link-icon"><i class="fas fa-stethoscope"></i></div>Especialidades
            </a>
            <a class="nav-link" href="javascript:void(0)" onclick="admJs.fListar('adm')">
                <div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>Administradores
            </a>

            <div class="sb-sidenav-menu-heading">Operações</div>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('consulta')">
                <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>Consultas
            </a>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('plano')">
                <div class="sb-nav-link-icon"><i class="fas fa-file-medical"></i></div>Planos
            </a>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('email')">
                <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>E-mail
            </a>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('upload')">
                <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>Upload
            </a>

        <?php elseif ($perfil === 'medic'): ?>
            <!-- ═══ MÉDICO ═══ -->
            <div class="sb-sidenav-menu-heading">Painel Médico</div>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('dashboard')">
                <div class="sb-nav-link-icon"><i class="fas fa-th-large"></i></div>Dashboard
            </a>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('consulta')">
                <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>Minhas Consultas
            </a>

        <?php elseif ($perfil === 'user'): ?>
            <!-- ═══ PACIENTE ═══ -->
            <div class="sb-sidenav-menu-heading">Minha Área</div>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('dashboard')">
                <div class="sb-nav-link-icon"><i class="fas fa-th-large"></i></div>Início
            </a>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('consulta')">
                <div class="sb-nav-link-icon"><i class="fas fa-calendar-plus"></i></div>Minhas Consultas
            </a>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('plano')">
                <div class="sb-nav-link-icon"><i class="fas fa-file-medical"></i></div>Planos Disponíveis
            </a>
            <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('servicos')">
                <div class="sb-nav-link-icon"><i class="fas fa-hospital"></i></div>Nossos Serviços
            </a>
        <?php endif; ?>

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logado como
            <?php
            $labels = ['adm'=>'Administrador','medic'=>'Médico','user'=>'Paciente'];
            echo $labels[$perfil] ?? $perfil;
            ?>
        </div>
        <span><?= htmlspecialchars($_SESSION['email'] ?? '') ?></span>
    </div>
</nav>
