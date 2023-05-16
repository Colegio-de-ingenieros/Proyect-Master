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
        //pone los encabezados de la tabla de gastos
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
            header("Content-type: application/pdf");
            $tipo= $resultado[$i]["TipoGas"];
            $fecha= $resultado[$i]["FechaGas"];
            $monto = $resultado[$i]["MontoGas"];
            //$comprobante = $resultado[$i]["DocGas"];
            $comprobante = "documento";
            $idGasto=$resultado[$i]["IdGas"];
            
            $tipoAct='gasto';
            $urlDatos=$idPar."=gasto=".$idGasto;
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $tipo. '</td>';
            $salida .= '<td>' . $fecha . '</td>';
            $salida .= '<td>' . $monto. '</td>';
            $salida .= '<td> <a target="_blank" href="../../controller/comprobantes/administrativo/gastos/'.$idGasto.'.pdf">Abrir archivo</a></td>';
            $salida .= '<td>  <a href="../../view/administrativo/Modi_Gastos_Participante.html?participante='.$urlDatos.'">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="table_item__link eliminar-elemento" data-participante="' . $idPar . '" data-actividad="'.$idGasto.'" data-tipo="'.$tipoAct.'">Eliminar</a></td>';
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
        //pone los encabezados de la tabla de ingresos
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
    
            $tipoAct='ingreso';
            $urlDatos=$idPar."=ingreso=".$idIngre;
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $fecha . '</td>';
            $salida .= '<td>' . $monto. '</td>';
            $salida .= '<td> <a target="_blank" href="../../controller/comprobantes/administrativo/ingresos/'.$idIngre.'.pdf">Abrir archivo</a> </td>';
            $salida .= '<td>  <a href="../../view/administrativo/Modi_Ingresos_Participante.html?participante='.$urlDatos.'">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="table_item__link eliminar-elemento" data-participante="' . $idPar . '"data-actividad="'.$idIngre.'"  data-tipo="'.$tipoAct.'">Eliminar</a></td>';
            $salida .= '</tr>';   
        }
    } 
    else {
        $salida .= 'No se encontraron resultados';
    }
}


echo ($salida);

?>

<script src="../../controller/administrativo/js/Eliminar_Gasto_Ingreso_Confirmacion.js"></script>