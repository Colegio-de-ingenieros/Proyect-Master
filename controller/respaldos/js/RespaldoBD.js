//responde cuando hay un click en el boton importar
formularioBD.addEventListener('submit', function (e){
    if (confirm("¿Está seguro que desea importar una nueva base de datos, se perderá la información actual?")) {
        e.preventDefault();
        const importar = document.getElementById('importar');
        importar.disabled = true;
        alert('Importación en curso, puede tomar unos minutos');
        let url = "../../controller/respaldos/Importar_BD.php";
        let form = new FormData(formularioBD);
        fetch(url, {
        method: "POST",
        body: form
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert(data);
                importar.disabled =false;
                window.location.href='../../view/administrativo/Informacion2.html';
                
        })  
    }
    else {
        e.preventDefault();
        window.location.href='../../view/administrativo/Informacion2.html';
    }


    
})

//responde cuando hay un click en el boton exportar
formularioBD.exportar.addEventListener('click', function (e){
    e.preventDefault();
    location.href='../../controller/respaldos/Exportar_BD.php';

})