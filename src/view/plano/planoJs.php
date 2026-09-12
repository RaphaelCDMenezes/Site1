<script>
var planoJs = ({
    fNovo:    function () { $.ajax({ url: '/Site1-main/src/controller/planoController.php?action=novo' }).done(function(d){ $('#layoutSidenav_content').html(d); }); },
    fVoltar:  function () { $.ajax({ url: '/Site1-main/src/controller/planoController.php?action=pesquisar' }).done(function(d){ $('#layoutSidenav_content').html(d); }); },
    fSalvar:  function () { $.ajax({ url: '/Site1-main/src/controller/planoController.php', method:'post', data:$('#formPlanoCreate').serialize() }).done(function(d){ $('#layoutSidenav_content').html(d); }); },
    fEditar:  function (id) { $.ajax({ url: '/Site1-main/src/controller/planoController.php', data:{ action:'editar', id_plano:id } }).done(function(d){ $('#layoutSidenav_content').html(d); }); },
    fExcluir: function (id) { if(!confirm('Excluir o plano #'+id+'?')) return; $.ajax({ url: '/Site1-main/src/controller/planoController.php', data:{ action:'excluir', id_plano:id } }).done(function(d){ $('#layoutSidenav_content').html(d); }); }
});
</script>
