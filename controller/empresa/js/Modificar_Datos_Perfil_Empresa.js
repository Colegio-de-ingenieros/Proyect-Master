
let baderas = {
    brfc: false,
    bnombre_empresa: false,
    bcorreo_empresa: false,
    bcontra: false,
    bcontra_conf: false,
    bcontra_actual: false,
    brazon: false,

    bcodigo_postal: false,
    bcalle: false,
    bciudad: true,
    bestado: true,

    brh_nombre: true,
    brh_pa:  true,
    brh_ma: true,
    brh_te: true,
    brh_exten: true,
    brh_correo: true,

    bti_nombre: true,
    bti_pa:  true,
    bti_ma: true,
    bti_te: true,
    bti_exten: true,
    bti_correo: true,

    bca_nombre: true,
    bca_pa:  true,
    bca_ma: true,
    bca_te: true,
    bca_exten: true,
    bca_correo: true
}



let rh_nombre = document.getElementById("rh_nombre");
let rh_paterno = document.getElementById("rh_paterno");
let rh_materno = document.getElementById("rh_materno");
let rh_tele = document.getElementById("rh_tele");
let rh_exten = document.getElementById("rh_exten");
let rh_correo = document.getElementById("rh_correo");

let it_nombre = document.getElementById("ti_nombre");
let it_paterno = document.getElementById("ti_paterno");
let it_materno = document.getElementById("ti_materno");
let it_tele = document.getElementById("ti_tele");
let it_exten = document.getElementById("ti_exten");
let it_correo = document.getElementById("ti_correo");

let ac_nombre = document.getElementById("ac_nombre");
let ac_paterno = document.getElementById("ac_paterno");
let ac_materno = document.getElementById("ac_materno");
let ac_tele = document.getElementById("ac_tele");
let ac_exten = document.getElementById("ac_exten");
let ac_correo = document.getElementById("ac_correo");

let acuerdo_si = document.getElementById("acuerdo1");
let acuerdo_no = document.getElementById("acuerdo2");

let formulario  = document.getElementById("formula");
let formulario_contra = document.getElementById("formulario_contra");
let formDomicilio  = document.getElementById("formDomicilio");
let formDias  = document.getElementById("formDias");
let formularioRH  = document.getElementById("recursosHumanos");
let formularioIT  = document.getElementById("areaIt");
let formularioAC  = document.getElementById("areaCapacitacion");
let formularioAcuerdo = document.getElementById("acuerdo");

let estado = document.getElementById("estado");
let ciudad = document.getElementById("ciudad");
let inp_codigo_postal = document.getElementById("codigo_postal");

let element_btn_rh = document.getElementById("btn_rh");
let element_btn_it = document.getElementById("btn_it");
let element_btn_ac = document.getElementById("btn_ac");

let btn_elimnar_rh = document.getElementById("btn_eliminar_rh");
let btn_elimnar_it = document.getElementById("btn_eliminar_it");
let btn_elimnar_ac = document.getElementById("btn_eliminar_ac");

let checkbox_rh_1 = document.getElementById("rh_ck");
let checkbox_it_2 = document.getElementById("ti_ck");
let checkbox_ac_3 = document.getElementById("ac_ck");

window.addEventListener("load",(e)=>{
    

    fetch("../../controller/empresa/Mostrar_Datos_Perfil_Empresa.php")
        .then(response => response.json())
        .then(data =>{
            
            llenar_campos_formulario(data);
        });
    

    
});

acuerdo_si.addEventListener("click",(e)=>{
    acuerdo_no.checked = false;
});
acuerdo_no.addEventListener("click",(e)=>{
    acuerdo_si.checked = false;
})

inp_codigo_postal.addEventListener('blur', (e) => {
    let contenido =  document.getElementById("codigo_postal").value;
    
    if(contenido.length == 5){
        
        let formulario_data = new FormData();
        formulario_data.append("codigo_postal",contenido);
        

        fetch("../../controller/registro/Registro_Empresa.php",
        {
            method: 'POST',
            body: formulario_data,
        })
        .then(response => response.json())
        .then(data => {
            if(data.length != 0){
                rellenar_lista(data);
            }
            
        });

    }
  });


formulario.addEventListener("submit",(e)=>{
    e.preventDefault();
    formulario.rfc.disabled = false;
    let formulario_data = new FormData(e.target);
    
        
    fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",
    {
            method: 'POST',
            body: formulario_data,
    })
    .then(response => response.json())
    .then(data => {
        alert(data);
       
        formulario.rfc.disabled = true;
    });
        
       
        
    
   
});

