<script>
    var medicoJs = ({
        fNovo: function() {
            $.ajax({
                'url': '/src/controller/medicoController.php?action=novo'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })

        },
        fVoltar: function() {
            $.ajax({
                'url': '/src/controller/medicoController.php?action=pesquisar'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })

        },
        fSalvar: function() {
            $.ajax({
                'url': '/src/controller/medicoController.php',
                'method': 'post',
                'data': $('#formMedicoCreate').serialize()
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })
        },
        fEditar: function(id_medico) {
            $.ajax({
                'url': '/src/controller/medicoController.php',
                'data': {
                    'action': 'editar',
                    'id_medico': id_medico
                }
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })
        },
        fExcluir: function(id_medico) {
            if (confirm('Deseja excluir o médico ' + id_medico + '?')) {
                $.ajax({
                    'url': '/src/controller/medicoController.php',
                    'data': {
                        'action': 'excluir',
                        'id_medico': id_medico
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
                'data': $('#formMedicoCreate').serialize()
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
        //document.getElementById('medico-btn-limpar').addEventListener('click', medicoJs.fNovo);
        $('#medico-btn-limpar').click(function () {
            medicoJs.fNovo();
        })
    })
</script>