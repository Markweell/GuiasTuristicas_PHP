$(init);

let numeroDeSelect = 1;
let opcionesDOM = "";
let opciones = {};
let opcionesDisponibles = {};
let numeroDeRecorridos = 1;
let numeroSelectPorRecorrido = {};

function init() {
    solicitudAjaxPuntosInteres();
    $("#anadir_recorrido").click(crearRecorridoDom);
    $("#busquedaGuiaTuristica").keyup(buscarGuias);
    $("#busquedaPtoInteres").keyup(buscarPuntosInteres);
}

function solicitudAjaxPuntosInteres() {
    $.ajax({
        url: 'utiles/obtenerListaPuntosInteresAJAX.php',
        success: function success(result) {
            $.each(JSON.parse(result), function (key, value) {
                opcionesDOM += "<option id='opcion" + key + "'>" + value + "</option>";
                opciones[value] = key;
            });
        }
    });
}

function crearRecorridoDom() {
    let template = `
    <div class="creacion_recorrido">
        <h2>Crear recorrido:</h2>
        <label for="titulo_recorrido${numeroDeRecorridos}">Título recorrido ${numeroDeRecorridos}:</label>
        <input type="text" name="titulo_recorrido${numeroDeRecorridos}"  placeholder="título">
        <div class="Contenedor_selects" id="Contenedor_select${numeroDeRecorridos}"></div>
        <input type="button" class="agregarPuntoInteres" id="agregarPuntoInteres${numeroDeRecorridos}" value="+">
        <input type="button" class="quitarPuntoInteres" id="quitarPuntoInteres${numeroDeRecorridos}" value="-">
    </div>`;
    $("#listado_recorridos").append(template);
    numeroSelectPorRecorrido[numeroDeRecorridos] = 1;//Con esto decímos que el número de select que hay para este recorrido se inicia en 1;
    $("#agregarPuntoInteres" + numeroDeRecorridos).click(crearSelect);//Al boton + que hemos creado le asiignamos el evento de crear más puntos de interés
    $("#agregarPuntoInteres" + numeroDeRecorridos).click();
    $("#quitarPuntoInteres" + numeroDeRecorridos).click(quitarSelect);//Al boton + que hemos creado le asiignamos el evento de crear más puntos de interés

    numeroDeRecorridos++;

}

function crearSelect() {
    let nRecorrido = parseInt(this.id.split("agregarPuntoInteres")[1]);
    let nSelect = numeroSelectPorRecorrido[nRecorrido];
    numeroSelectPorRecorrido[nRecorrido]++
    opcionesDisponibles = clonandoOpciones();
    let template = `
    <div class="Contenedor_select" id="Contenedor_select${nRecorrido}_${nSelect}">
        <label for="selectPuntosInteres_${nRecorrido}_${nSelect}">Punto de interes ${nSelect} :</label>
        <select name="selectPuntosInteres_${nRecorrido}_${nSelect}" id="selectPuntosInteres_${nRecorrido}_${nSelect}">
            <option id='' selected="true" disabled="disabled">Selecciona un punto de interés</option>;
            ${opcionesDOM}
        </select>
    </div>`;
    $("#Contenedor_select" + nRecorrido).append(template);
    $("#selectPuntosInteres_" + nRecorrido + "_" + nSelect).change(cribarRestoSelect);
}

function quitarSelect() {
    let nRecorrido = parseInt(this.id.split("quitarPuntoInteres")[1]);
    console.log(numeroSelectPorRecorrido[nRecorrido]);
    if ((numeroSelectPorRecorrido[nRecorrido] - 1) != 1) {
        console.log(numeroSelectPorRecorrido[nRecorrido] + "qsd");
        $("#Contenedor_select" + nRecorrido + "_" + (--numeroSelectPorRecorrido[nRecorrido])).remove();
    }
}

function cribarRestoSelect() {
    nRecorrido = this.id.split("_")[1];
    nSelect = this.id.split("_")[2];
    opcionesDisponibles = clonandoOpciones();
    i = 1;
    while ($("#selectPuntosInteres_" + nRecorrido + "_" + i)[0] !== undefined) {
        if (opcionesDisponibles[$("#selectPuntosInteres_" + nRecorrido + "_" + i).val()] === undefined) {
            $("#selectPuntosInteres_" + nRecorrido + "_" + i).val("Selecciona un punto de interés");
            $("#selectPuntosInteres_" + nRecorrido + "_" + i).css({color: "red"});
        } else {
            $("#selectPuntosInteres_" + nRecorrido + "_" + i).css({color: "black"});
            delete opcionesDisponibles[$("#selectPuntosInteres_" + nRecorrido + "_" + i).val()];
        }
        i++;
    }
}

function clonandoOpciones() {
    let clonOpciones = {};
    $.each(opciones, (key, value) => {
        clonOpciones[key] = value;
    });
    return clonOpciones;
}


function buscarGuias() {
    inputGuias=$("#busquedaGuiaTuristica");
    $.ajax({
        url: 'utiles/buscadorGuiasTuristicasAjax.php',
        data: {
            'textoInput': inputGuias.val()
        },
        success: function success(result) {
            $("#containerGuiasTuristicas").html("");
            let template=``;
            $.each(JSON.parse(result), function (key, value) {
                let descripcion= devolverQuinientosCaracteres(value['descripcion']);
                template+=`
                    <li class="targetPtoInteres">
                        <div>
                            <a href="index.php?page=guiaTuristica&guiaTuristica=${value['id']}"><h3>${value['Titulo']}</h3></a>
                            <p>
                                ${descripcion}...<a href="index.php?page=guiaTuristica&guiaTuristica=${value['id']}"> Leer Más</a>
                            </p>
                        </div>
                    </li>`;
            });
            $("#containerGuiasTuristicas").append(template);
        }
    });
}
function devolverQuinientosCaracteres(texto) {
    return texto.substr(0,500);
}
function buscarPuntosInteres() {
    inputPtoInteres=$("#busquedaPtoInteres");
    $.ajax({
        url: 'utiles/buscadorPuntoInteresAjax.php',
        data: {
            'textoInput': inputPtoInteres.val()
        },
        success: function success(result) {
            $("#containerPtoInteres").html("");
            let template=``;
            $.each(JSON.parse(result), function (key, value) {
                let descripcion= devolverQuinientosCaracteres(value['descripcion']);
                template+=`
                    <li class="targetPtoInteres">
                        <a href="index.php?page=puntoInteres&ptoInteres=${value['id']}">
                            <img src="${value['imagen']}" alt="Portada del punto de interés">
                        </a>
                        <div>
                            <a href="index.php?page=puntoInteres&ptoInteres=${value['id']}"><h3>${value['titulo']}</h3></a>
                            <p>
                                ${descripcion}...<a href="index.php?page=puntoInteres&ptoInteres=${value['id']}"> Leer Más</a>
                            </p>
                        </div>
                    </li>`;
            });
            $("#containerPtoInteres").append(template);
        }
    });
}