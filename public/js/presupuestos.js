
function updateTratamientos(id, index) {
    console.log('updateTratamientos ' + id + ' ' + index)
    tratamientosSelect = $('#s_tratamiento-' + id)[0]
    tratamientosSelect.options.length=0

    if (index == 0) {
        tratamientosSelect.options[tratamientosSelect.options.length]=new Option(tratamientos[0], 0)
    } else {
        for (i=0; i<tratamientos[index].length; i++) {
            if (i==0) {
                tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- Elija un tratamiento --', '0')
            }
            t = tratamientos[index][i]
            tratamientosSelect.options[tratamientosSelect.options.length]=new Option(t['nombre'], t['id'])
        }

        if (tratamientosSelect.options.length == 0) {
            tratamientosSelect.options[tratamientosSelect.options.length]=new Option('-- No hay tratamientos --', '0')
        }

    }
}

function addTratamiento(gid, tid) {
    lastIndex++
    console.log('addTratamiento... ' + lastIndex + '(' + gid + ',' + tid + ')')

    grupo = "grupo-" + lastIndex
    trat = "tratamiento-" + lastIndex
    lprecio = "precio-" + lastIndex
    lpreciof = "preciof-" + lastIndex
    ldescu = "descuento-" + lastIndex
    tdescu = "tipodescuento-" + lastIndex
    lpiezas = "piezas-" + lastIndex;

    // Grupo de tratamientos
    label1 = $("<label>").attr({for: grupo}).text('Grupo de tratamientos:')
    select1 = $('<select>').attr({onchange: "updateTratamientos(" + lastIndex + ", this.selectedIndex)", id: grupo, name: grupo})

    // Tratamiento
    label2 = $("<label>").attr({for: trat}).text('Tratamiento:')
    select2 = $('<select>').attr({onchange: "updatePrecios(" + lastIndex + ", this.selectedIndex)", id: "s_" + trat, name: trat})

    // Descuento
    label3 = $("<label>").attr({for: ldescu}).text('Descuento:')
    input3 = $('<input>').attr({onchange: "updatePrecios(" + lastIndex + ")", id: ldescu, name: ldescu,
                                type: "text", size: 3})
    input3.val(0)
    select3 = $('<select>').attr({onchange: "updatePrecios(" + lastIndex + ")", id: "s_" + tdescu, name: tdescu})
    select3.append(new Option('EUR', 'E'))
    select3.append(new Option('%', 'P'))

    divPrecio = $("<div>").attr({id: "dprecio-" + lastIndex})
    divPrecio.append('Precio base: <span id="' + lprecio + '">0.00</span><br>')
    divPrecio.append(label3)
    divPrecio.append(input3)
    divPrecio.append(select3)
    divPrecio.append('Precio final del tratamiento: <span id="' + lpreciof + '">0.00</span>')

    for(var i = 0; i < grupos.length; i++) {
        select1.append(new Option(grupos[i], i))
    }

    if (tid == null) {
        select2.append(new Option(tratamientos[0], 0))
    } else {
        for(var i = 0; i < tratamientos[gid].length; i++) {
            console.log('updateTratamientos ' + tratamientos[gid][i]['nombre'] + ' ' + tratamientos[gid][i]['id'])
            select2.append(new Option(tratamientos[gid][i]['nombre'], tratamientos[gid][i]['id']))
        }
    }

    nuevodiv = $("<div>").attr({id: trat})
    nuevodiv.append(label1)
    nuevodiv.append(select1)
    nuevodiv.append(label2)
    nuevodiv.append(select2)
    nuevodiv.append(divPrecio)

    div = $("#tratamientos")
    div.append(nuevodiv)
    div.append('<hr/>')

    $('input[name="num_tratamientos"]').val(lastIndex)

    if (gid) select1.val(gid)
    if (tid) select2.val(tid)

    return false
}

