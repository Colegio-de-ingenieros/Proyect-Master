<?php
include_once('../../model/Mostrar_Cursos.php');

$respuesta = '';
$bd = new MostrarCurso();
$bd->BD();

//manda a hacer la busqueda
$datos = $bd->cursos_disponibles();

if ($datos == true) {
    
    $respuesta .= 
    '
    <table class = "header_table">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Duración</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

    //agrega los resultados de la busqueda
    for ($i = 0; $i < count($datos); $i++) {
        //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
        $clave = $datos[$i]["ClaveCur"];
        $nombre = $datos[$i]["NomCur"];
        $duracion = $datos[$i]["DuracionCur"];
        //$extension = getExt($logo);

        //escribe los valores en la tabla
        $respuesta .= '<tr>';
        $respuesta .= '<td>' . $clave . '</td>';
        $respuesta .= '<td>' . $nombre . '</td>';
        $respuesta .= '<td>' . $duracion . ' hrs </td>';
        $respuesta .= '<td> 
        <a href="#">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#">Eliminar</a>
        </td>';
        $respuesta .= '</tr>';
        

        
    }
} 

else {
    $respuesta .= 'No se encontraron resultados';
}

$respuesta .= "</tbody></table>";

echo $respuesta;

?>