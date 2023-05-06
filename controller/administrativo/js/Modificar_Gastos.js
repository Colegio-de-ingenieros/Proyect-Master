window.onload = function () {
    obtener_Datos()
}

function obtener_Datos(){
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var participante = split[1];
    var valueHidden=1

    let url = "../../controller/administrativo/Get_Gastos.php";

    let form = new FormData();
    form.append("participante", participante);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
        console.log(data)
    }) 
}