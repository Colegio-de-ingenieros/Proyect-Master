const radioCursos = document.getElementById("cursos");
const radioCert = document.getElementById("certificaciones");
const radioProy = document.getElementById("proyectos");

const formulario = document.getElementById("formulario");

const radioCompleto = document.getElementById("completo");
const radioPeriodo = document.getElementById("periodo");

const botonGenerar = document.getElementById("registrar");

//const cuerpo_tabla = document.getElementById("cuerpo");
const contenedor = document.getElementById("tablaResultado")
//const totales = document.getElementById("datos");
const titulo = document.getElementById("nombre_actividad");

const textFechaI = document.getElementById("inicio");
const textFechaF = document.getElementById("fin");

const fechas_titulo = document.getElementById("fechas_titulo");

const total = document.getElementById("total")
const totales = document.createElement("div")
totales.id = "datos"
//document.appendChild(totales)

//crear la tabla
var tabla = document.createElement("table")

var encabezados = document.createElement("thead")

//encabezados
var encabezado = document.createElement("tr")
var titulo_actividad = document.createElement("th")
titulo_actividad.textContent = "Actividad"

var titulo_hotel = document.createElement("th")
titulo_hotel.textContent = "Hotel"

var titulo_transporte = document.createElement("th")
titulo_transporte.textContent = "Transporte"

var titulo_comida = document.createElement("th")
titulo_comida.textContent = "Comida"

var titulo_oficina = document.createElement("th")
titulo_oficina.textContent = "Oficina"

var titulo_honorarios = document.createElement("th")
titulo_honorarios.textContent = "Honorarios"

var titulo_subt = document.createElement("th")
titulo_subt.textContent = "Subtotal gastos"

var titulo_ingresos = document.createElement("th")
titulo_ingresos.textContent = "Ingresos"

//cuerpo de la tabla
var cuerpo_tabla = document.createElement("tbody")

crearTabla();

radioPeriodo.addEventListener('click', function (e){
    textFechaF.disabled = false;
    textFechaI.disabled = false
})

radioCompleto.addEventListener('click', function (e){
    textFechaF.disabled = true;
    textFechaI.disabled = true
})

formulario.addEventListener('submit', function (e){
    e.preventDefault()
    if (radioCert.checked) {
        //alert("certificaciones");
        peticion("certificaciones")
    }

    else if (radioCursos.checked) {
        //alert("cursos");
        peticion("cursos")
    }

    if (radioProy.checked) {
        //alert("proyectos");
        peticion("proyectos")
    }
})

function peticion(tipo)
{
    
    var band = true;
    
    if (radioCompleto.checked) {
        //alert("completo");
        fechaI = '-';
        fechaF = '-';

        band = true
    }

    else {
        //alert("periodo");
        fechaI = textFechaI.value;
        fechaF = textFechaF.value;

        console.log(fechaI + ' - ' + fechaF)

        if (fechaI == "" || fechaF == "") {
            alert("Debe seleccionar una fecha de inicio y una fecha de finalización")
            band = false;
        }

        else if (fechaF < fechaI) {
            alert("La fecha de inicio no debe ser mayor a la fecha de finalización");
            band = false;
        }

        else {
            band = true;
            fechas_titulo.innerHTML = formatoFecha(fechaI) + "  -  " + formatoFecha(fechaF) 
             
        }
    }

    if (band == true) {
        let tipo_nombre = new FormData();
        tipo_nombre.append("tipo", tipo);
        tipo_nombre.append("bandera", true);

        fetch('../../controller/administrativo/Reporte_General.php?tipo=' + tipo + '&fi=' + fechaI + '&ff=' + fechaF, {
            method: 'POST',
            body: tipo_nombre
        })
            //recibe el mensaje para mandarlo como alerta
            .then(res => res.json())
            .then(data =>
            {
                console.log(data);
                mostrar_tabla(data);
            })
    }
};

