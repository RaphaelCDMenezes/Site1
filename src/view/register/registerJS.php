<script>
    var loginJs = ({
        fSalvar: function() {
            $.ajax({
                'url': '/src/controller/registerController.php',
                'method': 'post',
                'data': $('#CriarLogin').serialize()
            }).done(function(dados) {
                $('#layoutAuthentication_content').html(dados);
            })
        },
    });
</script>