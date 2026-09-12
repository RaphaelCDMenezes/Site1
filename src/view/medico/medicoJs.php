<script>
    var medicoJs = ({
        fNovo: function() {
            $.ajax({
                'url': '/Site1-main/src/controller/medicoController.php?action=novo'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        },
        fVoltar: function() {
            $.ajax({
                'url': '/Site1-main/src/controller/medicoController.php?action=pesquisar'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        },
        fPesquisar: function() {
            $.ajax({
                'url': '/Site1-main/src/controller/medicoController.php?action=pesquisar'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        },
        fSalvar: function() {
            $.ajax({
                'url': '/Site1-main/src/controller/medicoController.php',
                'method': 'post',
                'data': $('#formMedicoCreate').serialize()
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        },
        fEditar: function(id_medico) {
            $.ajax({
                'url': '/Site1-main/src/controller/medicoController.php',
                'data': {
                    'action': 'editar',
                    'id_medico': id_medico
                }
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        },
        fExcluir: function(id_medico) {
            if (confirm('Deseja excluir o médico #' + id_medico + '?')) {
                $.ajax({
                    'url': '/Site1-main/src/controller/medicoController.php',
                    'data': {
                        'action': 'excluir',
                        'id_medico': id_medico
                    }
                }).done(function(dados) {
                    $('#layoutSidenav_content').html(dados);
                });
            }
            return false;
        }
    });

    $(document).ready(function() {
        $('#medico-btn-limpar').click(function() {
            medicoJs.fNovo();
        });
    });
</script>
