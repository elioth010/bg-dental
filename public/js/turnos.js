
// Convierte las etiquetas en selects
function modificarTurnoClick(day) {
    log('modificar turno ' + day);

    $('#selectturnosdia-' + day).show();
    $('#turnosdia-' + day).hide();

    // cambia botones
    $('#modifbutton-' + day).hide();
    $('#incidbutton-' + day).hide();

    $('#modifbuttons-' + day).show();
    $('#modifbuttonc-' + day).show();

}

// Cancela la modificación del turno
function modificarTurnoCancel(day) {
    log('cancel turno ' + day);

    $('#selectturnosdia-' + day).hide();
    $('#turnosdia-' + day).show();

    $('#modifbutton-' + day).show();
    $('#incidbutton-' + day).show();

    $('#modifbuttons-' + day).hide();
    $('#modifbuttonc-' + day).hide();
}

// Incidencia
function incidenciaClick(day) {
    log('incidenciaClick ' + day);

    $('#incidenciasdia-' + day).show();

    $('#turno_id-' + day).val('M1')
    $('#incidencia_text-' + day).val(incidencias[day]['M1']);

    $('#modifbutton-' + day).hide();
    $("#incidbutton-" + day).hide();

    $('#incidbuttons-' + day).show();
    $('#incidbuttonc-' + day).show();
}

function incidenciaCancel(day) {
    log('incidenciaCancel ' + day);

    $('#incidenciasdia-' + day).hide();

    $('#modifbutton-' + day).show();
    $("#incidbutton-" + day).show();

    $('#incidbuttons-' + day).hide();
    $('#incidbuttonc-' + day).hide();
}

function selectIncidenciaChange(day) {
    log('incidenciaChange ' + day);

    var turno = $('#turno_id-' + day).val();
    $('#incidencia_text-' + day).val(incidencias[day][turno]);

}