formulario_contra.addEventListener("submit",(e)=>{
    e.preventDefault();
 
    let formulario_data = new FormData(e.target);
    
        
    fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",
    {
            method: 'POST',
            body: formulario_data,
    })
    .then(response => response.json())
    .then(data => {
        alert(data);
        if(data == "Actualización exitosa"){
            formulario_contra.password.value = "";
            formulario_contra.password_confirmacion.value = "";
            formulario_contra.password_actual.value = "";
        }
       
    });
        
    
   
});

formDomicilio.addEventListener("submit",(e)=>{
    e.preventDefault();
    let formData = new FormData(formDomicilio);
    fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",{
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data =>{
        alert(data);
    });
    document.getElementById("ciudad").disabled = true;
    document.getElementById("estado").disabled = true;

})

formDias.addEventListener("submit",(e)=>{
    //traemos los datos del checkbox
    e.preventDefault();
    let time_inicio = document.getElementById("inicio");
    let time_fin = document.getElementById("fin");
     
    let dias = checke();
 
    if(!formDias.checkValidity()){
        formDias.reportValidity();
    }else{

        if (dias.length == 0) {
            alert("Por favor, seleccione al menos un día laboral.");
           
        }else if(time_inicio.value.length == 0){
            alert("Por favor, seleccione una hora de inicio.");
          
        }else if(time_fin.value.length == 0){
            alert("Por favor, seleccione una hora de finalización.");    
           
        }else if (dias.length > 0 &&  time_inicio.value.length > 0 && time_fin.value.length > 0  ) {
            /** extraemos los datos del formulario */
     
            let formulario_data = new FormData(e.target);
            
            dias.forEach(dia => {
                formulario_data.append("dias[]",dia)
            });
         
             
            fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",
             {
                 method: 'POST',
                 body: formulario_data,
            })
            .then(response => response.json())
            .then(data => {
                
                alert(data);
            });
        }

    }
         
});

formularioRH.addEventListener("submit",(e)=>{
    e.preventDefault();

    let formulario_data = new FormData(e.target);

    let clasesLista = formularioRH.className.split(" ");
    let clase_con_id = clasesLista.find(texto => texto.includes("id"));

    if(clase_con_id != undefined){
        let id = clase_con_id.split("-")[1];
        formulario_data.append("id",id);
    }else{
        formulario_data.append("tipo","1");
    }
             
    fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",
    {
        method: 'POST',
        body: formulario_data,
    })
    .then(response => response.json())
    .then(data => {
                
        alert(data[0]);
        if(clase_con_id == undefined){// significa que inserto
            //mostrar
            btn_elimnar_rh.style.display = "";
            let id = "id-"+ data[1];
            formularioRH.classList.add(id);
            checkbox_rh_1.disabled = true;
        }
    });
});
formularioIT.addEventListener("submit",(e)=>{
    e.preventDefault();
    let formulario_data = new FormData(e.target);

    let clasesLista = formularioIT.className.split(" ");
    let clase_con_id = clasesLista.find(texto => texto.includes("id"));

    if(clase_con_id != undefined){
        let id = clase_con_id.split("-")[1];
        formulario_data.append("id",id);
    }else{
        formulario_data.append("tipo","2");
    }
                  
             
    fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",
    {
        method: 'POST',
        body: formulario_data,
    })
    .then(response => response.json())
    .then(data => {
                
        alert(data[0]);
        if(clase_con_id == undefined){

            //mostrar
            btn_elimnar_it.style.display = "";
            let id = "id-"+ data[1];
            formularioIT.classList.add(id);
            checkbox_it_2.disabled = true;
        }

    });
});

formularioAC.addEventListener("submit",(e)=>{
    e.preventDefault();
    let formulario_data = new FormData(e.target);

    let clasesLista = formularioAC.className.split(" ");
    let clase_con_id = clasesLista.find(texto => texto.includes("id"));

    if(clase_con_id != undefined){
        let id = clase_con_id.split("-")[1];
        formulario_data.append("id",id);
    }else{
        formulario_data.append("tipo","3");
    } 
             
    fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",
    {
        method: 'POST',
        body: formulario_data,
    })
    .then(response => response.json())
    .then(data => {
                
        alert(data[0]);
        if(clase_con_id == undefined){
            //mostrar
            btn_elimnar_ac.style.display = "";
            let id = "id-"+ data[1];
            formularioAC.classList.add(id);
            checkbox_ac_3.disabled = true;
        }

    });

});

formularioAcuerdo.addEventListener("submit",(e)=>{
    e.preventDefault();
    let formulario_data = new FormData(e.target);

             
    fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",
    {
        method: 'POST',
        body: formulario_data,
    })
    .then(response => response.json())
    .then(data => {
                
        alert(data);
    });
});


