
// Convierte las etiquetas en selects
function modificarTurnoClick(day) {
    console.log('modificar turno ' + day);

    $('#selectturnosdia-' + day).show();
    $('#turnosdia-' + day).hide();

    // cambia botones
    $('#modifbutton-' + day).hide();
    $('#incidbutton-' + day).hide();

    $('#modifbuttons-' + day).show();
    $('#modifbuttonc-' + day).show();

}

// Salva la modificación del turno
// PUT y reload

function modificarTurnoSave(day) {
    console.log('save turno ' + day);

    var selector = "[name^='profesional_id-" + day + "']";
    var selects = $(selector);
    var data = {};
    selects.each(function(index, value) {
        console.log(index + ':' + $(this).attr('name') + '  ' + $(this).val());
        data[$(this).attr('name')] = $(this).val();
    });

    var url = $(location).attr('href');
    console.debug(url);

    form = $('<form>').attr({action: url, method: 'PUT'});

    jQuery.each(data, function(name, val) {
        form.append('<input type="hidden" name="' + name + '" value="' + val + '">');
    });
    console.debug(form);
    form.submit();

}

// Cancela la modificación del turno
function modificarTurnoCancel(day) {
    console.log('cancel turno ' + day);

    $('#selectturnosdia-' + day).hide();
    $('#turnosdia-' + day).show();

    $('#modifbutton-' + day).show();
    $('#incidbutton-' + day).show();

    $('#modifbuttons-' + day).hide();
    $('#modifbuttonc-' + day).hide();
}

// Incidencia
function incidenciaClick(day) {
    console.log('incidencia ' + day);
}
