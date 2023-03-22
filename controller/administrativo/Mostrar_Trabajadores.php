<?php
include_once('../../model/Mostrar_Trabajadores.php');
$salida = '';
$base = new MostrarTrabajadores();
$base->instancias();

//manda a hacer la busqueda
$resultado = $base->getTrabajadores();
//echo '<script>alert("si entra al php");</script>';
//echo "si entra al php";
if ($resultado == true) {
    //pone los encabezados de la tabla
    $salida .= '<table class="header_table" center >
                    <thead  >
                        <tr>
                            <th>RFC</th>
                            <th>Nombre</th>
                            <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>Correo electronico</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
            <tbody>';

    //agrega los resultados de la busqueda
    for ($i = 0; $i < count($resultado); $i++) {

        //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
        $rfc = $resultado[$i]["RFCT"];
        $nombre = $resultado[$i]["NombreT"];
        $apat = $resultado[$i]["ApePT"];
        $amat = $resultado[$i]["ApeMT"];
        $correo = $resultado[$i]["CorreoT"];
        $telefono = $resultado[$i]["TelT"];
        //$extension = getExt($logo);

        //escribe los valores en la tabla
        $salida .= '<tr>';
        $salida .= '<td>' . $rfc. '</td>';
        $salida .= '<td>' . $nombre . '</td>';
        $salida .= '<td>' . $apat . '</td>';
        $salida .= '<td>' . $amat . '</td>';
        $salida .= '<td>' . $correo . '</td>';
        $salida .= '<td>' . $telefono . '</td>';
        $salida .= '<td><a href="../../controller/administrativo/editarTrabajador.php?rfc='.$rfc.'" class="table_item__link">Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../controller/administrativo/Eliminar_Trabajadores.php?rfc='.$rfc.'" class="table_item__link">Eliminar</a></td>';
        $salida .= '</tr>';

        
    }
} 

else {
    //echo "si entra al else";
    $salida .= 'No se encontraron resultados';
}

$salida .= "</tbody></table>";
//echo '<script>alert("si entra al php");</script>';

echo $salida;

?>