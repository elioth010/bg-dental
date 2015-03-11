
// Se pincha en el select de grupo y actualiza el de tratamientos
function updateSelectTratamientos(id, gid) {
    console.log('updateSelectTratamientos ' + id + ' ' + gid)
    tratamientosSelect = $('#s_tratamiento-' + id)[0]
    tratamientosSelect.options.length=0

    if (gid == 0) {
        tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- Elija primero un grupo de tratamientos --', 0)
    } else {

        if (tratamientos[gid] == undefined) {
            tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- No hay tratamientos --', 0)
        } else {
            tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- Elija un tratamiento --', 0)

            gtratamientos = tratamientos[gid]
            for(tid in gtratamientos) {
                tratamientosSelect.options[tratamientosSelect.options.length]=new Option(gtratamientos[tid].nombre, tid)
            }
        }

    }

    updatePrecios(id)
}

// añadir descuento, piezas y unidad. Para edición
function addTratamiento(gid, tid) {
    lastIndex++
    console.log('addTratamiento... ' + lastIndex + '(' + gid + ',' + tid + ')')

    grupo = "grupo-" + lastIndex
    trat = "tratamiento-" + lastIndex
    strat = "s_tratamiento-" + lastIndex
    lcompania = "compania-" + lastIndex
    lprecio = "precio-" + lastIndex
    lpreciof = "preciof-" + lastIndex
    ldescu = "descuento-" + lastIndex
    tdescu = "tipodescuento-" + lastIndex
    lpiezas = "piezas-" + lastIndex;

    // Select: Grupos de tratamientos
    label1 = $("<label>").attr({for: grupo}).text('Grupo de tratamientos:')
    select1 = $('<select>').attr({onchange: "updateSelectTratamientos(" + lastIndex + ", this.value)", id: grupo, name: grupo})

    select1.append(new Option('-- Elija un grupo --', 0));
    for(var i = 0; i < grupos.length; i++) {
        select1.append(new Option(grupos[i].nombre, grupos[i].id))
    }

    // Select: Tratamiento
    label2 = $("<label>").attr({for: trat}).text('Tratamiento:')
    select2 = $('<select>').attr({onchange: "updatePrecios(" + lastIndex + ", this.value)", id: strat, name: trat})

    if (tid == null) {
        select2.append(new Option('-- Elija primero un grupo de tratamientos --', 0))
    } else {
        if (tratamientos[gid] == undefined) {
            select2.append(new Option('-- No hay tratamiento --', 0));
        } else {
            select2.append(new Option('-- Elija un tratamiento --', 0));

            for(t in tratamientos[gid]) {
                select2.append(new Option(tratamientos[gid][t].nombre, t))
            }

        }

    }

    // Descuento
    label3 = $("<label>").attr({for: ldescu}).text('Descuento:')
    input3 = $('<input>').attr({onchange: "updatePrecios(" + lastIndex + ")", id: ldescu, name: ldescu,
                                type: "text", size: 3})
    input3.val(0)
    select3 = $('<select>').attr({onchange: "updatePrecios(" + lastIndex + ")", id: "s_" + tdescu, name: tdescu})
    select3.append(new Option('EUR', 'E'))
    select3.append(new Option('%', 'P'))

    divPrecio = $("<div>").attr({id: "dprecio-" + lastIndex})
    divPrecio.append('Precio base: <span id="' + lprecio + '">0.00</span> <span id="' + lcompania + '"></span><br>')
    divPrecio.append(label3)
    divPrecio.append(input3)
    divPrecio.append(select3)
    divPrecio.append('Precio final del tratamiento: <span id="' + lpreciof + '">0.00</span>')

    compania = $("<input>").attr({name: "compania-" + lastIndex, type: "hidden", value: 0})

    nuevodiv = $("<div>").attr({id: trat})
    nuevodiv.append(label1)
    nuevodiv.append(select1)
    nuevodiv.append(label2)
    nuevodiv.append(select2)
    nuevodiv.append(divPrecio)
    nuevodiv.append(compania)

    div = $("#tratamientos")
    div.append(nuevodiv)
    div.append('<hr/>')

    $('input[name="num_tratamientos"]').val(lastIndex)

    // TODO: si tipo, meter piezas...

    if (gid) select1.val(gid)
    if (tid) select2.val(tid)

    return false
}

function creaDivPiezas(id) {
    dpiezas = $("<div>").attr("id", "dpiezas-" + id)

    ipiezas = $('<input readonly>').attr({id: 'ipiezas-' + id, name: 'ipiezas-' + id, type: "text", placeholder: 'Ninguna pieza seleccionada'})
    dpiezas.append(ipiezas)

    newLink = $("<a />", {id: 'piezas-' + id, href : "#", text : piezastext});
    newLink.click(function(e) {
        e.preventDefault();
        $("#dodontograma-" + id).attr("style", "position:absolute;left:10%;top:5%");
        areas = $('#odontograma-' + id + ' area')
        /*
        for (i=0; i<areas.length; i++) {
            aid = areas[i].id.substr(1)
            if (odontograma[id][aid]) {
                console.log('marcado ', id, aid)
            }
        }
        */
    });
    dpiezas.append(newLink)

    label = $("<label>").attr({for: 'iunidades-' + id}).text('Unidades:')
    iunidades = $('<input readonly>').attr({id: 'iunidades-' + id, name: 'iunidades-' + id, type: "text", size: 2})
    iunidades.val(0)
    dpiezas.append(label)
    dpiezas.append(iunidades)

    od = $('#dodontograma').clone()
    od.attr({id: "dodontograma-" + id, style: "display:none"})
    od.find('map').attr({name: "odontograma-" + id, id: "odontograma-" + id})
    od.find('img').attr({usemap: "#odontograma-" + id, id: "iodontograma-" + id})
    dpiezas.append(od)

    return dpiezas;
}

