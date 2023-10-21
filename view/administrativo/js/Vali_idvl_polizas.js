
let concepto = false
let monto = false
let conceptopdf = false

let cantidad_pdf = 0 

const tabla = []

fila = 0;

window.onload = function() {
    const url1 = window.location.href;
    console.log(url1);
    const parts = url1.split('?');
    console.log(parts);
    if (parts.length === 2) {
        // Divide la segunda parte (que contiene 'id=123') por '&'
        const params = parts[1].split('&');
        console.log(params);
        for (const param of params) {
            const [key, value] = param.split('=');
            if (key === 'idPol') {
                id1 = value; // Esto mostrará el valor del 'id' en la consola
                break;
            }
        }
    }
    id = id1;
    /* id = "0002"; */
    let url = "../../controller/administrativo/Registro_indvl_poliza_precarga.php";

    let form = new FormData();
    form.append("id", id1);
    
    fetch(url, {
        method: "POST",
        body: form
    })
        .then(response => response.json())
        
        .then(data => { 
        console.log(data);
        let primer_nombre = data[0]["NomElaPol"];
        let folio = String(data[0]["IdPolGral"]);
        let apellido_materno = data[0]["ApeMElaPol"];
        let apellido_paterno = data[0]["ApePElaPol"];
        let fecha_poliza = String(data[0]["FechaPolGral"]);
        let concepto_general = String(data[0]["CoceptoGral"]);
        if (apellido_materno == null) {
            apellido_materno = "";
        }

        let nombre = primer_nombre + " " + apellido_paterno + " " + apellido_materno;

        var folioElement = document.getElementById("folio_individual");
        var personaElaboracionElement = document.getElementById("persona_de_elaboracion");
        var fecha = document.getElementById("fecha_actual");
        var concept = document.getElementById("concepto_general");
      
        // Set the text content for the elements
        folioElement.textContent = folio; // Replace "Your Folio Text" with the desired text
        personaElaboracionElement.textContent = nombre; // Replace with the desired name
        fecha.textContent = fecha_poliza; // Replace with the desired date
        concept.textContent = concepto_general;

        //------------------------------------------------------------------------------------

        console.log(Object.keys(data[1]).length);
        if (Object.keys(data[1]).length == 8){
        var nom_persona = document.getElementById("nombre_persona");
        var servicios = document.getElementById("servicios");
        nom_perso =data[1]["NomPerso"];
        apep_perso =data[1]["ApePPerso"];
        apem_perso =data[1]["ApeMPerso"];
        tipo=data[2]['SerPol'];
        ser = data[1]["TipoU"];
        if (ser=="Asociado"){
            ser = "Asoc";
        }
        else if (ser=="Socio"){
            ser = "Soc";
        }
        if (apem_perso == null) {
            apem_perso = "";
        }

        if (tipo=="Membresía"){
            servicios.textContent=tipo;
        }

        else if (tipo=="Headhunter"){
            servicios.textContent=tipo;
        }
        else if (tipo=="Consultoría"){
            servicios.textContent=tipo;
        }
        else if (tipo=="Curso"){
            curso=data[3]["NomCur"];
            servicios.textContent=tipo+": "+curso;
        }

        else if (tipo=="Certificación"){
            curso=data[3]["NomCertInt"];
            servicios.textContent=tipo+": "+curso;
        }


        nom_persona.textContent = ser+": "+ nom_perso+" "+apep_perso+" "+apem_perso;

    }else if (Object.keys(data[1]).length == 2){
        var nom_persona = document.getElementById("nombre_persona");
        var servicios = document.getElementById("servicios");
        nom_empr =data[1]["NomUsuaEmp"];
        tipo=data[2]['SerPol'];
        if (tipo=="Membresía"){
            servicios.textContent=tipo;
        }

        else if (tipo=="Headhunter"){
            servicios.textContent=tipo;
        }
        else if (tipo=="Consultoría"){
            servicios.textContent=tipo;
        }
        else if (tipo=="Curso"){
            curso=data[3]["NomCur"];
            servicios.textContent=tipo+": "+curso;
        }

        else if (tipo=="Certificación"){
            curso=data[3]["NomCertInt"];
            servicios.textContent=tipo+": "+curso;
        }
        nom_persona.textContent = "Emp: "+ nom_empr;
        
    }
    })
    .catch(error => console.log(error));
    
}

