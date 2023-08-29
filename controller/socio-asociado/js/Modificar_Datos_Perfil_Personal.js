let formulario = document.getElementById('formulario');
let formulario1 = document.getElementById('formulario1');
let formulario2 = document.getElementById('formulario2');
let formulario3 = document.getElementById('formulario3');
let formulario4 = document.getElementById('formulario4');
let formulario5 = document.getElementById('formulario5');

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
        }else{
            alert (data)
        }
    })
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
        }else{
            alert (data)
        }
    })
})