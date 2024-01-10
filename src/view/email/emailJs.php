<script>
    var emailJs = ({
        fConfig : function () {
            $('#corpo').ckeditor()
        },
        fEnviar: function() {
            $.ajax({
                'url': '/src/controller/emailController.php',
                'method': 'post',
                'data': $('#formEmailCreate').serialize()
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            })
        }
    });

    $(document).ready(function() {
        emailJs.fConfig();
    });