/*Detecta cuando el boton fue presionado*/
let inserta = document.getElementById("btn_agregar");
inserta.addEventListener("click", (e) => {
    e.preventDefault();
    if (concepto==false){
        concept.style.border = "3px solid red";
        e.preventDefault()
    }else if(monto==false){
        amount.style.border = "3px solid red";
        e.preventDefault()
    }else if(conceptopdf==false){
        conceptpdf.style.border = "3px solid red";
        e.preventDefault()
    }
    else{
        //obtener el valor de la combobox y el nombre del archivo
        const combo = document.getElementById("tipoGradoPerso").value;

       /*  const archivo = document.getElementById("archivo"); */

       /*  var rutaCompleta = archivo.value;
        var partes = rutaCompleta.split("\\"); */
        //var nombreArchivo = partes[partes.length - 1];
        var nombreArchivo = "";

        const conceptos = document.getElementById("concepto").value;
        const montos = document.getElementById("monto").value;
        const concepto_pdf = document.getElementById("concepto_pdf").value;

        const text1 = document.getElementById("concepto");
        const saldo = document.getElementById("monto");
        const text2 = document.getElementById("concepto_pdf");

        filas = []
        if (combo != "") {
            /* var nombreArchivo2 = document.getElementById("archivo").files[0].name; */
            const filaInferior = document.getElementById("footer");
            const debe = document.getElementById("debe");
            const haber = document.getElementById("haber");
            const debe_value = document.getElementById("debe").textContent;
            const haber_value = document.getElementById("haber").textContent;
            //console.log("archivo2"+nombreArchivo2);
            if (combo == "1") {
                //alert("pdf"+nombreArchivo);
                var table = document.getElementById("tabla");
                var tbody = document.getElementById("body_tabla");
                 

                var row = tbody.insertRow();
                var cell1 = row.insertCell();
                cell1.setAttribute("colspan", "5");
                var cell6 = row.insertCell();
                var cell7 = row.insertCell();
                var cell8 = row.insertCell();
                var cell9 = row.insertCell();
                var cell10 = row.insertCell();

                // Agrega contenido a las celdas
                cell1.innerHTML = conceptos;
                cell6.innerHTML = "$ "+ montos;
                cell6.style.textAlign = "right";
                cell6.id = "cantidad";
                cell7.innerHTML = "";
                cell8.innerHTML = concepto_pdf;
                //cell9.innerHTML = nombreArchivo;
                var idd = "des"+fila;
                cell9.innerHTML = "<input type='file' accept='application/pdf' onchange='validarArchivo(this)' id ='"+fila+"'></input><div id='"+idd+"'></div>";
                /* var fileInput = document.createElement("input");
            fileInput.type = "file";
            fileInput.accept = ".pdf";
            cell9.appendChild(fileInput); */
                cell10.innerHTML = "<button class='btn btn-small btn-danger ti ti-backspace-filled' id="+fila+" onclick = 'eliminar(this)' type='button'></button>";
                fila = fila + 1;
                tbody.insertBefore(row, filaInferior);
                debe.textContent = "$ "+(parseFloat(debe_value.replace(/\$|,/g, '')) + parseFloat(montos));
                debe.style.textAlign = "right";
                filas.push(conceptos);
                filas.push(montos);
                filas.push(concepto_pdf);
                filas.push("x");
                filas.push("Debe");
                tabla.push(filas);
                cantidad_pdf = cantidad_pdf +1;
                filas.push(cantidad_pdf);

                text1.value = "";
                saldo.value = "";
                text2.value = "";
                var tipoGradoPerso = document.getElementById("tipoGradoPerso"); // Obtén el cuadro de selección por su ID

                // Restablece la opción predeterminada (Seleccione un tipo) seleccionando el primer elemento de opción
                tipoGradoPerso.selectedIndex = 0;
                concepto = false
                monto = false
                conceptopdf = false

                alert("Agregado exitosamente");


                const todo_d= document.getElementById("debe").textContent;
                const todo_h = document.getElementById("haber").textContent;
                const haber_tot = parseFloat(todo_h.replace(/\$|,/g, ''));
                const deber_tot = parseFloat(todo_d.replace(/\$|,/g, ''));
                
                if (haber_tot != deber_tot){
                    var di = document.getElementById("debe");
                    var hi = document.getElementById("haber");
                    di.style.backgroundColor = "rgb(235, 71, 71)";
                    di.style.fontWeight = "600";
                    di.style.color = "white";
                    di.textAlign = "right";

                    // Establecer los estilos para "haber"
                    hi.style.backgroundColor = "rgb(235, 71, 71)";
                    hi.style.fontWeight = "600";
                    hi.style.color = "white";
                    hi.style.textAlign = "right";
                }else{
                    var di = document.getElementById("debe");
                    var hi = document.getElementById("haber");
                    hi.removeAttribute("style");
                    di.removeAttribute("style");
                    hi.style.textAlign = "right";
                    di.style.textAlign = "right";
                }





            }else if (combo == "2") {
                var table = document.getElementById("tabla");
                var tbody = document.getElementById("body_tabla");
                var row = tbody.insertRow();
                var cell1 = row.insertCell();
                cell1.setAttribute("colspan", "5");
                var cell6 = row.insertCell();
                var cell7 = row.insertCell();
                var cell8 = row.insertCell();
                var cell9 = row.insertCell();
                var cell10 = row.insertCell();
    
                // Agrega contenido a las celdas
                cell1.innerHTML = conceptos;
                cell6.innerHTML = "";
                cell7.innerHTML = "$ "+montos;
                cell7.style.textAlign = "right";
                cell7.id = "cantidad";
                cell8.innerHTML = concepto_pdf;
                //cell9.innerHTML = nombreArchivo;
                var idd = "des"+fila;
                cell9.innerHTML = "<input type='file' accept='application/pdf' onchange='validarArchivo(this)' id ='"+fila+"'></input><div id ='"+idd+"'></div>";
                /* var fileInput = document.createElement("input");
                fileInput.type = "file";
                fileInput.accept = ".pdf"; */
                /* cell9.appendChild(fileInput); */
                cell10.innerHTML = "<button class='btn btn-small btn-danger ti ti-backspace-filled' id="+fila+" onclick = 'eliminar2(this)' type='button'></button>";
                fila = fila + 1;
                tbody.insertBefore(row, filaInferior);
                haber.textContent = "$ "+ (parseFloat(haber_value.replace(/\$|,/g, '')) + parseFloat(montos));
                haber.style.textAlign = "right";
                filas.push(conceptos);
                filas.push(montos);
                filas.push(concepto_pdf);
                filas.push("x");
                filas.push("Haber");
                tabla.push(filas);
                cantidad_pdf = cantidad_pdf +1;
                filas.push(cantidad_pdf);
                alert("Agregado exitosamente");
                text1.value = "";
                saldo.value = "";
                text2.value = "";
                var tipoGradoPerso = document.getElementById("tipoGradoPerso"); // Obtén el cuadro de selección por su ID
                concepto = false
                monto = false
                conceptopdf = false
                // Restablece la opción predeterminada (Seleccione un tipo) seleccionando el primer elemento de opción
                tipoGradoPerso.selectedIndex = 0;

                const todo_d= document.getElementById("debe").textContent;
                const todo_h = document.getElementById("haber").textContent;
                const haber_tot = parseFloat(todo_h.replace(/\$|,/g, ''));
                const deber_tot = parseFloat(todo_d.replace(/\$|,/g, ''));
                
                if (haber_tot != deber_tot){
                    var di = document.getElementById("debe");
                    var hi = document.getElementById("haber");
                    di.style.backgroundColor = "rgb(235, 71, 71)";
                    di.style.fontWeight = "600";
                    di.style.color = "white";
                    di.textAlign = "right";

                    // Establecer los estilos para "haber"
                    hi.style.backgroundColor = "rgb(235, 71, 71)";
                    hi.style.fontWeight = "600";
                    hi.style.color = "white";
                    hi.style.textAlign = "right";
                }else{
                    var di = document.getElementById("debe");
                    var hi = document.getElementById("haber");
                    hi.removeAttribute("style");
                    di.removeAttribute("style");
                    hi.style.textAlign = "right";
                    di.style.textAlign = "right";
                }

            }
        }else{
            alert("faltan campos por llenar");
        }


    
    }
});

