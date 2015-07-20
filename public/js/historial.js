/**
 * @function log()
 * esta funcion verificara que exista la instancia consola y si existe escribira los parametros 
 * en la misma debido a que IE no soporta la funcion console.log asi que se dejara de imprimir en navegadores 
 * con IE, se remplaza en la implementacion toda la parte de la consola con con la funcion log
 * para poder imprimir
 */
window.log = function () {
    if (this.console && this.console.log) {
        this.console.log(Array.prototype.slice.call(arguments));
    }
};


// Se pincha en el select de grupo y actualiza el de tratamientos
function updateSelectTratamientos(gid) {
    log('updateSelectTratamientos ' + gid);
    //tratamientosSelect = $('#s_tratamientos')[0];
    //tratamientosSelect.options.length=0;

    if (tratamientos[gid] == undefined) {
        //tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- No hay tratamientos --', 0);
        $('#s_tratamientos').html('');
        $('#s_tratamientos').append($('<option>', {value: 0, text: '-- No hay tratamientos --'}));
    } else {
        //tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- Elija un tratamiento --', 0)
        gtratamientos = tratamientos[gid];
        $('#s_tratamientos').html('');
        for(tid in gtratamientos) {
            //tratamientosSelect.options[tratamientosSelect.options.length]=new Option(gtratamientos[tid].nombre, tid);
            $('#s_tratamientos').append($('<option>', {value: tid, text: gtratamientos[tid].nombre}));
        }
    }

    updatePrecios();
}


function setTratamientos() {

    var s_grupos = $('#s_grupos');
    var s_trats = $('#s_tratamientos');
    var gid = 1; // default: preventiva

    for(var i = 0; i < grupos.length; i++) {
        log('grupo:' + grupos[i].nombre + ' -- ' + grupos[i].id);
        //s_grupos.append(new Option(grupos[i].nombre, grupos[i].id));
        $('#s_grupos').append($('<option>', {value: grupos[i].id, text: grupos[i].nombre}));
    }

    if (tratamientos[gid] == undefined) {
        //tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- No hay tratamientos --', 0);
        $('#s_tratamientos').html('');
        $('#s_tratamientos').append($('<option>', {value: 0, text: '-- No hay tratamientos --'}));
    }else{
        $('#s_tratamientos').html('');
        for(t in tratamientos[gid]) {
            log('tratamiento:' + tratamientos[gid][t].nombre + ' -- ' + t);
            //s_trats.append(new Option(tratamientos[gid][t].nombre, t));
            $('#s_tratamientos').append($('<option>', {value: grupos[i].id, text: grupos[i].nombre}));
        }
    }

    updatePrecios();

    return false;
}

function updatePrecios() {
    var s_precios = $('#s_precios');
    var gid = $("#s_grupos").val();
    var tid = $("#s_tratamientos").val();
    if(tratamientos[gid] != undefined || tratamientos[gid] != null){
        if(tratamientos[gid][tid] != undefined || tratamientos[gid][tid] != null){
         var precios = tratamientos[gid][tid].precios;
        //var comp_economica = tratamientos[gid][t].compania_economica;

        log('updatePrecios gid:' + gid + ' tid:' + tid);

        //s_precios.find('option').remove();
        $('#s_precios').children('option').remove();
        for(p in precios) {
            var texto = companias[p] + " (" + precios[p] + "\u20ac)";
            $('#s_precios').append($('<option>', {value: precios[p], text: texto}));
            //s_precios.append(new Option(texto, precios[p]));
        }
        // TODO: default val
        //s_precios.val(comp_economica)
        //s_precios[0].options[0].value = '00'
    }
   
}
}


// Si el tipo es anticipo, comprobar que la cantidad introducida no es mayor que saldon
function validate_cobro(form) {
    log('validate_cobro');

    var valid = true;
    var fields = {};
    $(form).find(":input").each(function() {
        fields[this.name] = $(this).val();
    });
    var saldo = $('#saldo').text();
    var cobrar = parseInt(fields['cobrar']);

    if ((fields['tipos_de_cobro_id'] == 1) && (cobrar > saldo)) {
        valid = false;
    }

    if(!valid) {
        alert('La cantidad a cobrar desde anticipo es mayor que el saldo disponible.');
        return false;
    }
    else {
        var tipo_text = $(form).find("select[name^='tipos_de_cobro_id'] option:selected").text();
        return confirm('ï¿½Desea realizar un cobro de ' + cobrar + '\u20ac usando ' + tipo_text + '?');
    }
}
