
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
