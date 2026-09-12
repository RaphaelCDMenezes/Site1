<script>
    var loginJs = ({
        fSalvar: function() {
            $.ajax({
                'url': '/Site1-main/src/controller/registerController.php',
                'method': 'post',
                'data': $('#CriarLogin').serialize()
            }).done(function(dados) {
                $('#layoutAuthentication_content').html(dados);
            })
        },
    });
</script>