

let bNombre = true
let bApeP = true
let bApeM = true
let bConcepto= true


/*Detecta cuando el boton fue presionado*/
let botonRegistrar = document.getElementById("registrar");
botonRegistrar.addEventListener("click", (e) => {
  
    if (bNombre==false){
        nom_proyecto.style.border = "3px solid red";
        e.preventDefault()
    }else if(bApeP==false){
        obj_proyecto.style.border = "3px solid red";
        e.preventDefault()
    }else if(bApeM==false){
        monto_proyecto.style.border = "3px solid red";
        e.preventDefault()
    }
    else if(bConcepto==false){
        concepto_gen.style.border = "3px solid red";
        e.preventDefault()
    }else{
        validar(true);
    }
});

const expresiones = {
    Nombre: /^[a-zA-ZÁ-Ýá-ý\.\s]{1,40}$/,
    ApeP: /^[a-zA-ZÁ-Ýá-ý\s]{1,20}$/,
    ApeM: /^[a-zA-ZÁ-Ýá-ý\s]{0,20}$/,
    Concepto:/^[a-zA-ZÁ-ý\s ,.0-9;:_"#]{1,400}$/,

}

formularioPolGral.nombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    formularioPolGral.nombre.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

    if (!expresiones.Nombre.test(valorInput)) {
        nombre.style.border = "3px solid red";
        bNombre= false
	}else{
        nombre.removeAttribute("style");
        bNombre = true
    } 
})

formularioPolGral.apellido_pat.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    formularioPolGral.apellido_pat.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');


    if (!expresiones.ApeP.test(valorInput)) {
        apellido_pat.style.border = "3px solid red";
        bApeP= false
	}else{
        apellido_pat.removeAttribute("style");
        bApeP = true
    } 
})

formularioPolGral.apellido_mat.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioPolGral.apellido_mat.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');


    if (!expresiones.ApeM.test(valorInput)) {
        apellido_mat.style.border = "3px solid red";
        bApeM= false
	}else{
        apellido_mat.removeAttribute("style");
        bApeM = true
    } 
})

formularioPolGral.concepto_gen.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioPolGral.concepto_gen.value = valorInput.replace(/[^a-zA-ZÁ-ý\s ,.0-9;:_"#]/g, '');


    if (!expresiones.Concepto.test(valorInput)) {
        concepto_gen.style.border = "3px solid red";
        bConcepto = false
	}else{
        concepto_gen.removeAttribute("style");
        bConcepto = true
    }
})


function validar(bandera){
    const registrar = document.getElementById('registrar');
    if(bandera == true){
        registrar.disabled=false;
       
    }
    else{
        registrar.disabled=true;
       
    }

}

