//responde cuando hay un click en el boton importar


formularioBD.addEventListener('submit', function (e){
    e.preventDefault();
    const importar = document.getElementById('importar');
    importar.disabled = true;
    alert('Esto puede tardar ');
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
            window.location.href='../../view/administrativo/Informacion.html';
            
    })  
})

//responde cuando hay un click en el boton exportar
formularioBD.exportar.addEventListener('click', function (e){
    e.preventDefault();
    location.href='../../controller/respaldos/Exportar_BD.php';

})