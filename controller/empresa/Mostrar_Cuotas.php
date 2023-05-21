<?php
session_start();
include_once('../../model/empresa/Mostrar_Cuotas.php');
if (isset ($_SESSION['usuario']  )){
    $usuario = $_SESSION['usuario'];

    $salida = '';
    $bd = new MostrarCuota();
    $id = $bd->usuario($usuario);
    $cuotas = $bd->cuotas_disponibles($id[0]['RFCUsuaEmp']); 

    if (isset($_POST['consulta'])) {
        //echo($_POST['consulta']);
        $busqueda = $_POST['consulta'];

        $resultado = $bd->buscar($busqueda,$id[0]['RFCUsuaEmp']);

        if ($resultado == true) {
            //pone los encabezados de la tabla
            $salida .= '<table>
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de finalización</th>
                        <th>Monto</th>
                        <th>Comprobante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            //agrega los resultados de la busqueda
            for ($i = 0; $i < count($resultado); $i++) {
                //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
                $idV = $resultado[$i]["IdVigCuo"];
                $monto = $resultado[$i]["MontoVigCuo"];
                $tipo = $resultado[$i]["TipoCuota"];
                $fecha_inicio = $resultado[$i]["IniVigCuo"];
                $fecha_fin = $resultado[$i]["FinVigCuo"];
                

                //escribe los valores en la tabla
                $salida .= '<tr>';
                $salida .= '<td>' . $tipo . '</td>';
                $salida .= '<td>' . $fecha_inicio . '</td>';
                $salida .= '<td>' . $fecha_fin . '</td>';
                $salida .= '<td>' . $monto . '</td>';
                $salida .= '<td> <a href="../../controller/Comprobantes/empresa/cuotas/'.$idV.'">Abrir archivo</a></td>';
                $salida .= '<td> 
                <a href="../../controller/empresa/Get_Cuotas.php?idV='.$idV.'">Modificar</a>&nbsp;&nbsp;&nbsp
                <a href="#" class="table_item__link eliminar-elemento" data-idc="' . $idV . '">Eliminar</a>
                </td>';
                $salida .= '</tr>';
            }
        } else {
            $salida .= 'No se encontraron resultados';
        }

        $salida .= "</tbody></table>";

    } else {
        //manda a hacer la busqueda

        if ($cuotas == true) {
            //pone los encabezados de la tabla
            $salida .= '<table>
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de finalización</th>
                        <th>Monto</th>
                        <th>Comprobante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            //agrega los resultados de la busqueda
            for ($i = 0; $i < count($cuotas); $i++) {
                //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
                $idV = $cuotas[$i]["IdVigCuo"];
                $monto = $cuotas[$i]["MontoVigCuo"];
                $tipo = $cuotas[$i]["TipoCuota"];
                $fecha_inicio = $cuotas[$i]["IniVigCuo"];
                $fecha_fin = $cuotas[$i]["FinVigCuo"];
                

                //escribe los valores en la tabla
                $salida .= '<tr>';
                $salida .= '<td>' . $tipo . '</td>';
                $salida .= '<td>' . $fecha_inicio . '</td>';
                $salida .= '<td>' . $fecha_fin . '</td>';
                $salida .= '<td>' . $monto . '</td>';
                $salida .= '<td> <a target="_blank" href="../../controller/Comprobantes/empresa/cuotas/'.$idV.'">Abrir archivo</a></td>';
                $salida .= '<td> 
                <a href="../../controller/empresa/Get_Cuotas.php?idV='.$idV.'">Modificar</a>&nbsp;&nbsp;&nbsp
                <a href="#" class="table_item__link eliminar-elemento" data-idc="' . $idV . '">Eliminar</a>
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

<script src="../../controller/empresa/js/Eliminar_Cuotas_Confirmacion.js"></script>