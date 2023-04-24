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

btn_descargar_reportes.addEventListener("click",(e)=>{

    window.open("../../controller/administrativo/Pdf_ReporteIn.php");

});

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

    if(btn_cursos.checked == false && 
       btn_certificaciones.checked == false && 
       btn_proyectos.checked == false){

        alert("Debe seleccionar un nombre de actividad");

    }else if((fecha1 == "" || fecha2 == "") && document.getElementById("periodo").checked ){
        alert("Debe seleccionar una fecha de inicio y una fecha de Finalización");
    }else{
        

        let fecha_inicio1 = new Date(fecha1);
        let fecha_fin1 = new Date(fecha2);

        if((fecha_inicio1 > fecha_fin1) && document.getElementById("periodo").checked){
            alert("La fecha de inicio no debe ser mayor a la fecha de Finalización");
        }else{

            let nombre = document.getElementById("nombres").textContent.split(" ")[1];
            let numero = document.getElementById("nombres").value.split(" ");
    
            let form_data = new FormData(formulario);
            form_data.append("numero_seguimiento",numero[0]);
            form_data.append("nombre_titulo", nombre);

            fetch("../../controller/administrativo/Mostrar_ReporteIn.php",{
                method:"POST",
                body: form_data
            }).then(respuesta=> respuesta.json())
            .then(datos=>{

                if(document.getElementById("periodo").checked){
                    fechas_titulo.innerText = fecha1 + "  "+ fecha2  ;
                }else{
                    fechas_titulo.innerText = "";
                }
                contenedor_tabla.style.display = 'block';
                btn_descargar_reportes.style.display = 'block';
                titulo.innerText = nombre;
                rellenar_tabla(datos);
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
                            hotel_col.innerText = "$ "+datos[i][1][k][1];
                        }else if(datos[i][1][k][2] == "Transporte"){
                            sub_transporte += parseFloat(datos[i][1][k][1]);
                            transporte_col.innerText = "$ "+datos[i][1][k][1];
                        }else if(datos[i][1][k][2] == "Comida"){
                            sub_comida += parseFloat(datos[i][1][k][1]);
                            comida_col.innerText = "$ "+datos[i][1][k][1];
                        }else if(datos[i][1][k][2] == "Oficina"){
                            sub_oficina += parseFloat(datos[i][1][k][1]);
                            oficina_col.innerText = "$ "+datos[i][1][k][1];
                        }else if(datos[i][1][k][2] == "Honorario"){
                            sub_honorarios += parseFloat(datos[i][1][k][1]);
                            honorarios_col.innerText = "$ "+datos[i][1][k][1];
                        }
                        sub_gastos += parseFloat(datos[i][1][k][1]);
                    }
                    
                }

                sub_sub_gastos += sub_gastos;
                sub_gastos_col.innerText = "$ "+sub_gastos;
                
                // ingresos
                //console.log(datos[i][2]);
                if(datos[i][2].length != 0){

                    //checa si todavia hay ingresos, si hay se mete si no no
                    if( j < datos[i][2].length){
                        
                        ingresos_col.innerText = "$ "+ datos[i][2][j][1];
                        sub_ingresos += parseFloat(datos[i][2][j][1]);
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
    hotel_col.innerText = "$ " + sub_hotel;
    transporte_col.innerText = "$ " + sub_transporte;
    comida_col.innerText = "$ " + sub_comida;
    oficina_col.innerText = "$ " + sub_oficina;
    honorarios_col.innerText = "$ " + sub_honorarios;
    sub_gastos_col.innerText = "$ " + sub_sub_gastos;
    ingresos_col.innerText = "$ " + sub_ingresos;

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

    gastos_totales.innerText = "Total de gastos: $ " + sub_sub_gastos ;
    ingresos_totales.innerText = "Total de ingresos: $ " + sub_ingresos;
    total_final.innerText = "Total: $" + (sub_ingresos-sub_sub_gastos);

    totales.appendChild(gastos_totales);
    totales.appendChild(ingresos_totales);
    totales.appendChild(total_final);


}