btn_elimnar_rh.addEventListener("click",(e)=>{

    if (confirm("¿Está seguro que desea eliminar esta área?")) {
        let formulario_data = new FormData();
        formulario_data.append("tipo","1");
        
        let clasesLista = formularioRH.className.split(" ");
        let clase_con_id = clasesLista.find(texto => texto.includes("id"));

        if(clase_con_id != undefined){
            let id = clase_con_id.split("-")[1];
            formulario_data.append("id",id);
        } 

        fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",
        {
            method: 'POST',
            body: formulario_data,
        })
        .then(response => response.json())
        .then(data => {
                    
            alert(data);
            
            formularioRH.classList.remove(clase_con_id);
            btn_elimnar_rh.style.display = "none";
            
            checkbox_rh_1.disabled = false;
            checkbox_rh_1.checked = false;
            checkbox_rh_1.dispatchEvent(new Event("change"));

        }).catch(error => { 
            alert("Upps ocurrio un error!!!");
            console.log(error);
        });
    }
    


});
btn_elimnar_it.addEventListener("click",(e)=>{

    if (confirm("¿Está seguro que desea eliminar esta área?")) {
        let formulario_data = new FormData();
        formulario_data.append("tipo","2");
        
        let clasesLista = formularioIT.className.split(" ");
        let clase_con_id = clasesLista.find(texto => texto.includes("id"));

        if(clase_con_id != undefined){
            let id = clase_con_id.split("-")[1];
            formulario_data.append("id",id);
        } 

        fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",
        {
            method: 'POST',
            body: formulario_data,
        })
        .then(response => response.json())
        .then(data => {
                    
            alert(data);
            formularioIT.classList.remove(clase_con_id);
            btn_elimnar_it.style.display = "none";

            checkbox_it_2.disabled = false;            
            checkbox_it_2.checked = false;
            checkbox_it_2.dispatchEvent(new Event("change"));
        }).catch(error => { 
            alert("Upps ocurrio un error!!!");
            console.log(error);
        });
    }


});
btn_elimnar_ac.addEventListener("click",(e)=>{

    if (confirm("¿Está seguro que desea eliminar esta área?")) {
        let formulario_data = new FormData();
        formulario_data.append("tipo","3");
        
        let clasesLista = formularioAC.className.split(" ");
        let clase_con_id = clasesLista.find(texto => texto.includes("id"));

        if(clase_con_id != undefined){
            let id = clase_con_id.split("-")[1];
            formulario_data.append("id",id);
        } 

        fetch("../../controller/empresa/Modificar_Datos_Perfil_Empresa.php",
        {
            method: 'POST',
            body: formulario_data,
        })
        .then(response => response.json())
        .then(data => {
                    
            alert(data);
            //ocultar boton eliminar
            formularioAC.classList.remove(clase_con_id);
            btn_elimnar_ac.style.display = "none";

            checkbox_ac_3.disabled = false;
            checkbox_ac_3.checked = false;
            checkbox_ac_3.dispatchEvent(new Event("change"));
            
        }).catch(error => { 
            alert("Upps ocurrio un error!!!");
            console.log(error);
        });
    }


});


function rellenar_lista(datos) {
    estado.value = "";
    ciudad.value = "";

    document.getElementById("busqueda_colonia").innerHTML = "";
    estado.value = datos[0][3];
    ciudad.value = datos[0][2];

    
    datos.forEach(registro => {
        var optionElement = document.createElement("option");
        optionElement.value = registro[0];
        optionElement.text = registro[1];
        document.getElementById("busqueda_colonia").appendChild(optionElement);
    });
    
}
function checke() {
    // ve si hay dias seleccionados
    let lista = [];
    var checked_list = document.querySelectorAll('.dias');
    for(var i=0; checked_list[i]; ++i){
        if(checked_list[i].checked){
            lista.push(checked_list[i].value);
            
        }
    }
    return lista;
}


