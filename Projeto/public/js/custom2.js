// /public/js/custom.js

jQuery(function($) {
    $("#create").on('click', function(event){
        event.preventDefault();
        $.post("../add", {
            coluna_1: $('#coluna_1').val(),
            coluna_2: $('#coluna_2').val(),
            coluna_3: $('#coluna_3').val(),
            coluna_4: $('#coluna_4').val(),
            coluna_5: $('#coluna_5').val(),
            coluna_6: $('#coluna_6').val(),
            coluna_7: $('#coluna_7').val(),
            coluna_8: $('#coluna_8').val(),
            idlista : $('#idlista').val()
        },
            function(data){
                if(data.response == true){
                    alert('Registro Incluido com sucesso');
                     window.close();
                    window.setTimeout('location.reload()', 3000);
                // print success message
                } else {
                    // print error message
                    console.log('could not add');
                    window.close();
                    window.setTimeout('location.reload()', 3000);
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
                {
                $lista.parent().remove(); 
                window.setTimeout('location.reload()', 1000);
                }
                else{
                // print error message
                console.log('could not remove ');
            }
        }, 'json');
    });
    
jQuery(function($) {
    $("#alter").on('click', function(event){
     $('#alter').attr('disabled', 'disabled');  
        event.preventDefault();
        $.post("../../update", {
             coluna_1: $('#coluna_1').val(),
            coluna_2: $('#coluna_2').val(),
            coluna_3: $('#coluna_3').val(),
            coluna_4: $('#coluna_4').val(),
            coluna_5: $('#coluna_5').val(),
            coluna_6: $('#coluna_6').val(),
            coluna_7: $('#coluna_7').val(),
            coluna_8: $('#coluna_8').val(),
            idregistro : $('#idregistro').val(),
            idlista : $('#idlista').val()
        },function(data){
            if(data.response == true){
                    alert('Lista Atualizada com sucesso');
                // print success message
                } else {
                    // print error message
                      alert('Não houve alterações');
                     $('#alter').removeAttr('disabled');
                }
        }, 'json');
      });

    });
});