<script>
    var especialidadeJs = ({
        fNovo: function() {
            $.ajax({
                'url': '/Site1-main/src/controller/especialidadeController.php?action=novo'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        },
        fVoltar: function() {
            $.ajax({
                'url': '/Site1-main/src/controller/especialidadeController.php?action=pesquisar'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        },
        fPesquisar: function() {
            $.ajax({
                'url': '/Site1-main/src/controller/especialidadeController.php?action=pesquisar'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        },
        fSalvar: function() {
            $.ajax({
                'url': '/Site1-main/src/controller/especialidadeController.php',
                'method': 'post',
                'data': $('#formespecialidadeCreate').serialize()
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        },
        fEditar: function(id_especialidade) {
            $.ajax({
                'url': '/Site1-main/src/controller/especialidadeController.php',
                'data': {
                    'action': 'editar',
                    'id_especialidade': id_especialidade
                }
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        },
        fExcluir: function(id_especialidade) {
            if (confirm('Deseja excluir a especialidade #' + id_especialidade + '?')) {
                $.ajax({
                    'url': '/Site1-main/src/controller/especialidadeController.php',
                    'data': {
                        'action': 'excluir',
                        'id_especialidade': id_especialidade
                    }
                }).done(function(dados) {
                    $('#layoutSidenav_content').html(dados);
                });
            }
            return false;
        }
    });

    $(document).ready(function() {
        $('#especialidade-btn-limpar').click(function() {
            especialidadeJs.fNovo();
        });
    });
</script>
