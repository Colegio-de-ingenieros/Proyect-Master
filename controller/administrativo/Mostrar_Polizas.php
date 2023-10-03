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

            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $folio . '</td>';
            $salida .= '<td>' . $concepto . '</td>';
            $salida .= '<td>' . $fecha . '</td>';
            $salida .= '<td>' . $elaboro . '</td>';
            $salida .= '<td>  <a href="../../view/administrativo/Vista_Datos_Usuario.html?usuario='.$folio.'">Ver más</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="../../view/administrativo/Vista_Cursos_SocioAsociado.html?id='.$folio.'">Cursos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="../../view/administrativo/Vista_Cuotas_SocioAsociado.html?id='.$folio.'">Cuotas</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>';
            $salida .= '</tr>';  
    }
} 
else {
    $salida .= 'No se encontraron resultados';
}

echo $salida;

?>