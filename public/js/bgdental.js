function initSelectSedes() {
    $("input[name='sede-4']").change(function() {
        if($(this).is(":checked")) {
            marcarSedes(true);
        } else {
            marcarSedes(false);
        }
    });

    var todas_checked = $("input[name='sede-4']").is(':checked');
    if (todas_checked) {
        marcarSedes(true);
    }
}

// Cuando marca Todas se desactivan las demás
function marcarSedes(value) {
    var inputs = $("input[name^='sede-']");
    inputs.each(function(index, input){
        if (input.name != 'sede-4') {
            input.disabled = value;
        }
    });
}


// Mensaje genérico para confirmar la eliminación de cualquier cosa
function confirm_eliminar() {
    return confirm('¿Desea eliminar el componente?');
}
