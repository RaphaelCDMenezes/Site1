<script>
var admJs = ({
    fListar: function (tabela) {
        $.ajax({ url: '/Site1-main/src/controller/admController.php', data:{ action:'listar', tabela:tabela } })
         .done(function(d){ $('#layoutSidenav_content').html(d); });
    },
    fEditar: function (id, tabela) {
        $.ajax({ url: '/Site1-main/src/controller/admController.php', data:{ action:'editar', id:id, tabela:tabela } })
         .done(function(d){ $('#layoutSidenav_content').html(d); });
    },
    fSalvar: function () {
        $.ajax({ url: '/Site1-main/src/controller/admController.php', method:'post', data:$('#formAdmEditar').serialize() })
         .done(function(d){ $('#layoutSidenav_content').html(d); });
    },
    fExcluir: function (id, tabela, nome) {
        if (!confirm('Excluir "' + nome + '"? Esta ação não pode ser desfeita.')) return;
        $.ajax({ url: '/Site1-main/src/controller/admController.php', data:{ action:'excluir', id:id, tabela:tabela } })
         .done(function(d){ $('#layoutSidenav_content').html(d); });
    }
});
</script>
