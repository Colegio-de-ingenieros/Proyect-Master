let montoGasto = false
let montoIngreso = false

//detecta el click del boton anadir2
let botonDos = document.getElementById("anadir2");
botonDos.addEventListener("click", (e) =>{
    console.log(montoGasto)
    if (montoGasto == false) {
        gastos_monto.style.border = "3px solid red";
    } else {
        validarUno(true)
    }
})

//detecta el click del boton anadir3
let botonTres = document.getElementById("anadir3");
botonTres.addEventListener("click", (e) =>{
    console.log(montoIngreso)
    if (montoIngreso == false) {
        ingresos_monto.style.border = "3px solid red";
    } else {
        validarDos(true)
    }
})


//definicion de las expresiones regulares
const expresiones = {
    monto: /^[0-9]+(.([0-9])+)*$/,
}

//revisa el campo monto de gastos
formulario_Gastos.gastos_monto.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    formulario_Gastos.gastos_monto.value = valorInput

    //Eliminar espacios en blanco
	.replace(/\s/g, '')
    //Elimina caracteres especiales
    .replace(/[^0-9.]/g, '');
    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.monto.test(valorInput)) {
        gastos_monto.style.border = "3px solid red";
        montoGasto = false
    } else {
        gastos_monto.removeAttribute("style");
        montoGasto = true;
    }

    validarUno(montoGasto);
})


//revisa el campo monto de ingresos
formulario_Ingresos.ingresos_monto.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    formulario_Ingresos.ingresos_monto.value = valorInput

    //Eliminar espacios en blanco
	.replace(/\s/g, '')
    //Elimina caracteres especiales
    .replace(/[^0-9.]/g, '');
    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.monto.test(valorInput)) {
        ingresos_monto.style.border = "3px solid red";
        montoIngreso = false
    } else {
        ingresos_monto.removeAttribute("style");
        montoIngreso = true;
    }

    validarDos(montoIngreso);
})


function validarUno(bandera){
    const anadir2 = document.getElementById('anadir2');
    if(bandera == false){     
        console.log("bloqueado")        
        anadir2.disabled=true;
    }else{
        console.log("desbloqueado") 
        anadir2.disabled=false;
    }
}

function validarDos(bandera){
    const anadir3 = document.getElementById('anadir3');
    if(bandera == false){     
        console.log("bloqueadoDos")        
        anadir3.disabled=true;
    }else{
        console.log("desbloqueadoDos") 
        anadir3.disabled=false;
    }
}