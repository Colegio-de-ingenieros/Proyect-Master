function confirmacion(e){

    if (confirm("¿Está seguro que desea eliminar esta certificación?")) {
        e.preventDefault();
        var idc = $(this).data('idc');

        fetch('../../controller/administrativo/Eliminar_Certificaciones.php?idc='+idc, {
            method: 'GET',
            idc:idc
        })
            //recibe el mensaje para mandarlo como alerta
            .then(res => res.json())
            .then(data =>
            {
                //el registro fue exitoso
                if (data === 'ok') {
                    alert("Eliminado con éxito");
                    location.href = '../../view/administrativo/Reg_Certificaciones.html';
                }

                //los datos no pasaron alguna validacion
                else {
                    alert(data);
                }
            })


    } else {
        e.preventDefault();
    }
}
var linkDelete = document.querySelectorAll(".table_item__link");

for (var i = 0; i < linkDelete.length; i++) {
    linkDelete[i].addEventListener('click', confirmacion);
}

//alert("si entra al js");