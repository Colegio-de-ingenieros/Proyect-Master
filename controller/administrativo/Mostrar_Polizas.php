<?php
require_once('../../model/administrativo/Mostrar_Polizas.php');
$objeto=new Mostrar_Polizas();
$salida = '';
$valTipo=$_POST["tipo"];
if ($valTipo==""){
    $resultado = $objeto->mostrar_Egresos();
}
if($valTipo!=""){
    if ($valTipo=="egreso"){
        $resultado = $objeto->mostrar_Egresos();
    }else if ($valTipo=="ingreso"){
        $resultado = $objeto->mostrar_Ingresos();
    }
}
if (isset($_POST['consulta'])){
    $busqueda=($_POST['consulta']);
    if ($busqueda!="ingreso" && $busqueda!="egreso"){
        if ($valTipo=="egreso"){
        $resultado = $objeto->buscar_Egresos($busqueda);
        }else if ($valTipo=="ingreso"){
            $resultado = $objeto->buscar_Ingresos($busqueda);
        }
    }
    
}
if ($resultado == true) {
    //pone los encabezados de la tabla
    $salida .= '<table>
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Tipo</th>
                            <th>Concepto general</th>
                            <th>Fecha</th>
                            <th>Elaboro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                <tbody>';

    //agrega los resultados de la busqueda
    for ($i = 0; $i < count($resultado); $i++) {
            //$auxValTipo="Curso";
            $folio= $resultado[$i]["IdPolGral"];
            $elaboro = $resultado[$i]["NomElaPol"].' '.$resultado[$i]["ApePElaPol"].' '.$resultado[$i]["ApeMElaPol"];
            $concepto = $resultado[$i]["CoceptoGral"];
            $fecha = $resultado[$i]["FechaPolGral"];
            $tipoPoliza=$resultado[$i]["SerPol"];
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $folio . '</td>';
            $salida .= '<td>' . $tipoPoliza . '</td>';
            $salida .= '<td>' . $concepto . '</td>';
            $salida .= '<td>' . $fecha . '</td>';
            $salida .= '<td>' . $elaboro . '</td>';
            $salida .= '<td>  <a href="../../controller/administrativo/Mostrar_Poliza_Individual.php?usuario='.$folio.'&tipo=' . $tipoPoliza .'&poliza='.$valTipo.'">Ver más</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="../../view/administrativo/Modi_Polizas_General.html?id='.$folio.'">Datos generales</a>&nbsp;&nbsp;
                        <a href="../../view/administrativo/Modi_Polizas_Individual.html?id='.$folio.'">Datos individuales</a>&nbsp;&nbsp;
                        </td>';
            $salida .= '</tr>';  
    }
} 
else {
    $salida .= 'No se encontraron resultados';
}

echo $salida;

?>