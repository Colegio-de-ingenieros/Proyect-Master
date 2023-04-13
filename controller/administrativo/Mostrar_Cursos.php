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
    <style>
    table{
        width: 100%;
        border-collapse: collapse;
        font-family: "Manrope";

    }
    
    .header_table thead th {
        
        top: 0;
        background-color: #085262;
        color: #e6e7e8;
        font-size: 1.125rem;
    }
    th,td {
        border-bottom: 1px solid #000000;
        padding: 10px 20px;
        font-size: 15px;
        text-align: center;
        background-color: #dfe3e7;
    }
    .di{
       padding-top: 20px;
    }
    </style>
    <div class="di">
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
        <a href="../../controller/administrativo/Ver_Cursos.php?id='. $clave .'">Ver</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="../../view/administrativo/Modi_Cursos.php?id='. $clave .'">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="../../controller/administrativo/Eliminar_Cursos.php?id='. $clave .'">Eliminar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>';
        $respuesta .= '</tr>';
        $respuesta .= '</div>';

        
    }
} 

else {
    $respuesta .= 'No se encontraron resultados';
}

$respuesta .= "</tbody></table>";

echo $respuesta;

?>