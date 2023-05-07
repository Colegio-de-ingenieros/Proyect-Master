let bRechazo = false  

var radioButton1 = document.getElementById("ti_ck1");
var radioButton2 = document.getElementById("ti_ck2");

let botonRegresar = document.getElementById("boton_registro");

botonRegresar.addEventListener("click", (e) => {

    if(bRechazo==false){
        descri_puesto.style.border = "3px solid red";
    }else if(!(radioButton1.checked || radioButton2.checked)){
        alert("Debes marcar uno de los dos botones");
    }
    else{
        validar(true);
    }
});

const expresiones = {
    cadenasAcademicos:/^[a-zA-ZÁ-ý 0-9,.\s]{1,1000}$/,
    cadenasDescripcion:/^[a-zA-ZÁ-ý 0-9,.\s]{1,1000}$/,

}


formula.descri_puesto.addEventListener('keyup', (e) => {

	let valorInput = e.target.value;
    //console.log(valorInput);
	formula.descri_puesto.value = valorInput
   // Eliminar numeros
   //.replace(/[0-9]/g, '')
   // Eliminar caracteres especiales
  .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôö·òûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷°¨±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|<>\/?]/g, '')

    if (!expresiones.cadenasAcademicos.test(valorInput)) {
        descri_puesto.style.border = "3px solid red";
        bRechazo = false
	}else{
        descri_puesto.removeAttribute("style");
        bRechazo = true
    }
    validar(bRechazo);
});

function validar(bandera){
    const guardar = document.getElementById('boton_registro');
    if(bandera == false){              
        guardar.disabled=true;
        
    }
    else if (bandera == true){
        guardar.disabled=false;
        

    }
    else{
        guardar.disabled=true;
    }

}