// Cuando se cambia de tratamiento en el selector
function updatePrecios(id, index) {
    console.log('updatePrecios ' + id + ', ' + index)

    if (id != null) {
        precio = $('#precio-' + id)
        preciof = $('#preciof-' + id)
        desc = $('#descuento-' + id).val()
        tipodesc = $('#s_tipodescuento-' + id).val()
        grupo = $('#grupo-' + id).val()
        ipiezas = $('#ipiezas-' + id)
        divtratamiento = $("#tratamiento-" + id)
        dpiezas = $('#dpiezas-' + id)

        if (index != null) {
            if (index == 0) {
                precio.text("0.00")
                preciof.text("0.00")

                if (dpiezas.length) {
                    dpiezas.remove()
                }
            } else {

                tipo = tratamientos[grupo][index-1]['tipo']

                // 1 = pieza, 2 = general, 3 = puente
                if (tipo == 2) {
                    if (dpiezas.length) {
                        dpiezas.remove()
                    }
                } else {
                    odontograma[id] = new Array
                    
                    if (tipo == 3) {
                        piezastext = "Elegir puente"
                        piezasplaceholder = "3-6,..."
                    } else {
                        piezastext = "Elegir piezas"
                        piezasplaceholder = "3,..."
                    }

                    if (!dpiezas.length) {
                        dpiezas = $("<div>").attr("id", "dpiezas-" + id)

                        ipiezas = $('<input readonly>').attr({id: 'ipiezas-' + id, name: 'ipiezas-' + id, type: "text", placeholder: piezasplaceholder})
                        dpiezas.append(ipiezas)

                        newLink = $("<a />", {id: 'piezas-' + id, href : "#", text : piezastext});
                        newLink.click(function(e) {
                            e.preventDefault();
                            $("#dodontograma-" + id).attr("style", "position:absolute;left:10%;top:5%");
                            areas = $('#odontograma-' + id + ' area')
                            for (i=0; i<areas.length; i++) {
                                aid = areas[i].id.substr(1)
                                if (odontograma[id][aid]) {
                                    console.log('marcado ', id, aid)
                                }
                            }
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
                        divtratamiento.append(dpiezas)
                        $("#iodontograma-" + id).maphilight();

                        $('#dodontograma-' + id + ' > button').click(function(e) {
                            onOdontogramaClose(id, $(this).parent(), ipiezas, iunidades);
                        });

                        // pinchas en el map, no en el div ni en la imagen
                        areas = $('#odontograma-' + id + ' area')
                        areas.click(function(e) {
                            e.preventDefault();
                            onOdontogramaClick(id, this)
                        });

                    } else {
                        lpiezas = $('#piezas-' + id)[0]
                        lpiezas.text = piezastext

                        ipiezas.attr({placeholder: piezasplaceholder})
                    }

                    ipiezas.val("")
                }

                updatePrecioTratamiento(id, index, grupo)
            }

        } else {

            grupo = $('#grupo-' + id).val()
            index = $('#s_tratamiento-' + id)[0].selectedIndex
            updatePrecioTratamiento(id, index, grupo)
        }

        preciof.text(preciof.text() + " ")
    }

    updatePrecioFinal()
}


function updatePrecioTratamiento(id, index, grupo) {

    iunidades = $('#iunidades-' + id)

    if (tipodesc == 'P') {

        if (iunidades.length) {
            descuento = desc * tratamientos[grupo][index-1]['precio'] * iunidades.val() / 100
            preciofinal = tratamientos[grupo][index-1]['precio'] * iunidades.val() - descuento
        } else {
            descuento = desc * tratamientos[grupo][index-1]['precio'] / 100
            preciofinal = tratamientos[grupo][index-1]['precio'] - descuento
        }

    } else {

        if (iunidades.length) {
            preciofinal = tratamientos[grupo][index-1]['precio'] * iunidades.val() - desc
        } else {
            preciofinal = tratamientos[grupo][index-1]['precio'] - desc
        }
    }

    precio.text(tratamientos[grupo][index-1]['precio'])
    preciof.text(preciofinal)
}


function updatePrecioFinal() {

    // bucle 1
    //g = $('#grupo-' + i)[0].value
    //t = $('#s_tratamiento-' + i)[0].selectedIndex
    //if (t != 0) subtotal += parseInt(tratamientos[g][t-1]['precio'])

    subtotal = 0
    for (i=1; i<=lastIndex; i++) {
        subtotal += parseFloat($('#preciof-' + i)[0].innerHTML)
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
    odontograma[1][area.id.substr(1)] = data.alwaysOn
    $(area).data('maphilight', data).trigger('alwaysOn.maphilight');
}

function onOdontogramaClose(id, parent, ipiezas, iunidades) {
    parent.attr("style", "display:none")

    active = ""
    unidades = 0
    console.log('odontograma id')

    for (i=0; i<odontograma[id].length; i++) {
        console.log(i, odontograma[id][i])
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
