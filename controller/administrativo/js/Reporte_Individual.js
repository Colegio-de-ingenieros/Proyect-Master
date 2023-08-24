const btn_cursos = document.getElementById("cursos");
const btn_certificaciones = document.getElementById("certificaciones");
const btn_proyectos = document.getElementById("proyectos");

const formulario = document.getElementById("formulario");

const cuerpo_tabla = document.getElementById("cuerpo");
const totales = document.getElementById("datos");
const titulo = document.getElementById("nombre_actividad");

const fecha_inicio = document.getElementById("inicio");
const fecha_fin = document.getElementById("fin");
const fechas_titulo = document.getElementById("fechas_titulo");

const contenedor_tabla = document.getElementById("contenedor_tabla");
const btn_descargar_reportes = document.getElementById("boton_descargar_reporte");

const btn_periodo = document.getElementById("completo");
const btn_historial_completo = document.getElementById("periodo");

const option_nombre = document.getElementById("nombres");

contenedor_tabla.style.display = 'none';
btn_descargar_reportes.style.display = 'none';


btn_cursos.addEventListener("click",(e)=>{
    peticion_nombres("cursos");

});
btn_certificaciones.addEventListener("click",(e)=>{
    peticion_nombres("certificaciones");
});
btn_proyectos.addEventListener("click",(e)=>{
    peticion_nombres("proyectos");
});

btn_periodo.addEventListener("click",(e)=>{
    fecha_inicio.disabled = true;
    fecha_fin.disabled = true;
});

btn_historial_completo.addEventListener("click",(e)=>{
    fecha_inicio.valueAsDate = null;
    fecha_fin.valueAsDate = null;
    fecha_inicio.disabled = false;
    fecha_fin.disabled = false;
});

window.addEventListener("load",(e)=>{
    peticion_nombres("cursos");
});


