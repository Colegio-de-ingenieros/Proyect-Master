window.addEventListener('DOMContentLoaded', function() {
    const search=document.querySelector('#search');
    const tabla=document.querySelector('#tabla_Trabajador tbody');
    const result=document.querySelector('#resultContainer');
    const errors=document.querySelector('.errorsContainer');
    let criterio = ''
    if(search){
        search.addEventListener('input', event =>{
            criterio = event.target.value.toUpperCase()
            mostrarTrabajadores()
        })
    }
    //enviar peticion usando fetch
    const buscarTrabajadores = async () =>{
        let buscarTrabajadores=new FormData()
        buscarTrabajadores.append('criterio', criterio)
        try{
            const response=await fetch('../../model/Mostrar_Trabajadores.php',{
                method: 'POST',
                body: buscarTrabajadores
            })
            return response.json()
        }catch(error){
            alert(`${'Error al buscar los trabajadores'}${error.message}`)
            console.log(error)
        }
    }
    //funcion para mostrar los datos
    const mostrarTrabajadores = () =>{
        buscarTrabajadores()
        .then(dataResults =>{
            console.log(dataResults)
        })
    }

});

/*let trabajador=[
    {rfc:"MIML970715L19",nombre:"Leobardo", apaterno:"Miramontes", amaterno:"Ibarra",correo:'led.tesmur@gmail.com',telefono:'449 123 4567'},
    {rfc:"MIML970715Q34",nombre:"Leobardo", apaterno:"Mendoza", amaterno:"Ibarra",correo:'led.tesmur@gmail.com',telefono:'449 123 4567'},
    {rfc:"MIML970715FCV",nombre:"Leobardo", apaterno:"Mendoza", amaterno:"Ibarra",correo:'led.tesmur@gmail.com',telefono:'449 123 4567'},
    {rfc:"MIML970715I87",nombre:"Leobardo", apaterno:"Mendoza", amaterno:"Ibarra",correo:'led.tesmur@gmail.com',telefono:'449 123 4567'},
    {rfc:"MIML970715LA2",nombre:"Leobardo", apaterno:"Mendoza", amaterno:"Ibarra",correo:'led.tesmur@gmail.com',telefono:'449 123 4567'},
];
let crearTabla = function(lista){
    let stringTabla = "<thead><tr><th>RFC</th><th>Nombre</th><th>Apellido paterno</th><th>Apellido materno</th><th>Correo electronico</th><th>Teléfono</th><th>Acciones</th></tr></thead><tbody>";
    for(let trabajador of lista){
        let fila= "<tr> <td>"
        fila+= trabajador.rfc + "</td><td>"
        fila+= trabajador.nombre + "</td><td>"
        fila+= trabajador.apaterno + "</td><td>"
        fila+= trabajador.amaterno + "</td><td>"
        fila+= trabajador.correo + "</td><td>"
        fila+= trabajador.telefono + "</td><td>"
        fila+= "<a href="+"#"+">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="+"#"+">Eliminar</a></td></tr></tbody>"
        stringTabla+=fila;
        //console.log(stringTabla);
    }
    return stringTabla;
};
document.getElementById("tabla_Trabajador").innerHTML= crearTabla(trabajador);*/