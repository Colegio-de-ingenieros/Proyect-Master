<?php

require_once('../../model/administrativo/Mostrar_Actividad_Tabla.php');
$objeto=new Actividad_Seg_Tabla();

$salida = '';

$id=$_POST["idAct"];

$resultado = $objeto->consul_datos_tabla($id);  
if ($resultado == true) {
    //pone los encabezados de la tabla
    $salida .= '<table>
                    <thead>
                        <tr>
                            <th>Participante</th>
                            <th>Hotel</th>
                            <th>Transporte</th>
                            <th>Comida</th>
                            <th>Oficina</th>
                            <th>Honorario</th>
                            <th>Ingresos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
            
                <tbody>';

    //agrega los resultados de la busqueda
    for ($i = 0; $i < count($resultado[0]); $i++) {
            $nombre=$resultado[1][$i];
            $hotel= $resultado[2][$i];
            $transporte= $resultado[3][$i];
            $comida= $resultado[4][$i];
            $oficina= $resultado[5][$i];
            $honorario= $resultado[6][$i];
            $ingresos= $resultado[7][$i];

        $idp=$resultado[0][$i];
        //escribe los valores en la tabla
        $salida .= '<tr>';
        $salida .= '<td>' . $nombre. '</td>';
        $salida .= '<td>' . $hotel . '</td>';
        $salida .= '<td>' . $transporte. '</td>';
        $salida .= '<td>' . $comida . '</td>';
        $salida .= '<td>' . $oficina. '</td>';
        $salida .= '<td>' . $honorario . '</td>';
        $salida .= '<td>' . $ingresos. '</td>';
        $salida .= '<td>  <a href="#">Ver más</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" class="table_item__link eliminar-elemento" data-participante="' . $idp . '">Eliminar</a></td>';
        $salida .= '</tr>';   
    }
} 
else {



    
    $salida .= 'No se encontraron resultados';
}

echo ($salida);

?>

<script src="../../controller/administrativo/js/Eliminar_Participante_Confirmacion.js"></script>