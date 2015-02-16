
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
                                type: "text"})
    input3.val(0)
    select3 = $('<select>').attr({onchange: "updatePrecios(" + lastIndex + ", this.selectedIndex)", id: "s_" + tdescu, name: tdescu})
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

function updatePrecios(id, index) {
    console.log('updatePrecios ' + id + ', ' + index)

    if (id != null) {
        p1 = $('#precio-' + id)[0]
        p2 = $('#preciof-' + id)[0]
        desc = $('#descuento-' + id)[0].value
        tipodesc = $('#s_tipodescuento-' + id)[0].value
        grupo = $('#grupo-' + id)[0].value
        ipiezas = $('#ipiezas-' + id)
        divtratamiento = $("#tratamiento-" + id)
        dpiezas = $('#dpiezas-' + id)

        if (index != null) {
            if (index == 0) {
                p1.innerHTML = '0.00'
                p2.innerHTML = '0.00'

                if (dpiezas.length) {
                    dpiezas.remove()
                }
            } else {
                if (tipodesc == 'P') {
                    descuento = desc * tratamientos[grupo][index-1]['precio'] / 100
                    preciofinal = tratamientos[grupo][index-1]['precio'] - descuento
                } else {
                    preciofinal = tratamientos[grupo][index-1]['precio'] - desc
                }

                p1.innerHTML = tratamientos[grupo][index-1]['precio']
                p2.innerHTML = preciofinal

                tipo = tratamientos[grupo][index-1]['tipo']

                // 1 = pieza, 2 = general, 3 = puente
                if (tipo == 2) {
                    if (dpiezas.length) {
                        dpiezas.remove()
                    }
                } else {

                    if (tipo == 3) {
                        piezastext = "Elegir puente"
                        piezasplaceholder = "3-6,..."
                    } else {
                        piezastext = "Elegir piezas"
                        piezasplaceholder = "3,..."
                    }

                    if (!dpiezas.length) {
                        dpiezas = $("<div>").attr("id", "dpiezas-" + id)

                        input = $('<input>').attr({id: 'ipiezas-' + id, name: 'ipiezas-' + id, type: "text", placeholder: piezasplaceholder})
                        dpiezas.append(input)

                        newLink = $("<a />", {id: 'piezas-' + id, href : "#", text : piezastext});
                        newLink.click(function(e) {
                            e.preventDefault();
                            $("#dodontograma-" + id).attr("style", "position:absolute;left:10%;top:5%");
                        });
                        dpiezas.append(newLink)

                        odontograma = $('#dodontograma').clone()
                        odontograma.attr({id: "dodontograma-" + id, style: "display:none"})
                        odontograma.find('map').attr({name: "odontograma-" + id, id: "odontograma-" + id})
                        odontograma.find('img').attr({usemap: "#odontograma-" + id, id: "iodontograma-" + id})
                        dpiezas.append(odontograma)
                        divtratamiento.append(dpiezas)
                        $("#iodontograma-" + id).maphilight();

                        $('#dodontograma-' + id + ' > button').click(function(e) {
                            $(this).parent().attr("style", "display:none")
                        });

                        // pinchas en el map, no en el div ni en la imagen
                        areas = $('#odontograma-' + id + ' area')
                        areas.click(function(e) {
                            e.preventDefault();
                            console.log('pinchado '+  id + ' ' + this.id)
                            var data = $(this).mouseout().data('maphilight') || {};
                            data.alwaysOn = !data.alwaysOn;
                            $(this).data('maphilight', data).trigger('alwaysOn.maphilight');
                        });


                    } else {
                        lpiezas = $('#piezas-' + id)[0]
                        lpiezas.text = piezastext

                        ipiezas.attr({placeholder: piezasplaceholder})
                    }
                }
            }

        } else {
            if (tipodesc == 'P') {
                descuento = desc * p1.innerHTML / 100
                preciofinal = p1.innerHTML - descuento
            } else {
                preciofinal = p1.innerHTML - desc
            }

            p2.innerHTML = preciofinal
        }

        p2.innerHTML += ' '

    }

    subtotal = 0
    for (i=1; i<=lastIndex; i++) {
        //g = $('#grupo-' + i)[0].value
        //t = $('#s_tratamiento-' + i)[0].selectedIndex
        //if (t != 0) subtotal += parseInt(tratamientos[g][t-1]['precio'])
        subtotal += parseFloat($('#preciof-' + i)[0].innerHTML)
    }

    desc = $('#descuento')[0].value
    tdesc = $('#tipodescuento')[0].value
    if (tdesc == 'P') {
        descuento = desc * subtotal / 100
        descuentotext = descuento + ' (' + desc + '%)'
    } else {
        descuento = desc
        descuentotext = desc
    }
    total = subtotal - descuento
    $('#p_subtotal')[0].innerHTML = subtotal
    $('#p_descuento')[0].innerHTML = descuentotext
    $('#p_total')[0].innerHTML = total

}