function llenar_campos_formulario(datos) {
    // coloca todoa la informacion de la empresa en su lugar correspondiente
    
    if(datos["generales"].length > 0){
        formulario.rfc.value = datos["generales"][0];
        formulario.nombre.value = datos["generales"][1];
        formulario.correo_m.value = datos["generales"][2];
        formulario.razon.value = datos["generales"][3];
        formulario.rfc.disabled = true;

        baderas.brfc = true;
        baderas.bnombre_empresa = true;
        baderas.bcorreo_empresa = true;
        baderas.brazon = true;
    }
    if(datos["domicilio"].length > 0){

        let formulario_data = new FormData();
        formulario_data.append("codigo_postal",datos["domicilio"][1]);
            

        fetch("../../controller/registro/Registro_Empresa.php",
            {
                method: 'POST',
                body: formulario_data,
            })
            .then(response => response.json())
            .then(data => {
                if(data.length != 0){
                    rellenar_lista_postal(data,datos["domicilio"][0]);
                }
                
            });

        
        formDomicilio.codigo_postal.value = datos["domicilio"][1];
        formDomicilio.calle.value = datos["generales"][4];

        baderas.bcodigo_postal = true;
        baderas.bcalle = true ;

    }
    if(datos["dias"].length > 0){
        var checked_list = document.querySelectorAll('.dias');
        for(var i=0; checked_list[i]; ++i){

            for (let j = 0; j < datos["dias"].length; j++) {
                if(checked_list[i].value == datos["dias"][j] ){
                    checked_list[i].checked = true;
                    
                }
                
            }
            
        }
    }
    // las horas
    formDias.inicio.value = datos["generales"][5];
    formDias.fin.value = datos["generales"][6];

    if(datos["areas"].length > 0){
        // ver si tiene areas y colocar la info de cada area
       for (let i = 0; i < datos["areas"].length; i++) {
            let tipo_area = datos["areas"][i][0];
            let id = "id-"+ datos["areas"][i][1];

            if(tipo_area == 1){
                // recursos humanos
                formularioRH.rh_ck.checked = true;
                checkbox_rh_1.disabled = true;
            
                rh_nombre.disabled = false; 
                rh_paterno.disabled = false;
                rh_materno.disabled = false;
                rh_tele.disabled = false;
                rh_exten.disabled = false;
                rh_correo.disabled = false;

                baderas.brh_nombre= true;
                baderas.brh_pa =  true;
                baderas.brh_ma = true;
                baderas.brh_te = true;
                baderas.brh_exten = true;
                baderas.brh_correo = true;

                element_btn_rh.removeAttribute("disabled");

                rh_nombre.value = datos["areas"][i][2];
                rh_paterno.value = datos["areas"][i][3];
                rh_materno.value = datos["areas"][i][4];
                rh_tele.value = datos["areas"][i][5];
                rh_exten.value = datos["areas"][i][6];
                rh_correo.value = datos["areas"][i][7];
                
                formularioRH.classList.add(id);

                // lo regresa a lo determinado en css
                btn_elimnar_rh.style.display = "";


             
            }else if(tipo_area == 2){
                // it
                formularioIT.ti_ck.checked = true;

                checkbox_it_2.disabled = true;

                it_nombre.disabled = false;
                it_paterno.disabled = false;
                it_materno.disabled = false;
                it_tele.disabled = false;
                it_exten.disabled = false;
                it_correo.disabled = false;

                baderas.bti_nombre = true;
                baderas.bti_pa =  true;
                baderas.bti_ma = true;
                baderas.bti_te = true;
                baderas.bti_exten = true;
                baderas.bti_correo = true;
                element_btn_it.removeAttribute("disabled");
           
                it_nombre.value = datos["areas"][i][2];
                it_paterno.value = datos["areas"][i][3];
                it_materno.value = datos["areas"][i][4];
                it_tele.value = datos["areas"][i][5];
                it_exten.value = datos["areas"][i][6];
                it_correo.value = datos["areas"][i][7];

                formularioIT.classList.add(id);
                btn_elimnar_it.style.display = "";
                
            }else{
                // capacitacion
                formularioAC.ac_ck.checked = true;

                checkbox_ac_3.disabled = true;

                ac_nombre.disabled = false;
                ac_paterno.disabled = false;
                ac_materno.disabled = false;
                ac_tele.disabled = false;
                ac_exten.disabled = false;
                ac_correo.disabled = false;

                baderas.bca_nombre = true;
                baderas.bca_pa =  true;
                baderas.bca_ma = true;
                baderas.bca_te = true;
                baderas.bca_exten = true;
                baderas.bca_correo = true;

                element_btn_ac.removeAttribute("disabled");
                
                ac_nombre.value = datos["areas"][i][2];
                ac_paterno.value = datos["areas"][i][3];
                ac_materno.value = datos["areas"][i][4];
                ac_tele.value = datos["areas"][i][5];
                ac_exten.value = datos["areas"][i][6];
                ac_correo.value = datos["areas"][i][7];
                formularioAC.classList.add(id);
                btn_elimnar_ac.style.display = "";
            }
        
       }


    }

    if(datos["generales"][7] == 1){
        formularioAcuerdo.acuerdo1.checked = true;
    }else{
        formularioAcuerdo.acuerdo2.checked = true;
    }
    
    
}
function rellenar_lista_postal(datos, localidad) {
    //rellena y marca la casilla de localidades

    estado.value = datos[0][3];
    ciudad.value = datos[0][2];
    document.getElementById("busqueda_colonia").innerHTML = "";

    
    datos.forEach(registro => {
        var optionElement = document.createElement("option");
        optionElement.value = registro[0];
        optionElement.text = registro[1];
        if(registro[0] == localidad){
            optionElement.selected = true;
        }
        document.getElementById("busqueda_colonia").appendChild(optionElement);
    });
}