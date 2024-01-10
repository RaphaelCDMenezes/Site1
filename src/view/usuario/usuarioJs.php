<script>
    var usuarioJs = ({
        fNovo: function() {
            $.ajax({
                'url': '/src/controller/usuarioController.php?action=novo'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })

        },
        fVoltar: function() {
            $.ajax({
                'url': '/src/controller/usuarioController.php?action=pesquisar'
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })

        },
        fSalvar: function() {
            $.ajax({
                'url': '/src/controller/usuarioController.php',
                'method': 'post',
                'data': $('#formUsuarioCreate').serialize()
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })
        },
        fEditar: function(id_usuario) {
            $.ajax({
                'url': '/src/controller/usuarioController.php',
                'data': {
                    'action': 'editar',
                    'id_usuario': id_usuario
                }
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })
        },
        fExcluir: function(id_usuario) {
            if (confirm('Deseja excluir o médico ' + id_usuario + '?')) {
                $.ajax({
                    'url': '/src/controller/usuarioController.php',
                    'data': {
                        'action': 'excluir',
                        'id_usuario': id_usuario
                    }
                }).done(function(dados) {
                    $('#layoutSidenav_content').html(dados);
                })

            }
            return false;
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
        //document.getElementById('usuario-btn-limpar').addEventListener('click', usuarioJs.fNovo);
        $('#usuario-btn-limpar').click(function () {
            usuarioJs.fNovo();
        })
    })
</script>