const expresiones = {
    Nombre: /^[a-zA-ZÁ-Ýá-ý\.\s]{1,40}$/,
    Apellidos: /^[a-zA-ZÁ-Ýá-ý\s]{1,20}$/,

    e_monto: /^[0-9]+(.([0-9])+)*$/,
    Concepto: /^[a-zA-Z0-9Á-ý\s ,.-;-:_"#]{1,150}$/,

}
let concept = document.getElementById("concepto");
concept.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	concept.value = valorInput

    .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº`´·°¿⌐¬½¼«»÷±~!¡@$%^&^*()+\=\[\]{}'\\|<>\/?]/g, '')

    if (!expresiones.Concepto.test(valorInput)) {
        concept.style.border = "3px solid red";
        concepto = false
	}else{
        concept.removeAttribute("style");
        concepto = true
    }
})


let conceptpdf = document.getElementById("concepto_pdf");
conceptpdf.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	conceptpdf.value = valorInput

    .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº`´·°¿⌐¬½¼«»÷±~!¡@$%^&^*()+\=\[\]{}'\\|<>\/?]/g, '')

    if (!expresiones.Concepto.test(valorInput)) {
        conceptpdf.style.border = "3px solid red";
        conceptopdf = false
	}else{
        conceptpdf.removeAttribute("style");
        conceptopdf = true
    }
})


