<?php

require_once('../../model/administrativo/Mostrar_Gastos_Ingresos.php');
$objeto=new Actividad_Seg_Tabla_Montos();

$salida = '';

$idPar=$_POST["participante"];
$tipo=$_POST["tipo"];

if ($tipo=="gastos"){
    #buscar los gastos
    if (strpos($idPar, 'P') !== false) {
        $resultado = $objeto->buscar_gastos_perso($idPar);  
    } else if(strpos($idPar, 'E') !== false) {
        $resultado = $objeto->buscar_gastos_empresa($idPar);
    } else {    
        $resultado = $objeto->buscar_gastos_instr($idPar);
    }

    if ($resultado == true) {
        //pone los encabezados de la tabla pde gastos
        $salida .= '<table>
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Comprobante</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                
                    <tbody>';
    
        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
            $tipo= $resultado[$i]["TipoGas"];
            $fecha= $resultado[$i]["FechaGas"];
            $monto = $resultado[$i]["MontoGas"];
            $comprobante = $resultado[$i]["MontoGas"];
    
            $idGasto=$resultado[$i]["IdGas"];
    
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $tipo. '</td>';
            $salida .= '<td>' . $fecha . '</td>';
            $salida .= '<td>' . $monto. '</td>';
            $salida .= '<td>' . $comprobante . '</td>';
            $salida .= '<td>  <a href="../../view/administrativo/Modi_Gastos_Participante.html?participante='.$idGasto.'">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="table_item__link eliminar-elemento" data-participante="' . $idPar . '"data-gasto="'.$idGasto.'">Eliminar</a></td>';
            $salida .= '</tr>';   
        }
    } 
    else {
        $salida .= 'No se encontraron resultados';
    }
}else{
    #buscar los ingresos
    if (strpos($idPar, 'P') !== false) {
        $resultado = $objeto->buscar_ingresos_perso($idPar);  
    } else if(strpos($idPar, 'E') !== false) {
        $resultado = $objeto->buscar_ingresos_empresa($idPar);
    } else {    
        $resultado = $objeto->buscar_ingresos_instr($idPar);
    }

    if ($resultado == true) {
        //pone los encabezados de la tabla pde gastos
        $salida .= '<table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Comprobante</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                
                    <tbody>';
    
        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
            $fecha= $resultado[$i]["FechaIngre"];
            $monto= $resultado[$i]["MontoIngre"];
            $comprobante = $resultado[$i]["MontoIngre"];
    
            $idIngre=$resultado[$i]["IdIngre"];
    
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $fecha . '</td>';
            $salida .= '<td>' . $monto. '</td>';
            $salida .= '<td>' . $comprobante . '</td>';
            $salida .= '<td>  <a href="../../view/administrativo/Modi_Ingresos_participante.html?participante='.$idIngre.'">Modifcar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="table_item__link eliminar-elemento" data-participante="' . $idPar . '"data-ingreso="'.$idIngre.'">Eliminar</a></td>';
            $salida .= '</tr>';   
        }
    } 
    else {
        $salida .= 'No se encontraron resultados';
    }
}


echo ($salida);

?>

<script src="../../controller/administrativo/js/Eliminar_Participante_Confirmacion.js"></script>