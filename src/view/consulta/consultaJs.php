<script>
var consultaJs = ({
    fNovo: function () {
        $.ajax({ url: '/Site1-main/src/controller/consultaController.php?action=novo' })
         .done(function (d) { $('#layoutSidenav_content').html(d); });
    },
    fVoltar: function () {
        $.ajax({ url: '/Site1-main/src/controller/consultaController.php?action=pesquisar' })
         .done(function (d) { $('#layoutSidenav_content').html(d); });
    },
    fSalvar: function () {
        $.ajax({ url: '/Site1-main/src/controller/consultaController.php', method: 'post',
                 data: $('#formConsultaCreate').serialize() })
         .done(function (d) { $('#layoutSidenav_content').html(d); });
    },
    fRealizada: function (id) {
        if (!confirm('Marcar consulta #' + id + ' como realizada?')) return false;
        $.ajax({ url: '/Site1-main/src/controller/consultaController.php',
                 data: { action: 'realizada', id_consulta: id } })
         .done(function (d) { $('#layoutSidenav_content').html(d); });
    },
    fCancelarModal: function (id) {
        $('#idConsultaCancelar').val(id);
        $('#motivoCancelamento').val('');
        var modal = new bootstrap.Modal(document.getElementById('modalCancelar'));
        modal.show();
    },
    fConfirmarCancelamento: function () {
        var id     = $('#idConsultaCancelar').val();
        var motivo = $('#motivoCancelamento').val().trim();
        if (!motivo) { alert('Informe o motivo do cancelamento'); return; }
        bootstrap.Modal.getInstance(document.getElementById('modalCancelar')).hide();
        $.ajax({ url: '/Site1-main/src/controller/consultaController.php', method: 'post',
                 data: { action: 'cancelar', id_consulta: id, motivo_cancelamento: motivo } })
         .done(function (d) { $('#layoutSidenav_content').html(d); });
    },
    fCancelarDireto: function (id) {
        if (!confirm('Deseja cancelar a consulta #' + id + '?')) return false;
        $.ajax({ url: '/Site1-main/src/controller/consultaController.php', method: 'post',
                 data: { action: 'cancelar', id_consulta: id, motivo_cancelamento: 'Cancelado pelo médico' } })
         .done(function (d) { $('#layoutSidenav_content').html(d); });
    },
    fExcluir: function (id) {
        if (!confirm('Excluir permanentemente a consulta #' + id + '?')) return false;
        $.ajax({ url: '/Site1-main/src/controller/consultaController.php',
                 data: { action: 'excluir', id_consulta: id } })
         .done(function (d) { $('#layoutSidenav_content').html(d); });
    }
});
</script>
