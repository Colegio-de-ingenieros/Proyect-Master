
let concepto = false
let monto = false
let conceptopdf = false

const tabla = []

fila = 0;

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

        const archivo = document.getElementById("archivo");

        var rutaCompleta = archivo.value;
        var partes = rutaCompleta.split("\\");
        var nombreArchivo = partes[partes.length - 1];

        const conceptos = document.getElementById("concepto").value;
        const montos = document.getElementById("monto").value;
        const concepto_pdf = document.getElementById("concepto_pdf").value;

        filas = []
        if (combo != "" && nombreArchivo != "") {
            var nombreArchivo2 = document.getElementById("archivo").files[0].name;
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
                cell6.innerHTML = montos;
                cell6.id = "cantidad";
                cell7.innerHTML = "";
                cell8.innerHTML = concepto_pdf;
                cell9.innerHTML = nombreArchivo;
                cell10.innerHTML = "<button class='btn btn-small btn-danger ti ti-backspace-filled' id="+fila+" onclick = 'eliminar(this)' type='button'></button>";
                fila = fila + 1;
                tbody.insertBefore(row, filaInferior);
                debe.textContent = parseFloat(debe_value.replace(/\$|,/g, '')) + parseFloat(montos);
                
                filas.push(conceptos);
                filas.push(montos);
                filas.push(concepto_pdf);
                filas.push(nombreArchivo2);
                filas.push("Debe");
                tabla.push(filas);

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
                cell7.innerHTML = montos;
                cell7.id = "cantidad";
                cell8.innerHTML = concepto_pdf;
                cell9.innerHTML = nombreArchivo;
                cell10.innerHTML = "<button class='btn btn-small btn-danger ti ti-backspace-filled' id="+fila+" onclick = 'eliminar2(this)' type='button'></button>";
                fila = fila + 1;
                tbody.insertBefore(row, filaInferior);
                haber.textContent = parseFloat(haber_value.replace(/\$|,/g, '')) + parseFloat(montos);
                filas.push(conceptos);
                filas.push(montos);
                filas.push(concepto_pdf);
                filas.push(nombreArchivo2);
                filas.push("Haber");
                tabla.push(filas);
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
    Concepto:/^[a-zA-ZÁ-ý\s ,.-0-9;:_"#]{1,150}$/,

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
    console.log(ext);
    if (archivo && archivo.size > maxSize) {
      alert("El archivo seleccionado supera el tamaño máximo permitido de 3MB");
      input.value = ""; // Limpia el valor del campo de archivo
    }
    else if (ext != "pdf") {
        alert("Extensión no permitida: " + ext);
        input.value = ""; // Limpia el valor del campo de archivo
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
        alert("No se puede registrar una poliza sin movimientos");
    }else if (haber_total != deber_total) {
        alert("La poliza no esta cuadrada");
    }else{
        var formData = new FormData();
        formData.append("tabla", JSON.stringify(tabla));


        const archivosInput = document.getElementById("archivo");

        for (let i = 0; i < archivosInput.files.length; i++) {
            formData.append("archivo[]", archivosInput.files[i]);
            console.log(archivosInput.files[i]);
        }

  
  
        fetch('../../controller/administrativo/Registro_Individual_Polizas.php', {
          method: 'POST',
          body: formData
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            if (data === 'exito') {
                alert (data);
                
            }
            //los datos no pasaron alguna validacion
            else {
                alert (data);
            }
        })
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
   
    debe.textContent = parseFloat(debe_value.replace(/\$|,/g, '')) - parseFloat(montoTexto);
    
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
    haber.textContent = parseFloat(haber_value.replace(/\$|,/g, '')) - parseFloat(montoTexto);
    
    
}