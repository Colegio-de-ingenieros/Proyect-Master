<?php
include_once('../../model/empresa/Mostrar_Cuotas_empresa.php');

session_start();

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
                        <th>Monto</th>
                        <th>Tipo de cuota</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Comprobante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            //agrega los resultados de la busqueda
            for ($i = 0; $i < count($resultado); $i++) {
                //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
                $monto = $resultado[$i]["MontoVigCuo"];
                $tipo = $resultado[$i]["TipoCuota"];
                $fecha_inicio = $resultado[$i]["IniVigCuo"];
                $fecha_fin = $resultado[$i]["FinVigCuo"];
                $pdf = $resultado[$i]["DocCuota"];

                //escribe los valores en la tabla
                $salida .= '<tr>';
                $salida .= '<td>' . $monto . '</td>';
                $salida .= '<td>' . $tipo . '</td>';
                $salida .= '<td>' . $fecha_inicio . '</td>';
                $salida .= '<td>' . $fecha_fin . '</td>';
                $salida .= '<td> <a href="../../controller/Comprobantes/'.$pdf.'">Abrir archivo</a></td>';
                $salida .= '<td> 
                <a href="#">Modificar</a>&nbsp;&nbsp;&nbsp
                <a href="#">Eliminar</a>
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
                        <th>Monto</th>
                        <th>Tipo de cuota</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>   
                        <th>Comprobante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            //agrega los resultados de la busqueda
            for ($i = 0; $i < count($cuotas); $i++) {
                //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
                $monto = $cuotas[$i]["MontoVigCuo"];
                $tipo = $cuotas[$i]["TipoCuota"];
                $fecha_inicio = $cuotas[$i]["IniVigCuo"];
                $fecha_fin = $cuotas[$i]["FinVigCuo"];
                $pdf = $cuotas[$i]["DocCuota"];

                //escribe los valores en la tabla
                $salida .= '<tr>';
                $salida .= '<td>' . $monto . '</td>';
                $salida .= '<td>' . $tipo . '</td>';
                $salida .= '<td>' . $fecha_inicio . '</td>';
                $salida .= '<td>' . $fecha_fin . '</td>';
                $salida .= '<td> <a target="_blank" href="../../controller/Comprobantes/'.$pdf.'">Abrir archivo</a></td>';
                $salida .= '<td> 
                <a href="#">Modificar</a>&nbsp;&nbsp;&nbsp
                <a href="#">Eliminar</a>
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