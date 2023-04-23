<?php
include_once('../../model/socio-asociado/Mostrar_Cursos.php');

$salida = '';
$base = new MostrarCursos();
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
                    <th>Nombre</th>
                    <th>Organización</th>
                    <th>Total de horas</th>
                    <th>PDF</th>
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
            $abre = $resultado[$i]["abrevCertInt"];
            $desc = $resultado[$i]["DesCerInt"];
            $status = $resultado[$i]["EstatusCertInt"];
            $precioG = $base->buscarUltimoPrecioG($idc);
            $precioA = $base->buscarUltimoPrecioA($idc);

            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '"width="50" height="50"></td>';
            $salida .= '<td>' . $abre . '</td>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $desc . '</td>';
            $salida .= '<td>$' . $precioG . '</td>';
            $salida .= '<td>$' . $precioA . '</td>';
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
                    <th>Nombre</th>
                    <th>Organización</th>
                    <th>Total de horas</th>
                    <th>PDF</th>   
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
            $abre = $resultado[$i]["abrevCertInt"];
            $desc = $resultado[$i]["DesCerInt"];
            $status = $resultado[$i]["EstatusCertInt"];
            $precioG = $base->buscarUltimoPrecioG($idc);
            $precioA = $base->buscarUltimoPrecioA($idc);

            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . '<img src="data:image/jpeg;base64,' . base64_encode($logo) . '"width="50" height="50"></td>';
            $salida .= '<td>' . $abre . '</td>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $desc . '</td>';
            $salida .= '<td>$' . $precioG . '</td>';
            $salida .= '<td>$' . $precioA . '</td>';
            $salida .= '<td> 
        <a href="../../controller/administrativo/Mostrar_Historial.php?idc=' . $idc . '">Historial</a>&nbsp;&nbsp;&nbsp
        <a href="../../controller/administrativo/Get_Certificacion.php?idc='.$idc.'">Modificar</a>&nbsp;&nbsp;&nbsp
        <a href="#" class="table_item__link eliminar-elemento" data-idc="' . $idc . '">Eliminar</a>&nbsp;&nbsp;&nbsp
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
