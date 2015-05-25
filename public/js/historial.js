
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

    //updatePrecios(id)
}


function setTratamientos() {

    var s_grupos = $("#s_grupos")
    var s_trats = $("#s_tratamientos")
    var gid = 1; // default: preventiva

    for(var i = 0; i < grupos.length; i++) {
        console.log('grupo:' + grupos[i].nombre + ' -- ' + grupos[i].id)
        s_grupos.append(new Option(grupos[i].nombre, grupos[i].id))
    }

    for(t in tratamientos[gid]) {
        console.log('tratamiento:' + tratamientos[gid][t].nombre + ' -- ' + t)
        s_trats.append(new Option(tratamientos[gid][t].nombre, t))
    }

    return false
}
