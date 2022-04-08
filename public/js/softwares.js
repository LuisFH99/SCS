let aux = 1;
let datos = [];
let datos1 = [];


function SoloNumeros(e) {
    var key = Window.Event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
        e.preventDefault();
    }
};

function mostrarPrecio(id) {
    if (id == 1) {
        //aparecer
        $("#divPrecio").removeClass("d-none");
        $("#divTipo").removeClass("d-flex");
        $("#divAgregar").removeClass("d-flex");
        $("#divPrecio").addClass("d-flex");
        $("#divTipo").addClass("d-none");
        $("#divAgregar").addClass("d-none");
    } else {
        //desaparecer
        $("#divPrecio").removeClass("d-flex");
        $("#divTipo").removeClass("d-none");
        $("#divAgregar").removeClass("d-none");
        $("#divPrecio").addClass("d-none");
        $("#divTipo").addClass("d-flex");
        $("#divAgregar").addClass("d-flex");
    }
}

function agregarFila(num, idtipo, idperiodo, dt) {
    let tipo_txt = $('.js-example-basic-multiple').select2().find('option:selected').text();
    let periodo_txt = $('.js-example-basic-multiple1').select2().find('option[value=' + idperiodo + ']').text();
    if (num === 1 && dt === 0) {
        $("#tableDato").html("<tr id='fila" + num + "'><td>" +
            "<input name='tiposid[]' type='hidden' value='" + idtipo + "'>" + tipo_txt + "</td>" +
            "<td><input name='periodosid[]' type='hidden' value='" + idperiodo + "'>" + periodo_txt + "</td>" +
            "<td><a href='#' onclick='eliminarFila(" + num + ");'><i class='fas fa-minus-circle text-danger'></i></a></td>" +
            "</tr>");
    } else {
        $("#tableDato").append("<tr id='fila" + num + "'><td>" +
            "<input name='tiposid[]' type='hidden' value='" + idtipo + "'>" + tipo_txt + "</td>" +
            "<td><input name='periodosid[]' type='hidden' value='" + idperiodo + "'>" + periodo_txt + "</td>" +
            "<td><a href='#' onclick='eliminarFila(" + num + ");'><i class='fas fa-minus-circle text-danger'></i></a></td>" +
            "</tr>");
    }
}

function eliminarFila(id) {
    $("#fila" + id).remove();
}

function llenarTable(dt) {
    let tipo = $('.js-example-basic-multiple').select2().val();
    let periodo = $('.js-example-basic-multiple1').select2().val();
    var tables = document.getElementById("tableDato");
    if (tipo !== '') {
        if (periodo.length !== 0) {
            if (aux === 1) {
                if (periodo.length === 1) {
                    agregarFila(aux, tipo, periodo, dt);
                    aux++;
                } else {
                    periodo.forEach(function(element) {
                        agregarFila(aux, tipo, element, dt);
                        aux++;
                    });
                }
            } else {
                if (periodo.length === 1) {
                    if (!validarDatos(periodo)) {
                        agregarFila(aux, tipo, periodo, dt);
                        aux++;
                    } else {
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: 'Mensaje de Sistema',
                            body: 'Ya has Agregado estos datos, Intente con otra selección',
                            autohide: true,
                            delay: 3350
                        });
                        $('.js-example-basic-multiple').select2().focus();
                    }
                } else {
                    periodo.forEach(function(element) {
                        if (!validarDatos(element)) {
                            agregarFila(aux, tipo, element, dt);
                            aux++;
                        } else {
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Mensaje de Sistema',
                                body: 'Ya has Agregado estos datos, Intente con otra selección',
                                autohide: true,
                                delay: 3350
                            });
                            $('.js-example-basic-multiple').select2().focus();
                        }

                    });
                }
            }
            limpiarCB();
        } else {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Mensaje de Sistema',
                body: 'Debes seleccionar una o más opciones en Periodo',
                autohide: true,
                delay: 3350
            });
            $('.js-example-basic-multiple1').select2().focus();
        }
    } else {
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Mensaje de Sistema',
            body: 'Debes seleccionar una opción en Licencia',
            autohide: true,
            delay: 3350
        });
        $('.js-example-basic-multiple').select2().focus();
    }
}

function validarDatos(periodo) {
    let bdr = false;
    let tipo_txt = $('.js-example-basic-multiple').select2().find('option:selected').text().trim();
    let periodo_txt = $('.js-example-basic-multiple1').select2().find('option[value=' + periodo + ']').text().trim();
    let aux1 = 1;
    let bdr1 = false;
    let bdr2 = false;
    $('#tableDatos tr').each(function() {
        $(this).find('td').each(function() {
            let valor = $(this).text().trim();
            if (valor == '') {
                aux1 = 1;
                bdr1 = false;
                bdr2 = false;
            } else {
                //console.log(valor,tipo_txt,periodo_txt);
                if (valor === tipo_txt && aux1 == 1) {
                    bdr1 = true;
                }
                if (valor === periodo_txt && aux1 == 2) {
                    bdr2 = true;
                }
                //console.log(bdr1,bdr2);
                if (bdr1 && bdr2) {
                    bdr = true;
                }
                aux1++;
            }
        });
    });
    return bdr;
}

function limpiarCB() {
    $('.js-example-basic-multiple').val(null).trigger('change');
    $('.js-example-basic-multiple1').val(null).trigger('change');
}