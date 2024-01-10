<script>
    var uploadJs = ({
        fEnviar: function() {
            var formData = new FormData($('#formUploadCreate')[0]);
            $.ajax({
                'url': '/src/controller/uploadController.php',
                'method': 'post',
                'data': formData,
                'async': true,
                'cache': false,
                'contentType': false,
                'processData': false
            }).done(function(dados) {
                $('#layoutSidenav_content').html(dados);
            });
        }
    });
</script>