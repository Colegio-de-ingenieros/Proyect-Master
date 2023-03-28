<?php
include_once('../../model/Mostrar_Proyectos.php');

$salida = '';
$base = new MostrarProyectos();
$base->instancias();

//manda a hacer la busqueda
$resultado = $base->getProyectos();
$resultado1 = $base->getIniPro();
$resultado2 = $base->getFinPro();


if ($resultado == true) {
    //pone los encabezados de la tabla
    $salida .= '<table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de finalización</th>
                            <th>Monto</th>
                            <th>Objetivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
            
                <tbody>';

    //agrega los resultados de la busqueda
    for ($i = 0; $i < count($resultado); $i++) {
        //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
        $nombre= $resultado[$i]["NomProyecto"];
        $inicio = $resultado1[$i]["IniPro"];
        $fin = $resultado2[$i]["FinPro"];
        $monto = $resultado[$i]["MontoPro"];
        $monto=substr($monto, 0,  strlen($monto) - 3);
        $objetivo = $resultado[$i]["ObjPro"];
        

        //escribe los valores en la tabla
        $salida .= '<tr>';
        $salida .= '<td>' . $nombre . '</td>';
        $salida .= '<td>' . $inicio . '</td>';
        $salida .= '<td>' . $fin . '</td>';
        $salida .= '<td>$' . $monto . '</td>';
        $salida .= '<td>' . $objetivo . '</td>';
        $salida .= '<td>  <a href="#">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#">Eliminar</a></td>';
        $salida .= '</tr>';

        
    }
} 

else {
    $salida .= 'No se encontraron resultados';
}

$salida .= "</tbody></table>";
//echo '<script>alert("si entra al php");</script>';

echo $salida;

?>