// /public/js/custom.js
$(function() {
    $("#create").off("click").on('click', function(event) {
        if ($('#txtSenha').val().length< 5) {
            alert('O Campo senha deverá ter 5 digitos'); 
            return false;
        }
        event.preventDefault();
        $.post("caixa/add", {
            txtControle: $('#txtControle').val(),
            txtHistorico: $('#txtHistorico').val(),
            txtNomeOrigem: $('#txtNomeOrigem').val(),
            txtRazaosocial: $('#txtRazaosocial').val(),
            txtNordem: $('#txtNordem').val(),
            txtObsCaixa: $('#txtObsCaixa').val(),
            txtOperacao: $('#txtOperacao').val(),
            txtOptions: $('#txtOptions').val(),
            txtProduto: $('#txtProduto').val(),
            txtQuantidade: $('#txtQuantidade').val(),
            txtValor: $('#txtValor').val(),
            txtSenha: $('#txtSenha').val(),
            selproduto: $('#selproduto option:selected').val(),
        },
                function(data) {
                    if (data.response == true) {
                        alert('Lista Incluida com sucesso');
                    } else {
                        alert('Não houve alterações');
                    }
                }, 'json');
    });


    $('.delete').on('click', function(event) {
        var $lista = $(this);
        var remove_id = $(this).attr('id');
        remove_id = remove_id.replace("remove-", "");
        event.preventDefault();
        $.post("caixa/remove", {
            id: remove_id
        },
        function(data) {
            if (data.response == true) {
                $lista.remove();
                alert('Item Cancelado com sucesso');
            }
            else {
                // print error message
                alert('Erro');
            }
        }, 'json');
    });


    $("#close").off("click").on('click', function(event) {
        $('#my-dialog').dialog('destroy');
    });

    $("#cancel").off("click").on('click', function(event) {
        alert('Itens Selecionados cancelados com sucesso !');
        $('#my-dialog').dialog('destroy');
    });

    $("#alter").on('click', function(event) {
        $('#alter').attr('disabled', 'disabled');
        event.preventDefault();
        $.post("update", {
            txtatrcol01: $('#coluna_1').val(),
            txtatrcol02: $('#coluna_2').val(),
            txtatrcol03: $('#coluna_3').val(),
            txtatrcol04: $('#coluna_4').val(),
            txtatrcol05: $('#coluna_5').val(),
            txtatrcol06: $('#coluna_6').val(),
            txtatrcol07: $('#coluna_7').val(),
            txtatrcol08: $('#coluna_8').val(),
            txtnomelista: $('#titulo_lista').val(),
            idmodulo: $('#idlista').val()
        }, function(data) {
            if (data.response == true) {
                alert('Lista Atualizada com sucesso');
                $('#my-dialog').dialog('destroy');
                window.setTimeout('location.reload()', 1);

                // print success message
            } else {
                // print error message
                alert('Não houve alterações');
                //   $('#alter').removeAttr('disabled');
                // $('#my-dialog').modal('toggle');
            }
        }, 'json');
    });

    $('#my-dialog').dialog({
        autoOpen: false,
        width: 600,
        resizable: false,
        scroll: true,
        modal: true
    });


    $('.show-modal').off("click").click(function() {
        var parametros  ;
          
         if ($('#txtRazaosocial').val() !== "")
            {parametros =$('#txtRazaosocial').val() ;}else{parametros = "xx" }
            
    
         if ($('#txtControle').val() !== "")
            {parametros = parametros + "/" + $('#txtControle').val();}else{parametros = parametros + "/xx" }   
            
             if ($('#txtHistorico').val() !== "")
            {parametros = parametros + "/" + $('#txtHistorico').val();} else{parametros = parametros + "/xx" }   
            
            
            
             if ($('#txtNomeOrigem').val() !== "")
            {parametros = parametros + "/" + $('#txtNomeOrigem').val();} else{parametros = parametros + "/xx" }   
            
             if ($('#txtNordem').val() !== "")
            {parametros = parametros + "/" + $('#txtNordem').val();} else{parametros = parametros + "/xx" }   
            
            
             if ($('#txtObsCaixa').val() !== "")
            {parametros = parametros + "/" + $('#txtObsCaixa').val();} else{parametros = parametros + "/xx" }   
            
           
                if ($('#txtQuantidade').val() !== "")
            {parametros = parametros + "/" + $('#txtQuantidade').val();} else{parametros = parametros + "/777" }   
            
            
                if ($('#txtValor').val() !== "")
            {parametros = parametros + "/" + $('#txtValor').val();} else{parametros = parametros + "/777" }   
            
                if ($('#txtSenha').val() !== "")
            {parametros = parametros + "/" + $('#txtSenha').val();} else{parametros = parametros + "/xx" }   
           
      
      
        
        $('#my-dialog').load("caixa/consultacaixa/" + parametros, function() {
            $(this).dialog('open');
        });
        return false;
    });

    $('.show-modal2').click(function() {
        $('#my-dialog').load("novalista/" + this.id, function() {
            $(this).dialog('open');
        });
        return false;
    });

});
