<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <a class="nav-link" href="">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Menu
            </a>
            <?php if ($_SESSION['perfil'] == 'adm') { ?>
            <div class="sb-sidenav-menu-heading">Painel Administrativo</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Cadastros   
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a><?php } ?>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <?php if ($_SESSION['perfil'] == 'adm') { ?>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('medico')">Médico</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('especialidade')">Especialidades</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('usuario')">Paciente</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('upload')">Upload</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('email')">Email</a>
                    <?php } ?>
                </nav>
            </div>

            <?php if ($_SESSION['perfil'] == 'medic') { ?>
            <div class="sb-sidenav-menu-heading">Painel Médico</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Consultas 
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a><?php } ?>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <?php if ($_SESSION['perfil'] == 'medic') { ?>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('medico')">Médico</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('especialidade')">Especialidades</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('usuario')">Paciente</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('upload')">Upload</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('email')">Email</a>
                    <?php } ?>
                </nav>
            </div>

            <?php if ($_SESSION['perfil'] == 'user') { ?>
            <div class="sb-sidenav-menu-heading">Painel Paciente</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Consultas 
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a><?php } ?>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <?php if ($_SESSION['perfil'] == 'user') { ?>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('medico')">Médico</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('especialidade')">Especialidades</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('usuario')">Paciente</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('upload')">Upload</a>
                        <a class="nav-link" href="javascript:void(0)" onclick="agendamentoJs.fCarregarMenu('email')">Email</a>
                    <?php } ?>
                </nav>
            </div>

            <div class="sb-sidenav-menu-heading">Consultas</div>
            <a class="nav-link" href="charts.html">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Agendamento
            </a>
            <a class="nav-link" href="tables.html">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Relatório
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logado como:</div>
        <?= $_SESSION['email'] ?>
    </div>
</nav>