btn_descargar_reportes.addEventListener("click",(e)=>{

    let nombre = titulo.textContent;
    let periodo =  fechas_titulo.textContent;
    let gastos = document.getElementById("gastos").textContent;
    let ingresos = document.getElementById("ingresos").textContent;
    let total  = document.getElementById("total").textContent;
    let cells = document.querySelectorAll("#cuerpo td");
    var fila = "";
    let datos_tabla = ""
    let contador = 0;

    cells.forEach(cell =>{
        
        if(contador == 8){
            if(datos_tabla.length == 0){
                datos_tabla =  fila;
            }else{
                datos_tabla = datos_tabla + ":" + fila;
            }
            
            fila = ""
            contador = 0;
        }
        if(fila.length == 0){
            fila = cell.textContent;
        }else{
            fila = fila + "," +cell.textContent;
        }
        
        contador++;
        
    });
    datos_tabla = datos_tabla + ":" + fila;
   

    var datos_totales = {
        nombre: nombre,
        periodo: periodo,
        gastos: gastos,
        ingresos: ingresos,
        total: total,
        array_datos: datos_tabla
    };
    
    
    postForm("../../controller/administrativo/Pdf_ReporteIn.php", datos_totales);
   

});
function postForm(path, params, method) {
    //hace un formulario oculto para
    // asi mandar los datos al lugar donde descargaremos la info
    //todo es un input
    method = method || 'post';

    var form = document.createElement('form');
    form.setAttribute('method', method);
    form.setAttribute('action', path);
    form.setAttribute('target', '_blank');


    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement('input');
            hiddenField.setAttribute('type', 'hidden');
            hiddenField.setAttribute('name', key);
            hiddenField.setAttribute('value', params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}


function peticion_nombres(tipo){

    let tipo_nombre = new FormData();
    tipo_nombre.append("tipo",tipo);
    tipo_nombre.append("bandera", true);

    fetch("../../controller/administrativo/Mostrar_ReporteIn.php",{
        method:"POST",
        body: tipo_nombre
    }).then(respuesta=> respuesta.json())
      .then(datos=>{

        rellenar_lista(datos);

    });
}

formulario.addEventListener("submit",(e)=>{

    e.preventDefault();

    let fecha1 = fecha_inicio.value;
    let fecha2 = fecha_fin.value;

    if(document.getElementById("nombres").textContent == "" && btn_cursos.checked){

        alert("No hay cursos con seguimiento");

    }else if(document.getElementById("nombres").textContent == "" && btn_certificaciones.checked){

        alert("No hay certificaciones con seguimiento");

    }else if(document.getElementById("nombres").textContent == "" && btn_proyectos.checked){

        alert("No hay proyectos con seguimiento");

    }else if((fecha1 == "" || fecha2 == "") && document.getElementById("periodo").checked ){
        alert("Debe seleccionar una fecha de inicio y una fecha de finalización");
    }else{
        

        let fecha_inicio1 = new Date(fecha1);
        let fecha_fin1 = new Date(fecha2);
      

        if((fecha_inicio1 > fecha_fin1) && document.getElementById("periodo").checked){
            alert("La fecha de inicio no debe ser mayor a la fecha de finalización");
        }else{

            let nombre = getNombre();
            let numero = option_nombre.options[option_nombre.selectedIndex].text.split(" ");
    
            let form_data = new FormData(formulario);
            form_data.append("numero_seguimiento",numero[0]);
            form_data.append("nombre_titulo", nombre);

            fetch("../../controller/administrativo/Mostrar_ReporteIn.php",{
                method:"POST",
                body: form_data
            }).then(respuesta=> respuesta.json())
            .then(datos=>{
                contenedor_tabla.style.display = 'block';
                btn_descargar_reportes.style.display = 'block';
                titulo.innerText = nombre;

                if(document.getElementById("periodo").checked){
                   
                    fechas_titulo.innerText = cambiar_fecha(fecha1) + "  "+ cambiar_fecha(fecha2)  ;
                    rellenar_tabla(datos);
                }else{
                    if(datos[0][0][0] != null && datos[0][0][1] != null){
                        fechas_titulo.innerText = datos[0][0][0] + "  " + datos[0][0][1];   
                    }else{
                        fechas_titulo.innerText = "";
                    }
                    rellenar_tabla(datos[1]);
                    
                }
                
                
            });

        }

        

    }

    

});

//rellenamos el combo nombres
function rellenar_lista(datos) {
    
    

    document.getElementById("nombres").innerHTML = "";

    datos.forEach(registro => {
        var optionElement = document.createElement("option");
        optionElement.value = registro[0] + " " + registro[2];
        optionElement.text = registro[0] + " " + registro[1];
        document.getElementById("nombres").appendChild(optionElement);
    });
    
}

//rellenamos el combo nombres
function rellenar_tabla(datos) {
    //limpiamos la tabla primero
   
    cuerpo_tabla.innerHTML = "";
    totales.innerHTML = "";
    
    sub_hotel = 0;
    sub_transporte = 0;
    sub_comida = 0;
    sub_oficina = 0;
    sub_honorarios = 0;
    sub_sub_gastos  = 0;
    sub_ingresos = 0;
   
    for (let i = 0; i < datos.length; i++) {
        
        
        if(datos[i][0].length == 0){

            continue
        }else{
            
            

            for (let j = 0; j < datos[i][0].length; j++) {

                var row = document.createElement('tr');
                var nombre_col = document.createElement('td');
                var hotel_col = document.createElement('td');
                var transporte_col = document.createElement('td');
                var comida_col = document.createElement('td');
                var oficina_col = document.createElement('td');
                var honorarios_col = document.createElement('td');
                var sub_gastos_col = document.createElement('td');
                var ingresos_col = document.createElement('td'); 

                hotel_col.innerText = "$ 0";
                transporte_col.innerText = "$ 0";
                comida_col.innerText = "$ 0";
                oficina_col.innerText = "$ 0";
                honorarios_col.innerText = "$ 0";
                sub_gastos_col.innerText = "$ 0";
                ingresos_col.innerText = "$ 0";

                //nombres
                nombre_col.innerText = datos[i][0][j]["nombre"];
                identificador = datos[i][0][j]["id"]; 
                
                // gastos
                sub_gastos = 0;
                //agregaremos 6 celdas a la tabla si estan
                for (let k = 0; k < datos[i][1].length ; k++) {
                    if(datos[i][1][k]["id"] === identificador){

                        if(datos[i][1][k][2] == "Hotel"){
                            sub_hotel += parseFloat(datos[i][1][k][1]);
                            hotel_col.innerText = "$ "+parseFloat(datos[i][1][k][1]).toFixed(2);
                        }else if(datos[i][1][k][2] == "Transporte"){
                            sub_transporte += parseFloat(datos[i][1][k][1]);
                            transporte_col.innerText = "$ "+ parseFloat(datos[i][1][k][1]).toFixed(2);
                        }else if(datos[i][1][k][2] == "Comida"){
                            sub_comida += parseFloat(datos[i][1][k][1]);
                            comida_col.innerText = "$ "+parseFloat(datos[i][1][k][1]).toFixed(2);
                        }else if(datos[i][1][k][2] == "Oficina"){
                            sub_oficina += parseFloat(datos[i][1][k][1]);
                            oficina_col.innerText = "$ "+parseFloat(datos[i][1][k][1]).toFixed(2);
                        }else if(datos[i][1][k][2] == "Honorario"){
                            sub_honorarios += parseFloat(datos[i][1][k][1]);
                            honorarios_col.innerText = "$ "+parseFloat(datos[i][1][k][1]).toFixed(2);
                        }
                        sub_gastos += parseFloat(datos[i][1][k][1]);
                    }
                    
                }

                sub_sub_gastos += sub_gastos;
                sub_gastos_col.innerText = "$ "+parseFloat(sub_gastos).toFixed(2);
                
                // ingresos
                //console.log(datos[i][2]);
                if(datos[i][2].length != 0){

                    //checa si todavia hay ingresos, si hay ingresos y son de esa persona se meten
                    for (let index = 0; index < datos[i][2].length; index++) {
                       
                       
                        if(datos[i][2][index][0] === identificador){
                            ingresos_col.innerText = "$ "+ parseFloat(datos[i][2][index][1]).toFixed(2);
                            sub_ingresos += parseFloat(datos[i][2][index][1]);
                        }
                        
                    }
                    
                    
                }

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
        
        
        
    }

    var row = document.createElement('tr');
    var sub_col = document.createElement('td');
    var hotel_col = document.createElement('td');
    var transporte_col = document.createElement('td');
    var comida_col = document.createElement('td');
    var oficina_col = document.createElement('td');
    var honorarios_col = document.createElement('td');
    var sub_gastos_col = document.createElement('td');
    var ingresos_col = document.createElement('td'); 

    sub_col.innerText = "Subtotal";
    hotel_col.innerText = "$ " + parseFloat(sub_hotel).toFixed(2);
    transporte_col.innerText = "$ " + parseFloat(sub_transporte).toFixed(2);
    comida_col.innerText = "$ " + parseFloat(sub_comida).toFixed(2);
    oficina_col.innerText = "$ " + parseFloat(sub_oficina).toFixed(2);
    honorarios_col.innerText = "$ " + parseFloat(sub_honorarios).toFixed(2);
    sub_gastos_col.innerText = "$ " + parseFloat(sub_sub_gastos).toFixed(2);
    ingresos_col.innerText = "$ " + parseFloat(sub_ingresos).toFixed(2);

    sub_col.classList.add('subtotal');
    hotel_col.classList.add('subtotal');
    transporte_col.classList.add('subtotal');
    comida_col.classList.add('subtotal');
    oficina_col.classList.add('subtotal');
    honorarios_col.classList.add('subtotal');
    sub_gastos_col.classList.add('subtotal');
    ingresos_col.classList.add('subtotal');

    row.appendChild(sub_col);
    row.appendChild(hotel_col);
    row.appendChild(transporte_col);
    row.appendChild(comida_col);
    row.appendChild(oficina_col);
    row.appendChild(honorarios_col);
    row.appendChild(sub_gastos_col);
    row.appendChild(ingresos_col);
    cuerpo_tabla.appendChild(row);

    let gastos_totales = document.createElement('div');
    let ingresos_totales = document.createElement('div');
    let total_final = document.createElement('div');
    let cantidad1 = document.createElement("span")
    let cantidad2 = document.createElement("span")
    let cantidad3 = document.createElement("span")
    
    cantidad1.setAttribute("id","gastos");
    cantidad2.setAttribute("id","ingresos");
    cantidad3.setAttribute("id","total");

    cantidad1.textContent = "$ " + parseFloat(sub_sub_gastos).toFixed(2);
    cantidad2.textContent = "$ " + parseFloat(sub_ingresos).toFixed(2);
    cantidad3.textContent = "$ " + parseFloat((sub_ingresos-sub_sub_gastos)).toFixed(2);

    gastos_totales.innerText = "Total de gastos: "  ;
    ingresos_totales.innerText = "Total de ingresos: " ;
    total_final.innerText = "Total: " ;

    gastos_totales.appendChild(cantidad1);
    ingresos_totales.appendChild(cantidad2);
    total_final.appendChild(cantidad3);

    totales.appendChild(ingresos_totales);
    totales.appendChild(gastos_totales);
    totales.appendChild(total_final);


}

function getNombre() {
    //muestra el nombre
    let nombre_elementos = option_nombre.options[option_nombre.selectedIndex].text.split(" ");
    let nombre_completo = "";

    nombre_elementos.shift();

    nombre_elementos.forEach(elemento =>{

        nombre_completo += " " + elemento;
        
    });

    return nombre_completo;
}


function cambiar_fecha(string) {
    let separacion = string.split("-");
    let nueva_fecha = separacion[2] + "/" + separacion[1] +"/"+ separacion[0];
    return nueva_fecha;
    
}