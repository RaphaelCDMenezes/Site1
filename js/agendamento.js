/**
 * agendamento.js
 * Lógica central de navegação AJAX do sistema Masara.
 * Responsável por carregar os módulos do painel sem recarregar a página.
 */

var agendamentoJs = (function () {

    /**
     * Carrega um módulo no painel via AJAX.
     * @param {string} modulo - Nome do módulo: 'medico', 'especialidade', 'usuario', 'upload', 'email'
     */
    function fCarregarMenu(modulo) {
        var url = '';

        switch (modulo) {
            case 'medico':
                url = '/Site1-main/src/controller/medicoController.php?action=pesquisar';
                break;
            case 'especialidade':
                url = '/Site1-main/src/controller/especialidadeController.php?action=pesquisar';
                break;
            case 'usuario':
                url = '/Site1-main/src/controller/usuarioController.php?action=pesquisar';
                break;
            case 'upload':
                url = '/Site1-main/src/controller/uploadController.php?action=pesquisar';
                break;
            case 'email':
                url = '/Site1-main/src/controller/emailController.php?action=pesquisar';
                break;
            default:
                console.warn('Módulo desconhecido: ' + modulo);
                return;
        }

        $.ajax({
            url: url,
            method: 'GET'
        }).done(function (dados) {
            $('#layoutSidenav_content').html(dados);
        }).fail(function () {
            $('#layoutSidenav_content').html(
                '<div class="container-fluid px-4 mt-4">' +
                '<div class="alert alert-danger">Erro ao carregar o módulo. Tente novamente.</div>' +
                '</div>'
            );
        });
    }

    return {
        fCarregarMenu: fCarregarMenu
    };

})();
