<script>
    var especialidadeJs = ({
        fNovo: function() {
            $.ajax({
                'url': '/src/controller/especialidadeController.php?action=novo'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })

        },
        fVoltar: function() {
            $.ajax({
                'url': '/src/controller/especialidadeController.php?action=pesquisar'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })

        },
        fSalvar: function() {
            $.ajax({
                'url': '/src/controller/especialidadeController.php',
                'method': 'post',
                'data': $('#formespecialidadeCreate').serialize()
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })
        },
        fEditar: function(id_especialidade) {
            $.ajax({
                'url': '/src/controller/especialidadeController.php',
                'data': {
                    'action': 'editar',
                    'id_especialidade': id_especialidade
                }
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })
        },
        fExcluir: function(id_especialidade) {
            if (confirm('Deseja excluir o médico ' + id_especialidade + '?')) {
                $.ajax({
                    'url': '/src/controller/especialidadeController.php',
                    'data': {
                        'action': 'excluir',
                        'id_especialidade': id_especialidade
                    }
                }).done(function(dados) {
                    $('#layoutSidenav_content').html(dados);
                })

            }
            return false;
        },
        fListar: function() {
            $.ajax({
                'url': '/src/controller/especialidadeController.php',
                'method': 'post',
                'data': $('#formespecialidadeCreate').serialize()
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })
        },
        // fSelecionarTodos : function () {
        //     //$('input:checkbox').attr('enabled', true);
        // },
        // fExcluirTodos : function () {
        //     if (confirm('ATENÇÃO! Deseja excluir TODOS??')) {

        //     }
        // }
    });

    $(document).ready(function() {
        /*Exemplo bind botao limpar via JS sem o onclick no botao */
        //document.getElementById('especialidade-btn-limpar').addEventListener('click', especialidadeJs.fNovo);
        $('#especialidade-btn-limpar').click(function () {
            especialidadeJs.fNovo();
        })
    })
</script>