function mostrar_tabla(datos){
    //pone las fechas si se pide historial completo
    if (radioCompleto.checked) {
        
        fechas_titulo.innerHTML = formatoFecha(datos[datos.length - 2]) + "  -  " + formatoFecha(datos[datos.length - 1]) 
    }
    tabla.innerHTML = ""
    crearTabla()
    cuerpo_tabla.innerHTML = "";
    totales.innerHTML = "";

    sub_hotel = 0;
    sub_transporte = 0;
    sub_comida = 0;
    sub_oficina = 0;
    sub_honorarios = 0;
    sub_sub_gastos = 0;
    sub_ingresos = 0;

    for (let i = 0; i < datos.length -2; i++) {

        //poner los datos recibidos en la tabla
        if (datos[i].length == 0) {
            continue
        }

        else {
            var row = document.createElement('tr');
            var nombre_col = document.createElement('td');
            var hotel_col = document.createElement('td');
            var transporte_col = document.createElement('td');
            var comida_col = document.createElement('td');
            var oficina_col = document.createElement('td');
            var honorarios_col = document.createElement('td');
            var sub_gastos_col = document.createElement('td');
            var ingresos_col = document.createElement('td');

            //suma las cosas para los totales
            sub_hotel += parseFloat(datos[i][1]);
            sub_transporte += parseFloat(datos[i][2]);
            sub_comida += parseFloat(datos[i][3]);
            sub_oficina += parseFloat(datos[i][4]);
            sub_honorarios += parseFloat(datos[i][5]);
            sub_sub_gastos += parseFloat(datos[i][6])
            sub_ingresos += parseFloat(datos[i][7])

            nombre_col.innerText = datos[i][0]
            hotel_col.innerText = "$" + datos[i][1];
            transporte_col.innerText = "$" + datos[i][2];
            comida_col.innerText = "$" + datos[i][3];
            oficina_col.innerText = "$" + datos[i][4];
            honorarios_col.innerText = "$" + datos[i][5];
            sub_gastos_col.innerText = "$" + datos[i][6];
            ingresos_col.innerText = "$" + datos[i][7];

            row.appendChild(nombre_col);
            row.appendChild(hotel_col);
            row.appendChild(transporte_col);
            row.appendChild(comida_col);
            row.appendChild(oficina_col);
            row.appendChild(honorarios_col);
            row.appendChild(sub_gastos_col);
            row.appendChild(ingresos_col);
            cuerpo_tabla.appendChild(row);
        }

    }

    //crea la fila para os subtotales
    var row = document.createElement('tr');
    var nombre_col = document.createElement('td');
    var hotel_col = document.createElement('td');
    var transporte_col = document.createElement('td');
    var comida_col = document.createElement('td');
    var oficina_col = document.createElement('td');
    var honorarios_col = document.createElement('td');
    var sub_gastos_col = document.createElement('td');
    var ingresos_col = document.createElement('td');
    
    //le da valor a las coumnas
    nombre_col.innerText = "Subtotal"
    hotel_col.innerText = "$" + sub_hotel;
    transporte_col.innerText = "$" + sub_transporte;
    comida_col.innerText = "$" + sub_comida;
    oficina_col.innerText = "$" + sub_oficina;
    honorarios_col.innerText = "$" + sub_honorarios;
    sub_gastos_col.innerText = "$" + sub_sub_gastos;
    ingresos_col.innerText = "$" + sub_ingresos;

    nombre_col.classList.add('subtotal');
    hotel_col.classList.add('subtotal');
    transporte_col.classList.add('subtotal');
    comida_col.classList.add('subtotal');
    oficina_col.classList.add('subtotal');
    honorarios_col.classList.add('subtotal');
    sub_gastos_col.classList.add('subtotal');
    ingresos_col.classList.add('subtotal');

    

    //pone la fila de totales
    row.appendChild(nombre_col);
    row.appendChild(hotel_col);
    row.appendChild(transporte_col);
    row.appendChild(comida_col);
    row.appendChild(oficina_col);
    row.appendChild(honorarios_col);
    row.appendChild(sub_gastos_col);
    row.appendChild(ingresos_col);
    cuerpo_tabla.appendChild(row);

    //calcula los totales
    var total_gastos = sub_hotel + sub_transporte + sub_comida + sub_oficina + sub_honorarios
    
    let gastos_totales = document.createElement('div');
    let ingresos_totales = document.createElement('div');
    let total_final = document.createElement('div');
    let cantidad1 = document.createElement("span")
    let cantidad2 = document.createElement("span")
    let cantidad3 = document.createElement("span")

    cantidad1.setAttribute("id", "gastos");
    cantidad2.setAttribute("id", "ingresos");
    cantidad3.setAttribute("id", "total");

    cantidad1.textContent = "$ " + parseFloat(sub_sub_gastos);
    cantidad2.textContent = "$ " + parseFloat(sub_ingresos);
    cantidad3.textContent = "$ " + parseFloat((sub_ingresos - sub_sub_gastos));

    gastos_totales.innerText = "Total de gastos: ";
    ingresos_totales.innerText = "Total de ingresos: ";
    total_final.innerText = "Total: ";

    gastos_totales.appendChild(cantidad1);
    ingresos_totales.appendChild(cantidad2);
    total_final.appendChild(cantidad3);

    totales.appendChild(ingresos_totales);
    totales.appendChild(gastos_totales);
    totales.appendChild(total_final);

    contenedor.appendChild(tabla)

    total.appendChild(totales)
}

function crearTabla(){
    
    encabezado.appendChild(titulo_actividad)
    encabezado.appendChild(titulo_hotel)
    encabezado.appendChild(titulo_transporte)
    encabezado.appendChild(titulo_comida)
    encabezado.appendChild(titulo_oficina)
    encabezado.appendChild(titulo_honorarios)
    encabezado.appendChild(titulo_subt)
    encabezado.appendChild(titulo_ingresos)

    encabezados.appendChild(encabezado);
    tabla.appendChild(encabezados)

    //cuerpo de la tabla
    tabla.appendChild(cuerpo_tabla);
}

//recibe la fecha como una cadena y le da el formato dd/mm/aaa
function formatoFecha(cad){
    console.log(cad)
    fecha1 = new Date(cad);

    fecha = new Date(fecha1)
    fecha.setDate(fecha.getDate() + 1)
    console.log(fecha)

    var dia = fecha.getDate();
    var mes = fecha.getMonth() + 1; 
    var year = fecha.getFullYear();

    if (dia < 10) {
        dia = '0' + dia;
    }
    if (mes < 10) {
        mes = '0' + mes; 
    }

    var formato = dia + '/' + mes + '/' + year;

    return formato
}