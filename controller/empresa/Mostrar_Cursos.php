<?php
include_once('../../model/empresa/Mostrar_Cursos.php');
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    $salida = '';
    $base = new mostrarCursos();

    $id_perso=$base->usuario($usuario);
    $idperso=$id_perso[0]['RFCUsuaEmp'];
    $id_final=$idperso;
    $cursos=$base->tabla_completa($id_final);

    if (isset($_POST['consulta'])) {
        //echo($_POST['consulta']);
        $busqueda = $_POST['consulta'];

        $resultado = $base->inteligente($id_final, $busqueda);

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
                $idc = $resultado[$i]["IdCurPerso"];
                $nombre = $resultado[$i]["NomCurPerso"];
                $orga = $resultado[$i]["OrgCurPerso"];
                $hrs = $resultado[$i]["HraCurPerso"];
                $pdf = $resultado[$i]["DocCurPerso"];

                //escribe los valores en la tabla
                $salida .= '<tr>';
                $salida .= '<td>' . $nombre . '</td>';
                $salida .= '<td>' . $orga . '</td>';
                $salida .= '<td>' . $hrs . '</td>';
                $salida .= '<td>$' . $pdf . '</td>';
                $salida .= '<td> 
                <a href="#">Historial</a>&nbsp;&nbsp;&nbsp
                <a href="#'.$idc.'">Modificar</a>&nbsp;&nbsp;&nbsp
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

        if ($cursos == true) {
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
            for ($i = 0; $i < count($cursos); $i++) {
                //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
                $idc = $cursos[$i]["IdCurPerso"];
                $nombre = $cursos[$i]["NomCurPerso"];
                $orga = $cursos[$i]["OrgCurPerso"];
                $hrs = $cursos[$i]["HraCurPerso"];
                $pdf = $cursos[$i]["DocCurPerso"];

                //escribe los valores en la tabla
                $salida .= '<tr>';
                $salida .= '<td>' . $nombre . '</td>';
                $salida .= '<td>' . $orga . '</td>';
                $salida .= '<td>' . $hrs . '</td>';
                $salida .= '<td> <a href="'.$pdf.'">Historial</a>&nbsp;&nbsp;&nbsp</td>';
                $salida .= '<td> 
                <a href="#'.$idc.'">Modificar</a>&nbsp;&nbsp;&nbsp
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
}
?>