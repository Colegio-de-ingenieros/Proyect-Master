<?php
include_once('../../model/Mostrar_Certificaciones.php');

$salida = '';
$base = new MostrarCertificaciones();
$base->instancias();

//manda a hacer la busqueda
$resultado = $base->getCertificaciones();

if ($resultado == true) {
    //pone los encabezados de la tabla
    $salida .= '<table>
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio general</th>
                    <th>Precio socio/asociado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

    //agrega los resultados de la busqueda
    for ($i = 0; $i < count($resultado); $i++) {
        //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
        $idc = $resultado[$i]["IdCerInt"];
        $logo = $resultado[$i]["LogoCerInt"];
        $nombre = $resultado[$i]["NomCertInt"];
        $desc = $resultado[$i]["DesCerInt"];
        $precioG = $base->buscarUltimoPrecioG($idc);
        $precioA = $base->buscarUltimoPrecioA($idc);
        //$extension = getExt($logo);

        //escribe los valores en la tabla
        $salida .= '<tr>';
        $salida .= '<td>' . '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '"width="50" height="50"></td>';
        $salida .= '<td>' . $nombre . '</td>';
        $salida .= '<td>' . $desc . '</td>';
        $salida .= '<td>' . $precioG . '</td>';
        $salida .= '<td>' . $precioA . '</td>';
        $salida .= '<td> 
        <a href="#">Historial</a>&nbsp;&nbsp;&nbsp
        <a href="#">Modificar</a>&nbsp;&nbsp;&nbsp
        <a href="#">Eliminar</a>&nbsp;&nbsp;&nbsp
        </td>';
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