let amount = document.getElementById("monto");
amount.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	amount.value = valorInput
    // Eliminar espacios en blanco
   .replace(/\s/g, '')
   //Elimina letras
   .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNMéáíóúñÑªº¿®ÁÉ±|Í¶ÓÚ]/g, '')
   // Eliminar caracteres especiales
   .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒª`´·¨°º¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':" \\|,<>\/?]/g, '')
   // Eliminar el ultimo espaciado
   .trim();
   //elimina el ultimo punto agregado si ya habia otro
   if (verificarPuntos(valorInput) == true) {
    amount.style.border = "3px solid red";
    valorInput = valorInput.substr(0, valorInput.length - 1);
    amount.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput) == true) {
        amount.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        amount.value = valorInput;
    }

    if (validarDecimales(valorInput) == true) {
        valorInput = valorInput.substr(0, valorInput.length - 1);
        //alert(valorInput.length);
        amount.value = valorInput;
    }

    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.e_monto.test(valorInput)) {
        amount.style.border = "3px solid red";
        monto = false
    } else {
        amount.removeAttribute("style");
        monto = true;
    }
})



function validarUno(bandera){
    const anadir2 = document.getElementById('actualizar');
    if(bandera == false){     
        console.log("bloqueado")        
        anadir2.disabled=true;
    }else{
        console.log("desbloqueado") 
        anadir2.disabled=false;
    }
}


//funcion para verificar que la cadena no tenga mas de un punto
function verificarPuntos(cadena){
    var puntos = 0;

    for (i = 0; i < cadena.length; i++){
        if (cadena[i] == '.') {
            puntos++;
        }
    }
    if (puntos >= 2) {
        return true
    }
    else {
        return false
    }
}

//funcion para verificar que el primer caracter no sea un punto, retorna true si si es un punto
function primeroNum(cadena){
    if (cadena[0] == '.') {
        return true
    }
    else {
        return false
    }
}

//verifica que si el ultimo caracter de una cadena es un punto
function ultimoNum(cadena)
{
    //alert(cadena.length);
    if (cadena.length >= 1) {
        if (cadena[cadena.length - 1] == '.') {
            return true
        }
        else {
            return false
        }
    }
    else {
        return false;
    }
}

//verifica que la cadena no tenga mas de dos decimales
function validarDecimales(cadena){
    var decimales = 0
    var j = cadena.length - 1
    var puntos = 0;
    console.log(cadena);
    for (i = 0; i < cadena.length; i++) {
        if (cadena[i] == '.') {
            puntos++;
        }
    }

    if (puntos == 1) {
        while (cadena[j] != '.' && j > 1) {
            decimales++;
            j--;
            console.log("decimales: " + decimales);
        }

        if (decimales >= 3) {
            return true
        }

        else {
            return false
        }
    }

    else {
        return false
    }

}



function validar(bandera){
    console.log(bandera);
}

function validarArchivo(input) {
    var archivo = input.files[0];
    var maxSize = 3 * 1024 * 1024; // 3MB
    var ext = input.value.split('.').pop().toLowerCase();
    var lugar = input.parentNode.parentNode;
    console.log(ext);
    if (archivo && archivo.size > maxSize) {
      alert("El archivo seleccionado supera el tamaño máximo permitido de 3MB");
      input.value = ""; // Limpia el valor del campo de archivo
    }
    else if (ext != "pdf") {
        alert("Extensión no permitida: " + ext);
        input.value = ""; // Limpia el valor del campo de archivo
        j = input.id;
        
        r = document.getElementById("des"+j);
        r.textContent = "";
    } 
    else{
        j = input.id;
        
        r = document.getElementById("des"+j);
        r.textContent = input.files[0].name;
        input.removeAttribute("style");
    
    /* input.removeAttribute("style");
    a = document.getElementById("des");
    a.textContent = input.files[0].name; */
    }
  }


function registrar(){
    const debe = document.getElementById("debe");
    const haber = document.getElementById("haber");
    const debe_value = document.getElementById("debe").textContent;
    const haber_value = document.getElementById("haber").textContent;
    const haber_total = parseFloat(haber_value.replace(/\$|,/g, ''));
    const deber_total = parseFloat(debe_value.replace(/\$|,/g, ''));
    
    if (haber_total == deber_total && haber_total == 0 && deber_total == 0) {
        /* alert("No se puede registrar una poliza sin movimientos"); */
        var d = document.getElementById("debe");
        var h = document.getElementById("haber");
    }else if (haber_total != deber_total) {
        var d = document.getElementById("debe");
        var h = document.getElementById("haber");
        d.style.backgroundColor = "rgb(235, 71, 71)";
        d.style.fontWeight = "600";
        d.style.color = "white";
        d.textAlign = "right";

        // Establecer los estilos para "haber"
        h.style.backgroundColor = "rgb(235, 71, 71)";
        h.style.fontWeight = "600";
        h.style.color = "white";
        h.style.textAlign = "right";
        alert("Los totales de los campos debe y haber no coinciden"); 
    }else{
        var d = document.getElementById("debe");
        var h = document.getElementById("haber");
        d.removeAttribute("style");
        h.removeAttribute("style");
        d.style.textAlign = "right";
        h.style.textAlign = "right";
        lista_id=[];
        lista_id.push(id);
        var formData = new FormData();
        formData.append("tabla", JSON.stringify(tabla));
        formData.append("id_general", JSON.stringify(lista_id));

        console.log(tabla);

        lista = []
        var fileInputs = document.querySelectorAll('input[type="file"]');
        console.log("inputs"+fileInputs.length);
           /*  var formData = new FormData(); */
            console.log(fileInputs);

            let con = 0;
            fileInputs.forEach(function(input) {
                if (input.files.length > 0) {
                    console.log(input.files[0]);
                    formData.append("pdfs[]", input.files[0]);
                    con = con+1;
                    /* lista.push(input.files[0]); */
                    input.removeAttribute("style"); 
                }
                else {
                    input.style.backgroundColor = "rgb(235, 71, 71)";
                }
                
            });
            console.log("con"+con);
            console.log("pdf"+cantidad_pdf)
            /* formData.append("pdfs", JSON.stringify(lista));
            console.log(formData); */
        if (con==cantidad_pdf){
        fetch('../../controller/administrativo/Registro_Individual_Polizas.php', {
                method: "POST",
                body: formData
            })
            .then(function(response) {
                if (response.ok) {
                    //alert("Los PDFs se han guardado con éxito en el servidor.");
                    alert("Registro exitoso");
                    window.location.href = "../../view/administrativo/Vista_Polizas.html";
                } else {
                    alert("Hubo un problema al guardar los PDFs en el servidor.");
                }
            })
            .catch(function(error) {
                console.error("Error en la solicitud fetch:", error);
            });
        }else{
            alert("favor de subir los comprobantes faltantes")
        }
    }
}

function eliminar(button){
    btnid = button.id;
    console.log("numero de fila"+btnid);

    tabla[parseInt(btnid)] = "n/a"

    var row = button.parentNode.parentNode;
    var montoElement = row.querySelector('#cantidad');
    var montoTexto = montoElement.textContent;
    console.log(montoTexto);
    row.parentNode.removeChild(row);

    const debe = document.getElementById("debe");
    
    const debe_value = document.getElementById("debe").textContent;
   
    debe.textContent = "$ "+ (parseFloat(debe_value.replace(/\$|,/g, '')) - parseFloat(montoTexto.replace(/\$|,/g, '')));
    debe.style.textAlign = "right";
    cantidad_pdf = cantidad_pdf -1;

    const todo_d= document.getElementById("debe").textContent;
    const todo_h = document.getElementById("haber").textContent;
    
    const haber_tot = parseFloat(todo_h.replace(/\$|,/g, ''));
    const deber_tot = parseFloat(todo_d.replace(/\$|,/g, ''));
    
    if (haber_tot != deber_tot){
        var di = document.getElementById("debe");
        var hi = document.getElementById("haber");
        di.style.backgroundColor = "rgb(235, 71, 71)";
        di.style.fontWeight = "600";
        di.style.color = "white";
        di.textAlign = "right";

        // Establecer los estilos para "haber"
        hi.style.backgroundColor = "rgb(235, 71, 71)";
        hi.style.fontWeight = "600";
        hi.style.color = "white";
        hi.style.textAlign = "right";
    }else{
        var di = document.getElementById("debe");
        var hi = document.getElementById("haber");
        hi.removeAttribute("style");
        di.removeAttribute("style");
        hi.style.textAlign = "right";
        di.style.textAlign = "right";
    }

}
function eliminar2(button){
    btnid = button.id;
    console.log("numero de fila"+btnid);

    tabla[parseInt(btnid)] = "n/a"

    var row = button.parentNode.parentNode;
    var montoElement = row.querySelector('#cantidad');
    var montoTexto = montoElement.textContent;
    console.log(montoTexto);
    row.parentNode.removeChild(row);

   
    const haber = document.getElementById("haber"); 
    const haber_value = document.getElementById("haber").textContent; 
    haber.textContent = "$ "+ (parseFloat(haber_value.replace(/\$|,/g, '')) - parseFloat(montoTexto.replace(/\$|,/g, '')));
    haber.style.textAlign = "right";
    cantidad_pdf = cantidad_pdf -1;


    const todo_d= document.getElementById("debe").textContent;
    const todo_h = document.getElementById("haber").textContent;
    const haber_tot = parseFloat(todo_h.replace(/\$|,/g, ''));
    const deber_tot = parseFloat(todo_d.replace(/\$|,/g, ''));
    
    if (haber_tot != deber_tot){
        var di = document.getElementById("debe");
        var hi = document.getElementById("haber");
        di.style.backgroundColor = "rgb(235, 71, 71)";
        di.style.fontWeight = "600";
        di.style.color = "white";
        di.textAlign = "right";

        // Establecer los estilos para "haber"
        hi.style.backgroundColor = "rgb(235, 71, 71)";
        hi.style.fontWeight = "600";
        hi.style.color = "white";
        hi.style.textAlign = "right";
    }else{
        var di = document.getElementById("debe");
        var hi = document.getElementById("haber");
        hi.removeAttribute("style");
        di.removeAttribute("style");
        hi.style.textAlign = "right";
        di.style.textAlign = "right";
    }

}

//responde cuando hay un click en el boton cancelar
function cancelar(){
    let urlAct = window.location+''

    var resp = confirm("Los cambios realizados no se guardarán, ¿desea continuar?");
    if(resp ==  true){
      window.location.href='../../view/administrativo/Vista_Polizas.html';
    }
}
