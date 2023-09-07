let formulario = document.getElementById('formulario');
let formulario1 = document.getElementById('formulario1');
let formulario2 = document.getElementById('formulario2');
let formulario3 = document.getElementById('formulario3');
let formulario4 = document.getElementById('formulario4');
let formulario5 = document.getElementById('formulario5'); //Agregar o actualizar empresa
let formulario6 = document.getElementById('formulario6'); //eliminar
let formulario7 = document.getElementById('formulario7'); //Agregar funciones
let btn_guardarlaborales = document.getElementById("btn_guardarlaborales");
let btn_generales6 = document.getElementById("btn_generales6");



//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario);
    fetch('../../controller/socio-asociado/Modificar_Datos_Perfil_Personal.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        if (data === 'exito') {
            alert("Actualización exitosa");
            location.href="../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php";
        }
        //los datos no pasaron alguna validacion
        else if (data === 'no exito'){
            alert("Hubo un error");
        }else{
            alert (data)
        }
    })
})

//responde cuando hay un click en el boton
formulario1.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario1);
    fetch('../../controller/socio-asociado/Modificar_Datos_Perfil_Personal_Contra.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        if (data === 'exito') {
            alert("Actualización exitosa");
            location.href="../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php";
        }
        //los datos no pasaron alguna validacion
        else if (data === 'no exito'){
            alert("Hubo un error");
        }else if (data === 'igual'){
            alert("La contraseña actual no coincide");
        }else{
            alert (data)
        }
    })
})

formulario2.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario2);
    fetch('../../controller/socio-asociado/Modificar_Datos_Perfil_Personal_Domicilio.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        if (data === 'exito') {
            alert("Actualización exitosa");
            location.href="../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php";
        }
        //los datos no pasaron alguna validacion
        else if (data === 'no exito'){
            alert("Hubo un error");
        }else{
            alert (data)
        }
    })
})

//responde cuando hay un click en el boton
formulario3.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario3);
    fetch('../../controller/socio-asociado/Modificar_Datos_Perfil_Personal_Grado.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        if (data === 'exito') {
            alert("Actualización exitosa");
            location.href="../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php";
        }
        //los datos no pasaron alguna validacion
        else if (data === 'no exito'){
            alert("Hubo un error");
        }else{
            alert (data)
        }
    })
})


//responde cuando hay un click en el boton
formulario4.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario4);
    fetch('../../controller/socio-asociado/Modificar_Datos_Perfil_Personal_Cert.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        if (data === 'exito') {
            alert("Registro exitoso");
            location.href="../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php";
        }
        //los datos no pasaron alguna validacion
        else if (data === 'no exito'){
            alert("Hubo un error");
        }else if (data === 'fecha'){
            alert("La fecha de emisión tiene que ser menor que la fecha de vigencia");
        }else{
            alert (data)
        }
    })
})

//responde cuando hay un click en el boton
formulario6.addEventListener('submit', function (e)
{
    e.preventDefault();
    if (confirm("¿Está seguro que desea eliminar sus datos laborales?")) {

        var datos= new FormData(formulario6);
        let campo = document.getElementById("idlaboral");
        var idc= campo.value;
        console.log(idc);
        // Realizar la solicitud Ajax para eliminar el elemento
        $.ajax({
            //manda a llamar al php que tiene la logica para eliminar
            url: '../../controller/socio-asociado/Eliminar_Datos_Lab_Perfil_Personal.php?idc='+idc, 
            method: 'POST',
            body: datos,
            data: {idc: idc}, 
            success: function (response)
            {
                // Procesar la respuesta del servidor en caso de éxito
                alert("Eliminado con exito");
                nombre=document.getElementById("nomEmpPerso");
                puesto=document.getElementById("puestoEmpPerso");
                correo=document.getElementById("correoEmpPerso");
                tel=document.getElementById("telFEmpPerso");
                ext=document.getElementById("ExtTelFEmp");
                nombre.value="";
                puesto.value="";
                correo.value="";
                tel.value="";
                ext.value="";
                // volver a la pagina de vista
                location.href = '../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php';
            },
        });


    } else {
    }
    })


//responde cuando hay un click en el boton
formulario5.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario5);
    fetch('../../controller/socio-asociado/Modificar_Datos_Perfil_Personal_Func.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        if (data === 'exito') {
            alert("Actualización exitosa");
            location.href="../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php";
        }
        //los datos no pasaron alguna validacion
        else if (data === 'no exito'){
            alert("Hubo un error");
        }else if (data === 'exito1'){
            alert("Registro exitoso");
            location.href="../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php";
        }else{
            alert (data)
        }
    })
})




formulario7.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario7);
    fetch('../../controller/socio-asociado/Modificar_Datos_Perfil_Personal_Func2.php', {
        method: 'POST',
        body: datos
    })

    .then(res => res.json())
    .then(data => {
        if (data === 'exito') {
            alert("Registro exitoso");
            location.href="../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php";
        }
        //los datos no pasaron alguna validacion
        else if (data === 'no exito'){
            alert("Hubo un error");
        }else{
            alert (data)
        }
    })
})