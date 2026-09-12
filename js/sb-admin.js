/**
 * sb-admin.js — Lógica do layout do painel Masara
 * Toggle da sidebar e comportamento responsivo
 */
document.addEventListener('DOMContentLoaded', function () {

    // Botão de toggle da sidebar
    var sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem(
                'sb|sidebar-toggle',
                document.body.classList.contains('sb-sidenav-toggled')
            );
        });
    }

    // Restaura estado da sidebar ao carregar
    if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        document.body.classList.add('sb-sidenav-toggled');
    }

});
