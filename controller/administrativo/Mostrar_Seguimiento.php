<?php
require_once('../../model/administrativo/Mostrar_Seguimiento.php');
$objeto=new Mostrar_Seguimiento();

$salida = '';

$valTipo=$_POST["tipo"];


if($valTipo!=""){
    if ($valTipo=="curso"){
        $resultado = $objeto->buscar_cursos();
    }else if ($valTipo=="proyecto"){
        $resultado = $objeto->buscar_proyectos();
    }elseif ($valTipo=="certificacion"){
        $resultado = $objeto->buscar_certificaciones();
    }

    if (isset($_POST['consulta'])){
        $busqueda=($_POST['consulta']);
        if ($valTipo=="curso"){
            $resultado = $objeto->consul_intel_curso($busqueda);
        }else if ($valTipo=="proyecto"){
            $resultado = $objeto->consul_intel_proyecto($busqueda);
        }elseif ($valTipo=="certificacion"){
            $resultado = $objeto->consul_intel_certi($busqueda);
        }
    }

    if ($resultado == true) {
        //pone los encabezados de la tabla
        $salida .= '<table>
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                
                    <tbody>';

        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
            if ($valTipo=="curso"){
                $clave= $resultado[$i]["IdSeg"];
                $nombre = $resultado[$i]["NomCur"];
            }else if ($valTipo=="proyecto"){
                $clave= $resultado[$i]["IdSeg"];
                $nombre = $resultado[$i]["NomProyecto"];
            }elseif ($valTipo=="certificacion"){
                $clave= $resultado[$i]["IdSeg"];
                $nombre = $resultado[$i]["NomCertInt"];
            }

            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $clave . '</td>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>  <a href="#">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#">Eliminar</a></td>';
            $salida .= '</tr>';   
        }
    } 
    else {
        $salida .= 'No se encontraron resultados';
    }

} else{
    $salida .= "No se que mostrar al cargar la pagina";
}
echo $salida;

?>