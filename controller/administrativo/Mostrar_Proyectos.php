<?php
include_once('../../model/administrativo/Mostrar_Proyectos.php');

$salida = '';
$base = new MostrarProyectos();
$base->instancias();

//manda a hacer la busqueda
$resultado = $base->getProyectos();
$resultado1 = $base->getIniPro();
$resultado2 = $base->getFinPro();

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
                                <th>Fecha de inicio</th>
                                <th>Fecha de finalización</th>
                                <th>Monto</th>
                                <th>Objetivo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                
                    <tbody>';

        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $idp= $resultado[$i]["IdPro"];
            $nombre= $resultado[$i]["NomProyecto"];
            $inicio = $resultado[$i]["IniPro"];
            $fin = $resultado[$i]["FinPro"];
            $monto = $resultado[$i]["MontoPro"];
            $objetivo = $resultado[$i]["ObjPro"];
            

            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $inicio . '</td>';
            $salida .= '<td>' . $fin . '</td>';
            $salida .= '<td>$' . $monto . '</td>';
            $salida .= '<td>' . $objetivo . '</td>';
            $salida .= '<td>  <a href="../../controller/administrativo/Get_Proyecto.php?idp='.$idp.'">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
            <a href="#" class="table_item__link eliminar-elemento" data-idp="' . $idp . '">Eliminar</a></td>';
            $salida .= '</tr>';

            
        }
    } 

    else {
        $salida .= 'No se encontraron resultados';
    }

    $salida .= "</tbody></table>";

}
else{
    $resultado = $base->getProyectos();
    $resultado1 = $base->getIniPro();
    $resultado2 = $base->getFinPro();

    if ($resultado == true) {
        //pone los encabezados de la tabla
        $salida .= '<table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha de finalización</th>
                                <th>Monto</th>
                                <th>Objetivo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                
                    <tbody>';

        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $idp= $resultado[$i]["IdPro"];
            $nombre= $resultado[$i]["NomProyecto"];
            $inicio = $resultado1[$i]["IniPro"];
            $fin = $resultado2[$i]["FinPro"];
            $monto = $resultado[$i]["MontoPro"];
            $objetivo = $resultado[$i]["ObjPro"];
            

            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $inicio . '</td>';
            $salida .= '<td>' . $fin . '</td>';
            $salida .= '<td>$' . $monto . '</td>';
            $salida .= '<td>' . $objetivo . '</td>';
            $salida .= '<td>  <a href="../../controller/administrativo/Get_Proyecto.php?idp='.$idp.'">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
            <a href="#" class="table_item__link eliminar-elemento" data-idp="' . $idp . '">Eliminar</a></td>';
            $salida .= '</tr>';

            
        }
    } 

    else {
        $salida .= 'No se encontraron resultados';
    }

    $salida .= "</tbody></table>";

    

}

echo $salida;

?>
<script src="../../controller/administrativo/js/Eliminar_Proyectos_Confirmacion.js"></script>
