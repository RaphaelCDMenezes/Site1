/**
 * agendamento.js — Navegação AJAX do painel Masara
 */
var agendamentoJs = (function () {

    var urls = {
        dashboard:     '/Site1-main/src/view/painel/dashboardPaciente.php',
        admpainel:     '/Site1-main/src/controller/admController.php?action=painel',
        medico:        '/Site1-main/src/controller/medicoController.php?action=pesquisar',
        especialidade: '/Site1-main/src/controller/especialidadeController.php?action=pesquisar',
        usuario:       '/Site1-main/src/controller/usuarioController.php?action=pesquisar',
        upload:        '/Site1-main/src/controller/uploadController.php?action=pesquisar',
        email:         '/Site1-main/src/controller/emailController.php?action=pesquisar',
        consulta:      '/Site1-main/src/controller/consultaController.php?action=pesquisar',
        plano:         '/Site1-main/src/controller/planoController.php?action=pesquisar',
        servicos:      '/Site1-main/src/view/painel/servicos.php',
        agenda:        '/Site1-main/src/view/painel/conteudo.php'
    };

    function fCarregarMenu(modulo) {
        var url = urls[modulo];
        if (!url) { console.warn('Módulo desconhecido: ' + modulo); return; }

        $.ajax({ url: url, method: 'GET' })
            .done(function (dados) { $('#layoutSidenav_content').html(dados); })
            .fail(function () {
                $('#layoutSidenav_content').html(
                    '<div class="container-fluid px-4 mt-4"><div class="alert alert-danger">' +
                    '<i class="fas fa-exclamation-triangle me-2"></i>Erro ao carregar o módulo.</div></div>'
                );
            });
    }

    return { fCarregarMenu: fCarregarMenu };
})();
