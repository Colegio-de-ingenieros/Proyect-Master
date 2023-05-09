window.onload = function() {
    let id_instructor = document.getElementById('id_instructor').textContent;

    //* Crear el objeto para hacer la solicitud de datos al servidor
    let url = '../../controller/administrativo/Mostrar_Instructores_Individual.php';
    let form = new FormData();
    form.append('id_instructor', id_instructor);

    //* Realizar la solicitud de datos mediante FETCH
    fetch(url, {
        method: 'POST',
        body: form
    }).then(res => res.json())
    .then(data => response(data))
    .catch(error => console.log(error));

    //* Funcion para mostrar los datos en la vista
    function response(data) {
        //* Mostrar los datos que están llegando del servidor
        console.log(data);

        let lista_datos_generales = [];
        let lista_especialidades = [];
        let lista_certificaciones_internas = [];
        let lista_certificaciones_externas = [];

        //* Recorrer el arreglo de datos generales
        for (let i = 0; i < data.datos_generales.length; i++) {
            lista_datos_generales.push(data.datos_generales[i]);
        }

        //* Recorrer el arreglo de especialidades
        for (let i = 0; i < data.especialidades.length; i++) {
            lista_especialidades.push(data.especialidades[i]);
        }

        //* Recorrer el arreglo de certificaciones internas
        for (let i = 0; i < data.certificaciones_internas.length; i++) {
            lista_certificaciones_internas.push(data.certificaciones_internas[i]);
        }

        //* Recorrer el arreglo de certificaciones externas
        for (let i = 0; i < data.certificaciones_externas.length; i++) {
            lista_certificaciones_externas.push(data.certificaciones_externas[i]);
        }

        //* Guardar el nombre del instructor
        let nombre_instructor = lista_datos_generales[0][0] + " " + lista_datos_generales[0][1] + " " + (lista_datos_generales[0][2] || "");
        document.getElementById('nombre_instructor').textContent = nombre_instructor;


    }
};