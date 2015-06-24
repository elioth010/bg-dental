
// Se pincha en el select de grupo y actualiza el de tratamientos
function updateSelectTratamientos(gid) {
    console.log('updateSelectTratamientos ' + gid)
    tratamientosSelect = $('#s_tratamientos')[0]
    tratamientosSelect.options.length=0

    if (tratamientos[gid] == undefined) {
        tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- No hay tratamientos --', 0)
    } else {
        //tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- Elija un tratamiento --', 0)

        gtratamientos = tratamientos[gid]
        for(tid in gtratamientos) {
            tratamientosSelect.options[tratamientosSelect.options.length]=new Option(gtratamientos[tid].nombre, tid)
        }
    }

    updatePrecios()
}


function setTratamientos() {

    var s_grupos = $('#s_grupos')
    var s_trats = $('#s_tratamientos')
    var gid = 1; // default: preventiva

    for(var i = 0; i < grupos.length; i++) {
        console.log('grupo:' + grupos[i].nombre + ' -- ' + grupos[i].id)
        s_grupos.append(new Option(grupos[i].nombre, grupos[i].id))
    }

    for(t in tratamientos[gid]) {
        console.log('tratamiento:' + tratamientos[gid][t].nombre + ' -- ' + t)
        s_trats.append(new Option(tratamientos[gid][t].nombre, t))
    }

    updatePrecios();

    return false
}

function updatePrecios() {
    var s_precios = $('#s_precios');
    var gid = $("#s_grupos").val();
    var tid = $("#s_tratamientos").val();
    var precios = tratamientos[gid][tid].precios;
    //var comp_economica = tratamientos[gid][t].compania_economica;

    console.log('updatePrecios gid:' + gid + ' tid:' + tid);

    s_precios.find('option').remove();
    for(p in precios) {
        var texto = companias[p] + " (" + precios[p] + "€)";
        s_precios.append(new Option(texto, precios[p]));
    }

    // TODO: default val
    //s_precios.val(comp_economica)
    //s_precios[0].options[0].value = '00'
}


// Si el tipo es anticipo, comprobar que la cantidad introducida no es mayor que saldon
function validate_cobro(form) {
    console.log('validate_cobro');
    console.debug(form);
    /*
    {{ Form::number('cobrar' ,$historial->precio,  array('class' => 'euros', 'step' => 'any')) }}
    {{ Form::select('tipos_de_cobro_id', $tipos_de_cobro) }}
    */
    return false;
    var valid = true;

    var inputs = $("input[name^='iunidades-']");
    inputs.each(function(index, input){
        if (input.value == 0) {
            valid = false;
        }
    });

    if(!valid) {
        alert('La cantidad a cobrar desde anticipo es mayor que el saldo disponible.');
        return false;
    }
    else {
        // TODO
        return confirm('¿Desea realizar un cobro de' + '0' + ' usando ' + 'Anticipo' + '?');
    }
}