// Cuando se cambia de tratamiento en el selector
function updatePrecios(id, tid) {
    grupo = $('#grupo-' + id).val()
    console.log('updatePrecios ' + id + ', ' + tid + ", " + grupo)

    if (id != null) {
        precio = $('#precio-' + id)
        preciof = $('#preciof-' + id)
        desc = $('#descuento-' + id).val()
        tipodesc = $('#s_tipodescuento-' + id).val()
        ipiezas = $('#ipiezas-' + id)
        divtratamiento = $("#tratamiento-" + id)
        dpiezas = $('#dpiezas-' + id)

        if (tid != null) {

            if (tid == 0) {
                $('input[name="compania-' + id + '"]').val(0)
                $('#compania-' + id).text('')

                precio.text("0.00")
                preciof.text("0.00")

                if (dpiezas.length) {
                    dpiezas.remove()
                }
            } else {
                $('input[name="compania-' + id + '"]').val(tratamientos[grupo][tid]['compania'])
                text = '(' + companias[tratamientos[grupo][tid]['compania']] + ')'
                $('#compania-' + id).text(text.toUpperCase())

                tipo = tratamientos[grupo][tid]['tipo']

                // 1 = pieza, 2 = general, 3 = puente
                if (tipo == 2) {
                    if (dpiezas.length) {
                        dpiezas.remove()
                    }
                } else {
                    odontograma[id] = new Array

                    if (tipo == 3) {
                        piezastext = "Elegir puente"
                    } else {
                        piezastext = "Elegir piezas"
                    }

                    if (!dpiezas.length) {
                        dpiezas = creaDivPiezas(id)
                        divtratamiento.append(dpiezas)
                        odontogramaHighlight(id)
                    } else {
                        lpiezas = $('#piezas-' + id)[0]
                        lpiezas.text = piezastext
                    }

                    ipiezas.val("")
                }

                updatePrecioTratamiento(id, tid, grupo)
            }

        } else {
            console.log('algo ' + id)
            tid = $('#s_tratamiento-' + id)[0].value
            updatePrecioTratamiento(id, tid, grupo)
        }

        preciof.text(preciof.text() + " ")
    }

    updatePrecioFinal()
}

// Actualiza los campos de precio cuando se ha seleccionado otro tratamiento
function updatePrecioTratamiento(id, tid, grupo) {
    console.log('updatePrecioTratamiento ' + id + ', ' + tid + ", " + grupo)

    iunidades = $('#iunidades-' + id)

    if (tid == 0) {
        precio.text("0.00")
        preciof.text("0.00")
    } else {
        if (tipodesc == 'P') {

            if (iunidades.length) {
                descuento = desc * tratamientos[grupo][tid].precio * iunidades.val() / 100
                preciofinal = tratamientos[grupo][tid].precio * iunidades.val() - descuento
            } else {
                descuento = desc * tratamientos[grupo][tid].precio / 100
                preciofinal = tratamientos[grupo][tid].precio - descuento
            }

        } else {

            if (iunidades.length) {
                preciofinal = tratamientos[grupo][tid].precio * iunidades.val() - desc
            } else {
                preciofinal = tratamientos[grupo][tid].precio - desc
            }
        }

        precio.text(tratamientos[grupo][tid].precio)
        preciof.text(preciofinal)
    }

}

function updatePrecioFinal() {

    // bucle 1
    //g = $('#grupo-' + i)[0].value
    //t = $('#s_tratamiento-' + i)[0].selectedIndex
    //if (t != 0) subtotal += parseInt(tratamientos[g][t-1]['precio'])

    subtotal = 0
    for (i=1; i<=lastIndex; i++) {
        subtotal += parseFloat($('#preciof-' + i).text())
    }

    desc = $('#descuento').val()
    tdesc = $('#tipodescuento').val()
    if (tdesc == 'P') {
        descuento = desc * subtotal / 100
        descuentotext = descuento + ' (' + desc + '%)'
    } else {
        descuento = desc
        descuentotext = desc
    }
    total = subtotal - descuento
    $('#p_subtotal').text(subtotal)
    $('#p_descuento').text(descuentotext)
    $('#p_total').text(total)
}

function onOdontogramaClick(id, area) {
    console.log('pinchado '+  id + ' ' + area.id)
    var data = $(area).mouseout().data('maphilight') || {};
    data.alwaysOn = !data.alwaysOn;
    odontograma[id][area.id.substr(1)] = data.alwaysOn
    $(area).data('maphilight', data).trigger('alwaysOn.maphilight');
}

function odontogramaHighlight(id) {
    $("#iodontograma-" + id).maphilight();

    $('#dodontograma-' + id + ' > button').click(function(e) {
        onOdontogramaClose(id, $(this).parent(), ipiezas, iunidades);
    });

    areas = $('#odontograma-' + id + ' area')
    areas.click(function(e) {
        e.preventDefault();
        onOdontogramaClick(id, this)
    });
}

function onOdontogramaClose(id, parent, ipiezas, iunidades) {
    parent.attr("style", "display:none")
    active = ""
    unidades = 0

    for (i=0; i<odontograma[id].length; i++) {
        //console.log(i, odontograma[id][i])
        if (odontograma[id][i]) {
            active += i + ","
            unidades++
        }
    }
    active = active.substr(0, active.length-1)
    ipiezas.val(active)
    iunidades.val(unidades)

    precio = $('#precio-' + id)
    preciof = $('#preciof-' + id)

    preciof.text(precio.text() * unidades)

    updatePrecioFinal()
}
