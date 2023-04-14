window.onload = function() {
    let url = "../../controller/socio-asociado/Bolsa_Trabajo.php";
    let id = 0;

    let form = new FormData();
    form.append("id", id);

    fetch(url, {
        method: "POST",
        body: form
    })
        .then(response => response.json())
        .then(data => arrays(data))
        .catch(error => alert(error));
    
    const arrays = (data) => {
        /* Saca la información de data en sus primeros 14 elementos*/
        let array = data.slice(0, 14);
        console.log(array);
    }
}
