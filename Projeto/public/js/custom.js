// /public/js/custom.js
$(function () {
        
  
        
    $("#create").on('click', function(event){
        event.preventDefault();
        $.post("add", {
            txtatrcol01: $('#txtatrcol01').val(),
            txtatrcol02: $('#txtatrcol02').val(),
            txtatrcol03: $('#txtatrcol03').val(),
            txtatrcol04: $('#txtatrcol04').val(),
            txtatrcol05: $('#txtatrcol05').val(),
            txtatrcol06: $('#txtatrcol06').val(),
            txtatrcol07: $('#txtatrcol07').val(),
            txtatrcol08: $('#txtatrcol08').val(),
            txtnomelista: $('#txtnomelista').val(),
            idmodulo : $('#idmodulo').val(),
        },
            function(data){
                if(data.response == true){
                    alert('Lista Incluida com sucesso');
                       $('#my-dialog').dialog('destroy');
                   window.setTimeout('location.reload()', 1);
                // print success message
                } else {
                    // print error message
                        alert('Não houve alterações'); 
                }
            }, 'json');
    });

    $('.delete').on('click', function(event){
        event.preventDefault();
        var $lista = $(this);
        var remove_id = $(this).attr('id');
        remove_id = remove_id.replace("remove-","");

        $.post("remove", {
            id: remove_id
        },
        function(data){
            if(data.response == true)
                $lista.parent().remove();
            else{
                // print error message
                console.log('could not remove ');
            }
        }, 'json');
    });
    

    $("#alter").on('click', function(event){
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
            idmodulo : $('#idlista').val()
        },function(data){
            if(data.response == true){
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
                modal: true
            });

            $('.show-modal').click(function() {
                $('#my-dialog').load("editalista/"+this.id, function() {
                    $(this).dialog('open');
                });
                return false;
            });  
            
            $('.show-modal2').click(function() {
                $('#my-dialog').load("novalista/"+this.id, function() {
                    $(this).dialog('open');
                });
                return false;
            });  

   });
