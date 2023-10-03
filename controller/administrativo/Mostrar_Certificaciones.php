<?php
include_once('../../model/administrativo/Mostrar_Certificaciones.php');

$salida = '';
$base = new MostrarCertificaciones();
$base->instancias();

if (isset($_POST['consulta'])) {
    //echo($_POST['consulta']);
    $busqueda = $_POST['consulta'];

    $resultado = $base->consultaInteligente($busqueda);

    if ($resultado == true) {
        //pone los encabezados de la tabla
        $salida .= '<table>
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Identificador<th>
                    <th>Abreviación</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio general</th>
                    <th>Precio socio/asociado</th>
                    <th>Seguimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
            $seguimiento = 'No';

            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $idc = $resultado[$i]["IdCerInt"];
            $logo = $resultado[$i]["LogoCerInt"];
            $nombre = $resultado[$i]["NomCertInt"];
            $abre = $resultado[$i]["abrevCertInt"];
            $desc = $resultado[$i]["DesCerInt"];
            $status = $resultado[$i]["EstatusCertInt"];
            $precioG = $base->buscarUltimoPrecioG($idc);
            $precioA = $base->buscarUltimoPrecioA($idc);

            //obtiene el valor real de seguimiento
            if($status == 0){
                $seguimiento = 'Si';
            }

            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '"width="50" height="50"></td>';
            $salida .= '<td>' . $abre . '</td>';
            $salida .= '<td>' . $abre . '</td>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $desc . '</td>';
            $salida .= '<td>$' . $precioG . '</td>';
            $salida .= '<td>$' . $precioA . '</td>';
            $salida .= '<td>' . $seguimiento . '</td>';
            $salida .= '<td> 
        <a href="../../controller/administrativo/Mostrar_Historial.php?idc=' . $idc . '">Historial</a>&nbsp;&nbsp;&nbsp
        <a href="../../controller/administrativo/Get_Certificacion.php?idc=' . $idc . '">Modificar</a>&nbsp;&nbsp;&nbsp
        <a href="#" class="table_item__link eliminar-elemento" data-idc="' . $idc . '">Eliminar</a>&nbsp;&nbsp;&nbsp
        </td>';
            $salida .= '</tr>';
        }
    } else {
        $salida .= 'No se encontraron resultados';
    }

    $salida .= "</tbody></table>";

} else {
    //manda a hacer la busqueda
    $resultado = $base->getCertificaciones();

    if ($resultado == true) {
        //pone los encabezados de la tabla
        $salida .= '<table>
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Abreviación</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio general</th>
                    <th>Precio <br>socio/asociado</th>
                    <th>Seguimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
            $seguimiento = 'No';
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $idc = $resultado[$i]["IdCerInt"];
            $logo = $resultado[$i]["LogoCerInt"];
            $nombre = $resultado[$i]["NomCertInt"];
            $abre = $resultado[$i]["abrevCertInt"];
            $desc = $resultado[$i]["DesCerInt"];
            $status = $resultado[$i]["EstatusCertInt"];
            $precioG = $base->buscarUltimoPrecioG($idc);
            $precioA = $base->buscarUltimoPrecioA($idc);

            //obtiene el valor real de seguimiento
            if($status == 0){
                $seguimiento = 'Si';
            }

            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '"width="50" height="50"></td>';
            $salida .= '<td>' . $abre . '</td>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $desc . '</td>';
            $salida .= '<td>$' . $precioG . '</td>';
            $salida .= '<td>$' . $precioA . '</td>';
            $salida .= '<td>' . $seguimiento . '</td>';
            $salida .= '<td> 
        <center>
        <a href="../../controller/administrativo/Mostrar_Historial.php?idc=' . $idc . '">Historial</a>&nbsp;&nbsp;
        <a href="../../controller/administrativo/Get_Certificacion.php?idc='.$idc.'">Modificar</a>&nbsp;&nbsp;
        <a href="#" class="table_item__link eliminar-elemento" data-idc="' . $idc . '">Eliminar</a>
        </center>
        </td>';
            $salida .= '</tr>';
        }
    } else {
        $salida .= 'No se encontraron resultados';
    }

    $salida .= "</tbody></table>";

}
echo $salida;

?>
<script src="../../controller/administrativo/js/Eliminar_Certificaciones_Confirmacion.js"></script>