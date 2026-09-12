<nav class="sb-topnav navbar navbar-expand navbar-light">
    <!-- Logo -->
    <a class="masara-logo ps-1" href="/Site1-main/src/view/painel/">
        <div class="logo-icon"><i class="fas fa-heartbeat"></i></div>
        <span><?= __AGENDAMENTO_TITULO__ ?></span>
    </a>

    <!-- Toggle sidebar -->
    <button id="sidebarToggle" class="ms-3"><i class="fas fa-bars"></i></button>

    <!-- Busca -->
    <form class="d-none d-md-flex ms-auto me-3" style="width:280px">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Buscar" />
            <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>

    <!-- Usuário -->
    <ul class="navbar-nav ms-md-0 me-2">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" id="navbarDropdown"
               href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div style="width:32px;height:32px;border-radius:50%;background:var(--primary-light);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:.85rem;">
                    <i class="fas fa-user"></i>
                </div>
                <span class="d-none d-md-inline" style="font-size:.83rem;font-weight:500;color:var(--gray-800)">
                    <?= htmlspecialchars(isset($_SESSION['email']) ? explode('@', $_SESSION['email'])[0] : 'Usuário') ?>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <div class="px-3 py-2 border-bottom" style="font-size:.78rem;">
                        <div style="font-weight:600;color:var(--gray-800)"><?= htmlspecialchars(isset($_SESSION['email']) ? explode('@', $_SESSION['email'])[0] : '') ?></div>
                        <div style="color:var(--gray-400)"><?= htmlspecialchars(isset($_SESSION['email']) ? $_SESSION['email'] : '') ?></div>
                    </div>
                </li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2 text-muted"></i>Configurações</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <a class="dropdown-item text-danger" href="<?= __AGENDAMENTO_HTTP__ ?>src/controller/loginController.php?action=logout">
                        <i class="fas fa-sign-out-alt me-2"></i>Sair
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
